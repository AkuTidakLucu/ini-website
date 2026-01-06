<?php

namespace App\Controllers;

class PositionFitController extends BaseController
{
    public function index()
    {
        $lang = session()->get('lang') ?? 'id';
        
        $data = [
            'title' => ($lang == 'id') ? 'Position Fit Evaluation' : 'Position Fit Evaluation',
            'meta_description' => ($lang == 'id') ? 'Evaluasi kesesuaian posisi untuk memahami seberapa baik Anda cocok dengan peran yang ditawarkan.' : 'Position fit evaluation to understand how well you match with the offered role.',
            'lang' => $lang
        ];

        return view('position_fit_evaluation', $data);
    }
}