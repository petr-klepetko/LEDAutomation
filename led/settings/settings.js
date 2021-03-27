$(document).ready(() => {
    let modeRange = $('#modeRange');
    let mode;
    let resetButton = $('#resetButton');

    modeRange.on('change', () => {
        let modeNumber = modeRange[0].value;

        console.log(modeNumber);

        if (modeNumber == 0) {
            mode = 'automatic';
        } else if (modeNumber == 1) {
            mode = 'user';
        } else {
            mode = 'automatic';
            //TODO nějaká zpráva o erroru
        }

        $.get(`../../Automation/Mode/?mode=${mode}`);
        $.get(`../../Automation/`);

    });

    resetButton.on('click', () => {
        $.get('../reset/');
    });

});


