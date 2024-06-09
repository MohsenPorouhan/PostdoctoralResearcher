/**
 * Select2 <fa> translation.
 * 
 * Author: Ali Choopan <choopan@arsh.co>
 */
(function ($) {
    "use strict";

    $.extend($.fn.select2.defaults, {
        formatNoMatches: function () { return "ظ†طھغŒط¬ظ‡â€Œط§غŒ غŒط§ظپطھ ظ†ط´ط¯."; },
        formatInputTooShort: function (input, min) { var n = min - input.length; return " ظ„ط·ظپط§ ط¨غŒط´ ط§ط²"+n+"ع©ط§ط±ط§ع©طھط± ظˆط§ط±ط¯ ظ†ظ…ط§غŒغŒط¯ "; },
        formatInputTooLong: function (input, max) { var n = input.length - max; return " ظ„ط·ظپط§" + n + " ع©ط§ط±ط§ع©طھط± ط±ط§ ط­ط°ظپ ع©ظ†غŒط¯."; },
        formatSelectionTooBig: function (limit) { return "ط´ظ…ط§ ظپظ‚ط· ظ…غŒâ€Œطھظˆط§ظ†غŒط¯ " + limit + " ظ…ظˆط±ط¯ ط±ط§ ط§ظ†طھط®ط§ط¨ ع©ظ†غŒط¯"; },
        formatLoadMore: function (pageNumber) { return "ط¯ط± ط­ط§ظ„ ط¨ط§ط±ع¯ط°ط§ط±غŒ ظ…ظˆط§ط±ط¯ ط¨غŒط´طھط± ..."; },
        formatSearching: function () { return "ط¯ط± ط­ط§ظ„ ط¬ط³طھط¬ظˆ"; }
    });
})(jQuery);
