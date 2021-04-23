<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use JavaScript;

class AmidaController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function create()
    {
        return view('create');
    }

    public function store(User $user, Request $request)
    {
        $user->fill($request->all())->save();
        return redirect('/'. $user->id);
    }

    public function showAmida(User $user)
    {
        JavaScript::put(['kuji_num' => $user->kuji_num, 'kuji_row' => 10]);
        return view('amidakuji');
    }

}