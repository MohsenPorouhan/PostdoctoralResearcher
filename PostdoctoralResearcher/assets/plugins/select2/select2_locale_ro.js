/**
 * Select2 Romanian translation.
 */
(function ($) {
    "use strict";

    $.extend($.fn.select2.defaults, {
        formatNoMatches: function () { return "Nu a fost gؤƒsit nimic"; },
        formatInputTooShort: function (input, min) { var n = min - input.length; return "Vؤƒ rugؤƒm sؤƒ introduceب›i incؤƒ " + n + " caracter" + (n == 1 ? "" : "e"); },
        formatInputTooLong: function (input, max) { var n = input.length - max; return "Vؤƒ rugؤƒm sؤƒ introduceب›i mai puب›in de " + n + " caracter" + (n == 1? "" : "e"); },
        formatSelectionTooBig: function (limit) { return "Aveب›i voie sؤƒ selectaب›i cel mult " + limit + " element" + (limit == 1 ? "" : "e"); },
        formatLoadMore: function (pageNumber) { return "Se أ®ncarcؤƒ..."; },
        formatSearching: function () { return "Cؤƒutare..."; }
    });
})(jQuery);
