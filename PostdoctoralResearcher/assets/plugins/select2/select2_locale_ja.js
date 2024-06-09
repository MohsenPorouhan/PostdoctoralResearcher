/**
 * Select2 Japanese translation.
 */
(function ($) {
    "use strict";

    $.extend($.fn.select2.defaults, {
        formatNoMatches: function () { return "è©²ه½“مپھمپ—"; },
        formatInputTooShort: function (input, min) { var n = min - input.length; return "ه¾Œ" + n + "و–‡ه­—ه…¥م‚Œمپ¦مپڈمپ مپ•مپ„"; },
        formatInputTooLong: function (input, max) { var n = input.length - max; return "و¤œç´¢و–‡ه­—هˆ—مپŒ" + n + "و–‡ه­—é•·مپ™مپژمپ¾مپ™"; },
        formatSelectionTooBig: function (limit) { return "وœ€ه¤ڑمپ§" + limit + "é …ç›®مپ¾مپ§مپ—مپ‹éپ¸وٹ‍مپ§مپچمپ¾مپ›م‚“"; },
        formatLoadMore: function (pageNumber) { return "èھ­è¾¼ن¸­ï½¥ï½¥ï½¥"; },
        formatSearching: function () { return "و¤œç´¢ن¸­ï½¥ï½¥ï½¥"; }
    });
})(jQuery);
