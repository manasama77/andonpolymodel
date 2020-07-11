<script>
	let realclock = $('#realclock');

	let dateDynamic1;
	let month1;
	let year1;

	let dateDynamic2;
	let month2;
	let year2;

	let dateDynamic3;
	let month3;
	let year3;

	$(document).ready(function(){
		clockUpdate();
		setInterval(clockUpdate, 1000);

		dateDynamic1 = moment();
		month1       = dateDynamic1.format('MMM');
		year1        = dateDynamic1.format('YYYY');

		dateDynamic2 = moment();
		month2       = dateDynamic2.format('MMM');
		year2        = dateDynamic2.format('YYYY');

		dateDynamic3 = moment();
		month3       = dateDynamic3.format('MMM');
		year3        = dateDynamic3.format('YYYY');

		initCalendar1();
	});
</script>
<script>

	function clockUpdate() {
		let now = moment();
		realclock.text(now.format(`ddd, DD MMM YYYY hh:mm:ss A`));
	}

	function initCalendar1()
	{
		$.ajax({
			url: `<?=site_url();?>planning/init_calendar1`,
			type: 'get',
			data: {
				month: month1,
				year: year1,
			},
			beforeSend: function(){
				$('#submit').attr('disabled', true);
				$.blockUI();
			},
			statusCode: {
				404: function(){
					$.unblockUI();
					alert('Page not Found');
				},
				500: function(){
					$.unblockUI();
					alert('Cannot connect to database');
				},
				503: function(){
					$.unblockUI();
					alert('Connection timeout');
				}
			}
		}).done(function(res){
			$('#vcalendar1').html(res);
			$('#submit1').attr('disabled', false);
			$.unblockUI();

			$('.fdate').inputmask('99:99');
			$("#datepicker1").datepicker({
				autoclose: true,
				format: "M yyyy",
				viewMode: "months", 
				minViewMode: "months"
			});
			$(".triggerDP1").click(function(){ $("#datepicker1").datepicker("show"); });

			$('#datepicker1').on('change', function(){
				let xdate = $(this).val();
				dateExplode = xdate.split(' ');
				month1 = dateExplode[0];
				year1 = dateExplode[1];
				dateDynamic1 = moment(`${month1} ${year1}`, 'MMM YYYY');
				initCalendar1();
			});

			$('.prev').on('click', function(){
				dateDynamic1.subtract(1, 'months');
				month1 = dateDynamic1.format('MMM');
				year1 = dateDynamic1.format('YYYY');
				$('#datepicker1').val(`${month1} ${year1}`).trigger('change');
			});

			$('.next').on('click', function(){
				dateDynamic1.add(1, 'months');
				month1 = dateDynamic1.format('MMM');
				year1 = dateDynamic1.format('YYYY');
				$('#datepicker1').val(`${month1} ${year1}`).trigger('change');
			});

		});
	}
</script>