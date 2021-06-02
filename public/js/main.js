'use strict';

(() => {
    const AMIDDA_ICON = document.getElementById('amida_start');
    const FORM_PLAYER_NAME = document.getElementById('form_player_name');
    const COL_NUM = document.getElementById('col_num');
    const PLAYER_NAME = document.getElementById('player_name');
    const PUBLISH_STATUS = document.getElementById('publish_status');
    const DESCRIPTION = document.getElementById('description');
    const COPY_BUTTON = document.getElementById('copy_button');

    window.addEventListener('DOMContentLoaded', () => {
        Setting.convertArrayToDOM(kuji_num,amida_array);
        if (publish_flg){
            PUBLISH_STATUS.innerText = '公開中';
            PUBLISH_STATUS.classList.remove('text_red');
            DESCRIPTION.innerText = '全てのくじが選択されました。\n名前をクリックすると個別の結果を確認できます。\n結果をまとめて集計する場合は、\n下記「結果を集計」をクリックしてください。';
        } else {
            PUBLISH_STATUS.innerText = '未公開';
            PUBLISH_STATUS.classList.add('text_red');
            DESCRIPTION.innerText = 'すべてのくじが選択されると、自動で公開されます。';
        }
    })
    
    if (publish_flg){
        Setting.setAmidaGoal();
        AMIDDA_ICON.addEventListener('click', (evt) => {
            if (evt.target.id.match(/player/)){
                let table_icon_id = document.getElementById(evt.target.id).id;
                Amida.initialize();
                Amida.changeColorBlackToRed(amida_array, table_icon_id);    
            }
        })
    } else {
        AMIDDA_ICON.addEventListener('click', (evt) => {
            if (evt.target.id.match(/icon/)) {
                if (confirm('選択します。よろしいですか？\n※選択後に変更はできません。')){
                    let name = prompt('表示名を入力してください。(最大10文字)');
                    if (name != null && Validation.playerName(name)){
                        PLAYER_NAME.value = name;
                        COL_NUM.value = evt.target.id.replace(/[^0-9]/g, '');
                        FORM_PLAYER_NAME.submit();
                    }
                }
            } else if (evt.target.id.match(/player/)) {
                alert('その場所はすでに選択済みのため選択できません。');
            }
        })    
    }

    COPY_BUTTON.addEventListener('click', ()=> {
        const INPUT_URL = document.getElementById('input_url');
        let range = document.createRange();
        range.selectNode(INPUT_URL);
        window.getSelection().addRange(range);
        document.execCommand('copy');
        alert('※コピーしました。');
    })

})()