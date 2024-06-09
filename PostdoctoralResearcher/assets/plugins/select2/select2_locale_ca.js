/**
 * Select2 Catalan translation.
 * 
 * Author: David Planella <david.planella@gmail.com>
 */
(function ($) {
    "use strict";

    $.extend($.fn.select2.defaults, {
        formatNoMatches: function () { return "No s'ha trobat cap coincidأ¨ncia"; },
        formatInputTooShort: function (input, min) { var n = min - input.length; return "Introduأ¯u " + n + " carأ cter" + (n == 1 ? "" : "s") + " mأ©s"; },
        formatInputTooLong: function (input, max) { var n = input.length - max; return "Introduأ¯u " + n + " carأ cter" + (n == 1? "" : "s") + "menys"; },
        formatSelectionTooBig: function (limit) { return "Nomأ©s podeu seleccionar " + limit + " element" + (limit == 1 ? "" : "s"); },
        formatLoadMore: function (pageNumber) { return "S'estan carregant mأ©s resultats..."; },
        formatSearching: function () { return "S'estأ  cercant..."; }
    });
})(jQuery);
