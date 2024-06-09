/**
 * Select2 Arabic translation.
 * 
 * Author: Your Name <amedhat3@gmail.com>
 */
(function ($) {
    "use strict";

    $.extend($.fn.select2.defaults, {
        formatNoMatches: function () { return "ظ„ط§ طھظˆط¬ط¯ ظ†طھط§ط¦ط¬"; },
        formatInputTooShort: function (input, min) { var n = min - input.length; return "ظ…ظ† ظپط¶ظ„ظƒ ط£ط¯ط®ظ„ " + n + " ط­ط±ظˆظپ ط£ظƒط«ط±"; },
        formatInputTooLong: function (input, max) { var n = input.length - max; return "ظ…ظ† ظپط¶ظ„ظƒ ط£ط­ط°ظپ  " + n + " ط­ط±ظˆظپ"; },
        formatSelectionTooBig: function (limit) { return "ظٹظ…ظƒظ†ظƒ ط§ظ† طھط®طھط§ط± " + limit + " ط£ط®طھظٹط§ط±ط§طھ ظپظ‚ط·"; },
        formatLoadMore: function (pageNumber) { return "طھط­ظ…ظ„ ط§ظ„ظ…ط°ظٹط¯ ظ…ظ† ط§ظ„ظ†طھط§ط¦ط¬ ..."; },
        formatSearching: function () { return "ط¬ط§ط±ظٹ ط§ظ„ط¨ط­ط« ..."; }
    });
})(jQuery);
