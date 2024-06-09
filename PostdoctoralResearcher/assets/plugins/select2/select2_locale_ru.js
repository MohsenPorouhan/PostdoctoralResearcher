/**
 * Select2 Russian translation
 */
(function ($) {
    "use strict";

    $.extend($.fn.select2.defaults, {
        formatNoMatches: function () { return "ذ،ذ¾ذ²ذ؟ذ°ذ´ذµذ½ذ¸ذ¹ ذ½ذµ ذ½ذ°ذ¹ذ´ذµذ½ذ¾"; },
        formatInputTooShort: function (input, min) { var n = min - input.length; return "ذںذ¾ذ¶ذ°ذ»رƒذ¹رپر‚ذ°, ذ²ذ²ذµذ´ذ¸ر‚ذµ ذµر‰ذµ " + n + " رپذ¸ذ¼ذ²ذ¾ذ»" + (n == 1 ? "" : ((n > 1)&&(n < 5) ? "ذ°" : "ذ¾ذ²")); },
        formatInputTooLong: function (input, max) { var n = input.length - max; return "ذںذ¾ذ¶ذ°ذ»رƒذ¹رپر‚ذ°, ذ²ذ²ذµذ´ذ¸ر‚ذµ ذ½ذ° " + n + " رپذ¸ذ¼ذ²ذ¾ذ»" + (n == 1 ? "" : ((n > 1)&&(n < 5)? "ذ°" : "ذ¾ذ²")) + " ذ¼ذµذ½رŒرˆذµ"; },
        formatSelectionTooBig: function (limit) { return "ذ’ر‹ ذ¼ذ¾ذ¶ذµر‚ذµ ذ²ر‹ذ±ر€ذ°ر‚رŒ ذ½ذµ ذ±ذ¾ذ»ذµذµ " + limit + " رچذ»ذµذ¼ذµذ½ر‚" + (limit == 1 ? "ذ°" : "ذ¾ذ²"); },
        formatLoadMore: function (pageNumber) { return "ذ—ذ°ذ³ر€رƒذ·ذ؛ذ° ذ´ذ°ذ½ذ½ر‹ر…..."; },
        formatSearching: function () { return "ذںذ¾ذ¸رپذ؛..."; }
    });
})(jQuery);
