<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/css/create.css') }}">

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
        <div class="align-center">
            <form action="{{ route('store') }}" method="post">
                @csrf
                <table class="create-form">
                    <tr>
                        <th colspan="2">あみだくじ設定内容</th>
                    </tr>
                    <tr>
                        <th>
                            <span>タイトル名<br></span>
                            <span class="size_8px color_grey">※任意 20文字以内</span>
                        </th>
                        <td>
                            <input type="text" class="title" name ="title" value =""></input>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <span>くじの本数<br></span>
                            <span class="size_8px color_red">※必須 最大100の半角数字</span>
                        </th>
                        <td>
                            <input type="number" class="kuji_num" name="kuji_num" id="kuji_num">本</input>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <span>くじ詳細<br></span>
                            <span class="size_8px color_red">※必須</span>
                        </th>
                        <td>
                            <div id="create_atarikuji">
                                <table>
                                    <tr>
                                        <th>残り：</th>
                                        <td><input type="number" class="remainig_kuji" id="remainig_kuji"></input></td>
                                    </tr>
                                    <tr>
                                        <th>はずれくじの本数：</th>
                                        <td><input type="number" class="hazure_num" name="hazure_num" id="hazure_num">本</input></td>
                                    </tr>
                                    <tr>
                                        <th colspan="2"><input type="radio" class="item" name="item" value="item_create">一つずつ作成</th>
                                    </tr>
                                    <tr>
                                        <th class="description" colspan="2">　　あたりくじの種類が少ない場合はこちらがおすすめです。</th>
                                    </tr>
                                    <tr class="display_off">
                                        <th>あたりくじの種類：</th>
                                        <td><input type="number" class="" name="" id="atari_types_num">種類</input></td>
                                    </tr>
                                    <tr class="display_off">
                                        <th colspan="2">
                                            <table>
                                                <tr>
                                                    <th>あたりくじの名前</th>
                                                    <th>本数</th>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" class="" name=""></input></td>
                                                    <td><input type="number" class="" name="">本</input></td>
                                                </tr>
                                            </table>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="2"><input type="radio" class="item" name="item" value="item_create_bulk">一括作成</th>
                                    <tr>
                                        <th class="description" colspan="2">　　Excelやスプレッドシートからコピーしたデータを<br>　　貼り付けたい場合はこちらがおすすめです。</th>
                                    </tr>
                                    <hr style="border:1px dotted #000000;">
                                    <input type="button" value="閉じる">
                                    <tr class="display_on">
                                        <th colspan="2">
                                            <table>
                                                <tr>
                                                    <td><textarea class = "bulk" rows="10" name="item_bulk"></textarea></td>
                                                    <td>タブ区切りかカンマ区切りで<br>「あたりくじの名前 あたりくじの本数」<br>の順番になるように入力してください。<br>あたりくじが複数の場合は改行して同様に入力してください。<br>※Excelなどからコピーすると簡単に入力できます。</td>
                                                </tr>
                                            </table>                            
                                        </th>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>                                    
                    <tr>
                        <th rowspan="5">
                            <span>管理人パスワード<br></span>
                            <span class="size_8px color_red">※必須　半角英数字のみ</span>
                        </th>
                    </tr>
                    <tr>
                        <td>4文字以上の半角英数字で設定してください。<br>(くじの編集や結果の集計に必要になります。)</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" class="pass" name ="pass" value =""></input>
                        </td>
                    </tr>
                    <tr>
                        <td>パスワードの再確認</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" class="pass" name ="pass" value =""></input>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <span>管理人メッセージ<br></span>
                            <span class="size_8px color_grey">※任意</span>
                        </th>
                        <td>
                            <textarea class = "message" rows="10" name="manager_comment"></textarea>
                        </td>
                    </tr>
                </table>
                <input type="submit" name="submit" class="button" value="作成"/>
            </form>
        </div>
        <script src={{ asset('js/class.js') }}></script>
        <script src={{ asset('js/form_main.js') }}></script>
    </body>
</html>
