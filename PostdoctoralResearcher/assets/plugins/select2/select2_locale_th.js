/**
 * Select2 Thai translation.
 *
 * Author: Atsawin Chaowanakritsanakul <joke@nakhon.net>
 */
(function ($) {
    "use strict";

    $.extend($.fn.select2.defaults, {
        formatNoMatches: function () { return "à¹„à¸،à¹ˆà¸‍à¸ڑà¸‚à¹‰à¸­à¸،à¸¹à¸¥"; },
        formatInputTooShort: function (input, min) { var n = min - input.length; return "à¹‚à¸›à¸£à¸”à¸‍à¸´à¸،à¸‍à¹Œà¹€à¸‍à¸´à¹ˆà¸،à¸­à¸µà¸پ " + n + " à¸•à¸±à¸§à¸­à¸±à¸پà¸©à¸£"; },
        formatInputTooLong: function (input, max) { var n = input.length - max; return "à¹‚à¸›à¸£à¸”à¸¥à¸ڑà¸­à¸­à¸پ " + n + " à¸•à¸±à¸§à¸­à¸±à¸پà¸©à¸£"; },
        formatSelectionTooBig: function (limit) { return "à¸„à¸¸à¸“à¸ھà¸²à¸،à¸²à¸£à¸–à¹€à¸¥à¸·à¸­à¸پà¹„à¸”à¹‰à¹„à¸،à¹ˆà¹€à¸پà¸´à¸™ " + limit + " à¸£à¸²à¸¢à¸پà¸²à¸£"; },
        formatLoadMore: function (pageNumber) { return "à¸پà¸³à¸¥à¸±à¸‡à¸„à¹‰à¸™à¸‚à¹‰à¸­à¸،à¸¹à¸¥à¹€à¸‍à¸´à¹ˆà¸،..."; },
        formatSearching: function () { return "à¸پà¸³à¸¥à¸±à¸‡à¸„à¹‰à¸™à¸‚à¹‰à¸­à¸،à¸¹à¸¥..."; }
    });
})(jQuery);
