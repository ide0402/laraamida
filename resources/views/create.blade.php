<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>あみだ</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/CSS/create.css') }}">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>
        <div class="align_center">

            <div class="space"></div>
            <form action="{{ route('store') }}" method="post" id="form_create" name="form_create">
                @csrf
                <div>あみだくじ設定内容</div>
                @foreach ($errors->all() as $error)
                <div class="error">{{ $error }}</div>
                @endforeach
                @foreach ($errors->get('atari_num') as $messages)
                    @foreach ($messages as $message)
                <div class="error">{{ $message }}</div>
                    @endforeach
                @endforeach
                <div class="validation_message align_left" id="validation_message"></div>
                <table class="create-form">
                    <tr><th>タイトル名</th></tr>
                    <tr>
                        <td>
                            <div class="margin_left_5px">20文字以内で設定してください。(任意)</div>
                            <div id="title_message_area" class="text-red"></div>
                            <input type="text" class="title" name ="title" value="{{ old('title', '') }}" id="title">
                            <div class="count_num">
                                <span id="title_length" class="molecule_black">0</span>
                                <span>/20</span>
                            </div>
                        </td>
                    </tr>
                    <tr><th>くじ詳細<span class="size_8px color_red">※</span></th></tr>
                    <tr>
                        <td>
                            <div id="option_message_area" class="text-red"></div>
                            <input type="radio" id="item_create" class="item session_radiobutton" name="item" value="item_create">一つずつ作成
                            <div class="description">あたりくじの種類が少ない場合はこちらがおすすめです。</div>
                            <input type="radio" id="item_create_bulk" class="item session_radiobutton" name="item" value="item_create_bulk">一括作成
                            <div class="description">Excelやスプレッドシートからコピーしたデータを<br>貼り付けたい場合はこちらがおすすめです。</div>
                            <div id="kuji_detail_area" class="display_status kuji_detail_area display_off session_isopen" data-atari_before="1" data-atari_after="1" data-isopen="false">
                                <hr style="border:1px dotted #000000; margin:5px; ">
                                <div class="margin_left_5px">
                                    <div id="kujinum_message_area" class="text-red"></div>
                                    <span>くじの本数</span>
                                    <input type="number" class="kuji_num" name="kuji_num" id="kuji_num" min="2" max="25" value="{{ old('kuji_num', '2') }}">本
                                    <span class="size_8px color_red">※ 最大25</span>
                                </div>
                                <div class="margin_left_5px">
                                    <div id="hazurenum_message_area" class="text-red"></div>
                                    <span>はずれくじの本数：</span>
                                    <span class="hazure_num" id="hazure_num">{{ old('hazure_num', '1') }}本</span>
                                    <div class="description">くじ本数・あたりくじの本数から自動で算出されます。<br>あみだくじの中では空白で表示されます。</div>
                                </div>
                                <div class="display_status margin_left_5px atari_detail_row display_off session_isopen" data-isopen="false">
                                    <div id="atari_types_num_message_area" class="text-red"></div>
                                    <span>あたりくじの種類：</span>
                                    <input type="number" class="atari_types_num" name="atari_types_num" id="atari_types_num" min="1" max="25" value="{{ old('atari_types_num', '1') }}">種類
                                    <span class="size_8px color_red">※</span>
                                    <div class="description">1以上25以下の整数を入力してください。<br>入力内容によって下記のあたりくじ詳細の欄が増減します。</div>
                                </div>
                                <div class="align_center margin_bottom_5px"><span><br><input type="button" value="閉じる" id="close_button" class="button button--shadow"></span></div>
                                <div class="display_status margin_left_20px atari_detail_row display_off session_isopen" data-isopen="false">
                                    <span>＜＜あたりくじ詳細＞＞</span>
                                    <div id="atariitem_name_message_area" class="text-red"></div>
                                    <div id="atariitem_num_message_area" class="text-red"></div>
                                </div>
                                <div class="display_status margin_left_20px atari_detail_row display_off session_isopen" data-isopen="false">
                                    <input type="checkbox" id="checkbox_atari_name">あたりくじの名前を自分で作成
                                    <div class="description">現在、あたりくじの名前は自動で設定されています。<br>自分で設定したい場合は下記にチェックをいれてください。</div>
                                    <div class="description">チェックを入れると現在入力されているあたりくじの名前の値がクリアされます。</div>
                                    <div class="description">自分で設定する場合は、10文字以内で入力してください。(空欄不可)</div>
                                </div>
                                <div class="display_status margin_left_20px atari_detail_row display_off session_isopen" data-isopen="false">
                                    <div class="space20"></div>
                                    <table class="atari_detail_table" id="atari_detail_table">
                                        <thead>
                                            <tr>
                                                <th class="atari_text_head margin_left_20px">
                                                    <span>あたりくじの名前</span>
                                                    <span class="size_8px color_red">※</span>
                                                </th>
                                                <th class="atari_num_head">
                                                    <span>本数</span>
                                                    <span class="size_8px color_red">※</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @empty (old('atari_name'))
                                            <tr class="atari_detail_row" id="atari_row_0">
                                                <td id="atari_text_0"><input type="text" name="atari_name[]" class="atari_text" value="○"></td>
                                                <td id="atari_number_0"><input type="number" name="atari_num[]" class="atari_num" value="1"></td>
                                            </tr>
                                            @else
                                            @for ($i = 0; $i < count(old('atari_name')); $i++)
                                            <tr class="atari_detail_row" id="{{ 'atari_row_' . $i }}">
                                                <td id="{{ 'atari_text_' . $i }}"><input type="text" name="atari_name[]" class="atari_text" value="{{ old('atari_name.'.$i) }}"></td>
                                                <td id="{{ 'atari_number_' . $i }}"><input type="number" name="atari_num[]" class="atari_num" value="{{ old('atari_num.'.$i) }}"></td>
                                            </tr>
                                            @endfor
                                            @endempty
                                        </tbody>
                                    </table>
                                    <div class="space20"></div>
                                </div>
                                <div id="option_bulk" class="display_status display_off session_isopen" data-isopen="false">
                                    <table class="item_bulk_table">
                                        <tr>
                                            <td colspan="2">
                                                <div class="margin_left_5px align_center">
                                                    <span>--------------------------------- あたりくじ一括入力フィールド ---------------------------------</span>
                                                </div>
                                                <div class="margin_left_5px">
                                                    <div id="atariitem_name_bulk_message_area" class="text-red"></div>
                                                    <div id="atariitem_num_bulk_message_area" class="text-red"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><textarea id="item_bulk" class="bulk" rows="10" name="item_bulk"></textarea></td>
                                            <td>
                                                <div class="bulk_description">
                                                    <div>※入力方法</div>
                                                    <div>「あたりくじの名前,あたりくじの本数」</div>
                                                    <div>の順番になるように左の枠に入力してください。</div>
                                                    <div>あたりくじが複数ある場合は</div>
                                                    <div>改行して同様に入力してください。</div>
                                                    <div>※エクセルからのペーストでも同様に入力できます。</div>
                                                    <div><入力例:直接入力する場合></div>
                                                    <img src="images/example_oneeach.png" class="message_icon">
                                                    <div><入力例:エクセルからペーストする場合></div>
                                                    <img src="images/example_bulk.png" class="message_icon">
                                                    <div>　上の図のような形でコピーして左の枠にペーストしてください。</div>
                                                    <div><br>※上記の例では大吉が3本・中吉が5本作成されます。</div>
                                                    <div>　はずれくじの本数はくじ本数によって変動します。</div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>                           
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- update -->
                    <tr><th>参加者の参加方法<span class="size_8px color_red">※</span></th></tr>
                    <tr>
                        <td>
                            <div id="option_message_area" class="text-red"></div>
                            <input type="radio" id="participant_self" class="item session_radiobutton" name="participant_radio" value="self" checked>名前もくじも参加者に選んでもらう場合
                            <div class="description">各参加者が自分でくじの場所を選択や名前を入力してもらう形になります。</div>
                            <input type="radio" id="participant_kujiauto" class="item session_radiobutton" name="participant_radio" value="kuji_auto">くじのみ参加者に選んでもらう場合
                            <div class="description">参加者の名前のリストを作成者(あなた)が用意。<br>参加者は、用意された名前のリストから名前を選択肢、くじの場所も自分で選んでもらう形になります。<br>(名前のリストはコンピュータがランダムで作成することも出来ます。)</div>
                            <input type="radio" id="participant_auto" class="item session_radiobutton" name="participant_radio" value="auto">特に参加者がいない場合
                            <div class="description">名前のリストを作成者(あなた)が用意。作成した名前の場所もランダムで配置されます。<br>(名前のリストはコンピュータがランダムで作成することも出来ます。)<br>すぐにあみだくじの結果を確認することができます。</div>

                            <div id="option_participant" class="display_status display_off session_isopen" data-isopen="false">
                                <table class="participant_table">
                                    <tr>
                                        <td colspan="2">
                                            <div class="margin_left_5px align_center">
                                                <span>----------------------------------------------------------------------------------------------------</span>
                                            </div>
                                            <div class="margin_left_5px">
                                                <div id="participant_text_message_area" class="text-red"></div>
                                                <div id="participant_num_message_area" class="text-red"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <textarea id="participant_name" class="bulk" rows="10" name="participant_name"></textarea>
                                            <div class="count_num">
                                                <span id="participant_length" class="molecule_black">0</span>
                                                <span>/</span>
                                                <span id="kujinum_length" class="denominator">2</span>
                                            </div>
                                            <!-- <input type="button" value="ランダムに名前を生成"> -->
                                        </td>
                                        <td rowspan="2">
                                            <div class="participant_username_description">
                                                <div>※改行区切りで名前を入力してください。<br>　(外部に公開されますので、個人を特定できる名前の使用はお控えください。)</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr><td id="button_align_center"><input type="button" id="name_random_button" class="button" value="ランダムに名前を生成"></td></tr>
                                </table>                           
                            </div>

                        </td>
                    </tr>
                    <!-- end update -->


                    <tr><th>参加者へのメッセージ</th></tr>
                    <tr>
                        <td>
                            <div class="margin_left_5px">200文字以内で設定してください。(任意)</div>
                            <div id="message_message_area" class="text-red"></div>
                            <textarea class="message" rows="10" name="manager_comment" id="message" value="">{{ old('manager_comment', '') }}</textarea>
                            <div class="count_num">
                                <span id="message_length" class="molecule_black">0</span>
                                <span>/200</span>
                            </div>
                        </td>
                    </tr>
                </table>
                <input type="hidden" name="hazure_num" id="hazure" value="{{ old('hazure_num', '') }}">
                <input type="hidden" name="atari_items_name" id="atari_items_name" value="{{ old('atari_items_name', '') }}">
                <input type="hidden" name="atari_items_num" id="atari_items_num" value="{{ old('atari_items_num', '') }}">
                <input type="hidden" name="participant" id="participant" value="{{ old('participant', '') }}">
                <div class="space"></div> 
                <input type="button" name="submit_button" class="button button--shadow" value="あたりくじを作成する" id="submit_button"/>
            </form>
            <div class="space"></div>
            <div><a href ="{{ route('top') }}" class="link margin20">TOPに戻る</a></div>
        </div>
        <script src={{ asset('js/form_class.js') }}></script>
        <script src={{ asset('js/form_main.js') }}></script>
    </body>
</html>
