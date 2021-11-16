<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'HOME',
            'active' => 'home'
        ];
        return view('pages/home', $data);
    }
}
