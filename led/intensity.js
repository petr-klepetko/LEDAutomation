$(document).ready( () => {
	let intensityRange = $('#intensity');
	intensityRange.on('change', () => {
		console.log(intensityRange[0].value);
		/** Save intensity */
		if(intensityRange[0].value == 0) {
			$.get(`../Automation/Intensity/?intensity=zero`);
		} else {
			$.get(`../Automation/Intensity/?intensity=${intensityRange[0].value}`);
		}
		$.get(`../Automation/Mode/?mode=automatic`);
	});
});
