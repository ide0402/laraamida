<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use App\Models\Player;

class PlayerRequest extends FormRequest
{
    public function rules()
    {
        if (is_null($this->user->player)){
            $player_field = [];
        } else {
            $player_field = unserialize($this->user->player->player_field);
        }

        return [
            'player_name'          => 'required|max:10|not_in:'.implode(',', $player_field),
            'col_num' => 'required|integer|min:0|max:'.$this->user->kuji_num,
        ];
    }

    public function messages()
    {
        return [
            'player_name.required'    => '表示名が未入力です',
            'player_name.max'    => '表示名は10文字以内で入力してください。',
            'player_name.not_in'    => 'その名前は別の方が使用しています。',
            'col_num.required' => '予期せぬ箇所が選択されています。',
            'col_num.integer' => '予期せぬ箇所が選択されています。',
            'col_num.min' => '予期せぬ箇所が選択されています。',
            'col_num.max' => '予期せぬ箇所が選択されています。',
        ];
    }
}
