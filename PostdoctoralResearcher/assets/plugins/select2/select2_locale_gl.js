/**
 * Select2 Galician translation
 * 
 * Author: Leandro Regueiro <leandro.regueiro@gmail.com>
 */
(function ($) {
    "use strict";

    $.extend($.fn.select2.defaults, {
        formatNoMatches: function () {
            return "Non se atoparon resultados";
        },
        formatInputTooShort: function (input, min) {
            var n = min - input.length;
            if (n === 1) {
                return "Engada un carأ،cter";
            } else {
                return "Engada " + n + " caracteres";
            }
        },
        formatInputTooLong: function (input, max) {
            var n = input.length - max;
            if (n === 1) {
                return "Elimine un carأ،cter";
            } else {
                return "Elimine " + n + " caracteres";
            }
        },
        formatSelectionTooBig: function (limit) {
            if (limit === 1 ) {
                return "Sأ³ pode seleccionar un elemento";
            } else {
                return "Sأ³ pode seleccionar " + limit + " elementos";
            }
        },
        formatLoadMore: function (pageNumber) {
            return "Cargando mأ،is resultados...";
        },
        formatSearching: function () {
            return "Buscando...";
        }
    });
})(jQuery);
