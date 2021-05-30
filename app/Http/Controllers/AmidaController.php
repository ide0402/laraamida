<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateRequest;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use App\Models\Player;
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
        if (!is_null($request->title)){
            $user->title = $request->title;
        }
        if (!is_null($request->manager_comment)){
            $user->manager_comment = $request->manager_comment;        
        }
        $user->manager_comment = $request->manager_comment;
        $user->kuji_num = $request->kuji_num;
        $user->amida = serialize($this->setAmida($request->kuji_num, 10));
        if ($request->item == 'item_create_bulk'){
            $atari = $this->setRandomAtariArray(explode(",", $request->atari_items_name), explode(",", $request->atari_items_num), $request->hazure_num);
        } elseif ($request->item == 'item_create'){
            $atari = $this->setRandomAtariArray($request->atari_name, $request->atari_num, $request->hazure_num);
        }
        $user->atari = serialize($atari);
        $user->save();
        return redirect('/'. $user->id);
    }

    public function showAmida(User $user)
    {
        if (is_null($user->player)){
            JavaScript::put([
                'title' => $user->title,
                'manager_comment' => $user->manager_comment,
                'atari_array' => unserialize($user->atari),
                'kuji_num' => $user->kuji_num, 
                'amida_array' => unserialize($user->amida), 
                'player_field' => '',
                'publish_flg' => 0,
            ]);                
        } else {
            JavaScript::put([
                'title' => $user->title,
                'manager_comment' => $user->manager_comment,
                'atari_array' => unserialize($user->atari),
                'kuji_num' => $user->kuji_num, 
                'amida_array' => unserialize($user->amida), 
                'player_field' => unserialize($user->player->player_field),
                'publish_flg' => $user->player->publish_flg,
            ]); 
        }
        return view('amidakuji')->with([
            'user' => $user,
        ]);
    }

    public function setAmida($kuji_num, $kuji_row)
    {
        $initial_array = [];
        $initial_array_first_row = [];
        // 最初の行はすべて0
        for ($i = 0; $i < $kuji_num - 1; $i++){
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
        for ($i = 0; $i < $kuji_num - 1; $i++){
            if ($i > 0 && $initial_array_per_row[$i-1] == 1){
                $rand_num = 0;
            } else {
                $rand_num = mt_rand(0, 1);
            }
            array_push($initial_array_per_row, $rand_num);
        };
        return $initial_array_per_row;
    }

    public function setRandomAtariArray($atari_item_array, $atari_num_array, $hazure_num)
    {
        $atari_array = array();
        for ($i = 0; $i < $hazure_num; $i++){
            $atari_array[] = '';
        }
        for ($i = 0; $i < count($atari_item_array); $i++){
            for ($j = 0; $j < $atari_num_array[$i]; $j++){
                $atari_array[] = $atari_item_array[$i];
            }
        }
        shuffle($atari_array);
        return $atari_array;
    }

    public function storePlayerName(Request $request, User $user)
    {
        if (is_null($user->player)){
            $player_array = array();
            for ($i = 0; $i < $user->kuji_num; $i++){
                $player_array[] = '';
            }
            $player_array[$request->col_num] = $request->player_name;
            $user->player()->create(['player_field' => serialize($player_array)]);
        } else {
            $player_array = unserialize($user->player->player_field);
            $player_array[$request->col_num] = $request->player_name;
            $user->player->fill([
                'player_field' => serialize($player_array),
                'publish_flg' => $this->checkPlayerNameFilled($player_array),
            ])->save();
        }
        return redirect('/'. $user->id);
    }

    public function aggregateResult(User $user)
    {
        $atari_array = unserialize($user->atari);
        $amida_array = unserialize($user->amida);
        $player_array = unserialize($user->player->player_field);
        $result_per_player = [];
        for ($i = 0; $i < count($player_array); $i++){
            $goal_col = $this->getGoalCol($i, $amida_array);
            array_push($result_per_player, [
                'player_name' => $player_array[$i], 
                'goal_result' => $atari_array[$goal_col],
            ]);
        }
        $result_per_atari = $this->convertAmidaResultPerAtari(array_unique($atari_array), $result_per_player);
        return view('summary')->with(['results' => $result_per_atari, 'user' => $user]);
    }

    private function checkPlayerNameFilled($player_array)
    {
        foreach($player_array as $player){
            if ($player == ''){
                return 0;
            }
        }
        return 1;
    }

    private function getGoalCol($present_col, $amida_array){
        $i = 0;
        while ($i < count($amida_array)){
            if ($present_col < count($amida_array[$i]) && $amida_array[$i][$present_col]){
                $present_col = $present_col + 1;
            } else if ($present_col - 1 >= 0 && $amida_array[$i][$present_col - 1]){
                $present_col = $present_col - 1;
            }
            $i++;
        }
        return $present_col;
    }

    private function convertAmidaResultPerAtari($unique_atari_array, $results_per_player)
    {
        $result_per_atari = [];
        foreach($unique_atari_array as $atari_name){
            $player_name = '';
            foreach ($results_per_player as $result_per_player){
                if ($result_per_player['goal_result'] == $atari_name){
                    if ($player_name == ''){
                        $player_name = $result_per_player['player_name'];
                    } else {
                        $player_name = $player_name . ',' . $result_per_player['player_name'];
                    }
                }
            }
            array_push($result_per_atari,['atari' => $atari_name, 'player' => $player_name]);
        }
        return $result_per_atari;
    }

}