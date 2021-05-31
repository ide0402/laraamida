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
            'atari_types_num' => 'required_if:item,item_create|integer|min:1|max:25',
            //ラジオボタンが一個ずつの場合必須
            'atari_name'    => 'required_if:item,item_create|array',
            'atari_name.*'  => 'max:10|min:1',
            'atari_num'    => 'required_if:item,item_create|array',
            'atari_num.*'  => 'integer|max:24|min:0',

            //ラジオボタンがbulkの場合必須
            'atari_items_name'    => 'required_if:item,item_create_bulk|array',
            'atari_items_name.*'  => 'max:10|min:1',
            'atari_items_num'    => 'required_if:item,item_create_bulk|array',
            'atari_items_num.*'  => 'integer|max:24|min:0',            
        ];
    }

    public function messages()
    {
        return [
            'title.max' => 'タイトルは20文字以内で設定してください。',
            'manager_comment.max' => '参加者へのメッセージは2000文字以内で設定してください。',
            'kuji_num.required'    => 'くじの本数を設定してください。',
            'kuji_num.integer'    => 'くじの本数は整数で設定してください。',
            'kuji_num.min'    => 'くじの本数は2本以上で設定してください。',
            'kuji_num.max'    => 'くじの本数は25本以下で設定してください。',
            'hazure_num.required'    => 'くじの本数かあたりくじの本数に未入力箇所があります。',
            'hazure_num.integer'    => 'くじの本数とあたりくじの本数は整数で設定してください。',
            'hazure_num.min'    => 'はずれくじの本数が2本以上になるようにくじの本数とあたりくじの本数で調整してください。',
            'hazure_num.max'    => 'はずれくじの本数が24本以下になるようにくじの本数とあたりくじの本数で調整してください。',
            'atari_types_num.required_if'    => '「一つずつ作成」にチェックを入れている場合は、あたりくじの種類を設定してください。',
            'atari_types_num.integer'    => 'あたりくじの種類は整数で設定してください。',
            'atari_types_num.min'    => 'あたりくじの種類は1以上の整数を設定してください。',
            'atari_types_num_num.max'    => 'あたりくじの種類は25以下の整数を設定してください。',
            'atari_name.required_if'    => '「一つずつ作成」にチェックを入れている場合は、あたりくじの名前を最低一つは設定してください。',
            'atari_name.*.required'    => 'あたりくじの名前は空白不可です。',
            'atari_name.*.min'    => 'あたりくじの名前は1文字以上で設定してください。',
            'atari_name.*.max'    => 'あたりくじの名前は10文字以下で設定してください。',
            'atari_num.required_if'    => '「一つずつ作成」にチェックを入れている場合は、あたりくじの本数を最低一つは設定してください。',
            'atari_num.*.required'    => 'あたりくじの本数は空白不可です。',
            'atari_num.*.integer'    => 'あたりくじの本数は整数で設定してください。',
            'atari_num.*.min'    => 'あたりくじの本数は0以上の整数で設定してください。',
            'atari_num.*.max'    => 'あたりくじの本数は24以下の整数で設定してください。',
            'atari_items_name.required_if'    => '「一括作成」にチェックを入れている場合は、あたりくじの名前を最低一つは設定してください。',
            'atari_items_name.*.required'    => 'あたりくじの名前は空白不可です。',
            'atari_items_name.*.min'    => 'あたりくじの名前は1文字以上で設定してください。',
            'atari_items_name.*.max'    => 'あたりくじの名前は10文字以下で設定してください。',
            'atari_items_num.required_if'    => '「一括作成」にチェックを入れている場合は、あたりくじの本数を最低一つは設定してください。',
            'atari_items_num.*.required'    => 'あたりくじの本数は空白不可です。',
            'atari_items_num.*.integer'    => 'あたりくじの本数は整数で設定してください。',
            'atari_items_num.*.min'    => 'あたりくじの本数は0以上の整数で設定してください。',
            'atari_items_num.*.max'    => 'あたりくじの本数は24以下の整数で設定してください。',

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
