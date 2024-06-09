/* http://keith-wood.name/countdown.html
   Estonian initialisation for the jQuery countdown extension
   Written by Helmer <helmer{at}city.ee> */
(function($) {
    $.countdown.regional['et'] = {
        labels: ['Aastat', 'Kuud', 'Nأ¤dalat', 'Pأ¤eva', 'Tundi', 'Minutit', 'Sekundit'],
        labels1: ['Aasta', 'Kuu', 'Nأ¤dal', 'Pأ¤ev', 'Tund', 'Minut', 'Sekund'],
        compactLabels: ['a', 'k', 'n', 'p'],
        whichLabels: null,
		digits: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
        timeSeparator: ':', isRTL: false};
    $.countdown.setDefaults($.countdown.regional['et']);
})(jQuery);
