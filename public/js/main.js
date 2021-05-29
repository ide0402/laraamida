'use strict';

(() => {
    const AMIDDA_ICON = document.getElementById('amida_icon');
    Setting.convertArrayToDOM(kuji_num,amida_array);
    AMIDDA_ICON.addEventListener('click', (evt) => {
        let table_icon_id = document.getElementById(evt.target.id).id;
        Amida.initialize();
        Amida.changeColorBlackToRed(initial_array, table_icon_id);
    })
})()