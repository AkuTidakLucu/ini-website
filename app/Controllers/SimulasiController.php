<?php

namespace App\Controllers;

class SimulasiController extends BaseController
{
    public function index()
    {
        $lang = session()->get('lang') ?? 'id';
        
        $data = [
            'title' => ($lang == 'id') ? 'Simulasi Wawancara Kerja' : 'Job Interview Simulation',
            'meta_description' => ($lang == 'id') ? 'Persiapkan diri menghadapi HRD dengan simulasi wawancara kerja interaktif.' : 'Prepare yourself for HR interviews with interactive job interview simulations.',
            'lang' => $lang
        ];

        return view('simulasi_wawancara', $data);
    }
}