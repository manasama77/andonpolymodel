<script>
	let realclock = $('#realclock');
	let dateDynamic;
	let month;
	let monthNameNow;
	let year;

	$(document).ready(function(){
		dateDynamic = moment();
		month = dateDynamic.format('MMM');
		year = dateDynamic.format('YYYY');

		clockUpdate();
		setInterval(clockUpdate, 1000);
		initCalendar();
	});
</script>
<script>

	function clockUpdate() {
		let now = moment();
		realclock.text(now.format(`ddd, DD MMM YYYY hh:mm:ss A`));
	}

	function initCalendar()
	{
		$.ajax({
			url: `<?=site_url();?>planning/init_calendar`,
			type: 'get',
			data: {
				month: month,
				year: year,
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
			$('#vcalendar').html(res);
			$('#submit').attr('disabled', false);
			$.unblockUI();

			$('.fdate').inputmask('99:99');
			$("#datepicker").datepicker({
				autoclose: true,
				format: "M yyyy",
				viewMode: "months", 
				minViewMode: "months"
			});
			$(".triggerDP").click(function(){ $("#datepicker").datepicker("show"); });

			$('#datepicker').on('change', function(){
				let xdate = $(this).val();
				dateExplode = xdate.split(' ');
				month = dateExplode[0];
				year = dateExplode[1];
				dateDynamic = moment(`${month} ${year}`, 'MMM YYYY');
				initCalendar();
			});

			$('.prev').on('click', function(){
				dateDynamic.subtract(1, 'months');
				month = dateDynamic.format('MMM');
				year = dateDynamic.format('YYYY');
				$('#datepicker').val(`${month} ${year}`).trigger('change');
			});

			$('.next').on('click', function(){
				dateDynamic.add(1, 'months');
				month = dateDynamic.format('MMM');
				year = dateDynamic.format('YYYY');
				$('#datepicker').val(`${month} ${year}`).trigger('change');
			});

		});
	}
</script>