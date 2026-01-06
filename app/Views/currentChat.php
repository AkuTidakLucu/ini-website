<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://code.responsivevoice.org/responsivevoice.js?key=YT8cCBCv"></script>
    <link href='https://cdn.boxicons.com/3.0.6/fonts/basic/boxicons.min.css' rel='stylesheet'>
</head>

<style>
    /* RESET */
    * {
        box-sizing: border-box;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    body {
        background: #f4f6f8;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        height: 100dvh;
        overflow: hidden;
    }

    /* CHAT WRAPPER */
    .chat-container {
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    #chatBody {
        flex: 1;
        overflow-y: auto;
        padding-bottom: 90px;
        /* prevent overlap with input */
    }

    /* BUBBLE BASE */
    .bubble {
        max-width: 90%;
        padding: 12px 16px;
        border-radius: 16px;
        line-height: 1.5;
        font-size: 14px;
        word-wrap: break-word;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    }

    /* USER */
    .bubble.user {
        align-self: flex-end;
        background: #2563eb;
        color: #ffffff;
        border-bottom-right-radius: 4px;
    }

    /* BOT */
    .bubble.bot {
        align-self: flex-start;
        background: #ffffff;
        color: #1f2937;
        border-bottom-left-radius: 4px;
    }

    /* MARKDOWN INSIDE BOT */
    .bubble.bot p {
        margin: 0 0 8px;
    }

    .bubble.bot p:last-child {
        margin-bottom: 0;
    }

    .bubble.bot ul {
        padding-left: 18px;
        margin: 6px 0;
    }

    .bubble.bot li {
        margin-bottom: 4px;
    }

    .bubble.bot a {
        color: #2563eb;
        text-decoration: underline;
        word-break: break-word;
    }

    .bubble.bot a:hover {
        text-decoration: none;
    }

    /* INPUT AREA */
    .chat-input {
        background: #ffffff;
        border-top: 1px solid #e5e7eb;
        padding: 10px;
        display: flex;
        gap: 8px;
    }

    .chat-input textarea {
        flex: 1;
        resize: none;
        padding: 12px 14px;
        font-size: 14px;
        border-radius: 10px;
        border: 1px solid #d1d5db;
        outline: none;
    }

    .chat-input button {
        padding: 0 14px;
        border-radius: 10px;
        border: none;
        background: #2563eb;
        color: #ffffff;
        font-size: 14px;
        cursor: pointer;
    }

    .chat-input button:hover {
        background: #1e40af;
    }

    /* Navbar */
    .navbar {
        display: flex;
        background-color: #d1d5db;
        align-items: center;
        justify-content: space-between;
        padding: 0 15px;
    }

    .navbar .call-mode {
        font-size: 2em;
        cursor: pointer;
    }

    /* mode call */
    .mode-call {
        position: fixed;
        width: 100%;
        height: 100%;
        z-index: 2;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: #1f2937;
        display: none;
    }

    .mode-call .img-bot {
        width: 150px;
        aspect-ratio: 1/1;
        border-radius: 50%;
        overflow: hidden;
    }

    .mode-call .img-bot.onSpeak {
        animation: speakOn 1s ease-in-out infinite;
    }

    @keyframes speakOn {
        0% {
            transform: scale(1);
        }

        20% {
            transform: scale(1.04);
        }

        40% {
            transform: scale(0.98);
        }

        60% {
            transform: scale(1.06);
        }

        80% {
            transform: scale(1.02);
        }

        100% {
            transform: scale(1);
        }
    }


    .mode-call .img-bot img {
        height: 100%;
        width: 100%;
        object-fit: cover;
    }

    .end_call {
        width: 50px;
        aspect-ratio: 1/1;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        background-color: #de0000ff;
        position: absolute;
        bottom: 80px;
    }

    /* TABLET */
    @media (min-width: 768px) {
        .chat-container {
            padding: 24px 12%;
        }

        .navbar {
            padding: 0 12%;
        }

        .bubble {
            max-width: 75%;
            font-size: 15px;
        }
    }

    /* DESKTOP */
    @media (min-width: 1024px) {
        .chat-container {
            padding: 25px 20%;
        }

        .navbar {
            padding: 0 45px;
        }

        .bubble {
            max-width: 65%;
            font-size: 15px;
        }
    }

    /* LARGE DESKTOP */
    @media (min-width: 1440px) {
        .chat-container {
            padding: 25px 25%;
        }

        .bubble {
            max-width: 60%;
        }
    }
</style>

<?php

use League\CommonMark\CommonMarkConverter;

$converter = new CommonMarkConverter([
    'renderer' => [
        'soft_break' => "<br />\n",
    ],
]);
?>

<body>
    <div class="mode-call hold_me">
        <div class="img-bot">
            <img src="<?= base_url('assets/img/bot-image.jpg') ?>" alt="">
        </div>
        <div class="end_call">
            <i class='bx  bxs-phone'></i>
        </div>
    </div>

    <div class="navbar">
        <h1>Simulasi Interview</h1>
        <div class="call-mode calling_me">
            <i class='bx  bxs-phone'></i>
        </div>
    </div>

    <div class="chat-container" id="chatBody">
        <?php if (count($result) > 0): ?>
            <?php foreach ($result as $msg): ?>
                <div class="bubble <?= strtolower($msg['role']) ?>">
                    <?= $msg['role'] === 'BOT'
                        ? $converter->convert($msg['text'])
                        : nl2br(htmlspecialchars($msg['text'])) ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <form class="chat-input" action="/api/v1/send/<?= $id ?>/user" method="post">
        <textarea name="prompt" id="prompt" rows="1" maxlength="500" placeholder="Tulis pesan..."></textarea>
        <button class="send-btn" type="submit">Send</button>
    </form>

    <?php if (!empty($triggerAI)): ?>
        <script>
            const sendBtn = document.querySelector(".send-btn")
            sendBtn.disabled = true;

            setTimeout(() => {
                window.location.href = "/api/v1/send/<?= $id ?>/bot";
            }, 50);
        </script>
    <?php endif; ?>

    <script>
        const textarea = document.getElementById('prompt');
        const form = textarea.closest('form');

        const isMobile = /Android|iPhone|iPad|iPod/i.test(navigator.userAgent);

        textarea.addEventListener('keydown', function(e) {
            if (!isMobile && e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                form.submit();
            }
        });

        let speak;
        let recognition;
        let call_mode = localStorage.getItem('isCall');;
        let isListening = false;

        function checkBrowserSupport() {
            if (!('webkitSpeechRecognition' in window) && !('SpeechRecognition' in window)) {
                alert('Browser Anda tidak mendukung Speech Recognition. Coba gunakan Chrome atau Edge.');
                return false;
            }
            return true;
        }

        function initRecognition() {
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
            recognition = new SpeechRecognition();

            recognition.continuous = true;
            recognition.interimResults = true;
            recognition.lang = 'id-ID'; // Bahasa Indonesia

            recognition.onstart = function() {
                isListening = true;
                console.log("listening")
            };

            recognition.onresult = function(event) {
                let interimTranscript = '';
                let finalTranscript = '';

                for (let i = event.resultIndex; i < event.results.length; i++) {
                    const transcript = event.results[i][0].transcript;

                    if (event.results[i].isFinal) {
                        finalTranscript += transcript + ' ';
                    } else {
                        interimTranscript += transcript;
                    }
                }

                // Update final result
                if (finalTranscript) {
                    const textarea = document.getElementById('prompt');
                    textarea.value += finalTranscript;
                    textarea.scrollTop = textarea.scrollHeight;
                }
            };

            recognition.onerror = function(event) {
                console.error('Error:', event.error);

                let errorMsg = 'Error: ';
                switch (event.error) {
                    case 'no-speech':
                        errorMsg = 'Tidak terdeteksi suara';
                        break;
                    case 'audio-capture':
                        errorMsg = 'Tidak ada microphone';
                        break;
                    case 'not-allowed':
                        errorMsg = 'Akses microphone ditolak';
                        break;
                }

                console.log(errorMsg)
                stopListening();
            };

            recognition.onend = function() {
                stopListening();
            };
        }

        function startListening() {
            if (!checkBrowserSupport()) return;

            if (!recognition) {
                initRecognition();
            }

            try {
                recognition.start();
            } catch (error) {
                console.error('Error starting:', error);
                alert('Gagal memulai. Pastikan microphone tersedia dan diizinkan.');
            }
        }

        // Stop listening
        function stopListening() {
            if (recognition && isListening) {
                recognition.stop();
                isListening = false;
                console.log('stop listening');
            }
        }

        window.addEventListener('DOMContentLoaded', () => {
            call_mode = localStorage.getItem('isCall') == "true";
            const bubbles = document.querySelectorAll('.bubble');
            const onHoldCall = document.querySelector('.hold_me');
            const callMode = document.querySelector('.mode-call');
            const callingMe = document.querySelector('.calling_me');
            const endCall = document.querySelector('.end_call');
            const imgBot = document.querySelector('.img-bot');

            callMode.style.display = call_mode ? "flex" : "none";

            <?php if (!empty($speak)): ?>
                call_mode = localStorage.getItem('isCall') == "true";
                setTimeout(() => {
                    if (call_mode) {
                        speak();
                    }
                }, 100)
            <?php endif; ?>

            const MAX_HEIGHT = 160; // px

            textarea.addEventListener('input', () => {
                textarea.style.height = 'auto';

                const newHeight = Math.min(textarea.scrollHeight, MAX_HEIGHT);
                textarea.style.height = newHeight + 'px';

                textarea.style.overflowY =
                    textarea.scrollHeight > MAX_HEIGHT ? 'auto' : 'hidden';
            });

            if (!bubbles.length) return;

            const lastBubble = bubbles[bubbles.length - 1];
            const container = document.getElementById('chatBody'); // scroll container

            const offset = 40; // px (atur sesuai kebutuhan)

            const top =
                lastBubble.offsetTop -
                container.offsetTop -
                offset;

            container.scrollTo({
                top,
                behavior: 'smooth'
            });

            container.querySelectorAll("a").forEach(a => a.setAttribute("target", "_blank"));

            let isSpeaking = false;

            speak = () => {
                if (isListening) return;

                imgBot.classList.add('onSpeak');

                const text = lastBubble.classList.contains('bot') ?
                    lastBubble.textContent.replace(/\n{2,}/g, '\n').trim() :
                    '';

                isSpeaking = true;
                responsiveVoice.speak(text, "Indonesian Female", {
                    rate: 1.2,
                    pitch: 1,
                    volume: 1,
                    onend: () => {
                        isSpeaking = false;
                        imgBot.classList.remove('onSpeak');
                    }
                });
            }

            callingMe.onclick = () => {
                callMode.style.display = "flex";

                localStorage.setItem('isCall', "true")
            }

            onHoldCall.addEventListener('pointerdown', function(e) {
                let goals = e.target
                if (isSpeaking) {
                    responsiveVoice.cancel();
                    isSpeaking = false;
                }

                if (goals == onHoldCall || goals == onHoldCall.querySelector("img")) {
                    startListening();
                } else if (goals == endCall || goals.closest('.end_call') !== null) {
                    callMode.style.display = "none";
                    localStorage.setItem('isCall', "false")
                    imgBot.classList.remove('onSpeak');
                }
            });

            onHoldCall.addEventListener('pointerup', (e) => {
                let goals = e.target
                if (goals == onHoldCall || goals == onHoldCall.querySelector("img")) {
                    stopListening();
                    setTimeout(() => {
                        form.submit();

                        console.log('mengirim pesan');
                    }, 500);

                    localStorage.setItem('isCall', "true")
                }
            });

            // onHoldCall.addEventListener('pointerleave', (e) => {
            //     let goals = e.target
            //     console.log(goals);
            //     if (goals == onHoldCall) {
            //         stopListening();
            //     } else {
            //         setTimeout(() => {
            //             form.submit();
            //         }, 500);
            //     }
            // });

        });
    </script>

</body>

</html>