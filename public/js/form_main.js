'use strict';

(() => {
    AMIDDA_ICON.addEventListener('click', (evt) => {
        let table_icon_id = document.getElementById(evt.target.id).id;
        Amida.initialize();
        Amida.changeColorBlackToRed(initial_array, table_icon_id);
    })
})()