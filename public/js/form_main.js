'use strict';

(() => {
    const ITEMS = document.getElementsByName('item');
    const KUJI_NUM = document.getElementById('kuji_num');
    const ITEM_BULK = document.getElementById('item_bulk');
    const ATARI_TYPES_NUM = document.getElementById('atari_types_num');
    const KUJI_DETAIL_AREA = document.getElementById('kuji_detail_area');
    const ATARI_DETAIL_TABLE = document.getElementById('atari_detail_table');
    const CHECKBOX_ATARI_NAME = document.getElementById('checkbox_atari_name');
    const CLOSE_BUTTON = document.getElementById('close_button');
    const TITLE = document.getElementById('title');
    const MESSAGE = document.getElementById('message');
    const SUBMIT_BUTTON = document.getElementById('submit_button');
    let option_value = {oneeach:'item_create', bulk:'item_create_bulk'};
    let button_text = {on:'開く',off:'閉じる'};
    const HAZURE_NUM = document.getElementById('hazure_num');
    let max_length = {title:20,message:200};
    const TITLE_LENGTH = document.getElementById('title_length');
    const TITLE_MESSAGE_AREA = document.getElementById('title_message_area');
    const MESSAGE_LENGTH = document.getElementById('message_length');
    const MESSAGE_MESSAGE_AREA = document.getElementById('message_message_area');
    const ATARI_ITEMS_NAME = document.getElementById('atari_items_name');
    const ATARI_ITEMS_NUM = document.getElementById('atari_items_num');
    const NAME_RANDOM_BUTTON = document.getElementById('name_random_button'); 
    const PARTICIPANTS_RADIOBUTTON = document.getElementsByName('participant_radio');   
    const KUJINUM_LENGTH = document.getElementById('kujinum_length');
    const PARTICIPANT_NAME = document.getElementById('participant_name');
    const PARTICIPANT_TEXT_MESSAGE_AREA = document.getElementById('participant_text_message_area');
    const PARTICIPANT_NUM_MESSAGE_AREA = document.getElementById('participant_num_message_area');
    const PARTICIPANT = document.getElementById('participant');
    const PARTICIPANT_SELF = document.getElementById('participant_self');

    window.addEventListener('load', () => {
        const DISPLAY_STATUS = document.getElementsByClassName('display_status');
        let session_radiobutton = document.getElementsByClassName('session_radiobutton');
        let session_isopen = document.getElementsByClassName('session_isopen');

        if (sessionStorage.getItem('use_flg') != null && sessionStorage.getItem('use_flg')){
            for (let i = 0; i < session_radiobutton.length; i++){
                if (session_radiobutton[i].id == sessionStorage.getItem('radiobutton')){
                    session_radiobutton[i].checked = true;
                }
            }    
            let array_isopen = sessionStorage.getItem('isopen');
            array_isopen = JSON.parse(sessionStorage.getItem('isopen'));
    
            for (let i = 0; i < session_isopen.length; i++){
                session_isopen[i].dataset.isopen = array_isopen[i];
            }
    
            for (let i = 0; i < DISPLAY_STATUS.length; i++){
                if (DISPLAY_STATUS[i].dataset.isopen == 'true'){
                    Form.switchDisplayStatus(DISPLAY_STATUS[i], 'on');
                }
            }   
            TITLE_LENGTH.innerText = TITLE.value.length;
            Validation.text(max_length['title'], TITLE, TITLE_MESSAGE_AREA, TITLE_LENGTH);
            MESSAGE_LENGTH.innerText = MESSAGE.value.length;
            Validation.text(max_length['message'], MESSAGE, MESSAGE_MESSAGE_AREA, MESSAGE_LENGTH);
            ITEM_BULK.value = Bulk.conevrtArrayToBulk(ATARI_ITEMS_NAME.value.split(','), ATARI_ITEMS_NUM.value.split(','));
        }
    })

    window.addEventListener('beforeunload', function(e){
        sessionStorage.clear();
    });

    TITLE.addEventListener('change', () => {
        TITLE_LENGTH.innerText = TITLE.value.length;
        Validation.text(max_length['title'], TITLE, TITLE_MESSAGE_AREA, TITLE_LENGTH);
    })

    MESSAGE.addEventListener('change', () => {
        MESSAGE_LENGTH.innerText = MESSAGE.value.length;
        Validation.text(max_length['message'], MESSAGE, MESSAGE_MESSAGE_AREA, MESSAGE_LENGTH);
    })

    ITEM_BULK.addEventListener('keydown', (evt) => {
        if (evt.key === 'Tab') {
            evt.preventDefault();
            let TAB = '\t';
            let value = ITEM_BULK.value;
            let sPos = ITEM_BULK.selectionStart;
            let ePos = ITEM_BULK.selectionEnd;
            let result = value.slice(0, sPos) + TAB + value.slice(ePos);
            let cPos = sPos + TAB.length;
            ITEM_BULK.value = result;
            ITEM_BULK.setSelectionRange(cPos, cPos);
        }
    })

    ITEMS.forEach((ITEM) => {
        ITEM.addEventListener('click', () => {
            Form.SelectRadioButton(ITEM.value, option_value);
            Calculate.calcRemainingKuji(Form.getCheckedRadioButton(), HAZURE_NUM);
            CLOSE_BUTTON.value = button_text['off'];
        });
    });

    ATARI_TYPES_NUM.addEventListener('change', () => {
        let kuji_detail_data = KUJI_DETAIL_AREA.dataset;
        let atari_types_num = ATARI_TYPES_NUM.value;
        if (atari_types_num < 1 || atari_types_num > 25){
            ATARI_TYPES_NUM.value = kuji_detail_data.atari_after;
            kuji_detail_data.atari_before = kuji_detail_data.atari_after;
        } else {
            kuji_detail_data.atari_before = kuji_detail_data.atari_after;
            kuji_detail_data.atari_after = atari_types_num;
        }
        let loop_cnt = Number(kuji_detail_data.atari_after) - Number(kuji_detail_data.atari_before);
        if (loop_cnt < 0){
            Oneeach.deleteAtariDetailField(-1 * loop_cnt, ATARI_DETAIL_TABLE);
        } else if (loop_cnt > 0) {
            Oneeach.addAtariDetailField(Number(kuji_detail_data.atari_before), loop_cnt, ATARI_DETAIL_TABLE);        
        }
        if (!CHECKBOX_ATARI_NAME.checked){
            Oneeach.nameAtariItem();
        }
        Calculate.calcRemainingKuji(Form.getCheckedRadioButton(), HAZURE_NUM);
    })

    KUJI_NUM.addEventListener('change', () => {
        if (KUJI_NUM.value < 2){
            KUJI_NUM.value = 2;
        } else if (KUJI_NUM.value > 25){
            KUJI_NUM.value = 25;
        }
        Calculate.calcRemainingKuji(Form.getCheckedRadioButton(), HAZURE_NUM);
        KUJINUM_LENGTH.innerText = KUJI_NUM.value;
        if (PARTICIPANT_NAME.value != ''){
            let array_participant = Participant.separateParticipantTextToArray(PARTICIPANT_NAME.value);
            Validation.participantNum(array_participant.length, KUJI_NUM.value, PARTICIPANT_TEXT_MESSAGE_AREA);
            Validation.nameText(array_participant, PARTICIPANT_NUM_MESSAGE_AREA, 10);    
        }
    })

    ITEM_BULK.addEventListener('change', () => {
        let array_items = Bulk.convertBulkToArray(ITEM_BULK.value);
        array_items = Bulk.connectArrayWithKey(array_items);
        array_items = Bulk.separateItemFromNameAndNum(array_items);    
        ATARI_ITEMS_NAME.value = array_items.array_items_name;
        ATARI_ITEMS_NUM.value = array_items.array_items_num;
        Calculate.calcRemainingKuji(Form.getCheckedRadioButton(), HAZURE_NUM);
    })

    KUJI_DETAIL_AREA.addEventListener('change', () => {
        let radio_button_type = Form.getCheckedRadioButton();
        if (radio_button_type == 'oneeach'){
            const ATARIS_NUM = document.getElementsByName('atari_num[]');
            ATARIS_NUM.forEach((ATARI_NUM) => {
                ATARI_NUM.addEventListener('change', () => {
                    if (ATARI_NUM.value < 0){
                        ATARI_NUM.value = 0;
                    } else if (ATARI_NUM.value > 24){
                        ATARI_NUM.value = 24;
                    }
                    Calculate.calcRemainingKuji(radio_button_type, HAZURE_NUM);
                }, true);
            });
        }
    }, true)

    CHECKBOX_ATARI_NAME.addEventListener('click', () => {
        if (CHECKBOX_ATARI_NAME.checked){
            if (confirm('現在設定されているあたりくじの名前をクリアします。\nよろしいですか？')){
                Oneeach.clearAtariName();
            } else {
                CHECKBOX_ATARI_NAME.checked = false;
            }
        } else {
            if (confirm('現在設定されているあたりくじの名前をクリアして新しい名前を付与します。\nよろしいですか？')){
                Oneeach.nameAtariItem();
            } else {
                CHECKBOX_ATARI_NAME.checked = true;
            }
        }
    })

    CLOSE_BUTTON.addEventListener('click', () => {
        let checked_radio_button = Form.getCheckedRadioButton();
        const ATARI_DETAIL = document.getElementsByClassName('atari_detail_row');
        const OPTION_BULK = document.getElementById('option_bulk');
        const KEY_NAME = Object.keys(button_text).filter( (key) => {
            return button_text[key] === CLOSE_BUTTON.value;
        });

        if (CLOSE_BUTTON.value == button_text['on']){
            CLOSE_BUTTON.value = button_text['off'];
        } else {
            CLOSE_BUTTON.value = button_text['on'];
        }

        if (checked_radio_button == 'oneeach'){
            for (let i = 0; i < ATARI_DETAIL.length; i++){
                Form.switchDisplayStatus(ATARI_DETAIL[i], KEY_NAME[0]);
                // ATARI_DETAIL[i].dataset.isopen = true;
            }
        } else if (checked_radio_button == 'bulk'){
            Form.switchDisplayStatus(OPTION_BULK, KEY_NAME[0]);
            // OPTION_BULK.dataset.isopen = true;
        }
        KUJI_DETAIL_AREA.dataset.isopen = true;
    })

    SUBMIT_BUTTON.addEventListener('click', () => {
        const FORM_CREATE = document.getElementById('form_create');
        const ATARIITEM_NAME_MESSAGE_AREA = document.getElementById('atariitem_name_message_area');
        let atari_text = document.getElementsByClassName('atari_text');
        const ATARIITEM_NUM_MESSAGE_AREA = document.getElementById('atariitem_num_message_area');
        let atari_num = document.getElementsByClassName('atari_num');

        const ATARIITEM_NAME_BULK_MESSAGE_AREA = document.getElementById('atariitem_name_bulk_message_area');
        let ataris_text = document.getElementById('atari_items_name');
        const ATARIITEM_NUM_BULK_MESSAGE_AREA = document.getElementById('atariitem_num_bulk_message_area');
        let ataris_num = document.getElementById('atari_items_num');
        let array_participant = Participant.separateParticipantTextToArray(PARTICIPANT_NAME.value);

        let target_array_name = [];
        let target_array_num = [];
 
        let flg = [];
        flg.push(Validation.text(max_length['title'], TITLE, TITLE_MESSAGE_AREA, TITLE_LENGTH));
        flg.push(Validation.text(max_length['message'], MESSAGE, MESSAGE_MESSAGE_AREA, MESSAGE_LENGTH));
        flg.push(Validation.radiobutton());
        flg.push(Validation.kujiNum(KUJI_NUM));
        flg.push(Validation.hazureNum(HAZURE_NUM));
        if (!PARTICIPANT_SELF.checked){
            flg.push(Validation.participantNum(array_participant.length, KUJI_NUM.value, PARTICIPANT_TEXT_MESSAGE_AREA));
            flg.push(Validation.nameText(array_participant, PARTICIPANT_NUM_MESSAGE_AREA, 10));    
        }
        if (Form.getCheckedRadioButton() == 'oneeach'){
            flg.push(Validation.atariTypesNum(ATARI_TYPES_NUM));
            for (let i = 0; i < atari_text.length; i++){
                target_array_name.push(atari_text[i].value);
                target_array_num.push(atari_num[i].value);
            }
            flg.push(Validation.nameText(target_array_name, ATARIITEM_NAME_MESSAGE_AREA, 10));
            flg.push(Validation.atariNum(target_array_num, ATARIITEM_NUM_MESSAGE_AREA));
        } else if (Form.getCheckedRadioButton() == 'bulk'){
            target_array_name = ataris_text.value.split(',');
            target_array_num = ataris_num.value.split(',');
            flg.push(Validation.nameText(target_array_name, ATARIITEM_NAME_BULK_MESSAGE_AREA, 10));
            flg.push(Validation.atariNum(target_array_num, ATARIITEM_NUM_BULK_MESSAGE_AREA));
        }
        if (!flg.includes(false)){
            Form.storeDataTemporarily();
            sessionStorage.setItem('use_flg', true);    
            FORM_CREATE.submit();
        } else {
            alert('入力内容に不備があります。再度入力内容をご確認ください。');
        }
    })

    PARTICIPANTS_RADIOBUTTON.forEach((participant_radiobutton) => {
        const OPTION_PARTICIPANT = document.getElementById('option_participant');
        participant_radiobutton.addEventListener('click', (evt) => {
            if (evt.target.value == 'self'){
                Form.switchDisplayStatus(OPTION_PARTICIPANT, 'off')
            } else {
                Form.switchDisplayStatus(OPTION_PARTICIPANT, 'on')
            }
        });
    });


    NAME_RANDOM_BUTTON.addEventListener('click', ()=>{
        let participant_name = document.getElementById('participant_name');
        if (confirm('名前をランダムで生成します。よろしいですか？\n※現在入力されている名前はクリアされます。')){
            participant_name.value ='';
            participant_name.value = Participant.nameParticipantNameRandom(Number(KUJI_NUM.value));
            let array_participant = Participant.separateParticipantTextToArray(PARTICIPANT_NAME.value);
            PARTICIPANT.value = array_participant;
            Validation.participantNum(array_participant.length, KUJI_NUM.value, PARTICIPANT_TEXT_MESSAGE_AREA);
            Validation.nameText(array_participant, PARTICIPANT_NUM_MESSAGE_AREA, 10);    
        } 
    })

    PARTICIPANT_NAME.addEventListener('change', () => {
        let array_participant = Participant.separateParticipantTextToArray(PARTICIPANT_NAME.value);
        PARTICIPANT.value = array_participant;
        Validation.participantNum(array_participant.length, KUJI_NUM.value, PARTICIPANT_TEXT_MESSAGE_AREA);
        Validation.nameText(array_participant, PARTICIPANT_NUM_MESSAGE_AREA, 10);
    })

})()