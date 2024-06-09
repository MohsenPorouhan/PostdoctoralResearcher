/**
 * Select2 Finnish translation
 */
(function ($) {
    "use strict";
    $.extend($.fn.select2.defaults, {
        formatNoMatches: function () {
            return "Ei tuloksia";
        },
        formatInputTooShort: function (input, min) {
            var n = min - input.length;
            return "Ole hyvأ¤ ja anna " + n + " merkkiأ¤ lisأ¤أ¤";
        },
        formatInputTooLong: function (input, max) {
            var n = input.length - max;
            return "Ole hyvأ¤ ja anna " + n + " merkkiأ¤ vأ¤hemmأ¤n";
        },
        formatSelectionTooBig: function (limit) {
            return "Voit valita ainoastaan " + limit + " kpl";
        },
        formatLoadMore: function (pageNumber) {
            return "Ladataan lisأ¤أ¤ tuloksia...";
        },
        formatSearching: function () {
            return "Etsitأ¤أ¤n...";
        }
    });
})(jQuery);
