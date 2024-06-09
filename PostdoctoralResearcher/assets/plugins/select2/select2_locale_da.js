/**
 * Select2 Danish translation.
 *
 * Author: Anders Jenbo <anders@jenbo.dk>
 */
(function ($) {
    "use strict";

    $.extend($.fn.select2.defaults, {
        formatNoMatches: function () { return "Ingen resultater fundet"; },
        formatInputTooShort: function (input, min) { var n = min - input.length; return "Angiv venligst " + n + " tegn mere"; },
        formatInputTooLong: function (input, max) { var n = input.length - max; return "Angiv venligst " + n + " tegn mindre"; },
        formatSelectionTooBig: function (limit) { return "Du kan kun vأ¦lge " + limit + " emne" + (limit === 1 ? "" : "r"); },
        formatLoadMore: function (pageNumber) { return "Indlأ¦ser flere resultaterâ€¦"; },
        formatSearching: function () { return "Sأ¸gerâ€¦"; }
    });
})(jQuery);
