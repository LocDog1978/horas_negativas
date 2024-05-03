var startDate;
var endDate;

$(document).ready(function() {
	moment.locale('pt-br');
	$('#reportrange').daterangepicker({
		showDropdowns: true,
		ranges: {
			'Hoje': [moment(), moment()],
			'Ontem': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			'Últimos 7 Dias': [moment().subtract(6, 'days'), moment()],
			'Últimos 30 Dias': [moment().subtract(29, 'days'), moment()],
			'Este Mês': [moment().startOf('month'), moment().endOf('month')],
			'Último Mês': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		},
		opens: 'left',
		buttonClasses: ['btn btn-default'],
		applyClass: 'btn-small btn-primary',
		cancelClass: 'btn-small',
		startDate: moment(),
		minDate: '01/01/2015',
		endDate: '31/12/2030',
		maxDate: '31/12/2030',
		separator: ' to ',
		locale: {
			applyLabel: 'Aplicar',
			fromLabel: 'From',
			toLabel: 'To',
			customRangeLabel: 'Personalizado',
			daysOfWeek: ['Do', 'Se', 'Te', 'Qa', 'Qi', 'Se','Sa'],
			monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro']
		}
	},
	function(start, end) {
		$('#reportrange span').html(start.format('D MMMM YYYY') + ' - ' + end.format('D MMMM YYYY'));
		startDate = start;
		endDate = end;
		periodo = startDate.format('DD/MM/YYYY') + ' - ' + endDate.format('DD/MM/YYYY');
	});
	//Set the initial state of the picker label
	// $('#reportrange span').html(moment().format('D MMMM YYYY') + ' - ' + moment().format('D MMMM YYYY'));
	// Configuração do botão "Limpar"
    $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
        $('#reportrange span').html('');
        startDate = null;
        endDate = null;
    });

    // Set the initial state of the picker label
     $('#reportrange span').html('Selecione um intervalo');
});