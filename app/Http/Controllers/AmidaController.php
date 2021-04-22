<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JavaScript;

class AmidaController extends Controller
{
    public function index($kuji_num)
    {
        JavaScript::put(['kuji_num' => $kuji_num, 'kuji_row' => 10]);
        return view('amidakuji');
    }

}