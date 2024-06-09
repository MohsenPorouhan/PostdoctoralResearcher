/**
 * Select2 Swedish translation.
 *
 * Author: Jens Rantil <jens.rantil@telavox.com>
 */
(function ($) {
    "use strict";

    $.extend($.fn.select2.defaults, {
        formatNoMatches: function () { return "Inga trأ¤ffar"; },
        formatInputTooShort: function (input, min) { var n = min - input.length; return "Var god skriv in " + n + (n>1 ? " till tecken" : " tecken till"); },
        formatInputTooLong: function (input, max) { var n = input.length - max; return "Var god sudda ut " + n + " tecken"; },
        formatSelectionTooBig: function (limit) { return "Du kan max vأ¤lja " + limit + " element"; },
        formatLoadMore: function (pageNumber) { return "Laddar fler resultat..."; },
        formatSearching: function () { return "Sأ¶ker..."; }
    });
})(jQuery);
