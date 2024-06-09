/**
 * Select2 Vietnamese translation.
 * 
 * Author: Long Nguyen <olragon@gmail.com>
 */
(function ($) {
    "use strict";

    $.extend($.fn.select2.defaults, {
        formatNoMatches: function () { return "Khأ´ng tأ¬m thل؛¥y kل؛؟t quل؛£"; },
        formatInputTooShort: function (input, min) { var n = min - input.length; return "Vui lأ²ng nhل؛­p nhiل»پu hئ،n " + n + " kأ½ tل»±" + (n == 1 ? "" : "s"); },
        formatInputTooLong: function (input, max) { var n = input.length - max; return "Vui lأ²ng nhل؛­p أ­t hئ،n " + n + " kأ½ tل»±" + (n == 1? "" : "s"); },
        formatSelectionTooBig: function (limit) { return "Chل»‰ cأ³ thل»ƒ chل»چn ؤ‘ئ°ل»£c " + limit + " tأ¹y chل»چn" + (limit == 1 ? "" : "s"); },
        formatLoadMore: function (pageNumber) { return "ؤگang lل؛¥y thأھm kل؛؟t quل؛£..."; },
        formatSearching: function () { return "ؤگang tأ¬m..."; }
    });
})(jQuery);

