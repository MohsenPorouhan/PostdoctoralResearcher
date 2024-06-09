/**
* Select2 Hebrew translation.
*
* Author: Yakir Sitbon <http://www.yakirs.net/>
*/
(function ($) {
    "use strict";

    $.extend($.fn.select2.defaults, {
        formatNoMatches: function () { return "×œ×گ × ×‍×¦×گ×• ×”×ھ×گ×‍×•×ھ"; },
        formatInputTooShort: function (input, min) { var n = min - input.length; return "× ×گ ×œ×”×–×™×ں ×¢×•×“ " + n + " ×ھ×•×•×™×‌ × ×•×،×¤×™×‌"; },
        formatInputTooLong: function (input, max) { var n = input.length - max; return "× ×گ ×œ×”×–×™×ں ×¤×—×•×ھ " + n + " ×ھ×•×•×™×‌"; },
        formatSelectionTooBig: function (limit) { return "× ×™×ھ×ں ×œ×‘×—×•×¨ " + limit + " ×¤×¨×™×ک×™×‌"; },
        formatLoadMore: function (pageNumber) { return "×ک×•×¢×ں ×ھ×•×¦×گ×•×ھ × ×•×،×¤×•×ھ..."; },
        formatSearching: function () { return "×‍×—×¤×©..."; }
    });
})(jQuery);
