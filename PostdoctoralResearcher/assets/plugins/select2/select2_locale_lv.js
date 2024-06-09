/**
 * Select2 Latvian translation
 */
(function ($) {
    "use strict";

    $.extend($.fn.select2.defaults, {
        formatNoMatches: function () { return "Sakritؤ«bu nav"; },
        formatInputTooShort: function (input, min) { var n = min - input.length; return "Lإ«dzu ievadiet vؤ“l " + n + " simbol" + (n == 11 ? "us" : (/^\d*[1]$/im.test(n)? "u" : "us")); },
        formatInputTooLong: function (input, max) { var n = input.length - max; return "Lإ«dzu ievadiet par " + n + " simbol" + (n == 11 ? "iem" : (/^\d*[1]$/im.test(n)? "u" : "iem")) + " mazؤپk"; },
        formatSelectionTooBig: function (limit) { return "Jإ«s varat izvؤ“lؤ“ties ne vairؤپk kؤپ " + limit + " element" + (limit == 11 ? "us" : (/^\d*[1]$/im.test(limit)? "u" : "us")); },
        formatLoadMore: function (pageNumber) { return "Datu ielؤپde..."; },
        formatSearching: function () { return "Meklؤ“إ،ana..."; }
    });
	
})(jQuery);
