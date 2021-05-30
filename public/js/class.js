class Setting {

    static convertArrayToDOM(kuji_num,initial_array)
    {
        const TABLE_AMIDA = document.getElementById('amida_table');
        const CELL_CLASSNAME_BLACK = 'top-black';
        
        this.setAmidaStart(kuji_num);
        for (let i = 0; i < initial_array.length; i++){
            let table_row = TABLE_AMIDA.insertRow(-1);
            table_row.id = 'row' + i;
            for (let j = 0; j < initial_array[i].length; j++){
                let table_row_cell = table_row.insertCell(j);
                table_row_cell.id = 'row' + i + 'col' + j;
                table_row_cell.className = 'amida_cell';
                if (initial_array[i][j]){
                    table_row_cell.classList.add(CELL_CLASSNAME_BLACK);
                }
            } 
        }
    }

    static setAmidaStart(kuji_num)
    {
        const TABLE_ICON = document.getElementById('amida_start');
        let table_icon_row = TABLE_ICON.insertRow(-1);
        for (let i = 0; i < kuji_num; i++){
            let table_icon_cell = table_icon_row.insertCell(i);
            table_icon_cell.id = 'cell_col' + i;
            const TABLE_ICON_CELL = document.getElementById(table_icon_cell.id);
            if (player_field != '' && player_field[i] != ''){
                this.fillPlayerName(TABLE_ICON_CELL, i);  
            } else {
                this.insertImg(TABLE_ICON_CELL, i);
            }
        }
    }

    static fillPlayerName(TABLE_ICON_CELL, col_num)
    {
        let div = document.createElement('div');
        div.id = 'player_' + col_num;
        div.className = 'player';
        div.innerText = player_field[col_num];
        TABLE_ICON_CELL.appendChild(div);
    }

    static insertImg(TABLE_ICON_CELL, col_num)
    { 
        // let img_icon = document.createElement('img');
        // img_icon.src = 'images/icon.png';
        // img_icon.id = 'icon_' + col_num;
        // img_icon.className = 'icon';

        let img_icon = document.createElement('div');
        img_icon.src = 'images/icon.png';
        img_icon.id = 'icon_' + col_num;
        img_icon.className = 'icon';
        img_icon.innerText = '選択';

        TABLE_ICON_CELL.appendChild(img_icon);
    }

    static setAmidaGoal()
    {
        const TABLE_ICON = document.getElementById('amida_goal');
        let table_icon_row = TABLE_ICON.insertRow(-1);
        for (let i = 0; i < kuji_num; i++){
            let table_icon_cell = table_icon_row.insertCell(i);
            table_icon_cell.id = 'bottom_cell_col' + i;
            const TABLE_ICON_CELL = document.getElementById(table_icon_cell.id);
            let div = document.createElement('div');
            div.id = 'bottom_' + i;
            div.className = 'bottom';
            div.innerText = atari_array[i];
            TABLE_ICON_CELL.appendChild(div);    
        }
    }

    static aggregateResult()
    {

    }
}

class Amida {

    static initialize()
    {
        let amida_cell = document.getElementsByClassName('amida_cell');
        amida_cell = Array.from(amida_cell);
        for (let i = 0; i < amida_cell.length; i++){
            amida_cell[i].classList.remove('border-top-red');
            amida_cell[i].classList.remove('border-left-red');
            amida_cell[i].classList.remove('border-right-red');
        }
    }

    static changeColorBlackToRed(initial_array,icon_col)
    {
        let i = 0;
        let present_col = Number(icon_col.replace(/[^0-9]/g, ''));
        while (i < initial_array.length){
            if (initial_array[i][present_col]){
                document.getElementById('row' + i + 'col' + present_col).classList.add('border-top-red');                
                present_col = present_col + 1;
            } else if (present_col -1 >= 0 && initial_array[i][present_col - 1]){
                document.getElementById('row' + i + 'col' + (present_col - 1)).classList.add('border-top-red');
                present_col = present_col - 1;
            }
            if (present_col - 1 < 0){
                document.getElementById('row' + i + 'col' + present_col).classList.add('border-left-red');
            } else if (present_col + 1 > initial_array[i].length){
                document.getElementById('row' + i + 'col' + (present_col - 1)).classList.add('border-right-red');
            } else {
                document.getElementById('row' + i + 'col' + (present_col - 1)).classList.add('border-right-red');
                document.getElementById('row' + i + 'col' + present_col).classList.add('border-left-red');
            }
            i++;
        }
    }
}

class Validation {
    static playerName(player_name)
    {
        let max_length = 10;
        if (player_name > max_length){
            alert(this.message('length'));
            return false;
        } else if (player_name == ''){
            alert(this.message('null'));
            return false;
        } else if (player_field.includes(player_name)){
            alert(this.message('duplicate'));
            return false;
        } else {
            return true;
        }
    }

    static message(err_type)
    {
        switch (err_type){
            case 'length':
                return '表示名は20文字以内で入力してください。';
            case 'null':
                return '表示名に空白は使用できません。';
            case 'duplicate':
                return 'その名前はすでに使用されています。';
        }
    }
}