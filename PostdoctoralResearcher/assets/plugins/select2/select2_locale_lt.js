/**
 * Select2 lithuanian translation.
 * 
 * Author: CRONUS Karmalakas <cronus dot karmalakas at gmail dot com>
 */
(function ($) {
    "use strict";

    $.extend($.fn.select2.defaults, {
        formatNoMatches: function () { return "Atitikmenإ³ nerasta"; },
        formatInputTooShort: function (input, min) {
        	var n = min - input.length,
        	    suffix = (n % 10 == 1) && (n % 100 != 11) ? 'ؤ¯' : (((n % 10 >= 2) && ((n % 100 < 10) || (n % 100 >= 20))) ? 'ius' : 'iإ³');
        	return "ؤ®raإ،ykite dar " + n + " simbol" + suffix;
        },
        formatInputTooLong: function (input, max) {
        	var n = input.length - max,
        	    suffix = (n % 10 == 1) && (n % 100 != 11) ? 'ؤ¯' : (((n % 10 >= 2) && ((n % 100 < 10) || (n % 100 >= 20))) ? 'ius' : 'iإ³');
        	return "Paإ،alinkite " + n + " simbol" + suffix;
        },
        formatSelectionTooBig: function (limit) {
        	var n = limit,
                suffix = (n % 10 == 1) && (n % 100 != 11) ? 'ؤ…' : (((n % 10 >= 2) && ((n % 100 < 10) || (n % 100 >= 20))) ? 'us' : 'إ³');
        	return "Jإ«s galite pasirinkti tik " + limit + " element" + suffix;
        },
        formatLoadMore: function (pageNumber) { return "Kraunama daugiau rezultatإ³..."; },
        formatSearching: function () { return "Ieإ،koma..."; }
    });
})(jQuery);
