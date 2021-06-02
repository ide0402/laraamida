
class Form {

    static SelectRadioButton(select_option, option_value)
    {
        const KUJI_DETAIL_AREA = document.getElementById('kuji_detail_area');
        const OPTION_BULK = document.getElementById('option_bulk');
        const ATARI_DETAIL = document.getElementsByClassName('atari_detail_row');
        // let option_value = {oneeach:'item_create', bulk:'item_create_bulk'};
        this.switchDisplayStatus(KUJI_DETAIL_AREA, 'on');
        KUJI_DETAIL_AREA.dataset.isopen = true;
        switch (select_option){
            case option_value['oneeach']:
                this.switchDisplayStatus(OPTION_BULK, 'off');
                OPTION_BULK.dataset.isopen = false;
                for (let i = 0; i < ATARI_DETAIL.length; i++){
                    this.switchDisplayStatus(ATARI_DETAIL[i], 'on');
                    ATARI_DETAIL[i].dataset.isopen = true;
                }
                break;
            case option_value['bulk']:
                this.switchDisplayStatus(OPTION_BULK, 'on');
                OPTION_BULK.dataset.isopen = true;
                for (let i = 0; i < ATARI_DETAIL.length; i++){
                    this.switchDisplayStatus(ATARI_DETAIL[i], 'off');
                    ATARI_DETAIL[i].dataset.isopen = false;
                }
                break;
        }
    }

    static getDisplayStatusClassName(status)
    {
        let display_status_class_name = {on:'display_on', off:'display_off'};
        switch (status){
            case 'off':
                return display_status_class_name['off'];
                break;
        }
    }

    static getCheckedRadioButton()
    {
        if (document.getElementById('item_create').checked){
            return 'oneeach';
        }
        if (document.getElementById('item_create_bulk').checked){
            return 'bulk';
        }
        return '';
    }

    static switchDisplayStatus(element, status)
    {
        switch (status){
            case 'on':
                element.classList.remove(this.getDisplayStatusClassName('off'));
                break;
            case 'off':
                element.classList.add(this.getDisplayStatusClassName('off'));
                break;
        }
    }

    static storeDataTemporarily()
    {
        let session_radiobutton = document.getElementsByClassName('session_radiobutton');
        let session_isopen = document.getElementsByClassName('session_isopen');
        let isopen_flg = [];

        for (let i = 0; i < session_radiobutton.length; i++){
            if (session_radiobutton[i].checked){
                sessionStorage.setItem('radiobutton', session_radiobutton[i].id);    
            }
        }
        for (let i = 0; i < session_isopen.length; i++){
            isopen_flg.push(session_isopen[i].dataset.isopen);
        }
        sessionStorage.setItem('isopen', JSON.stringify(isopen_flg));
    }
}

class Validation {

    static text(max_length,target_field, message_field, molecule_field)
    {
        if (target_field.value.length > max_length){
            message_field.innerText = this.message('text_length');
            molecule_field.classList.add('molecule_red');
            molecule_field.classList.remove('molecule_black');
            return false;
        } else {
            message_field.innerText = '';
            molecule_field.classList.add('molecule_black');
            molecule_field.classList.remove('molecule_red');
            return true;
        }
    }

    static radiobutton()
    {
        const OPTION_MESSAGE_AREA = document.getElementById('option_message_area');
        if (Form.getCheckedRadioButton() == ''){
            OPTION_MESSAGE_AREA.innerText = this.message('option_button');
            return false;
        } else {
            OPTION_MESSAGE_AREA.innerText = '';
            return true;
        }
    }

    static kujiNum(KUJI_NUM){
        const KUJINUM_MESSAGE_AREA = document.getElementById('kujinum_message_area');
        let kuji_num_value = Number(KUJI_NUM.value);
        if (!(1 < kuji_num_value && kuji_num_value <= 25 && Number.isInteger(kuji_num_value))){
            KUJINUM_MESSAGE_AREA.innerText = this.message('kuji_num');
            return false;
        } else {
            KUJINUM_MESSAGE_AREA.innerText = '';
            return true;
        }
    }

    static hazureNum(HAZURE_NUM){
        const HAZURENUM_MESSAGE_AREA = document.getElementById('hazurenum_message_area');        
        if (!(0 <= HAZURE_NUM.value && HAZURE_NUM.value <= 24 && Number.isInteger(HAZURE_NUM.value))){
            HAZURENUM_MESSAGE_AREA.innerText = this.message('hazure_num');
            return false;
        } else {
            HAZURENUM_MESSAGE_AREA.innerText = '';
            return true;
        }
    }

    static atariTypesNum(ATARI_TYPES_NUM)
    {
        const ATARI_TYPES_NUM_MESSAGE_AREA = document.getElementById('atari_types_num_message_area');
        let atari_types_num_value = Number(ATARI_TYPES_NUM.value);
        if (!(1 <= atari_types_num_value && atari_types_num_value <= 25 && Number.isInteger(atari_types_num_value))){
            ATARI_TYPES_NUM_MESSAGE_AREA.innerText = this.message('atari_types_num');
            return false;
        } else {
            ATARI_TYPES_NUM_MESSAGE_AREA.innerText = '';
            return true;
        }
    }

    static atariText(target_field_value, message_field)
    {
        let flg = true
        for (let i = 0; i < target_field_value.length; i++){
            if (target_field_value[i] == '' || target_field_value[i].length > 10){
                message_field.innerText = this.message('atari_text');
                flg = false;
                break;
            } else {
                message_field.innerText = '';
            }
        }
        return flg;
    }

    static atariNum(target_field_value, message_field)
    {
        let flg = true;
        for (let i = 0; i < target_field_value.length; i++){
            console.log(target_field_value[i] != '');
            if (!(Number(target_field_value[i]) >= 0 && Number(target_field_value[i]) <= 24 && target_field_value[i] != '' && Number.isInteger(Number(target_field_value[i])))){
                message_field.innerText = this.message('atari_num');
                flg = false;
                break;           
            } else {
                message_field.innerText = '';
            }
        }
        return flg;
    }

    static message(err_type)
    {
        switch (err_type){
            case 'text_length':
                return '※文字数がオーバーしています。';
                break;
            case 'option_button':
                return '※いずれかにチェックをいれてください。';
                break;
            case 'kuji_num':
                return '※くじの本数は2本以上25本以下の整数で設定してください。';
                break;
            case 'hazure_num':
                return '※はずれくじの本数が0本以上24本以下の整数になるように\n　くじ本数・あたりくじの本数で調整してください。';
                break;
            case 'atari_types_num':
                return '※あたりくじの種類は1以上25以下の整数で設定してください。';
                break;
            case 'atari_text':
                return '※あたりくじの名前は10文字以下で設定してください。\n　(空欄不可)';
                break;
            case 'atari_num':
                return '※あたりくじの本数は0以上24以下の整数で設定してください。';
                break;                
        }
    }
}

class Calculate {

    static calcRemainingKuji(radio_option = '', HAZURE_NUM)
    {
        const HAZURE = document.getElementById('hazure');
        let kuji_num = document.getElementById('kuji_num').value;
        let atari_total_num = 0;
        let atari_items_num;
        
        switch (radio_option){
            case 'bulk':
                atari_items_num = document.getElementById('atari_items_num').value;
                if (atari_items_num != ''){
                    atari_total_num = this.calcAtariTotalNumByBulk(atari_items_num.split(','));
                }
                break;
            case 'oneeach':
                atari_items_num = document.getElementsByName('atari_num[]');
                atari_total_num = this.calcAtariTotalNumByOneEach(atari_items_num);
                break;
        }
        HAZURE_NUM.value = kuji_num - atari_total_num;
        HAZURE.value = HAZURE_NUM.value;
        HAZURE_NUM.innerText = HAZURE_NUM.value + '本'
        if (HAZURE_NUM.value < 0){
            HAZURE_NUM.classList.add('text-red');
        } else {
            HAZURE_NUM.classList.remove('text-red');
        }
    }

    static calcAtariTotalNumByBulk(atari_items_num)
    {
        let atari_total_num = 0;
        atari_items_num.forEach((atari_item_num) => {
            atari_total_num = atari_total_num + Number(atari_item_num);
        })
        return atari_total_num;
    }

    static calcAtariTotalNumByOneEach(atari_items_num_elm)
    {
        let atari_total_num = 0;
        atari_items_num_elm.forEach((atari_item_num) => {
            atari_total_num = atari_total_num + Number(atari_item_num.value);
        })
        return atari_total_num;
    }

}

class Bulk {

    static convertBulkToArray(item_bulk)
    {
        let array_items = [];
        let new_array_items = [];
        item_bulk.replace(/\r\n/g, '\n').replace(/\r/g, '\n');
        item_bulk.replace(/\t/g, ',');
        array_items = item_bulk.split('\n');
        array_items = array_items.filter(elm => elm !== '');
        array_items.forEach((array_item) => {
            new_array_items.push(array_item.split(','));
        });
        return new_array_items;
    }

    static conevrtArrayToBulk(atari_items_name, atari_items_num)
    {
        let item_bulk = '';
        item_bulk = atari_items_name[0] + ',' + atari_items_num[0];
        for (let i = 1; i < atari_items_name.length; i++){
            console.log('a');
            item_bulk = item_bulk + '\n' + atari_items_name[i] + ',' + atari_items_num[i];
        }
        return item_bulk;
    }

    static connectArrayWithKey(array_items)
    {
        const KEYS = ['item','item_num'];
        let atari_items = [];
        array_items.forEach((array_item) => {
            atari_items.push(Object.assign(
                ...KEYS.map((key, i) => ({ [key]: array_item[i] }))
            ));
        });
        return atari_items;
    }

    static separateItemFromNameAndNum(array_items)
    {
        let array_items_name = [];
        let array_items_num = [];
        array_items.forEach((array_item) => {
            array_items_name.push(array_item.item);
            array_items_num.push(array_item.item_num);
        });
        return {"array_items_name":array_items_name,　"array_items_num":array_items_num};
    }
}

class Oneeach {

    static addAtariDetailField(atari_num_before, loop_cnt, ATARI_DETAIL_TABLE)
    {
        for (let i = 0; i < loop_cnt; i++){
            let atari_row = ATARI_DETAIL_TABLE.insertRow();
            let new_field_num = atari_num_before + i;
            // atari_row.classList.add(Form.getDisplayStatusClassName('on'));
            atari_row.classList.add('atari_detail_row');
            atari_row.id = 'atari_row_' + new_field_num;
            this.addCellAndInputTag(atari_row, 'text', 'atari_name[]', new_field_num);
            this.addCellAndInputTag(atari_row, 'number', 'atari_num[]', new_field_num);
        }
    }

    static addCellAndInputTag(atari_row, input_type, input_name, new_field_num)
    {
        let atari_field = atari_row.insertCell();
        atari_field.id = 'atari_' + input_type + '_' + new_field_num;
        let input_tag = document.createElement('input');
        input_tag.type = input_type;
        input_tag.name = input_name;
        switch (input_type){
            case 'text':
                input_tag.className = 'atari_text';
                break;
            case 'number':
                input_tag.className = 'atari_num';
                input_tag.value = 1;
                break;
        }
        atari_field.appendChild(input_tag);
    }

    static deleteAtariDetailField(loop_cnt, KUJI_DETAIL_TABLE)
    {
        for (let i = 0; i < loop_cnt; i++){
            KUJI_DETAIL_TABLE.deleteRow(-1);
        }
    }

    static nameAtariItem()
    {
        let atari_text = document.getElementsByClassName('atari_text');
        let atari_list = [
            '○','●','☆','★','◎','◇','◆','□','■','△',
            '▲','▽','▼','＠','§','∀','∂','∇','♯','♭',
            '♪','α','β','γ','δ','ε','ζ','η','θ','ι',
            'κ','λ','μ','ν','ξ','ο','π','ρ','σ','τ',
            'υ','φ','χ','ψ','ω','а','б','в','г','д',
            '☆☆','★★','○○','●●','◎◎','◇◇','◆◆','□□','■■','△△',
            '▲▲','▽▽','▼▼','＠＠','§§','∀∀','∂∂','∇∇','♯♯','♭♭',
            '♪♪','αα','ββ','γγ','δδ','εε','ζζ','ηη','θθ','ιι',
            'κκ','λλ','μμ','νν','ξξ','οο','ππ','ρρ','σσ','ττ',
            'υυ','φφ','χχ','ψψ','ωω','аа','бб','вв','гг','дд'
        ];
        for (let i = 0; i < atari_text.length; i++){
            atari_text[i].value = atari_list[i];
        }
    }

    static clearAtariName()
    {
        let atari_text = document.getElementsByClassName('atari_text');        
        for (let i = 0; i < atari_text.length; i++){
            atari_text[i].value = '';
        }
    }

}