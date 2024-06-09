/**
 * Select2 <Language> translation.
 * 
 * Author: Swen Mun <longfinfunnel@gmail.com>
 */
(function ($) {
    "use strict";

    $.extend($.fn.select2.defaults, {
        formatNoMatches: function () { return "ê²°ê³¼ ى—†ى‌Œ"; },
        formatInputTooShort: function (input, min) { var n = min - input.length; return "ë„ˆë¬´ ى§§ىٹµë‹ˆë‹¤. "+n+"ê¸€ى‍گ ëچ” ى‍…ë ¥ي•´ى£¼ى„¸ىڑ”."; },
        formatInputTooLong: function (input, max) { var n = input.length - max; return "ë„ˆë¬´ ê¹پë‹ˆë‹¤. "+n+"ê¸€ى‍گ ى§€ى›Œى£¼ى„¸ىڑ”."; },
        formatSelectionTooBig: function (limit) { return "ىµœëŒ€ "+limit+"ê°œê¹Œى§€ë§Œ ى„ يƒ‌ي•کى‹¤ ىˆک ى‍ˆىٹµë‹ˆë‹¤."; },
        formatLoadMore: function (pageNumber) { return "ë¶ˆëں¬ىک¤ëٹ” ى¤‘â€¦"; },
        formatSearching: function () { return "ê²€ىƒ‰ ى¤‘â€¦"; }
    });
})(jQuery);
