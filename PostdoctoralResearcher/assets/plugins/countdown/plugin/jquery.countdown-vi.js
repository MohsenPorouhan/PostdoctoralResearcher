/* http://keith-wood.name/countdown.html
 * Vietnamese initialisation for the jQuery countdown extension
 * Written by Pham Tien Hung phamtienhung@gmail.com (2010) */
(function($) {
	$.countdown.regional['vi'] = {
		labels: ['Nؤƒm', 'Thأ،ng', 'Tuل؛§n', 'Ngأ y', 'Giل»‌', 'Phأ؛t', 'Giأ¢y'],
		labels1: ['Nؤƒm', 'Thأ،ng', 'Tuل؛§n', 'Ngأ y', 'Giل»‌', 'Phأ؛t', 'Giأ¢y'],
		compactLabels: ['nؤƒm', 'th', 'tu', 'ng'],
		whichLabels: null,
		digits: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
		timeSeparator: ':', isRTL: false};
	$.countdown.setDefaults($.countdown.regional['vi']);
})(jQuery);