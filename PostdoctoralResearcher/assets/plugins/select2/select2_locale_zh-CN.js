/**
 * Select2 Chinese translation
 */
(function ($) {
    "use strict";
    $.extend($.fn.select2.defaults, {
        formatNoMatches: function () { return "و²،وœ‰و‰¾هˆ°هŒ¹é…چé،¹"; },
        formatInputTooShort: function (input, min) { var n = min - input.length; return "è¯·ه†چè¾“ه…¥" + n + "ن¸ھه­—ç¬¦";},
        formatInputTooLong: function (input, max) { var n = input.length - max; return "è¯·هˆ وژ‰" + n + "ن¸ھه­—ç¬¦";},
        formatSelectionTooBig: function (limit) { return "ن½ هڈھèƒ½é€‰و‹©وœ€ه¤ڑ" + limit + "é،¹"; },
        formatLoadMore: function (pageNumber) { return "هٹ è½½ç»“و‍œن¸­..."; },
        formatSearching: function () { return "وگœç´¢ن¸­..."; }
    });
})(jQuery);
