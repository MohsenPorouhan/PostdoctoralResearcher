/**
 * Select2 Icelandic translation.
 * 
 */
(function ($) {
    "use strict";

    $.extend($.fn.select2.defaults, {
        formatNoMatches: function () { return "Ekkert fannst"; },
        formatInputTooShort: function (input, min) { var n = min - input.length; return "Vinsamlegast skrifiأ° " + n + " staf" + (n == 1 ? "" : "i") + " أ­ viأ°bأ³t"; },
        formatInputTooLong: function (input, max) { var n = input.length - max; return "Vinsamlegast styttiأ° texta um " + n + " staf" + (n == 1 ? "" : "i"); },
        formatSelectionTooBig: function (limit) { return "أ‍أ؛ getur aأ°eins valiأ° " + limit + " atriأ°i"; },
        formatLoadMore: function (pageNumber) { return "Sأ¦ki fleiri niأ°urstأ¶أ°ur..."; }, 
        formatSearching: function () { return "Leita..."; }
    });
})(jQuery);
