'use strict';

(() => {
    const AMIDDA_ICON = document.getElementById('amida_icon');
    let initial_array = [];
    initial_array = Setting.setAmida(kuji_num, kuji_row);
    Setting.convertArrayToDOM(kuji_num,initial_array);
    AMIDDA_ICON.addEventListener('click', (evt) => {
        let table_icon_id = document.getElementById(evt.target.id).id;
        Amida.initialize();
        Amida.changeColorBlackToRed(initial_array, table_icon_id);
    })
})()