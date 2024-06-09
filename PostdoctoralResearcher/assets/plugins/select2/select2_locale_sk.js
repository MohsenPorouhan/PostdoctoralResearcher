/**
 * Select2 Slovak translation.
 *
 * Author: David Vallner <david@vallner.net>
 */
(function ($) {
    "use strict";
    // use text for the numbers 2 through 4
    var smallNumbers = {
        2: function(masc) { return (masc ? "dva" : "dve"); },
        3: function() { return "tri"; },
        4: function() { return "إ،tyri"; }
    }
    $.extend($.fn.select2.defaults, {
        formatNoMatches: function () { return "Nenaإ،li sa إ¾iadne poloإ¾ky"; },
        formatInputTooShort: function (input, min) {
            var n = min - input.length;
            if (n == 1) {
                return "Prosأ­m zadajte eإ،te jeden znak";
            } else if (n <= 4) {
                return "Prosأ­m zadajte eإ،te ؤڈalإ،ie "+smallNumbers[n](true)+" znaky";
            } else {
                return "Prosأ­m zadajte eإ،te ؤڈalإ،أ­ch "+n+" znakov";
            }
        },
        formatInputTooLong: function (input, max) {
            var n = input.length - max;
            if (n == 1) {
                return "Prosأ­m zadajte o jeden znak menej";
            } else if (n <= 4) {
                return "Prosأ­m zadajte o "+smallNumbers[n](true)+" znaky menej";
            } else {
                return "Prosأ­m zadajte o "+n+" znakov menej";
            }
        },
        formatSelectionTooBig: function (limit) {
            if (limit == 1) {
                return "Mأ´إ¾ete zvoliإ¥ len jednu poloإ¾ku";
            } else if (limit <= 4) {
                return "Mأ´إ¾ete zvoliإ¥ najviac "+smallNumbers[limit](false)+" poloإ¾ky";
            } else {
                return "Mأ´إ¾ete zvoliإ¥ najviac "+limit+" poloإ¾iek";
            }
        },
        formatLoadMore: function (pageNumber) { return "Naؤچأ­tavajأ؛ sa ؤڈalإ،ie vأ½sledky..."; },
        formatSearching: function () { return "Vyhؤ¾adأ،vanie..."; }
    });
})(jQuery);
