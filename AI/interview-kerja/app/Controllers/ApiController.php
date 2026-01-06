<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ChatModel;
use CodeIgniter\HTTP\ResponseInterface;
use GeminiAPI\Client;
use GeminiAPI\Enums\HarmBlockThreshold;
use GeminiAPI\Enums\HarmCategory;
use GeminiAPI\GenerationConfig;
use GeminiAPI\Resources\ModelName;
use GeminiAPI\Resources\Parts\TextPart;
use GeminiAPI\SafetySetting;
use League\CommonMark\CommonMarkConverter;

use function PHPUnit\Framework\containsEqual;

class ApiController extends BaseController
{
    private array $pertanyaan_umum_prioritas;
    private array $knowladge;

    public function __construct()
    {
        session();

        $json_pertanyaan = file_get_contents(APPPATH . 'Knowladge/data.json');
        $this->pertanyaan_umum_prioritas = json_decode($json_pertanyaan, true)['pertanyaan_umum_prioritas'];

        // $modelData = new ModelData();
        // $this->pertanyaan_umum_prioritas = json_decode($modelData->findAll(), true);

        $prompt = file_get_contents(APPPATH . 'Knowladge/prompt.json');
        $this->knowladge = json_decode($prompt, true);

        // $modelPrompt = new ModelPrompt();
        // $this->knowladge = json_decode($modelPrompt->findAll(), true);
    }

    function findKeywordIndex(string $text, array $arr): ?int
    {
        foreach ($arr as $i => $group) {
            foreach ($group as $word) {
                if (stripos($text, $word) !== false) {
                    return $i;
                }
            }
        }
        return null;
    }

    function findKeywordTrigger(string $text, array $arr): ?int
    {
        foreach ($arr as $word) {
            if (stripos($text, $word) !== false) {
                return true;
            }
        }
        return false;
    }

    public function index($id)
    {
        $chat = new ChatModel();
        $chatData = $chat->find($id);

        if (!$chatData || empty($chatData['chat'])) {
            $messages = [];
        } else {
            $messages = json_decode($chatData['chat'], true);
            $messages = is_array($messages) ? $messages : [];
        }

        return view('currentChat', ['result' => $messages, 'id' => $chatData['id'], 'triggerAI' => $this->request->getGet('ai'), 'speak' => session()->getFlashdata('speak')]);
    }

    public function send($id = null)
    {
        $apiKey = env('GEMINI_API_KEY');

        $knowladge = $this->knowladge;

        $chat = new ChatModel();

        if ($id !== null) {
            $chatData = $chat->find($id);
            $data = json_decode($chatData['chat'], true);
        } else {
            $data = [];
        }

        $data = is_array($data) ? $data : [];

        $context = $data;

        if (!empty($context)) {
            array_pop($context);
        }

        $context = array_slice($context, -10);

        $contextText = "";

        foreach ($context as $msg) {
            $contextText .= "{$msg['role']}: {$msg['text']}\n";
        }

        $lastChat = $data[count($data) - 1]['role'] == "USER" ? $data[count($data) - 1]['text'] : null;

        $isSuccess = false;
        $text = null;

        $generationConfig = (new GenerationConfig())
            ->withCandidateCount(1)
            ->withTemperature(0.5)
            ->withTopK(40)
            ->withTopP(0.95)
            ->withStopSequences(['STOP']);

        $index  = session()->get('q_index');
        $systemInstruction = $knowladge["systemInsctruction"]["interview"];

        $mode = $index > count($this->pertanyaan_umum_prioritas)
            ? 'interview_ai'
            : 'interview_review';

        $aturan = implode("\n", $knowladge["aturan"][$mode]["list_aturan"]);

        $aturan_global = implode("\n", $knowladge["aturan"]["global"]["list_aturan"]);
        $alur = implode("\n", $knowladge["aturan"][$mode]["alur"]);

        $fullPrompt = <<<PROMPT
            [SYSTEM INSTRUCTION]
            $systemInstruction

            ATURAN WAJIB:
            $aturan_global
            $aturan

            ALUR WAJIB PERCAKAPAN:
            $alur

            [CONTEXT]
            $contextText

            Pertanyaan Baru:
            [PROMPT]
            $lastChat
            PROMPT;

        $textBot_v2 = $knowladge['response_static']['begin']['interview'];

        $oot = $knowladge['response_static']['outoftopic']['interview'];
        $outoftopic = <<<OOT
$oot
OOT;

        $continue = false;
        $nextIndex = 0;

        try {
            if ($lastChat !== null) {
                if (count($data) > 3) {
                    $client = new Client($apiKey);

                    $response = $client->generativeModel(ModelName::GEMINI_2_5_FLASH_LITE)
                        ->withAddedSafetySetting(
                            new SafetySetting(
                                HarmCategory::HARM_CATEGORY_HARASSMENT,
                                HarmBlockThreshold::BLOCK_MEDIUM_AND_ABOVE
                            )
                        )
                        ->withAddedSafetySetting(
                            new SafetySetting(
                                HarmCategory::HARM_CATEGORY_HATE_SPEECH,
                                HarmBlockThreshold::BLOCK_LOW_AND_ABOVE
                            )
                        )
                        ->withAddedSafetySetting(
                            new SafetySetting(
                                HarmCategory::HARM_CATEGORY_SEXUALLY_EXPLICIT,
                                HarmBlockThreshold::BLOCK_ONLY_HIGH
                            )
                        )
                        ->withAddedSafetySetting(
                            new SafetySetting(
                                HarmCategory::HARM_CATEGORY_DANGEROUS_CONTENT,
                                HarmBlockThreshold::BLOCK_LOW_AND_ABOVE
                            )
                        )
                        ->withGenerationConfig($generationConfig)
                        ->generateContent(
                            new TextPart($fullPrompt)
                        );

                    $text = $response->text();
                    if ($mode == "interview_review") {
                        $nextIndex = $index + 1;
                    }
                } else {
                    $text = count($data) > 2 ? $this->pertanyaan_umum_prioritas[$index] : $textBot_v2;
                }
            } else {
                return redirect()->back();
            }
        } catch (\Exception $e) {
            $text = "Model sedang sibuk, silahkan coba lagi nanti.";

            log_message('debug', 'BOT Error' . print_r("Terjadi kesalahan API: " . $e->getMessage(), true));
        }

        $data[] = [
            'role' => 'BOT',
            'text' => (
                $nextIndex > 0
                && $mode === 'interview_review'
                && isset($this->pertanyaan_umum_prioritas[$nextIndex])
            ) ? $text . "\n\nPertanyaan selanjutnya:\n**" . $this->pertanyaan_umum_prioritas[$nextIndex] . "**" : $text
        ];

        $jsonChat = json_encode($data, JSON_UNESCAPED_UNICODE);

        if ($id !== null && isset($chatData)) {
            $chat->update($chatData['id'], ['chat' => $jsonChat]);
            $chatId = $chatData['id'];
        } else {
            $chatId = $chat->insert(['chat' => $jsonChat], true);
        }

        session()->set('q_index', $nextIndex);

        return redirect()->to('/c/' . $chatId)->with('speak', 'ongoing');
    }

    public function newChat()
    {
        $chat = new ChatModel();

        $data = [];
        $data[] = [
            'role' => 'USER',
            'text' => 'Halo'
        ];

        $jsonChat = json_encode($data, JSON_UNESCAPED_UNICODE);

        $chatId = $chat->insert(['chat' => $jsonChat], true);
        session()->set('q_index', 0);

        return redirect()->to('/c/' . $chatId . '?ai=onMessage');
    }

    public function sendAfterPrompt($id = null)
    {
        $prompt = trim($this->request->getPost('prompt'));
        if ($prompt === '') {
            return redirect()->back();
        }

        $chat = new ChatModel();

        if ($id !== null) {
            $chatData = $chat->find($id);
            $data = json_decode($chatData['chat'], true);
        } else {
            $data = [];
        }

        $data = is_array($data) ? $data : [];
        $data = array_slice($data, -10);

        $data[] = [
            'role' => 'USER',
            'text' => $prompt
        ];

        $jsonChat = json_encode($data, JSON_UNESCAPED_UNICODE);

        if ($id !== null && isset($chatData)) {
            $chat->update($chatData['id'], ['chat' => $jsonChat]);
            $chatId = $chatData['id'];
        } else {
            $chatId = $chat->insert(['chat' => $jsonChat], true);
        }

        return redirect()->to('/c/' . $chatId . '?ai=onMessage');
    }

    public function stoped()
    {
        return view('test');
    }
}
