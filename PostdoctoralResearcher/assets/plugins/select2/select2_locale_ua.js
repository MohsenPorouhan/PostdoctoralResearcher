/**
 * Select2 <Language> translation.
 * 
 * Author: bigmihail <bigmihail@bigmir.net>
 */
(function ($) {
    "use strict";

    $.extend($.fn.select2.defaults, {
        formatNoMatches: function () { return "ذ‌ر–ر‡ذ¾ذ³ذ¾ ذ½ذµ ذ·ذ½ذ°ذ¹ذ´ذµذ½ذ¾"; },
        formatInputTooShort: function (input, min) { var n = min - input.length, s = ["", "ذ¸", "ر–ذ²"], p = [2,0,1,1,1,2]; return "ذ’ذ²ذµذ´ر–ر‚رŒ ذ±رƒذ»رŒ ذ»ذ°رپذ؛ذ° ر‰ذµ " + n + " رپذ¸ذ¼ذ²ذ¾ذ»" + s[ (n%100>4 && n%100<=20)? 2 : p[Math.min(n%10, 5)] ]; },
        formatInputTooLong: function (input, max) { var n = input.length - max, s = ["", "ذ¸", "ر–ذ²"], p = [2,0,1,1,1,2]; return "ذ’ذ²ذµذ´ر–ر‚رŒ ذ±رƒذ»رŒ ذ»ذ°رپذ؛ذ° ذ½ذ° " + n + " رپذ¸ذ¼ذ²ذ¾ذ»" + s[ (n%100>4 && n%100<=20)? 2 : p[Math.min(n%10, 5)] ] + " ذ¼ذµذ½رˆذµ"; },
        formatSelectionTooBig: function (limit) {var s = ["", "ذ¸", "ر–ذ²"], p = [2,0,1,1,1,2];  return "ذ’ذ¸ ذ¼ذ¾ذ¶ذµر‚ذµ ذ²ذ¸ذ±ر€ذ°ر‚ذ¸ ذ»ذ¸رˆذµ " + limit + " ذµذ»ذµذ¼ذµذ½ر‚" + s[ (limit%100>4 && limit%100<=20)? 2 : p[Math.min(limit%10, 5)] ]; },
        formatLoadMore: function (pageNumber) { return "ذ—ذ°ذ²ذ°ذ½ر‚ذ°ذ¶ذµذ½ذ½رڈ ذ´ذ°ذ½ذ¸ر…..."; },
        formatSearching: function () { return "ذںذ¾رˆرƒذ؛..."; }
    });
})(jQuery);
