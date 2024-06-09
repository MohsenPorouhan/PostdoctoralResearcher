/**
 * Select2 Turkish translation.
 * 
 * Author: Salim KAYABAإ‍I <salim.kayabasi@gmail.com>
 */
(function ($) {
    "use strict";

    $.extend($.fn.select2.defaults, {
        formatNoMatches: function () { return "Sonuأ§ bulunamadؤ±"; },
        formatInputTooShort: function (input, min) { var n = min - input.length; return "En az " + n + " karakter daha girmelisiniz"; },
        formatInputTooLong: function (input, max) { var n = input.length - max; return n + " karakter azaltmalؤ±sؤ±nؤ±z"; },
        formatSelectionTooBig: function (limit) { return "Sadece " + limit + " seأ§im yapabilirsiniz"; },
        formatLoadMore: function (pageNumber) { return "Daha fazla..."; },
        formatSearching: function () { return "Aranؤ±yor..."; }
    });
})(jQuery);
