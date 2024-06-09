/**
 * Select2 Traditional Chinese translation
 */
(function ($) {
    "use strict";
    $.extend($.fn.select2.defaults, {
        formatNoMatches: function () { return "و²’وœ‰و‰¾هˆ°ç›¸ç¬¦çڑ„é …ç›®"; },
        formatInputTooShort: function (input, min) { var n = min - input.length; return "è«‹ه†چè¼¸ه…¥" + n + "ه€‹ه­—ه…ƒ";},
        formatInputTooLong: function (input, max) { var n = input.length - max; return "è«‹هˆھوژ‰" + n + "ه€‹ه­—ه…ƒ";},
        formatSelectionTooBig: function (limit) { return "ن½ هڈھèƒ½éپ¸و“‡وœ€ه¤ڑ" + limit + "é …"; },
        formatLoadMore: function (pageNumber) { return "è¼‰ه…¥ن¸­..."; },
        formatSearching: function () { return "وگœه°‹ن¸­..."; }
    });
})(jQuery);
