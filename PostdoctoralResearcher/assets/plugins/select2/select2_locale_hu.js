/**
 * Select2 Hungarian translation
 */
(function ($) {
    "use strict";

    $.extend($.fn.select2.defaults, {
        formatNoMatches: function () { return "Nincs talأ،lat."; },
        formatInputTooShort: function (input, min) { var n = min - input.length; return "Tأ؛l rأ¶vid. Mأ©g " + n + " karakter hiأ،nyzik."; },
        formatInputTooLong: function (input, max) { var n = input.length - max; return "Tأ؛l hosszأ؛. " + n + " kerekterrel tأ¶bb mint kellene."; },
        formatSelectionTooBig: function (limit) { return "Csak " + limit + " elemet lehet kivأ،lasztani."; },
        formatLoadMore: function (pageNumber) { return "Tأ¶ltأ©s..."; },
        formatSearching: function () { return "Keresأ©s..."; }
    });
})(jQuery);
