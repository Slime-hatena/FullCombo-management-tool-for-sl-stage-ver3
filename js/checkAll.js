$(function() {
		$('.checkAll').on('change', function() {
			$('.' + this.id).prop('checked', this.checked);
		});
	});