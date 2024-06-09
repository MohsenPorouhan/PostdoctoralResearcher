/**
 * Select2 Persian translation.
 * 
 * Author: Ali Choopan <choopan@arsh.co>
 * Author: Ebrahim Byagowi <ebrahim@gnu.org>
 */
(function ($) {
    "use strict";

    $.fn.select2.locales['fa'] = {
        formatMatches: function (matches) { return matches + " ظ†طھغŒط¬ظ‡ ظ…ظˆط¬ظˆط¯ ط§ط³طھطŒ ع©ظ„غŒط¯ظ‡ط§غŒ ط¬ظ‡طھ ط¨ط§ظ„ط§ ظˆ ظ¾ط§غŒغŒظ† ط±ط§ ط¨ط±ط§غŒ ع¯ط´طھظ† ط§ط³طھظپط§ط¯ظ‡ ع©ظ†غŒط¯."; },
        formatNoMatches: function () { return "ظ†طھغŒط¬ظ‡â€Œط§غŒ غŒط§ظپطھ ظ†ط´ط¯."; },
        formatInputTooShort: function (input, min) { var n = min - input.length; return "ظ„ط·ظپط§ظ‹ " + n + " ظ†ظˆغŒط³ظ‡ ط¨غŒط´طھط± ظˆط§ط±ط¯ ظ†ظ…ط§غŒغŒط¯"; },
        formatInputTooLong: function (input, max) { var n = input.length - max; return "ظ„ط·ظپط§ظ‹ " + n + " ظ†ظˆغŒط³ظ‡ ط±ط§ ط­ط°ظپ ع©ظ†غŒط¯."; },
        formatSelectionTooBig: function (limit) { return "ط´ظ…ط§ ظپظ‚ط· ظ…غŒâ€Œطھظˆط§ظ†غŒط¯ " + limit + " ظ…ظˆط±ط¯ ط±ط§ ط§ظ†طھط®ط§ط¨ ع©ظ†غŒط¯"; },
        formatLoadMore: function (pageNumber) { return "ط¯ط± ط­ط§ظ„ ط¨ط§ط±ع¯غŒط±غŒ ظ…ظˆط§ط±ط¯ ط¨غŒط´طھط±â€¦"; },
        formatSearching: function () { return "ط¯ط± ط­ط§ظ„ ط¬ط³طھط¬ظˆâ€¦"; }
    };

    $.extend($.fn.select2.defaults, $.fn.select2.locales['fa']);
})(jQuery);
