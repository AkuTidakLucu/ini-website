<?php

namespace App\Controllers;

class JobMatchingController extends BaseController
{
    public function index()
    {
        $lang = session()->get('lang') ?? 'id';
        
        $data = [
            'title' => ($lang == 'id') ? 'Smart Job Matching' : 'Smart Job Matching',
            'meta_description' => ($lang == 'id') ? 'Sistem pintar yang menghubungkan Anda dengan peluang kerja terbaik berdasarkan skill dan pengalaman.' : 'Smart system connecting you with the best job opportunities based on skills and experience.',
            'lang' => $lang
        ];

        return view('job_matching', $data);
    }
}