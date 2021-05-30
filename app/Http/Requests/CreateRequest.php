<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title'          => 'nullable|max:20',
            'kuji_num'    => 'required|integer|min:2|max:25',
            'hazure_num'   => 'required|integer|min:0|max:24',
            'manager_comment' => 'nullable|max:2000',

            //ラジオボタンが一個ずつの場合必須
            'atari_name'    => 'required_if:item,item_create|array',
            'atari_name.*'  => 'max:2|min:1',
            'atari_num'    => 'required_if:item,item_create|array',
            'atari_num.*'  => 'Numeric|integer|max:25|min:0',

            //ラジオボタンがbulkの場合必須
            'atari_name'    => 'required_if:item,item_create_bulk',
            'atari_name.*'  => 'required|max:25|min:0',
            'atari_num'    => 'required_if:item,item_create_bulk',
            'atari_num.*'  => 'required|max:25|min:0',            
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'atari_items_name' => explode(",", $this->atari_items_name),
            'atari_items_num'  => explode(",", $this->atari_items_num),
        ]);
    }
}
