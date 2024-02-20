/**
 * Spanish translation for bootstrap-datepicker
 * Bruno Bonamin <bruno.bonamin@gmail.com>
 */
;(function($){
    function twoDigits(d) {
            if(0 <= d && d < 10) return "0" + d.toString();
            if(-10 < d && d < 0) return "-0" + (-1*d).toString();
            return d.toString();
        }
	$.fn.datepicker.dates['es'] = {
		days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
		daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
		daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
		months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
		monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
		today: "Hoy",
		monthsTitle: "Meses",
		clear: "Borrar",
		weekStart: 1,
		format:'dd/mm/yyyy'
	};
}(jQuery));
