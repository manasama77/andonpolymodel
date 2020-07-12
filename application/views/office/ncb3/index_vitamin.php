<style>
	input { font-weight: bold; }
	input:disabled { background: grey; color: white; font-weight: bold; }

	.cuttingLabel{ background-color: #92d050 !important; padding: 10px 20px 10px 20px; }
	.dandoriLabel{ background-color: #ffffff !important; padding: 10px 20px 10px 20px; }
	.manLabel{ background-color: #2e75b5 !important; padding: 10px 20px 10px 20px; }
	.idleLabel{ background-color: #ffff99 !important; padding: 10px 20px 10px 20px; }
	.alarmLabel{ background-color: #f7caac !important; padding: 10px 20px 10px 20px; }

	.kikukawa2Label{ background-color: #f7caac !important; padding: 0px 20px 7px 0px; }
	.ncb32Label{ background-color: #2e75b5 !important; padding: 0px 20px 7px 0px; }
	.ncb62Label{ background-color: #92d050 !important; padding: 0px 20px 7px 0px; }

	.kikukawa2LabelOff{ background-color: #000 !important; padding: 0px 20px 7px 0px; }
	.ncb32LabelOff{ background-color: #000 !important; padding: 0px 20px 7px 0px; }
	.ncb62LabelOff{ background-color: #000 !important; padding: 0px 20px 7px 0px; }

	.cuttingBG{ background-color: #92d050 !important; }
	.dandoriBG{ background-color: #ffffff !important; }
	.manBG{ background-color: #2e75b5 !important; }
	.idleBG{ background-color: #ffff99 !important; }
	.alarmBG{ background-color: #f7caac !important; }

	.chartShow{ display: block; }

	#t1 { margin-top: 100px; }
	#t1 > tbody > tr > td { color: #ffc107; font-size: 30px; padding: 20px; }
	#t1 > thead > tr > th { font-size: 30px; }
	#datepicker { background: #333; color: #ffc107; }
	#yearpicker { background: #333; color: #ffc107; }

</style>

<script>

	let realclock = $('.realclock');
	let dateDynamic;
	let month;
	let year;

	let datepicker = $('#datepicker');
	let yearpicker = $('#yearpicker');

	let slide1        = $('#section1');
	let slide2        = $('#section2');
	let slide3        = $('#section3');
	let intervalSlide = 2000;
	let kue           = Cookies.get('aktifslide');

	let chart1;
	let dataPoints  = [];
	let dataStandar = [];

	let chart2;
	let dataPoints2  = [];
	let dataStandar2 = [];

	let chart3;
	let dataPoints3  = [];
	let dataStandar3 = [];

	let chart22;
	let dataPoints22Kikukawa = [];
	let dataPoints22NCB3     = [];
	let dataPoints22NCB6     = [];

	let monthcal1;
	let yearcal1;
	let dateDynamicCal1;

	let monthcal2;
	let yearcal2;
	let dateDynamicCal2;

	let monthcal3;
	let yearcal3;
	let dateDynamicCal3;

	$(document).ready(function(){
		dateDynamicCal1 = moment();
		monthcal1       = dateDynamicCal1.format('MMM');
		yearcal1        = dateDynamicCal1.format('YYYY');

		dateDynamicCal2 = moment();
		monthcal2       = dateDynamicCal2.format('MMM');
		yearcal2        = dateDynamicCal2.format('YYYY');

		dateDynamicCal3 = moment();
		monthcal3       = dateDynamicCal3.format('MMM');
		yearcal3        = dateDynamicCal3.format('YYYY');


		clockUpdate();
		setInterval(clockUpdate, 1000);

		// wsKikukawa();
		// wsNCB3();
		// wsNCB6();

		$('.triggerChart1').click(function(e){
			if($('#kikukawa').hasClass('chartShow')){
				$('#kikukawa').parent().hide();
				$('#kikukawa').removeClass('chartShow');
				$(this).addClass('kikukawa2LabelOff');
			} else {
				$('#kikukawa').parent().show();
				$('#kikukawa').addClass('chartShow');
				$(this).removeClass('kikukawa2LabelOff');
			}
			countChartShow();
		});

		$('.triggerChart2').click(function(e){
			if($('#ncb3').hasClass('chartShow')){
				$('#ncb3').parent().hide();
				$('#ncb3').removeClass('chartShow');
				$(this).addClass('ncb32LabelOff');
			} else {
				$('#ncb3').parent().show();
				$('#ncb3').addClass('chartShow');
				$(this).removeClass('ncb32LabelOff');
			}
			countChartShow();
		});

		$('.triggerChart3').click(function(e){
			if($('#ncb6').hasClass('chartShow')){
				$('#ncb6').parent().hide();
				$('#ncb6').removeClass('chartShow');
				$(this).addClass('ncb62LabelOff');
			} else {
				$('#ncb6').parent().show();
				$('#ncb6').addClass('chartShow');
				$(this).removeClass('ncb62LabelOff');
			}
			countChartShow();
		});

		$("#menu-toggle").click(function(e) {
			e.preventDefault();
			$("#wrapper").toggleClass("toggled");
		});

		$('#tPlan').on('click', function(){
			$('#modal-planning').modal('show');
		});

		// initCalendar1();
		initCalendar2();
		// initCalendar3();

		$('#form_calendar1').validate({
			debug: true,
			errorClass: 'help-inline text-danger',
			submitHandler: function( form ) {
				$.ajax({
					url         : '<?=site_url();?>planning/update1',
					method      : 'POST',
					data        : $('#form_calendar1').serialize(),
					dataType    : 'JSON',
					beforeSend  : function(){
						$.blockUI({ message: '<i class="fa fa-spinner fa-spin"></i> Silahkan Tunggu...' });
					},
					statusCode  : {
						200: function() {
							$.unblockUI();
						},
						400: function() {
							$.unblockUI();
							alert('Error 400');
						},
						404: function() {
							$.unblockUI();
							alert('Error 404 - Halaman Tidak Ditemukan');
						},
						500: function() {
							$.unblockUI();
							alert('Error 500 - Gagal Terhubung Dengan Database');
						},
						503: function() {
							$.unblockUI();
							alert('Error 503 - Terputus Dengan Database');
						}
					}
				})
				.done(function(result){

					if(result.code == 200)
					{
						alert('Update Planning Hour Berhasil');
					}else{
						alert('Update Planning Hour Gagal');
					}
					$.unblockUI();
				});
			}
		});

		$('#form_calendar2').validate({
			debug: true,
			errorClass: 'help-inline text-danger',
			submitHandler: function( form ) {
				$.ajax({
					url         : '<?=site_url();?>planning/update2',
					method      : 'POST',
					data        : $('#form_calendar2').serialize(),
					dataType    : 'JSON',
					beforeSend  : function(){
						$.blockUI({ message: '<i class="fa fa-spinner fa-spin"></i> Silahkan Tunggu...' });
					},
					statusCode  : {
						200: function() {
							$.unblockUI();
						},
						400: function() {
							$.unblockUI();
							alert('Error 400');
						},
						404: function() {
							$.unblockUI();
							alert('Error 404 - Halaman Tidak Ditemukan');
						},
						500: function() {
							$.unblockUI();
							alert('Error 500 - Gagal Terhubung Dengan Database');
						},
						503: function() {
							$.unblockUI();
							alert('Error 503 - Terputus Dengan Database');
						}
					}
				})
				.done(function(result){

					if(result.code == 200)
					{
						alert('Update Planning Hour Berhasil');
					}else{
						alert('Update Planning Hour Gagal');
					}
					$.unblockUI();
				});
			}
		});

		$('#form_calendar3').validate({
			debug: true,
			errorClass: 'help-inline text-danger',
			submitHandler: function( form ) {
				$.ajax({
					url         : '<?=site_url();?>planning/update3',
					method      : 'POST',
					data        : $('#form_calendar3').serialize(),
					dataType    : 'JSON',
					beforeSend  : function(){
						$.blockUI({ message: '<i class="fa fa-spinner fa-spin"></i> Silahkan Tunggu...' });
					},
					statusCode  : {
						200: function() {
							$.unblockUI();
						},
						400: function() {
							$.unblockUI();
							alert('Error 400');
						},
						404: function() {
							$.unblockUI();
							alert('Error 404 - Halaman Tidak Ditemukan');
						},
						500: function() {
							$.unblockUI();
							alert('Error 500 - Gagal Terhubung Dengan Database');
						},
						503: function() {
							$.unblockUI();
							alert('Error 503 - Terputus Dengan Database');
						}
					}
				})
				.done(function(result){

					if(result.code == 200)
					{
						alert('Update Planning Hour Berhasil');
					}else{
						alert('Update Planning Hour Gagal');
					}
					$.unblockUI();
				});
			}
		});

		$('#tExport').on('click', function(){
			$('#modal-export').modal('show');
		});

		$(".datepickerexport").datepicker({
			autoclose: true,
			format: "dd/mm/yyyy"
		});

		$(".yearpickerexport").datepicker({
			autoclose: true,
			format: "mm/yyyy",
			viewMode: "months", 
			minViewMode: "months"
		});

		$('#daily_export').validate({
			debug: true,
			rules:{
				export_start:{
					required:true,
				},
				export_end:{
					required:true,
				}
			},
			errorClass: 'help-block text-danger',
			errorPlacement: function(error, element) {
				error.insertAfter($(element).parent());
			},
			submitHandler: function( form ) {
				let from = moment($('#export_start').val(), 'DD/MM/YYYY');
				let to   = moment($('#export_end').val(), 'DD/MM/YYYY');
				window.open(`<?=site_url();?>export/daily/${from.format('YYYY-MM-DD')}/${to.format('YYYY-MM-DD')}`, '_blank');
			}
		});

		$('#monthly_export').validate({
			debug: true,
			rules:{
				my:{
					required:true,
				}
			},
			errorClass: 'help-block text-danger',
			errorPlacement: function(error, element) {
				error.insertAfter($(element).parent());
			},
			submitHandler: function( form ) {
				let my = moment($('#my').val(), 'MM/YYYY');
				window.open(`<?=site_url();?>export/monthly/${my.format('YYYY-MM')}`, '_blank');
			}
		});

		
	});

	document.onkeydown = function(event) {
		if(event.keyCode == 39){
			$('#next_slide').trigger('click');
		}

		if(event.keyCode == 80){
			$('#pause_play').trigger('click');
		}
    };


</script>


<script>
	function countChartShow(){
		let count2 = $('.chartShow').length;

		if(count2 == 1){
			$('.chartShow').parent().removeClass('col-6').addClass('col-12').children().css('height', '400px');
		}else if(count2 == 2){
			$('.chartShow').parent().removeClass('col-12').addClass('col-6').children().css('height', '400px');
		}else{
			$('.chartShow').parent().removeClass('col-12').addClass('col-6').children().css('height', '260px');
		}
		chart1.render();
		chart2.render();
		chart3.render();
		chart22.render();
	}

	function clockUpdate() {
		let now = moment();
		realclock.text(now.format(`ddd, DD MMM YYYY hh:mm:ss A`));
	}

	function wsKikukawa()
	{
		wstest = new WebSocket("ws://localhost:1880/ws/trigger/kikukawa");
		wstest.onerror = (e) => console.log(e)
		wstest.onopen = () => console.log('connect');
		wstest.onclose = () => {
			console.log('disconnect');
			setTimeout(()=> wsKikukawa(), 1000);
		}
		wstest.onmessage = (e) => {
			data = $.parseJSON(e.data);
			let trigger = data.trigger;
			let values = data.values;
			$('#m1cutting').removeClass('cuttingBG').removeClass('text-dark');
			$('#m1dandori').removeClass('dandoriBG').removeClass('text-dark');
			$('#m1man').removeClass('manBG').removeClass('text-dark');
			$('#m1idle').removeClass('idleBG').removeClass('text-dark');
			$('#m1alarm').removeClass('alarmBG').removeClass('text-dark');

			if(trigger.length > 1){
				$.each(trigger, (i, k) => {
					if(k == "cutting"){ $('#m1cutting').addClass('cuttingBG text-dark'); }
					if(k == "dandori"){ $('#m1dandori').addClass('dandoriBG text-dark'); }
					if(k == "man"){ $('#m1man').addClass('manBG text-dark'); }
					if(k == "idle"){ $('#m1idle').addClass('idleBG text-dark');}
					if(k == "alarm"){ $('#m1alarm').addClass('alarmBG text-dark'); }
				});
			}else{
				$.each(trigger, (i, k) => {
					if(k == "cutting"){
						$('#m1cutting').addClass('cuttingBG text-dark');
					}else if(k == "dandori"){
						$('#m1dandori').addClass('dandoriBG text-dark');
					}else if(k == "man"){
						$('#m1man').addClass('manBG text-dark');
					}else if(k == "idle"){
						$('#m1idle').addClass('idleBG text-dark');
					}else if(k == "alarm"){
						$('#m1alarm').addClass('alarmBG text-dark');
					}
				});
			}

			$('#m1cutting').text( hhmm(values.cutting) );
			$('#m1dandori').text( hhmm(values.dandori) );
			$('#m1man').text( hhmm(values.man) );
			$('#m1idle').text( hhmm(values.idle) );
			$('#m1alarm').text( hhmm(values.alarm) );
			$('#m1eff').text( `${parseFloat(values.eff).toFixed(2)}%` );
		}
	}

	function wsNCB3()
	{
		wstest = new WebSocket("ws://localhost:1880/ws/trigger/ncb3");
		wstest.onerror = (e) => { console.log(e) }
		wstest.onopen = () => { console.log('connect') }
		wstest.onclose = () => {
			console.log('disconnect');
			setTimeout(()=> {
				wsNCB3();
			}, 1000);
		}
		wstest.onmessage = (e) => {
			data = $.parseJSON(e.data);
			
			let trigger = data.trigger;
			let values = data.values;

			$('#m2cutting').removeClass('cuttingBG').removeClass('text-dark');
			$('#m2dandori').removeClass('dandoriBG').removeClass('text-dark');
			$('#m2man').removeClass('manBG').removeClass('text-dark');
			$('#m2idle').removeClass('idleBG').removeClass('text-dark');
			$('#m2alarm').removeClass('alarmBG').removeClass('text-dark');

			if(trigger.length > 1){

				$.each(trigger, (i, k) => {
					if(k == "cutting"){ $('#m2cutting').addClass('cuttingBG text-dark'); }
					if(k == "dandori"){ $('#m2dandori').addClass('dandoriBG text-dark'); }
					if(k == "man"){ $('#m2man').addClass('manBG text-dark'); }
					if(k == "idle"){ $('#m2idle').addClass('idleBG text-dark');}
					if(k == "alarm"){ $('#m2alarm').addClass('alarmBG text-dark'); }
				});

			}else{
				$.each(trigger, (i, k) => {
					if(k == "cutting"){ 
						$('#m2cutting').addClass('cuttingBG text-dark'); 
					}else if(k == "dandori"){
						$('#m2dandori').addClass('dandoriBG text-dark');
					}else if(k == "man"){
						$('#m2man').addClass('manBG text-dark');
					}else if(k == "idle"){
						$('#m2idle').addClass('idleBG text-dark');
					}else if(k == "alarm"){
						$('#m2alarm').addClass('alarmBG text-dark');
					}
				});
			}

			$('#m2cutting').text( hhmm(values.cutting) );
			$('#m2dandori').text( hhmm(values.dandori) );
			$('#m2man').text( hhmm(values.man) );
			$('#m2idle').text( hhmm(values.idle) );
			$('#m2alarm').text( hhmm(values.alarm) );
			$('#m2eff').text( `${parseFloat(values.eff).toFixed(2)}%` );
		}
	}

	function wsNCB6()
	{
		wstest = new WebSocket("ws://localhost:1880/ws/trigger/ncb6");
		wstest.onerror = (e) => { console.log(e) }
		wstest.onopen = () => { console.log('connect') }
		wstest.onclose = () => {
			console.log('disconnect');
			setTimeout(()=> {
				wsNCB6();
			}, 1000);
		}
		wstest.onmessage = (e) => {
			data = $.parseJSON(e.data);
			
			let trigger = data.trigger;
			let values = data.values;

			$('#m3cutting').removeClass('cuttingBG text-dark');
			$('#m3dandori').removeClass('dandoriBG text-dark');
			$('#m3man').removeClass('manBG text-dark');
			$('#m3idle').removeClass('idleBG text-dark');
			$('#m3alarm').removeClass('alarmBG text-dark');

			if(trigger.length > 1){

				$.each(trigger, (i, k) => {
					if(k == "cutting"){ $('#m3cutting').addClass('cuttingBG text-dark'); }
					if(k == "dandori"){ $('#m3dandori').addClass('dandoriBG text-dark'); }
					if(k == "man"){ $('#m3man').addClass('manBG text-dark'); }
					if(k == "idle"){ $('#m3idle').addClass('idleBG text-dark');}
					if(k == "alarm"){ $('#m3alarm').addClass('alarmBG text-dark'); }
				});

			}else{
				$.each(trigger, (i, k) => {
					if(k == "cutting"){ 
						$('#m3cutting').addClass('cuttingBG text-dark'); 
					}else if(k == "dandori"){
						$('#m3dandori').addClass('dandoriBG text-dark');
					}else if(k == "man"){
						$('#m3man').addClass('manBG text-dark');
					}else if(k == "idle"){
						$('#m3idle').addClass('idleBG text-dark');
					}else if(k == "alarm"){
						$('#m3alarm').addClass('alarmBG text-dark');
					}
				});
			}

			$('#m3cutting').text( hhmm(values.cutting) );
			$('#m3dandori').text( hhmm(values.dandori) );
			$('#m3man').text( hhmm(values.man) );
			$('#m3idle').text( hhmm(values.idle) );
			$('#m3alarm').text( hhmm(values.alarm) );
			$('#m3eff').text( `${parseFloat(values.eff).toFixed(2)}%` );
		}
	}


	function pad(num) {
		return ("0"+num).slice(-2);
	}

	function hhmm(secs) {
		var minutes = Math.floor(parseInt(secs) / 60);
		secs = secs%60;
		var hours = Math.floor(minutes/60)
		minutes = minutes%60;
		return `${pad(hours)}:${pad(minutes)}`;
	}

	function initCalendar1()
	{
		$.ajax({
			url: `<?=site_url();?>planning/init_calendar1`,
			type: 'get',
			data: {
				monthcal1: monthcal1,
				yearcal1: yearcal1,
			},
			beforeSend: function(){
				$('#submit1').attr('disabled', true);
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
			$("#datepickercal1").datepicker({
				autoclose: true,
				format: "M yyyy",
				viewMode: "months", 
				minViewMode: "months"
			});

			$('#datepickercal1').on('change', function(){
				let xdate = $(this).val();
				let dateExplode = xdate.split(' ');
				monthcal1 = dateExplode[0];
				yearcal1 = dateExplode[1];
				dateDynamicCal1 = moment(`${monthcal1} ${yearcal1}`, 'MMM YYYY');
				initCalendar1();
			});

			$('.prev').on('click', function(){
				console.log(dateDynamicCal1)
				dateDynamicCal1.subtract(1, 'months');
				monthcal1 = dateDynamicCal1.format('MMM');
				yearcal1 = dateDynamicCal1.format('YYYY');
				$('#datepickercal1').val(`${monthcal1} ${yearcal1}`).trigger('change');
			});

			$('.next').on('click', function(){
				dateDynamicCal1.add(1, 'months');
				monthcal1 = dateDynamicCal1.format('MMM');
				yearcal1 = dateDynamicCal1.format('YYYY');
				$('#datepickercal1').val(`${monthcal1} ${yearcal1}`).trigger('change');
			});

		});
	}

	function initCalendar2()
	{
		$.ajax({
			url: `<?=site_url();?>planning/init_calendar2`,
			type: 'get',
			data: {
				monthcal2: monthcal2,
				yearcal2: yearcal2,
			},
			beforeSend: function(){
				$('#submit2').attr('disabled', true);
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
			$('#vcalendar2').html(res);
			$('#submit2').attr('disabled', false);
			$.unblockUI();

			$('.fdate').inputmask('99:99');
			$("#datepickercal2").datepicker({
				autoclose: true,
				format: "M yyyy",
				viewMode: "months", 
				minViewMode: "months"
			});

			// $(".triggerDP1").click(function(){ $("#datepickercal1").datepicker("show"); });

			$('#datepickercal2').on('change', function(){
				let xdate = $(this).val();
				let dateExplode = xdate.split(' ');
				monthcal2 = dateExplode[0];
				yearcal2 = dateExplode[1];
				dateDynamicCal2 = moment(`${monthcal2} ${yearcal2}`, 'MMM YYYY');
				initCalendar2();
			});

			$('.prev').on('click', function(){
				dateDynamicCal2.subtract(1, 'months');
				monthcal2 = dateDynamicCal2.format('MMM');
				yearcal2 = dateDynamicCal2.format('YYYY');
				$('#datepickercal2').val(`${monthcal2} ${yearcal2}`).trigger('change');
			});

			$('.next').on('click', function(){
				dateDynamicCal2.add(1, 'months');
				monthcal2 = dateDynamicCal2.format('MMM');
				yearcal2 = dateDynamicCal2.format('YYYY');
				$('#datepickercal2').val(`${monthcal2} ${yearcal2}`).trigger('change');
			});

		});
	}

	function initCalendar3()
	{
		$.ajax({
			url: `<?=site_url();?>planning/init_calendar3`,
			type: 'get',
			data: {
				monthcal3: monthcal3,
				yearcal3: yearcal3,
			},
			beforeSend: function(){
				$('#submit3').attr('disabled', true);
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
			$('#vcalendar3').html(res);
			$('#submit3').attr('disabled', false);
			$.unblockUI();

			$('.fdate').inputmask('99:99');
			$("#datepickercal3").datepicker({
				autoclose: true,
				format: "M yyyy",
				viewMode: "months", 
				minViewMode: "months"
			});

			$('#datepickercal3').on('change', function(){
				let xdate = $(this).val();
				let dateExplode = xdate.split(' ');
				monthcal3 = dateExplode[0];
				yearcal3 = dateExplode[1];
				dateDynamicCal3 = moment(`${monthcal3} ${yearcal3}`, 'MMM YYYY');
				initCalendar3();
			});

			$('.prev').on('click', function(){
				dateDynamicCal3.subtract(1, 'months');
				monthcal3 = dateDynamicCal3.format('MMM');
				yearcal3 = dateDynamicCal3.format('YYYY');
				$('#datepickercal3').val(`${monthcal3} ${yearcal3}`).trigger('change');
			});

			$('.next').on('click', function(){
				dateDynamicCal3.add(1, 'months');
				monthcal3 = dateDynamicCal3.format('MMM');
				yearcal3 = dateDynamicCal3.format('YYYY');
				$('#datepickercal3').val(`${monthcal3} ${yearcal3}`).trigger('change');
			});

		});
	}
</script>