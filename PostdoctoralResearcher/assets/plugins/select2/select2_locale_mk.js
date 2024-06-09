/**
 * Select2 Macedonian translation.
 * 
 * Author: Marko Aleksic <psybaron@gmail.com>
 */
(function ($) {
    "use strict";

    $.extend($.fn.select2.defaults, {
        formatNoMatches: function () { return "ذ‌ذµذ¼ذ° ذ؟ر€ذ¾ذ½ذ°رکذ´ذµذ½ذ¾ رپذ¾ذ²ذ؟ذ°ر“ذ°رڑذ°"; },
        formatInputTooShort: function (input, min) { var n = min - input.length; return "ذ’ذµ ذ¼ذ¾ذ»ذ¸ذ¼ذµ ذ²ذ½ذµرپذµر‚ذµ رƒرˆر‚ذµ " + n + " ذ؛ذ°ر€ذ°ذ؛ر‚ذµر€" + (n == 1 ? "" : "ذ¸"); },
        formatInputTooLong: function (input, max) { var n = input.length - max; return "ذ’ذµ ذ¼ذ¾ذ»ذ¸ذ¼ذµ ذ²ذ½ذµرپذµر‚ذµ " + n + " ذ؟ذ¾ذ¼ذ°ذ»ذ؛رƒ ذ؛ذ°ر€ذ°ذ؛ر‚ذµر€" + (n == 1? "" : "ذ¸"); },
        formatSelectionTooBig: function (limit) { return "ذœذ¾ذ¶ذµر‚ذµ ذ´ذ° ذ¸ذ·ذ±ذµر€ذµر‚ذµ رپذ°ذ¼ذ¾ " + limit + " رپر‚ذ°ذ²ذ؛" + (limit == 1 ? "ذ°" : "ذ¸"); },
        formatLoadMore: function (pageNumber) { return "ذ’ر‡ذ¸ر‚رƒذ²ذ°رڑذµ ر€ذµذ·رƒذ»ر‚ذ°ر‚ذ¸..."; },
        formatSearching: function () { return "ذںر€ذµذ±ذ°ر€رƒذ²ذ°رڑذµ..."; }
    });
})(jQuery);