class Setting {

    static setAmida(kuji_num, kuji_row)
    {
        let initial_array = [];
        let initial_array_first_row = [];
        // 最初の行はすべて0
        for (let i = 0; i < kuji_num; i++){
            initial_array_first_row.push(0);
        }
        initial_array.push(initial_array_first_row);
        // 残り行数分作成
        for (let i = 0; i < kuji_row - 1; i++){
            initial_array.push(this.setAmidaColumn(kuji_num));            
        }
        return initial_array;
    }

    static setAmidaColumn(kuji_num)
    {
        let initial_array_per_row = [];
        let rand_num
        for (let i = 0; i < kuji_num; i++){
            if (i > 0 && initial_array_per_row[i-1] == 1){
                rand_num = 0;
            } else {
                rand_num = Math.floor(Math.random() * 2);
            }
            initial_array_per_row.push(rand_num);
        };
        return initial_array_per_row;
    }

    static convertArrayToDOM(kuji_num,initial_array)
    {
        const TABLE_ICON = document.getElementById('amida_icon');
        const TABLE_AMIDA = document.getElementById('amida_table');
        const CELL_CLASSNAME_BLACK = 'top-black';
        let table_icon_row = TABLE_ICON.insertRow(-1);

        for (let i = 0; i <= kuji_num; i++){
                let table_icon_cell = table_icon_row.insertCell(i);
                table_icon_cell.innerText = i;
                table_icon_cell.id = 'icon_col' + i;
        }
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
            }
            else if (present_col -1 >= 0 && initial_array[i][present_col - 1]){
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