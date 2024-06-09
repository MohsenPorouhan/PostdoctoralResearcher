/*
 * Translated default messages for the jQuery validation plugin.
 * Locale: ES (Spanish; Espaأ±ol)
 */
(function ($) {
	$.extend($.validator.messages, {
		required: "Este campo es obligatorio.",
		remote: "Por favor, rellena este campo.",
		email: "Por favor, escribe una direcciأ³n de correo vأ،lida",
		url: "Por favor, escribe una URL vأ،lida.",
		date: "Por favor, escribe una fecha vأ،lida.",
		dateISO: "Por favor, escribe una fecha (ISO) vأ،lida.",
		number: "Por favor, escribe un nأ؛mero entero vأ،lido.",
		digits: "Por favor, escribe sأ³lo dأ­gitos.",
		creditcard: "Por favor, escribe un nأ؛mero de tarjeta vأ،lido.",
		equalTo: "Por favor, escribe el mismo valor de nuevo.",
		accept: "Por favor, escribe un valor con una extensiأ³n aceptada.",
		maxlength: $.validator.format("Por favor, no escribas mأ،s de {0} caracteres."),
		minlength: $.validator.format("Por favor, no escribas menos de {0} caracteres."),
		rangelength: $.validator.format("Por favor, escribe un valor entre {0} y {1} caracteres."),
		range: $.validator.format("Por favor, escribe un valor entre {0} y {1}."),
		max: $.validator.format("Por favor, escribe un valor menor o igual a {0}."),
		min: $.validator.format("Por favor, escribe un valor mayor o igual a {0}.")
	});
}(jQuery));