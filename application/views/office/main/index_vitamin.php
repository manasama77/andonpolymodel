<script>
	/*
	GLOBAL VARIABLE DEFINE HERE
	*/
	let 
	wrapper              = $("#wrapper"),
	menuToggle           = $("#menu-toggle"),
	now                  = moment(),
	realclock            = $('.realclock'),
	slideShow            = $("#slideshow"),
	zInterval            = `<?=ZINTERVAL;?>`,
	nextSlide            = $("#next_slide"),
	pausePlay            = $("#pause_play"),
	kue,
	varInterval,
	kikukawaChart,
	ncb3Chart,
	ncb6Chart,
	dateDynamic,
	month,
	year,
	datepicker           = $('#datepicker'),
	yearpicker           = $('#yearpicker'),
	chart1,
	dataPoints           = [],
	dataStandar          = [],
	chart2,
	dataPoints2          = [],
	dataStandar2         = [],
	chart3,
	dataPoints3          = [],
	dataStandar3         = [],
	chart22,
	dataPoints22Kikukawa = [],
	dataPoints22NCB3     = [],
	dataPoints22NCB6     = [],
	monthcal1,
	yearcal1,
	dateDynamicCal1,
	monthcal2,
	yearcal2,
	dateDynamicCal2,
	monthcal3,
	yearcal3,
	dateDynamicCal3,
	isPaused             = false,
	state                =  pausePlay.data('state');

	$(document).ready(() => {
		menuToggle.click((e) => { e.preventDefault(); wrapper.toggleClass("toggled"); });
		initClock();
		getJson();
		initDailyEfficiency();
		initCalendar();
		initModal();
	});
</script>

<script>
	document.onkeydown = function(event) {
		if(event.keyCode == 39){ nextSlide.trigger('click'); }
		if(event.keyCode == 80){ pausePlay.trigger('click'); }
	};

	function initClock(){
		clockUpdate();
		setInterval(clockUpdate, 1000);

		function clockUpdate() {
			now = moment();
			realclock.text(now.format(`ddd, DD MMM YYYY hh:mm:ss A`));
		}
	}

	function getJson(){
		$.getJSON(`<?=site_url();?>json/m1/${datepicker.val()}`, function(data) {  
			$.each(data, function(key, value){
				dataPoints.push({  
					label: `${value.tanggal}`,
					x: new Date(value.y, value.m, value.d),
					y: value.eff,
				});
			});
		});

		$.getJSON(`<?=site_url();?>json/m2/${datepicker.val()}`, function(data) {  
			$.each(data, function(key, value){
				dataPoints2.push({  
					label: `${value.tanggal}`,
					x: new Date(value.y, value.m, value.d),
					y: value.eff,
				});
			});
		});

		$.getJSON(`<?=site_url();?>json/m3/${datepicker.val()}`, function(data) {  
			$.each(data, function(key, value){
				dataPoints3.push({
					label: `${value.tanggal}`,
					x: new Date(value.y, value.m, value.d),
					y: parseFloat(value.eff),
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
	}

	function initModal()
	{
		$('#tExport').on('click', function(){
			$('#modal-export').modal('show');
		});

		$('#tPlan').on('click', function(){
			$('#modal-planning').modal('show');
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
	}

	function initCalendar()
	{
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

		dateDynamicCal1 = moment();
		dateDynamicCal2 = moment();
		dateDynamicCal3 = moment();

		monthcal1 = dateDynamicCal1.format('MMM');
		yearcal1  = dateDynamicCal1.format('YYYY');
		
		monthcal2 = dateDynamicCal2.format('MMM');
		yearcal2  = dateDynamicCal2.format('YYYY');

		monthcal3 = dateDynamicCal3.format('MMM');
		yearcal3  = dateDynamicCal3.format('YYYY');

		$('#submit1').click( function(e){
			e.preventDefault();
			$('#form_calendar1').submit();
			$('#form_calendar2').submit();
			$('#form_calendar3').submit();
		});
		$('#submit2').click( function(e){
			e.preventDefault();
			$('#form_calendar1').submit();
			$('#form_calendar2').submit();
			$('#form_calendar3').submit();
		});
		$('#submit3').click( function(e){
			e.preventDefault();
			$('#form_calendar1').submit();
			$('#form_calendar2').submit();
			$('#form_calendar3').submit();
		});

		generateCalendar(1, monthcal1, yearcal1);
		generateCalendar(2, monthcal2, yearcal2);
		generateCalendar(3, monthcal3, yearcal3);
		calendarValidate();

		function generateCalendar(no_calendar, monthcal, yearcal)
		{
			$.ajax({
				url: `<?=site_url();?>planning/init_calendar${no_calendar}`,
				type: 'get',
				data: {
					monthcal: monthcal,
					yearcal: yearcal,
				},
				beforeSend: function(){
					$(`#submit${no_calendar}`).attr('disabled', true);
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
				$(`#vcalendar${no_calendar}`).html(res);
				$(`#submit${no_calendar}`).attr('disabled', false);
				$('.fdate').inputmask('99:99');
				$(`#datepickercal${no_calendar}`).datepicker({
					autoclose: true,
					format: "M yyyy",
					viewMode: "months", 
					minViewMode: "months"
				});
				$.unblockUI();

				$(`#datepickercal${no_calendar}`).on('change', () => {
					let xdate       = $(`#datepickercal${no_calendar}`).val();
					let dateExplode = xdate.split(' ');

					monthcal       = dateExplode[0];
					yearcal        = dateExplode[1];

					if(no_calendar == 1){
						dateDynamicCal1 = moment(`${monthcal} ${yearcal}`, 'MMM YYYY');
					}else if(no_calendar == 2){
						dateDynamicCal2 = moment(`${monthcal} ${yearcal}`, 'MMM YYYY');
					}else if(no_calendar == 3){
						dateDynamicCal3 = moment(`${monthcal} ${yearcal}`, 'MMM YYYY');
					}

					generateCalendar(no_calendar, monthcal, yearcal);
				});

				$('.prev1').on('click', function(){
					dateDynamicCal1.subtract(1, 'months');
					monthcal1 = dateDynamicCal1.format('MMM');
					yearcal1  = dateDynamicCal1.format('YYYY');
					$('#datepickercal1').val(`${monthcal1} ${yearcal1}`).trigger('change');
				});

				$('.next1').on('click', function(){
					dateDynamicCal1.add(1, 'months');
					monthcal1 = dateDynamicCal1.format('MMM');
					yearcal1  = dateDynamicCal1.format('YYYY');
					$('#datepickercal1').val(`${monthcal1} ${yearcal1}`).trigger('change');
				});

				$('.prev2').on('click', function(){
					dateDynamicCal2.subtract(1, 'months');
					monthcal2 = dateDynamicCal2.format('MMM');
					yearcal2 = dateDynamicCal2.format('YYYY');
					$('#datepickercal2').val(`${monthcal2} ${yearcal2}`).trigger('change');
				});

				$('.next2').on('click', function(){
					dateDynamicCal2.add(1, 'months');
					monthcal2 = dateDynamicCal2.format('MMM');
					yearcal2 = dateDynamicCal2.format('YYYY');
					$('#datepickercal2').val(`${monthcal2} ${yearcal2}`).trigger('change');
				});

				$('.prev3').on('click', function(){
					dateDynamicCal3.subtract(1, 'months');
					monthcal3 = dateDynamicCal3.format('MMM');
					yearcal3 = dateDynamicCal3.format('YYYY');
					$('#datepickercal3').val(`${monthcal3} ${yearcal3}`).trigger('change');
				});

				$('.next3').on('click', function(){
					dateDynamicCal3.add(1, 'months');
					monthcal3 = dateDynamicCal3.format('MMM');
					yearcal3 = dateDynamicCal3.format('YYYY');
					$('#datepickercal3').val(`${monthcal3} ${yearcal3}`).trigger('change');
				});

			});
		}

		function calendarValidate()
		{
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

					// if(result.code == 200)
					// {
					// 	alert('Update Planning Hour Berhasil');
					// }else{
					// 	alert('Update Planning Hour Gagal');
					// }
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

					// if(result.code == 200)
					// {
					// 	alert('Update Planning Hour Berhasil');
					// }else{
					// 	alert('Update Planning Hour Gagal');
					// }
					$.unblockUI();
				});
				}
			});
		}
	}

	function initDailyEfficiency()
	{
		renderDailyEfficiency('kikukawa');
		renderDailyEfficiency('ncb3');
		renderDailyEfficiency('ncb6');

		function renderDailyEfficiency(type)
		{
			let ws = new WebSocket(`<?=NODERED?>/ws/trigger/${type}`);
			ws.onerror = (e) => console.log(e)
			ws.onopen = () => console.log('connect');
			ws.onclose = () => {
				console.log('disconnect');
				setTimeout(()=> renderDailyEfficiency(type), 1000);
			}
			ws.onmessage = (e) => {
				let res     = $.parseJSON(e.data);
				let trigger = res.trigger;
				let values  = res.values;
				let mType   = '';

				if(type == "kikukawa"){
					mType = "m1";
					checkTriggerDailyEfficiency(trigger, mType);
				}else if(type == "ncb3"){
					mType = "m2";
					checkTriggerDailyEfficiency(trigger, mType);
				}else if(type == "ncb6"){
					mType = "m3";
					checkTriggerDailyEfficiency(trigger, mType);
				}

				$(`#${mType}cutting`).removeClass('cuttingBG').removeClass('text-dark');
				$(`#${mType}dandori`).removeClass('dandoriBG').removeClass('text-dark');
				$(`#${mType}man`).removeClass('manBG').removeClass('text-dark');
				$(`#${mType}idle`).removeClass('idleBG').removeClass('text-dark');
				$(`#${mType}alarm`).removeClass('alarmBG').removeClass('text-dark');				

				$(`#${mType}cutting`).text( hhmm(values.cutting) );
				$(`#${mType}dandori`).text( hhmm(values.dandori) );
				$(`#${mType}man`).text( hhmm(values.man) );
				$(`#${mType}idle`).text( hhmm(values.idle) );
				$(`#${mType}alarm`).text( hhmm(values.alarm) );
				$(`#${mType}eff`).text(`${parseFloat(values.eff).toFixed(2)}%`);

				function checkTriggerDailyEfficiency(trigger, mType)
				{
					if(trigger.length > 1){
						$.each(trigger, (i, k) => {
							if(k == "cutting"){ $(`#${mType}cutting`).addClass('cuttingBG text-dark'); }
							if(k == "dandori"){ $(`#${mType}dandori`).addClass('dandoriBG text-dark'); }
							if(k == "man"){ $(`#${mType}man`).addClass('manBG text-dark'); }
							if(k == "idle"){ $(`#${mType}idle`).addClass('idleBG text-dark'); }
							if(k == "alarm"){ $(`#${mType}alarm`).addClass('alarmBG text-dark'); }
						});
					}else{
						$.each(trigger, (i, k) => {
							if(k == "cutting"){
								$(`#${mType}cutting`).addClass('cuttingBG text-dark');
							}else if(k == "dandori"){
								$(`#${mType}dandori`).addClass('dandoriBG text-dark');
							}else if(k == "man"){
								$(`#${mType}man`).addClass('manBG text-dark');
							}else if(k == "idle"){
								$(`#${mType}idle`).addClass('idleBG text-dark');
							}else if(k == "alarm"){
								$(`#${mType}alarm`).addClass('alarmBG text-dark');
							}
						});
					}
				}

				function hhmm(secs) {
					let minutes = Math.floor(parseInt(secs) / 60);
					let hours   = Math.floor(minutes/60)
					minutes     = minutes%60;
					return `${pad(hours)}:${pad(minutes)}`;
				}


				function pad(num) {
					return (`0${num}`).slice(-2);
				}

			}
		}
	}

	window.onload = function(){
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
				margin: 1,
				labelMaxWidth: 31,
				labelWrap: true,
				labelAutoFit: false,
				labelAngle: 180,
				labelFontFamily: "Calibri",
				labelFontColor: "#ffc107",
				labelFontSize: 15,
				labelFontweight: 'lighter',
				crosshair: { 
					enabled: true,
					snapToDataPoint: true,
				},
				interval: 1,
				intervalType: 'day',
				labelFormatter: function (e) {
					return CanvasJS.formatDate( e.value, "D");
				}
			},
			axisY: {
				valueFormatString: "#.##",
				title: "Efficiency (%)",
				titleFontColor: "#ffc107",
				suffix: "%",
				titleFontSize: 16,
				includeZero: true,
				gridThickness: 0.5,
				maximum: 120,
				labelFontColor: "#ffc107",
				labelWrap: true,
				crosshair: { 
					enabled: true,
					snapToDataPoint: true,
					labelFormatter: function (e) {
						return "Eff: " + CanvasJS.formatNumber(e.value, "#.##");
					}
				},
				interval: 20,
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
				fillOpacity: .5,
				dataPoints: dataPoints,
				indexLabel: '{y}%',
				indexLabelOrientation: 'vertical',
				indexLabelPlacement: 'outside',
				indexLabelFontColor: "#fff",
				indexLabelFontWeight: "bold",
			},
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
				margin: 1,
				labelMaxWidth: 31,
				labelWrap: true,
				labelAutoFit: false,
				labelAngle: 180,
				labelFontFamily: "Calibri",
				labelFontColor: "#ffc107",
				labelFontSize: 15,
				labelFontweight: 'lighter',
				crosshair: { 
					enabled: true,
					snapToDataPoint: true,
				},
				interval: 1,
				intervalType: 'day',
				labelFormatter: function (e) {
					return CanvasJS.formatDate( e.value, "D");
				}
			},
			axisY: {
				valueFormatString: "#.##",
				title: "Efficiency (%)",
				titleFontColor: "#ffc107",
				suffix: "%",
				titleFontSize: 16,
				includeZero: true,
				gridThickness: 0.5,
				maximum: 120,
				labelFontColor: "#ffc107",
				labelWrap: true,
				crosshair: { 
					enabled: true,
					snapToDataPoint: true,
					labelFormatter: function (e) {
						return "Eff: " + CanvasJS.formatNumber(e.value, "#.##");
					}
				},
				interval: 20,
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
				fillOpacity: .5,
				dataPoints: dataPoints2,
				indexLabel: '{y}%',
				indexLabelOrientation: 'vertical',
				indexLabelPlacement: 'outside',
				indexLabelFontColor: "#fff",
				indexLabelFontWeight: "bold",
			},
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
				margin: 1,
				labelMaxWidth: 31,
				labelWrap: true,
				labelAutoFit: false,
				labelAngle: 180,
				labelFontFamily: "Calibri",
				labelFontColor: "#ffc107",
				labelFontSize: 15,
				labelFontweight: 'lighter',
				crosshair: { 
					enabled: true,
					snapToDataPoint: true,
				},
				interval: 1,
				intervalType: 'day',
				labelFormatter: function (e) {
					return CanvasJS.formatDate( e.value, "D");
				}
			},
			axisY: {
				valueFormatString: "#.##",
				title: "Efficiency (%)",
				titleFontColor: "#ffc107",
				suffix: "%",
				titleFontSize: 16,
				includeZero: true,
				gridThickness: 0.5,
				maximum: 120,
				labelFontColor: "#ffc107",
				labelWrap: true,
				crosshair: { 
					enabled: true,
					snapToDataPoint: true,
					labelFormatter: function (e) {
						return "Eff: " + CanvasJS.formatNumber(e.value, "#.##");
					}
				},
				interval: 20,
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
				fillOpacity: .5,
				dataPoints: dataPoints3,
				indexLabel: '{y}%',
				indexLabelOrientation: 'vertical',
				indexLabelPlacement: 'outside',
				indexLabelFontColor: "#fff",
				indexLabelFontWeight: "bold",
			},
			]
		});

		chart22 = new CanvasJS.Chart('monthly', {
			animationEnabled: false,
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
				fillOpacity: .5,
				dataPoints: dataPoints22Kikukawa,
				indexLabel: '{y}%',
				indexLabelOrientation: 'vertical',
				indexLabelPlacement: 'outside',
				indexLabelFontColor: "#fff",
				indexLabelFontWeight: "bold",
			},
			{ 
				type: 'column',
				name: "NCB3",
				legendText: "NCB3",
				showInLegend: true,
				color: "#2e75b5",
				fillOpacity: .5,
				dataPoints: dataPoints22NCB3,
				indexLabel: '{y}%',
				indexLabelOrientation: 'vertical',
				indexLabelPlacement: 'outside',
				indexLabelFontColor: "#fff",
				indexLabelFontWeight: "bold",
			},
			{ 
				type: 'column',
				name: "NCB6",
				legendText: "NCB6",
				showInLegend: true,
				color: "#92d050",
				fillOpacity: .5,
				dataPoints: dataPoints22NCB6,
				indexLabel: '{y}%',
				indexLabelOrientation: 'vertical',
				indexLabelPlacement: 'outside',
				indexLabelFontColor: "#fff",
				indexLabelFontWeight: "bold",
			}
			]
		});

		chart1.render();
		chart2.render();
		chart3.render();
		chart22.render();

		$('#datepicker').on('change', () => updateChart() );
		$('#yearpicker').on('change', () => updateChart2() );

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
			dataPoints2.splice(0, dataPoints2.length);
			dataPoints3.splice(0, dataPoints3.length);

			$.getJSON(`<?=site_url();?>json/m1/${datepicker.val()}`, function(data) {  
				$.each(data, function(key, value){
					dataPoints.push({  
						label: `${value.tanggal}`,
						x: new Date(value.y, value.m, value.d),
						y: value.eff,
					});
				});
				chart1.render();
			});

			$.getJSON(`<?=site_url();?>json/m2/${datepicker.val()}`, function(data) {  
				$.each(data, function(key, value){
					dataPoints2.push({  
						label: `${value.tanggal}`,
						x: new Date(value.y, value.m, value.d),
						y: value.eff,
					});
				});
				chart2.render();
			});

			$.getJSON(`<?=site_url();?>json/m3/${datepicker.val()}`, function(data) {  
				$.each(data, function(key, value){
					dataPoints3.push({
						label: `${value.tanggal}`,
						x: new Date(value.y, value.m, value.d),
						y: parseFloat(value.eff),
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

		function wsMonthly()
		{
			wsBulanan = new WebSocket("<?=NODERED?>/ws/monthly");
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
					if(xlabel == dateDynamicCal1.format('MMM YYYY')){
						dataPoints22Kikukawa[z].y = parseFloat(kikukawa.toFixed(2));
					}
				}

				for (var z = 0; z < dataPoints22NCB3.length; z++) {
					let xlabel = dataPoints22NCB3[z].label;
					if(xlabel == dateDynamicCal2.format('MMM YYYY')){
						dataPoints22NCB3[z].y = parseFloat(ncb3.toFixed(2));
					}
				}

				for (var z = 0; z < dataPoints22NCB6.length; z++) {
					let xlabel = dataPoints22NCB6[z].label;
					if(xlabel == dateDynamicCal3.format('MMM YYYY')){
						dataPoints22NCB6[z].y = parseFloat(ncb6.toFixed(2));
					}
				}

				chart22.render();
			}
		}

		function wsKikukawa1()
		{
			wstest = new WebSocket("<?=NODERED?>/ws/trigger/kikukawa");
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
					if(xlabel == dateDynamicCal1.format('YYYY-MM-DD')){
						dataPoints[z].y = parseFloat(newEff);
						chart1.render();
					}
				}
			}
		}

		function wsNCB31()
		{
			wstest2 = new WebSocket("<?=NODERED?>/ws/trigger/ncb3");
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
					if(xlabel == dateDynamicCal2.format('YYYY-MM-DD')){
						dataPoints2[z].y = parseFloat(newEff);
						chart2.render();
					}
				}
			}
		}

		function wsNCB61()
		{
			wstest3 = new WebSocket("<?=NODERED?>/ws/trigger/ncb6");
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
					if(xlabel == dateDynamicCal3.format('YYYY-MM-DD')){
						dataPoints3[z].y = parseFloat(newEff);
						chart3.render();
					}
				}
			}
		}

		function wsMonthly()
		{
			wsBulanan = new WebSocket("<?=NODERED?>/ws/monthly");
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
					if(xlabel == dateDynamicCal1.format('MMM YYYY')){
						dataPoints22Kikukawa[z].y = parseFloat(kikukawa.toFixed(2));
					}
				}

				for (var z = 0; z < dataPoints22NCB3.length; z++) {
					let xlabel = dataPoints22NCB3[z].label;
					if(xlabel == dateDynamicCal2.format('MMM YYYY')){
						dataPoints22NCB3[z].y = parseFloat(ncb3.toFixed(2));
					}
				}

				for (var z = 0; z < dataPoints22NCB6.length; z++) {
					let xlabel = dataPoints22NCB6[z].label;
					if(xlabel == dateDynamicCal3.format('MMM YYYY')){
						dataPoints22NCB6[z].y = parseFloat(ncb6.toFixed(2));
					}
				}

				chart22.render();
			}
		}

		initSlideShow();

		function initSlideShow()
		{
			kue = Cookies.get('aktifSlide');
			if(kue){
				logicSlideShow();
				setTimeout(function(){
					varInterval = setInterval(function() {
						if(isPaused == false){
							kue++;
							if(kue == 3) { kue = 0; }
							Cookies.set("aktifSlide", kue);
							logicSlideShow();
							console.log("lanjut cookies");
						}
					},  zInterval);
				}, zInterval);
			}else{
				kue = 0;
				$("#slideshow > div:gt(0)").hide();
				varInterval = setInterval(function() {
					if(isPaused == false){
						$('#slideshow > div:first').fadeOut(1000).next().fadeIn(1000).end().appendTo('#slideshow');
						kue++;
						if(kue == 3) { kue = 0; }
						Cookies.set("aktifSlide", kue);
						console.log("lanjut normal");
					}
				},  zInterval);
			}

			setTimeout(function(){
				kikukawaChart = Cookies.get("kikukawaChart");
				if(kikukawaChart){
					if(kikukawaChart == 'off'){
						$('.triggerChart1').trigger('click');
					}
				}

				ncb3Chart = Cookies.get("ncb3Chart");
				if(ncb3Chart){
					if(ncb3Chart == 'off'){
						$('.triggerChart2').trigger('click');
					}
				}

				ncb6Chart = Cookies.get("ncb6Chart");
				if(ncb6Chart){
					if(ncb6Chart == 'off'){
						$('.triggerChart3').trigger('click');
					}
				}
			}, 1000);

			nextSlide.on('click', () => {
				isPaused = true;
				$('#button_pause').show();
				$('#button_play').hide();
				pausePlay.addClass('bg-warning').removeClass('bg-success');
				kue++;
				if(kue == 3) { kue = 0; }
				Cookies.set("aktifSlide", kue);
				logicSlideShow();
			});

			$('#pause_play').on('click', () => {
				if(state == 'play'){
					console.log(state);
					isPaused = true;
					state = 'pause';
					$('#button_pause').show();
					$('#button_play').hide();
					pausePlay.addClass('bg-warning').removeClass('bg-success');
				}else{
					console.log(state);
					isPaused = false;
					state = 'play';
					$('#button_pause').hide();
					$('#button_play').show();
					pausePlay.addClass('bg-success').removeClass('bg-warning');
				}
			});

			$('.triggerChart1').click(function(e){
				if($('#kikukawa').hasClass('chartShow')){
					$('#kikukawa').parent().hide();
					$('#kikukawa').removeClass('chartShow');
					$(this).addClass('kikukawa2LabelOff');
					Cookies.set("kikukawaChart", 'off');
				} else {
					$('#kikukawa').parent().show();
					$('#kikukawa').addClass('chartShow');
					$(this).removeClass('kikukawa2LabelOff');
					Cookies.set("kikukawaChart", 'on');
				}
				countChartShow();
			});

			$('.triggerChart2').click(function(e){
				if($('#ncb3').hasClass('chartShow')){
					$('#ncb3').parent().hide();
					$('#ncb3').removeClass('chartShow');
					$(this).addClass('ncb32LabelOff');
					Cookies.set("ncb3Chart", 'off');
				} else {
					$('#ncb3').parent().show();
					$('#ncb3').addClass('chartShow');
					$(this).removeClass('ncb32LabelOff');
					Cookies.set("ncb3Chart", 'on');
				}
				countChartShow();
			});

			$('.triggerChart3').click(function(e){
				if($('#ncb6').hasClass('chartShow')){
					$('#ncb6').parent().hide();
					$('#ncb6').removeClass('chartShow');
					$(this).addClass('ncb62LabelOff');
					Cookies.set("ncb6Chart", 'off');
				} else {
					$('#ncb6').parent().show();
					$('#ncb6').addClass('chartShow');
					$(this).removeClass('ncb62LabelOff');
					Cookies.set("ncb6Chart", 'on');
				}
				countChartShow();
			});

			function logicSlideShow()
			{
				if(kue == 0){
					$('.slide_1').fadeIn(1000);
					$('.slide_2').fadeOut(1000);
					$('.slide_3').fadeOut(1000);
				}else if(kue == 1){
					$('.slide_1').fadeOut(1000);
					$('.slide_2').fadeIn(1000);
					$('.slide_3').fadeOut(1000);
				}else if(kue == 2){
					$('.slide_1').fadeOut(1000);
					$('.slide_2').fadeOut(1000);
					$('.slide_3').fadeIn(1000);
				}else{
					$('.slide_1').fadeOut(1000);
					$('.slide_2').fadeOut(1000);
					$('.slide_3').fadeOut(1000);
				}

				chart1.render();
				chart2.render();
				chart3.render();
				chart22.render();
			}

			function countChartShow(){
				let count2 = $('.chartShow').length;

				if(count2 == 1){
					$('.chartShow').parent().removeClass('col-6').addClass('col-12').children().css('height', '520px');
				}else if(count2 == 2){
					$('.chartShow').parent().removeClass('col-12').addClass('col-6').children().css('height', '520px');
				}else{
					$('.chartShow').parent().removeClass('col-12').addClass('col-6').children().css('height', '240px');
				}
				chart1.render();
				chart2.render();
				chart3.render();
				chart22.render();
			}
		}

	}
</script>