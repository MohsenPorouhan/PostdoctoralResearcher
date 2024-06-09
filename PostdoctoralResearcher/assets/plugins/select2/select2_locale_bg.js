/**
 * Select2 <Language> translation.
 * 
 * Author: Lubomir Vikev <lubomirvikev@gmail.com>
 */
(function ($) {
    "use strict";

    $.extend($.fn.select2.defaults, {
        formatNoMatches: function () { return "ذ‌رڈذ¼ذ° ذ½ذ°ذ¼ذµر€ذµذ½ذ¸ رپرٹذ²ذ؟ذ°ذ´ذµذ½ذ¸رڈ"; },
        formatInputTooShort: function (input, min) { var n = min - input.length; return "ذœذ¾ذ»رڈ ذ²رٹذ²ذµذ´ذµر‚ذµ ذ¾ر‰ذµ " + n + " رپذ¸ذ¼ذ²ذ¾ذ»" + (n == 1 ? "" : "ذ°"); },
        formatInputTooLong: function (input, max) { var n = input.length - max; return "ذœذ¾ذ»رڈ ذ²رٹذ²ذµذ´ذµر‚ذµ رپ " + n + " ذ؟ذ¾-ذ¼ذ°ذ»ذ؛ذ¾ رپذ¸ذ¼ذ²ذ¾ذ»" + (n == 1? "" : "ذ°"); },
        formatSelectionTooBig: function (limit) { return "ذœذ¾ذ¶ذµر‚ذµ ذ´ذ° ذ½ذ°ذ؟ر€ذ°ذ²ذ¸ر‚ذµ ذ´ذ¾ " + limit + (limit == 1 ? " ذ¸ذ·ذ±ذ¾ر€" : " ذ¸ذ·ذ±ذ¾ر€ذ°"); },
        formatLoadMore: function (pageNumber) { return "ذ—ذ°ر€ذµذ¶ذ´ذ°ر‚ رپذµ ذ¾ر‰ذµ..."; },
        formatSearching: function () { return "ذ¢رٹر€رپذµذ½ذµ..."; }
    });
})(jQuery);
