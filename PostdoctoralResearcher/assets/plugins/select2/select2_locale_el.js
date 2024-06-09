/**
 * Select2 <Language> translation.
 * 
 * Author: Your Name <your@email>
 */
(function ($) {
    "use strict";

    $.extend($.fn.select2.defaults, {
        formatNoMatches: function () { return "خ”خµخ½ خ²دپخ­خ¸خ·خ؛خ±خ½ خ±د€خ؟د„خµخ»خ­دƒخ¼خ±د„خ±"; },
        formatInputTooShort: function (input, min) { var n = min - input.length; return "خ خ±دپخ±خ؛خ±خ»خ؟دچخ¼خµ خµخ¹دƒخ¬خ³خµد„خµ " + n + " د€خµدپخ¹دƒدƒدŒد„خµدپخ؟" + (n == 1 ? "" : "د…د‚") + " د‡خ±دپخ±خ؛د„خ®دپ" + (n == 1 ? "خ±" : "خµد‚"); },
        formatInputTooLong: function (input, max) { var n = input.length - max; return "خ خ±دپخ±خ؛خ±خ»خ؟دچخ¼خµ خ´خ¹خ±خ³دپخ¬دˆد„خµ " + n + " د‡خ±دپخ±خ؛د„خ®دپ" + (n == 1 ? "خ±" : "خµد‚"); },
        formatSelectionTooBig: function (limit) { return "خœد€خ؟دپخµخ¯د„خµ خ½خ± خµد€خ¹خ»خ­خ¾خµد„خµ خ¼دŒخ½خ؟ " + limit + " خ±خ½د„خ¹خ؛خµخ¯خ¼خµخ½" + (limit == 1 ? "خ؟" : "خ±"); },
        formatLoadMore: function (pageNumber) { return "خ¦دŒدپد„د‰دƒخ· د€خµدپخ¹دƒدƒدŒد„خµدپد‰خ½..."; },
        formatSearching: function () { return "خ‘خ½خ±خ¶خ®د„خ·دƒخ·..."; }
    });
})(jQuery);