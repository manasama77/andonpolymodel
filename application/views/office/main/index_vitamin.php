<style>
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
		dateDynamic = moment();
		month       = dateDynamic.format('MMM');
		year        = dateDynamic.format('YYYY');

		dateDynamicCal1 = moment();
		monthcal2       = dateDynamicCal1.format('MMM');
		yearcal2        = dateDynamicCal1.format('YYYY');


		clockUpdate();
		setInterval(clockUpdate, 1000);

		wsKikukawa();
		wsNCB3();
		wsNCB6();

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
					// console.log(result);

					if(result.code == 200)
					{
						// Swal.fire({
						// 	position: 'center',
						// 	icon: 'success',
						// 	title: 'Tambah Admin Berhasil',
						// 	showConfirmButton: false,
						// 	timer: 1500
						// }).then(function(){
						// 	window.location.reload();
						// });
						alert('Update Planning Hour Berhasil');
					}else{
						// Swal.fire({
						// 	position: 'center',
						// 	icon: 'error',
						// 	title: 'Gagal Terhubung Dengan Database',
						// 	showConfirmButton: false,
						// 	timer: 1500
						// }).then(function(){
						// 	$.unblockUI();
						// });
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
			format: "M yyyy",
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
				let from = $('#export_start').val();
				let to   = $('#export_end').val();
				window.open(`<?=site_url();?>export/daily/${from}/${to}`, '_blank');
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
				let my = $('#my').val();
				window.open(`<?=site_url();?>export/monthly/${my}`, '_blank');
			}
		});

		
	});


</script>


<script>
	function countChartShow(){
		let count2 = $('.chartShow').length;

		if(count2 == 1){
			$('.chartShow').parent().removeClass('col-6').addClass('col-12').children().css('height', '400px');
		}else if(count2 == 2){
			$('.chartShow').parent().removeClass('col-12').addClass('col-6').children().css('height', '400px');
		}else{
			$('.chartShow').parent().removeClass('col-12').addClass('col-6').children().css('height', '230px');
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

	$.getJSON(`<?=site_url();?>json/m1/${datepicker.val()}`, function(data) {  
		$.each(data, function(key, value){
			dataPoints.push({  
				y: parseFloat(value.eff),
				label: value.tanggal,
			});
			dataStandar.push({ 
				label: value.tanggal,
			});
		});
	});

	$.getJSON(`<?=site_url();?>json/m2/${datepicker.val()}`, function(data) {  
		$.each(data, function(key, value){
			dataPoints2.push({  
				y: parseFloat(value.eff),
				label: value.tanggal,
			});
			dataStandar2.push({ 
				label: value.tanggal,
			});
		});
	});

	$.getJSON(`<?=site_url();?>json/m3/${datepicker.val()}`, function(data) {  
		$.each(data, function(key, value){
			dataPoints3.push({  
				y: parseFloat(value.eff),
				label: value.tanggal,
			});
			dataStandar3.push({ 
				label: value.tanggal,
			});
		});
	});

	$.getJSON(`<?=site_url();?>json/monthly/${yearpicker.val()}`, function(data) {  
		$.each(data.kikukawa_array, function(key, value){
			dataPoints22Kikukawa.push({  
				label: `${value.month} ${value.year}`,
				y: value.eff,
			});
		});

		$.each(data.ncb3_array, function(key, value){
			dataPoints22NCB3.push({  
				label: `${value.month} ${value.year}`,
				y: value.eff,
			});
		});

		$.each(data.ncb6_array, function(key, value){
			dataPoints22NCB6.push({  
				label: `${value.month} ${value.year}`,
				y: value.eff,
			});
		});
	});

	window.onload = function (){
		let dateObj = new Date();
		let MYDate  = dateObj.toLocaleString('default', { month: 'short' }) + " " + dateObj.getFullYear();
		let newEff;
		
		if(datepicker.val() == MYDate){
			wsKikukawa1();
			wsNCB31();
			wsNCB61();
			wsMonthly();
		}
		
		chart1 = new CanvasJS.Chart('kikukawa', {
			animationEnabled: true,
			theme: "dark1",
			title: {
				text: "Kikukawa",
				fontColor: "#ffc107"
			},
			axisX: {
				labelFontFamily: "Calibri",
				labelFontSize: 12,
				interval: 32,
				labelAngle: 90,
				labelFontColor: "#ffc107",
			},
			axisY: {
				title: "Efficiency (%)",
				titleFontColor: "#ffc107",
				suffix: "%",
				titleFontSize: 16,
				includeZero: true,
				gridThickness: 0.5,
				maximum: 100,
				labelFontColor: "#ffc107",
			},
			toolTip: {
				shared: true
			},

			data: [
			{
				type: 'column',
				color: "#f7caac",
				showInLegend: false,
				name: "Eff",
				fillOpacity: 1,
				dataPoints: dataPoints,
				xValueFormatString: "YYYY-MM-DD",
				indexLabel: '{y}%',
				indexLabelOrientation: 'vertical',
				indexLabelPlacement: 'outside',
				indexLabelFontColor: "#ffc107",
				indexLabelFontWeight: "bold",
			},
			{ 
				type: "column",
				color: "#ffc107",
				xValueType: "dateTime",
				xValueFormatString: "YYYY-MM-DD",
				yValueFormatString: "#####.##",
				showInLegend: null,
				toolTipContent: null,
				markerType: null,
				name: "standard",
				fillOpacity: 0,
				dataPoints: dataStandar
			}
			]
		});

		chart2 = new CanvasJS.Chart('ncb3', {
			animationEnabled: true,
			theme: "dark1",
			title: {
				text: "NCB3",
				fontColor: "#ffc107"
			},
			axisX: {
				labelFontFamily: "Calibri",
				labelFontSize: 12,
				interval: 32,
				labelAngle: 90,
				labelFontColor: "#ffc107",
			},
			axisY: {
				title: "Efficiency (%)",
				titleFontColor: "#ffc107",
				suffix: "%",
				titleFontSize: 16,
				includeZero: true,
				gridThickness: 0.5,
				maximum: 100,
				labelFontColor: "#ffc107",
			},
			toolTip: {
				shared: true
			},

			data: [
			{
				type: 'column',
				color: "#2e75b5",
				showInLegend: false,
				name: "Eff",
				fillOpacity: 1,
				dataPoints: dataPoints2,
				xValueFormatString: "YYYY-MM-DD",
				indexLabel: '{y}%',
				indexLabelOrientation: 'vertical',
				indexLabelPlacement: 'outside',
				indexLabelFontColor: "#ffc107",
				indexLabelFontWeight: "bold",
			},
			{ 
				type: "column",
				color: "#999",
				xValueType: "dateTime",
				xValueFormatString: "YYYY-MM-DD",
				yValueFormatString: "#####.##",
				showInLegend: null,
				toolTipContent: null,
				markerType: null,
				name: "standard",
				fillOpacity: 0,
				dataPoints: dataStandar2
			}
			]
		});

		chart3 = new CanvasJS.Chart('ncb6', {
			animationEnabled: true,
			theme: "dark1",
			title: {
				text: "NCB6",
				fontColor: "#ffc107"
			},
			axisX: {
				labelFontFamily: "Calibri",
				labelFontSize: 12,
				interval: 32,
				labelAngle: 90,
				labelFontColor: "#ffc107",
			},
			axisY: {
				title: "Efficiency (%)",
				titleFontColor: "#ffc107",
				suffix: "%",
				titleFontSize: 16,
				includeZero: true,
				gridThickness: 0.5,
				maximum: 100,
				labelFontColor: "#ffc107",
			},
			toolTip: {
				shared: true
			},

			data: [
			{
				type: 'column',
				color: "#92d050",
				showInLegend: false,
				name: "Eff",
				fillOpacity: 1,
				dataPoints: dataPoints3,
				xValueFormatString: "YYYY-MM-DD",
				indexLabel: '{y}%',
				indexLabelOrientation: 'vertical',
				indexLabelPlacement: 'outside',
				indexLabelFontColor: "#ffc107",
				indexLabelFontWeight: "bold",
			},
			{ 
				type: "column",
				color: "#999",
				xValueType: "dateTime",
				xValueFormatString: "YYYY-MM-DD",
				yValueFormatString: "#####.##",
				showInLegend: null,
				toolTipContent: null,
				markerType: null,
				name: "standard",
				fillOpacity: 0,
				dataPoints: dataStandar3
			}
			]
		});

		chart22 = new CanvasJS.Chart('monthly', {
			animationEnabled: true,
			theme: "dark1",
			axisY: {
				title: "Efficiency (%)",
				titleFontColor: "#ffc107",
				suffix: "%",
				titleFontSize: 16,
				includeZero: true,
				gridThickness: 0.5,
				maximum: 110,
				labelFontColor: "#ffc107",
			},
			axisX: {
				labelFontColor: "#ffc107",
			},
			toolTip: {
				shared: true
			},
			legend: {
				cursor: "pointer",
				itemclick: toggleDataSeries22,
				fontColor: "#ffc107",
			},

			data: [
			{
				type: 'column',
				name: "Kikukawa",
				legendText: "Kikukawa",
				showInLegend: true,
				color: "#f7caac",
				fillOpacity: 1,
				dataPoints: dataPoints22Kikukawa,
				indexLabel: '{y}%',
				indexLabelOrientation: 'vertical',
				indexLabelPlacement: 'outside',
				indexLabelFontColor: "#ffc107",
				indexLabelFontWeight: "bold",
			},
			{ 
				type: 'column',
				name: "NCB3",
				legendText: "NCB3",
				showInLegend: true,
				color: "#2e75b5",
				fillOpacity: 1,
				dataPoints: dataPoints22NCB3,
				indexLabel: '{y}%',
				indexLabelOrientation: 'vertical',
				indexLabelPlacement: 'outside',
				indexLabelFontColor: "#ffc107",
				indexLabelFontWeight: "bold",
			},
			{ 
				type: 'column',
				name: "NCB6",
				legendText: "NCB6",
				showInLegend: true,
				color: "#92d050",
				fillOpacity: 1,
				dataPoints: dataPoints22NCB6,
				indexLabel: '{y}%',
				indexLabelOrientation: 'vertical',
				indexLabelPlacement: 'outside',
				indexLabelFontColor: "#ffc107",
				indexLabelFontWeight: "bold",
			}
			]
		});

		chart1.render();
		chart2.render();
		chart3.render();
		chart22.render();

		var cnt     = 0;
		var go      = false;
		function timer() {
			if(!go){
				return;
			}
			changeSlide(cnt);
			// setTimeout(timer, intervalSlide);
			setTimeout(timer, 2000);
		}
		
		function changeSlide(slide){
			console.log(slide)
			if(slide == '0'){
				slide1.show();
				slide2.hide();
				slide3.hide();
			}else if(slide == '1'){
				slide1.hide();
				slide2.show();
				slide3.hide();
			}else if(slide == '2'){
				slide1.hide();
				slide2.hide();
				slide3.show();
			}
			chart1.render();
			chart2.render();
			chart3.render();
			chart22.render();
			cnt++;
			if(cnt >= 3){
				cnt = 0;
			}
		}

		function stopTimer(){
			go = false;
		} 
		function startTimer(){
			go = true;
			timer();
		}
		function nextTimer()
		{
			go = false;
			changeSlide(cnt);
		}

		$('#next_slide').on('click', function(){
			$(this).data('state', 'pause');
			$('#button_pause').show();
			$('#button_play').hide();
			nextTimer();
		});
		startTimer();

		$('#pause_play').on('click', function(){
			state =  $(this).data('state');
			if(state == 'play'){
				$(this).data('state', 'pause');
				stopTimer();
				$('#button_pause').show();
				$('#button_play').hide();
				$(this).addClass('bg-warning').removeClass('bg-success');
			}else{
				$(this).data('state', 'play');
				startTimer();
				$('#button_pause').hide();
				$('#button_play').show();
				$(this).addClass('bg-success').removeClass('bg-warning');
			}
		});

		
		$("#datepicker").datepicker({
			autoclose: true,
			format: "M yyyy",
			viewMode: "months", 
			minViewMode: "months"
		});

		$("#yearpicker").datepicker({
			autoclose: true,
			format: "yyyy",
			viewMode: "years", 
			minViewMode: "years"
		});

		$('#datepicker').on('change', function(){			
			updateChart();
		});

		$('#yearpicker').on('change', function(){			
			updateChart2();
		});

		function toggleDataSeries22(e) {
			if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
				e.dataSeries.visible = false;
			}
			else {
				e.dataSeries.visible = true;
			}
			chart22.render();
		}

		
		function updateChart() {
			dataPoints.splice(0, dataPoints.length);
			dataStandar.splice(0, dataStandar.length);

			dataPoints2.splice(0, dataPoints2.length);
			dataStandar2.splice(0, dataStandar2.length);

			dataPoints3.splice(0, dataPoints3.length);
			dataStandar3.splice(0, dataStandar3.length);

			$.getJSON(`<?=site_url();?>json/m1/${datepicker.val()}`, function(data) {
				$.each(data, function(key, value){
					dataPoints.push({  
						y: parseFloat(value.eff),
						label: value.tanggal,
					});
					dataStandar.push({ 
						label: value.tanggal,
					});
				});
				chart1.render();
			});

			$.getJSON(`<?=site_url();?>json/m2/${datepicker.val()}`, function(data) {
				$.each(data, function(key, value){
					dataPoints2.push({  
						y: parseFloat(value.eff),
						label: value.tanggal,
					});
					dataStandar2.push({ 
						label: value.tanggal,
					});
				});
				chart2.render();
			});

			$.getJSON(`<?=site_url();?>json/m3/${datepicker.val()}`, function(data) {
				$.each(data, function(key, value){
					dataPoints3.push({  
						y: parseFloat(value.eff),
						label: value.tanggal,
					});
					dataStandar3.push({ 
						label: value.tanggal,
					});
				});
				chart3.render();
			});
		}

		function updateChart2() {
			dataPoints22Kikukawa.splice(0, dataPoints22Kikukawa.length);
			dataPoints22NCB3.splice(0, dataPoints22NCB3.length);
			dataPoints22NCB6.splice(0, dataPoints22NCB6.length);

			$.getJSON(`<?=site_url();?>json/monthly/${yearpicker.val()}`, function(data) {
				$.each(data.kikukawa_array, function(key, value){
					dataPoints22Kikukawa.push({  
						label: `${value.month} ${value.year}`,
						y: value.eff,
					});
				});

				$.each(data.ncb3_array, function(key, value){
					dataPoints22NCB3.push({  
						label: `${value.month} ${value.year}`,
						y: value.eff,
					});
				});

				$.each(data.ncb6_array, function(key, value){
					dataPoints22NCB6.push({  
						label: `${value.month} ${value.year}`,
						y: value.eff,
					});
				});

				chart22.render();
			});
		}
	}

	function wsKikukawa1()
	{
		wstest = new WebSocket("ws://localhost:1880/ws/trigger/kikukawa");
		wstest.onerror = (e) => console.log(e);
		wstest.onopen = () => console.log('connect');
		wstest.onclose = () => {
			console.log('disconnect');
			setTimeout(()=> wsKikukawa1(), 1000);
		}
		wstest.onmessage = (e) => {
			data = $.parseJSON(e.data);
			newEff = data.values.eff;

			for (var z = 0; z < dataPoints.length; z++) {
				let xlabel = dataPoints[z].label;
				if(xlabel == dateDynamic.format('YYYY-MM-DD')){
					dataPoints[z].y = parseFloat(newEff);
					chart1.render();
				}
			}
		}
	}

	function wsNCB31()
	{
		wstest2 = new WebSocket("ws://localhost:1880/ws/trigger/ncb3");
		wstest2.onerror = (e) => { console.log(e) }
		wstest2.onopen  = () => { console.log('connect') }
		wstest2.onclose = () => {
			console.log('disconnect');
			setTimeout(()=> {
				wsNCB31();
			}, 1000);
		}
		wstest2.onmessage = (e) => {
			data = $.parseJSON(e.data);
			newEff = data.values.eff;

			for (var z = 0; z < dataPoints2.length; z++) {
				let xlabel = dataPoints2[z].label;
				if(xlabel == dateDynamic.format('YYYY-MM-DD')){
					dataPoints2[z].y = parseFloat(newEff);
					chart2.render();
				}
			}
		}
	}

	function wsNCB61()
	{
		wstest3 = new WebSocket("ws://localhost:1880/ws/trigger/ncb6");
		wstest3.onerror = (e) => { console.log(e) }
		wstest3.onopen  = () => { console.log('connect') }
		wstest3.onclose = () => {
			console.log('disconnect');
			setTimeout(()=> {
				wsNCB61();
			}, 1000);
		}
		wstest3.onmessage = (e) => {
			data = $.parseJSON(e.data);
			newEff = data.values.eff;

			for (var z = 0; z < dataPoints3.length; z++) {
				let xlabel = dataPoints3[z].label;
				if(xlabel == dateDynamic.format('YYYY-MM-DD')){
					dataPoints3[z].y = parseFloat(newEff);
					chart3.render();
				}
			}
		}
	}

	function wsMonthly()
	{
		wsBulanan = new WebSocket("ws://localhost:1880/ws/monthly");
		wsBulanan.onerror = (e) => console.log(e);
		wsBulanan.onopen  = () => console.log('connect');
		wsBulanan.onclose = () => {
			console.log('disconnect');
			setTimeout(()=> wsMonthly(), 1000);
		}
		wsBulanan.onmessage = (e) => {
			let data = $.parseJSON(e.data);

			month    = data.month;
			kikukawa = data.kikukawa;
			ncb3     = data.ncb3;
			ncb6     = data.ncb6;

			for (var z = 0; z < dataPoints22Kikukawa.length; z++) {
				let xlabel = dataPoints22Kikukawa[z].label;
				if(xlabel == dateDynamic.format('MMM YYYY')){
					dataPoints22Kikukawa[z].y = parseFloat(kikukawa.toFixed(2));
					// chart22.render();
				}
			}

			for (var z = 0; z < dataPoints22NCB3.length; z++) {
				let xlabel = dataPoints22NCB3[z].label;
				if(xlabel == dateDynamic.format('MMM YYYY')){
					dataPoints22NCB3[z].y = parseFloat(ncb3.toFixed(2));
					// chart22.render();
				}
			}

			for (var z = 0; z < dataPoints22NCB6.length; z++) {
				let xlabel = dataPoints22NCB6[z].label;
				if(xlabel == dateDynamic.format('MMM YYYY')){
					dataPoints22NCB6[z].y = parseFloat(ncb6.toFixed(2));
					// chart22.render();
				}
			}

			// console.log(dataPoints22Kikukawa);

			chart22.render();
		}
	}

	function initCalendar1()
	{
		$.ajax({
			url: `<?=site_url();?>planning/init_calendar1`,
			type: 'get',
			data: {
				month: monthcal1,
				year: yearcal1,
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

			// $(".triggerDP1").click(function(){ $("#datepickercal1").datepicker("show"); });

			$('#datepickercal1').on('change', function(){
				let xdate = $(this).val();
				let dateExplode = xdate.split(' ');
				monthcal1 = dateExplode[0];
				yearcal1 = dateExplode[1];
				dateDynamicCal1 = moment(`${monthcal1} ${yearcal1}`, 'MMM YYYY');
				initCalendar1();
			});

			$('.prev').on('click', function(){
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

	// function initCalendar2()
	// {
	// 	$.ajax({
	// 		url: `<?=site_url();?>planning/init_calendar2`,
	// 		type: 'get',
	// 		data: {
	// 			month: monthcal2,
	// 			year: yearcal2,
	// 		},
	// 		beforeSend: function(){
	// 			$('#submit2').attr('disabled', true);
	// 			$.blockUI();
	// 		},
	// 		statusCode: {
	// 			404: function(){
	// 				$.unblockUI();
	// 				alert('Page not Found');
	// 			},
	// 			500: function(){
	// 				$.unblockUI();
	// 				alert('Cannot connect to database');
	// 			},
	// 			503: function(){
	// 				$.unblockUI();
	// 				alert('Connection timeout');
	// 			}
	// 		}
	// 	}).done(function(res){
	// 		$('#vcalendar2').html(res);
	// 		$('#submit2').attr('disabled', false);
	// 		$.unblockUI();

	// 		$('.fdate').inputmask('99:99');
	// 		$("#datepickercal2").datepicker({
	// 			autoclose: true,
	// 			format: "M yyyy",
	// 			viewMode: "months", 
	// 			minViewMode: "months"
	// 		});

	// 		$('#datepickercal2').on('change', function(){
	// 			let xdate = $(this).val();
	// 			let dateExplode = xdate.split(' ');
	// 			monthcal2 = dateExplode[0];
	// 			yearcal2 = dateExplode[1];
	// 			dateDynamicCal2 = moment(`${monthcal2} ${yearcal2}`, 'MMM YYYY');
	// 			initCalendar2();
	// 		});

	// 		$('.prev').on('click', function(){
	// 			dateDynamicCal2.subtract(1, 'months');
	// 			monthcal2 = dateDynamicCal2.format('MMM');
	// 			yearcal2 = dateDynamicCal2.format('YYYY');
	// 			$('#datepickercal2').val(`${monthcal2} ${yearcal2}`).trigger('change');
	// 		});

	// 		$('.next').on('click', function(){
	// 			dateDynamicCal2.add(1, 'months');
	// 			monthcal2 = dateDynamicCal2.format('MMM');
	// 			yearcal2 = dateDynamicCal2.format('YYYY');
	// 			$('#datepickercal2').val(`${monthcal2} ${yearcal2}`).trigger('change');
	// 		});

	// 	});
	// }
</script>