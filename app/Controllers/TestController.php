<?php

namespace App\Controllers;

class TestController extends BaseController
{
    public function minatBakat()
    {
        $lang = session()->get('lang') ?? 'id';
        
        // Akses webprofile dari layout
        $webprofile = service('webprofile');
        
        $data = [
            'title' => ($lang == 'id') ? 'Test Minat & Bakat' : 'Interest & Talent Test',
            'meta_description' => ($lang == 'id') ? 'Temukan potensi diri melalui test minat dan bakat psikologi. Identifikasi kecenderungan karir yang sesuai dengan kepribadian Anda.' : 'Discover your potential through psychological interest and talent tests. Identify career tendencies that match your personality.',
            'lang' => $lang,
            'webprofile' => $webprofile
        ];

        return view('test_minat_bakat', $data);
    }
}