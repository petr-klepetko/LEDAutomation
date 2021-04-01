$(document).ready(() => {
	/**
	 * Static variables 
	 * */
	let lock = false;

	let redRange 			= $('#redRange');
	let greenRange 			= $('#greenRange');
	let blueRange 			= $('#blueRange');

	let doButton 			= $('#doButton');

	let redValueOutput 		= $('#redValueOutput');
	let greenValueOutput 	= $('#greenValueOutput');
	let blueValueOutput = $('#blueValueOutput');

	let ranges = [];

	/**
	 * Functions
	 */
	let sleep = ms => {
		return new Promise(resolve => setTimeout(resolve, ms));
	};

	function lockButtons() {
		lock = true;
		console.log('Locked');
		sleep(2000).then(() => {
			lock = false;
			console.log('unlocked');
		});
	};

	function setValuesOutput() {
		redValueOutput.html(redRange[0].value);
		greenValueOutput.html(greenRange[0].value);
		blueValueOutput.html(blueRange[0].value);
	}

	function turnRgb() {
		$.get(`./../Color/?mode=rgb&red=${redRange[0].value}&green=${greenRange[0].value}&blue=${blueRange[0].value}`);
		$.get(`./../Color/SaveUserColors/?red=${redRange[0].value}&green=${greenRange[0].value}&blue=${blueRange[0].value}`);
		$.get(`./../../Automation/Mode/?mode=user`);
		setValuesOutput();
	}

	//	doButton.on('click tap', function turnRgb() {
	//		console.log('ajem here');
	//		$.get(`./color/?mode=rgb&red=${redRange[0].value}&green=${greenRange[0].value}&blue=${blueRange[0].value}`);
	//	});

	function initialize() {
		//		$.get(`./color/?mode=rgb&red=${redRange[0].value}&green=${greenRange[0].value}&blue=${blueRange[0].value}`);
		//turnRgb();

		ranges[1] 			= redRange;
		ranges[2] 			= greenRange;
		ranges[3] 			= blueRange;

		for (let i = 1; i < 4; i++) {
			ranges[i].on('change', turnRgb);
		}

		setValuesOutput();

		$('#red').on('click tap', function turnOnRed() {
			if (!lock) {
				$.get('../Color/?mode=word&color=red')
				lockButtons();
			}
		});

		$('#green').on('click tap', function turnOnGreen() {
			if (!lock) {
				$.get('../Color/?mode=word&color=green')
				lockButtons();
			}
		});

		$('#blue').on('click tap', function turnOnBlue() {
			if (!lock) {
				$.get('../Color/?mode=word&color=blue')
				lockButtons();
			}
		});

		$('#off').on('click tap', function turnOff() {
			if (!lock) {
				$.get('../Off')
				lockButtons();
			}
		});
	}

	/**
	 * Start
	 */
	initialize();


});



