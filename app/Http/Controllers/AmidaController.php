<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Item;
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

    public function store(User $user, Item $item, Request $request)
    {
        $user->fill($request->all());
        $user->amida = serialize($this->setAmida($request->kuji_num, 10));
        $user->save();
        // $item->users_id = $user->id;
        // $item->item = $request->item;
        // $item->item_num = $request->item_num;
        return redirect('/'. $user->id);
    }

    public function showAmida(User $user)
    {
        JavaScript::put(['kuji_num' => $user->kuji_num, 'amida_array' => unserialize($user->amida)]);
        return view('amidakuji');
    }

    public function setAmida($kuji_num, $kuji_row)
    {
        $initial_array = [];
        $initial_array_first_row = [];
        // 最初の行はすべて0
        for ($i = 0; $i < $kuji_num; $i++){
            array_push($initial_array_first_row,0);
        }
        array_push($initial_array, $initial_array_first_row);
        // 残り行数分作成
        for ($i = 0; $i < $kuji_row - 1; $i++){
            array_push($initial_array, $this->setAmidaColumn($kuji_num));
        }
        return $initial_array;
    }

    public function setAmidaColumn($kuji_num)
    {
        $initial_array_per_row = [];
        for ($i = 0; $i < $kuji_num; $i++){
            if ($i > 0 && $initial_array_per_row[$i-1] == 1){
                $rand_num = 0;
            } else {
                $rand_num = mt_rand(0, 1);
            }
            array_push($initial_array_per_row, $rand_num);
        };
        return $initial_array_per_row;
    }

}