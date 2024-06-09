/**
 * Select2 Czech translation.
 * 
 * Author: Michal Marek <ahoj@michal-marek.cz>
 * Author - sklonovani: David Vallner <david@vallner.net>
 */
(function ($) {
    "use strict";
    // use text for the numbers 2 through 4
    var smallNumbers = {
        2: function(masc) { return (masc ? "dva" : "dvؤ›"); },
        3: function() { return "tإ™i"; },
        4: function() { return "ؤچtyإ™i"; }
    }
    $.extend($.fn.select2.defaults, {
        formatNoMatches: function () { return "Nenalezeny إ¾أ،dnأ© poloإ¾ky"; },
        formatInputTooShort: function (input, min) {
            var n = min - input.length;
            if (n == 1) {
                return "Prosأ­m zadejte jeإ،tؤ› jeden znak";
            } else if (n <= 4) {
                return "Prosأ­m zadejte jeإ،tؤ› dalإ،أ­ "+smallNumbers[n](true)+" znaky";
            } else {
                return "Prosأ­m zadejte jeإ،tؤ› dalإ،أ­ch "+n+" znakإ¯";
            }
        },
        formatInputTooLong: function (input, max) {
            var n = input.length - max;
            if (n == 1) {
                return "Prosأ­m zadejte o jeden znak mأ©nؤ›";
            } else if (n <= 4) {
                return "Prosأ­m zadejte o "+smallNumbers[n](true)+" znaky mأ©nؤ›";
            } else {
                return "Prosأ­m zadejte o "+n+" znakإ¯ mأ©nؤ›";
            }
        },
        formatSelectionTooBig: function (limit) {
            if (limit == 1) {
                return "Mإ¯إ¾ete zvolit jen jednu poloإ¾ku";
            } else if (limit <= 4) {
                return "Mإ¯إ¾ete zvolit maximأ،lnؤ› "+smallNumbers[limit](false)+" poloإ¾ky";
            } else {
                return "Mإ¯إ¾ete zvolit maximأ،lnؤ› "+limit+" poloإ¾ek";
            }
        },
        formatLoadMore: function (pageNumber) { return "Naؤچأ­tajأ­ se dalإ،أ­ vأ½sledky..."; },
        formatSearching: function () { return "Vyhledأ،vأ،nأ­..."; }
    });
})(jQuery);
