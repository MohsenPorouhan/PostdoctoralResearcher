/**
 * Select2 French translation
 */
(function ($) {
    "use strict";

    $.extend($.fn.select2.defaults, {
        formatNoMatches: function () { return "Aucun rأ©sultat trouvأ©"; },
        formatInputTooShort: function (input, min) { var n = min - input.length; return "Merci de saisir " + n + " caractأ¨re" + (n == 1? "" : "s") + " de plus"; },
        formatInputTooLong: function (input, max) { var n = input.length - max; return "Merci de supprimer " + n + " caractأ¨re" + (n == 1? "" : "s"); },
        formatSelectionTooBig: function (limit) { return "Vous pouvez seulement sأ©lectionner " + limit + " أ©lأ©ment" + (limit == 1 ? "" : "s"); },
        formatLoadMore: function (pageNumber) { return "Chargement de rأ©sultats supplأ©mentaires..."; },
        formatSearching: function () { return "Recherche en cours..."; }
    });
})(jQuery);
