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
	.manBG{ background-color: #2e75b5 !important; }s
	.idleBG{ background-color: #ffff99 !important; }
	.alarmBG{ background-color: #f7caac !important; }

	.chartShow{ display: block; }
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
	let statusSlide   = 'play';
	let activeSlide   = 'slide2';
	let intervalSlide = 10000; // 10 detik

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
	

	let renderSlide = $.timer(function(){
		if(activeSlide == "slide1"){
			slide1.show();
			slide2.hide();
			slide3.hide();
			activeSlide = "slide2";
		}else if(activeSlide == "slide2"){
			slide1.hide();
			slide2.show();
			slide3.hide();
			activeSlide = "slide3";
		}else if(activeSlide == "slide3"){
			slide1.hide();
			slide2.hide();
			slide3.show();
			activeSlide = "slide1";
		}

		// chart1.render();
		// chart2.render();
		chart3.render();
		// chart22.render();
	});
	
	
	$(document).ready(function(){
		dateDynamic = moment();
		month = dateDynamic.format('MMM');
		year = dateDynamic.format('YYYY');

		clockUpdate();
		setInterval(clockUpdate, 1000);
		// wsKikukawa();
		// wsNCB3();
		wsNCB6();

		// renderSlide.set({
		// 	time: intervalSlide,
		// 	autostart: true
		// });

		// renderSlide.play();

		$('#section2').hide();
		$('#section3').hide();

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
		// chart1.render();
		// chart2.render();
		chart3.render();
		// chart22.render();
	}

	function clockUpdate() {
		let now = moment();
		realclock.text(now.format(`ddd, DD MMM YYYY hh:mm:ss A`));
	}

	function wsKikukawa()
	{
		wstest = new WebSocket("ws://localhost:1880/ws/trigger/kikukawa");
		wstest.onerror = (e) => { console.log(e) }
		wstest.onopen = () => { console.log('connect') }
		wstest.onclose = () => {
			console.log('disconnect');
			setTimeout(()=> {
				wsKikukawa();
			}, 1000);
		}
		wstest.onmessage = (e) => {
			data = $.parseJSON(e.data);
			
			let trigger = data.trigger;
			let values = data.values;

			$('#m1cutting').removeClass('cuttingBG');
			$('#m1dandori').removeClass('dandoriBG');
			$('#m1man').removeClass('manBG');
			$('#m1idle').removeClass('idleBG');
			$('#m1alarm').removeClass('alarmBG');

			if(trigger.length > 1){

				$.each(trigger, (i, k) => {
					if(k == "cutting"){ $('#m1cutting').addClass('cuttingBG'); }

					if(k == "dandori"){ $('#m1dandori').addClass('dandoriBG'); }

					if(k == "man"){ $('#m1man').addClass('manBG'); }

					if(k == "idle"){ $('#m1idle').addClass('idleBG');}

					if(k == "alarm"){ $('#m1alarm').addClass('alarmBG'); }

				});

			}else{
				$.each(trigger, (i, k) => {
					if(k == "cutting"){ 
						$('#m1cutting').addClass('cuttingBG'); 
					}else if(k == "dandori"){
						$('#m1dandori').addClass('dandoriBG');
					}else if(k == "man_act"){
						$('#m1man').addClass('manBG');
					}else if(k == "iddle"){
						$('#m1idle').addClass('idleBG');
					}else if(k == "alarm"){
						$('#m1alarm').addClass('alarmBG');
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

			$('#m2cutting').removeClass('cuttingBG');
			$('#m2dandori').removeClass('dandoriBG');
			$('#m2man').removeClass('manBG');
			$('#m2idle').removeClass('idleBG');
			$('#m2alarm').removeClass('alarmBG');

			if(trigger.length > 1){

				$.each(trigger, (i, k) => {
					if(k == "cutting"){ $('#m2cutting').addClass('cuttingBG'); }

					if(k == "dandori"){ $('#m2dandori').addClass('dandoriBG'); }

					if(k == "man"){ $('#m2man').addClass('manBG'); }

					if(k == "idle"){ $('#m2idle').addClass('idleBG');}

					if(k == "alarm"){ $('#m2alarm').addClass('alarmBG'); }

				});

			}else{
				$.each(trigger, (i, k) => {
					if(k == "cutting"){ 
						$('#m2cutting').addClass('cuttingBG'); 
					}else if(k == "dandori"){
						$('#m2dandori').addClass('dandoriBG');
					}else if(k == "man_act"){
						$('#m2man').addClass('manBG');
					}else if(k == "iddle"){
						$('#m2idle').addClass('idleBG');
					}else if(k == "alarm"){
						$('#m2alarm').addClass('alarmBG');
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

			$('#m3cutting').removeClass('cuttingBG');
			$('#m3dandori').removeClass('dandoriBG');
			$('#m3man').removeClass('manBG');
			$('#m3idle').removeClass('idleBG');
			$('#m3alarm').removeClass('alarmBG');

			if(trigger.length > 1){

				$.each(trigger, (i, k) => {
					if(k == "cutting"){ $('#m3cutting').addClass('cuttingBG'); }

					if(k == "dandori"){ $('#m3dandori').addClass('dandoriBG'); }

					if(k == "man"){ $('#m3man').addClass('manBG'); }

					if(k == "idle"){ $('#m3idle').addClass('idleBG');}

					if(k == "alarm"){ $('#m3alarm').addClass('alarmBG'); }

				});

			}else{
				$.each(trigger, (i, k) => {
					if(k == "cutting"){ 
						$('#m3cutting').addClass('cuttingBG'); 
					}else if(k == "dandori"){
						$('#m3dandori').addClass('dandoriBG');
					}else if(k == "man_act"){
						$('#m3man').addClass('manBG');
					}else if(k == "iddle"){
						$('#m3idle').addClass('idleBG');
					}else if(k == "alarm"){
						$('#m3alarm').addClass('alarmBG');
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

	function pausePlaySlide()
	{
		console.log(statusSlide);
		if(statusSlide == 'play'){
			statusSlide = 'pause';
			$('#button_pause').show();
			$('#button_play').hide();
			renderSlide.pause();
		}else if(statusSlide == 'pause'){
			statusSlide = 'play';
			$('#button_pause').hide();
			$('#button_play').show();
			renderSlide.play();
		}
	}

	function nextSlide()
	{
		console.log(activeSlide)
		statusSlide = 'pause';
		renderSlide.pause();
		$('#button_pause').show();
		$('#button_play').hide();

		if(activeSlide == "slide1"){
			slide1.show();
			slide2.hide();
			slide3.hide();
			activeSlide = "slide2";
		}else if(activeSlide == "slide2"){
			slide1.hide();
			slide2.show();
			slide3.hide();
			activeSlide = "slide3";
		}else if(activeSlide == "slide3"){
			slide1.hide();
			slide2.hide();
			slide3.show();
			activeSlide = "slide1";
		}

		// chart1.render();
		// chart2.render();
		chart3.render();
		// chart22.render();

	}

	// $.getJSON(`<?=site_url();?>json/m1/${datepicker.val()}`, function(data) {  
	// 	$.each(data, function(key, value){
	// 		dataPoints.push({  
	// 			y: parseFloat(value.eff),
	// 			label: value.tanggal,
	// 		});
	// 		dataStandar.push({ 
	// 			label: value.tanggal,
	// 		});
	// 	});
	// });

	// $.getJSON(`<?=site_url();?>json/m2/${datepicker.val()}`, function(data) {  
	// 	$.each(data, function(key, value){
	// 		dataPoints2.push({  
	// 			y: parseFloat(value.eff),
	// 			label: value.tanggal,
	// 		});
	// 		dataStandar2.push({ 
	// 			label: value.tanggal,
	// 		});
	// 	});
	// });

	// $.getJSON(`<?=site_url();?>json/m3/${datepicker.val()}`, function(data) {  
	// 	$.each(data, function(key, value){
	// 		dataPoints3.push({  
	// 			y: parseFloat(value.eff),
	// 			label: value.tanggal,
	// 		});
	// 		dataStandar3.push({ 
	// 			label: value.tanggal,
	// 		});
	// 	});
	// });

	// $.getJSON(`<?=site_url();?>json/monthly/${yearpicker.val()}`, function(data) {  
	// 	$.each(data.kikukawa_array, function(key, value){
	// 		dataPoints22Kikukawa.push({  
	// 			label: `${value.month} ${value.year}`,
	// 			y: value.eff,
	// 		});
	// 	});

	// 	$.each(data.ncb3_array, function(key, value){
	// 		dataPoints22NCB3.push({  
	// 			label: `${value.month} ${value.year}`,
	// 			y: value.eff,
	// 		});
	// 	});

	// 	$.each(data.ncb6_array, function(key, value){
	// 		dataPoints22NCB6.push({  
	// 			label: `${value.month} ${value.year}`,
	// 			y: value.eff,
	// 		});
	// 	});
	// });

	// window.onload = function (){
	// 	let dateObj = new Date();
	// 	let MYDate  = dateObj.toLocaleString('default', { month: 'short' }) + " " + dateObj.getFullYear();
	// 	let newEff;
		
	// 	if(datepicker.val() == MYDate){
	// 		wsKikukawa1();
	// 		wsNCB31();
	// 		wsNCB61();
	// 		wsMonthly();
	// 	}
		
	// 	chart1 = new CanvasJS.Chart('kikukawa', {
	// 		animationEnabled: true,
	// 		theme: "light1",
	// 		title: {
	// 			text: "Kikukawa"
	// 		},
	// 		axisX: {
	// 			labelFontFamily: "Calibri",
	// 			labelFontSize: 12,
	// 			interval: 32,
	// 			labelAngle: 90
	// 		},
	// 		axisY: {
	// 			title: "Efficiency (%)",
	// 			suffix: "%",
	// 			titleFontSize: 16,
	// 			includeZero: true,
	// 			gridThickness: 0.5,
	// 			maximum: 100,
	// 		},
	// 		toolTip: {
	// 			shared: true
	// 		},

	// 		data: [
	// 		{
	// 			type: 'column',
	// 			color: "#f7caac",
	// 			showInLegend: false,
	// 			name: "Eff",
	// 			fillOpacity: 1,
	// 			dataPoints: dataPoints,
	// 			xValueFormatString: "YYYY-MM-DD",
	// 		},
	// 		{ 
	// 			type: "column",
	// 			color: "#999",
	// 			xValueType: "dateTime",
	// 			xValueFormatString: "YYYY-MM-DD",
	// 			yValueFormatString: "#####.##",
	// 			showInLegend: null,
	// 			toolTipContent: null,
	// 			markerType: null,
	// 			name: "standard",
	// 			fillOpacity: 0,
	// 			dataPoints: dataStandar
	// 		}
	// 		]
	// 	});

	// 	chart2 = new CanvasJS.Chart('ncb3', {
	// 		animationEnabled: true,
	// 		theme: "light1",
	// 		title: {
	// 			text: "NCB3"
	// 		},
	// 		axisX: {
	// 			labelFontFamily: "Calibri",
	// 			labelFontSize: 12,
	// 			interval: 32,
	// 			labelAngle: 90
	// 		},
	// 		axisY: {
	// 			title: "Efficiency (%)",
	// 			suffix: "%",
	// 			titleFontSize: 16,
	// 			includeZero: true,
	// 			gridThickness: 0.5,
	// 			maximum: 100,
	// 		},
	// 		toolTip: {
	// 			shared: true
	// 		},

	// 		data: [
	// 		{
	// 			type: 'column',
	// 			color: "#2e75b5",
	// 			showInLegend: false,
	// 			name: "Eff",
	// 			fillOpacity: 1,
	// 			dataPoints: dataPoints2,
	// 			xValueFormatString: "YYYY-MM-DD",
	// 		},
	// 		{ 
	// 			type: "column",
	// 			color: "#999",
	// 			xValueType: "dateTime",
	// 			xValueFormatString: "YYYY-MM-DD",
	// 			yValueFormatString: "#####.##",
	// 			showInLegend: null,
	// 			toolTipContent: null,
	// 			markerType: null,
	// 			name: "standard",
	// 			fillOpacity: 0,
	// 			dataPoints: dataStandar2
	// 		}
	// 		]
	// 	});

	// 	chart3 = new CanvasJS.Chart('ncb6', {
	// 		animationEnabled: true,
	// 		theme: "light1",
	// 		title: {
	// 			text: "NCB6"
	// 		},
	// 		axisX: {
	// 			labelFontFamily: "Calibri",
	// 			labelFontSize: 12,
	// 			interval: 32,
	// 			labelAngle: 90
	// 		},
	// 		axisY: {
	// 			title: "Efficiency (%)",
	// 			suffix: "%",
	// 			titleFontSize: 16,
	// 			includeZero: true,
	// 			gridThickness: 0.5,
	// 			maximum: 100,
	// 		},
	// 		toolTip: {
	// 			shared: true
	// 		},

	// 		data: [
	// 		{
	// 			type: 'column',
	// 			color: "#92d050",
	// 			showInLegend: false,
	// 			name: "Eff",
	// 			fillOpacity: 1,
	// 			dataPoints: dataPoints3,
	// 			xValueFormatString: "YYYY-MM-DD",
	// 		},
	// 		{ 
	// 			type: "column",
	// 			color: "#999",
	// 			xValueType: "dateTime",
	// 			xValueFormatString: "YYYY-MM-DD",
	// 			yValueFormatString: "#####.##",
	// 			showInLegend: null,
	// 			toolTipContent: null,
	// 			markerType: null,
	// 			name: "standard",
	// 			fillOpacity: 0,
	// 			dataPoints: dataStandar3
	// 		}
	// 		]
	// 	});

	// 	chart22 = new CanvasJS.Chart('monthly', {
	// 		animationEnabled: true,
	// 		theme: "light1",
	// 		axisY: {
	// 			title: "Efficiency (%)",
	// 			suffix: "%",
	// 			titleFontSize: 16,
	// 			includeZero: true,
	// 			gridThickness: 0.5,
	// 			maximum: 110,
	// 		},
	// 		toolTip: {
	// 			shared: true
	// 		},
	// 		legend: {
	// 			cursor: "pointer",
	// 			itemclick: toggleDataSeries22
	// 		},

	// 		data: [
	// 		{
	// 			type: 'column',
	// 			name: "Kikukawa",
	// 			legendText: "Kikukawa",
	// 			showInLegend: true,
	// 			color: "#f7caac",
	// 			fillOpacity: 1,
	// 			dataPoints: dataPoints22Kikukawa
	// 		},
	// 		{ 
	// 			type: 'column',
	// 			name: "NCB3",
	// 			legendText: "NCB3",
	// 			showInLegend: true,
	// 			color: "#2e75b5",
	// 			fillOpacity: 1,
	// 			dataPoints: dataPoints22NCB3
	// 		},
	// 		{ 
	// 			type: 'column',
	// 			name: "NCB6",
	// 			legendText: "NCB6",
	// 			showInLegend: true,
	// 			color: "#92d050",
	// 			fillOpacity: 1,
	// 			dataPoints: dataPoints22NCB6
	// 		}
	// 		]
	// 	});

	// 	chart1.render();
	// 	chart2.render();
	// 	chart3.render();
	// 	chart22.render();

		
	// 	$("#datepicker").datepicker({
	// 		autoclose: true,
	// 		format: "M yyyy",
	// 		viewMode: "months", 
	// 		minViewMode: "months"
	// 	});

	// 	$("#yearpicker").datepicker({
	// 		autoclose: true,
	// 		format: "yyyy",
	// 		viewMode: "years", 
	// 		minViewMode: "years"
	// 	});

	// 	$('#datepicker').on('change', function(){			
	// 		updateChart();
	// 	});

	// 	$('#yearpicker').on('change', function(){			
	// 		updateChart2();
	// 	});

	// 	function toggleDataSeries22(e) {
	// 		if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
	// 			e.dataSeries.visible = false;
	// 		}
	// 		else {
	// 			e.dataSeries.visible = true;
	// 		}
	// 		chart22.render();
	// 	}

		
	// 	function updateChart() {
	// 		dataPoints.splice(0, dataPoints.length);
	// 		dataStandar.splice(0, dataStandar.length);

	// 		dataPoints2.splice(0, dataPoints2.length);
	// 		dataStandar2.splice(0, dataStandar2.length);

	// 		dataPoints3.splice(0, dataPoints2.length);
	// 		dataStandar3.splice(0, dataStandar2.length);

	// 		$.getJSON(`<?=site_url();?>json/m1/${datepicker.val()}`, function(data) {
	// 			$.each(data, function(key, value){
	// 				dataPoints.push({  
	// 					y: parseFloat(value.eff),
	// 					label: value.tanggal,
	// 				});
	// 				dataStandar.push({ 
	// 					label: value.tanggal,
	// 				});
	// 			});
	// 			chart1.render();
	// 		});

	// 		$.getJSON(`<?=site_url();?>json/m2/${datepicker.val()}`, function(data) {
	// 			$.each(data, function(key, value){
	// 				dataPoints2.push({  
	// 					y: parseFloat(value.eff),
	// 					label: value.tanggal,
	// 				});
	// 				dataStandar2.push({ 
	// 					label: value.tanggal,
	// 				});
	// 			});
	// 			chart2.render();
	// 		});

	// 		$.getJSON(`<?=site_url();?>json/m3/${datepicker.val()}`, function(data) {
	// 			$.each(data, function(key, value){
	// 				dataPoints3.push({  
	// 					y: parseFloat(value.eff),
	// 					label: value.tanggal,
	// 				});
	// 				dataStandar3.push({ 
	// 					label: value.tanggal,
	// 				});
	// 			});
	// 			chart3.render();
	// 		});
	// 	}

	// 	function updateChart2() {
	// 		dataPoints22Kikukawa.splice(0, dataPoints22Kikukawa.length);
	// 		dataPoints22NCB3.splice(0, dataPoints22NCB3.length);
	// 		dataPoints22NCB6.splice(0, dataPoints22NCB6.length);

	// 		$.getJSON(`<?=site_url();?>json/monthly/${yearpicker.val()}`, function(data) {
	// 			$.each(data.kikukawa_array, function(key, value){
	// 				dataPoints22Kikukawa.push({  
	// 					label: `${value.month} ${value.year}`,
	// 					y: value.eff,
	// 				});
	// 			});

	// 			$.each(data.ncb3_array, function(key, value){
	// 				dataPoints22NCB3.push({  
	// 					label: `${value.month} ${value.year}`,
	// 					y: value.eff,
	// 				});
	// 			});

	// 			$.each(data.ncb6_array, function(key, value){
	// 				dataPoints22NCB6.push({  
	// 					label: `${value.month} ${value.year}`,
	// 					y: value.eff,
	// 				});
	// 			});

	// 			chart22.render();
	// 		});
	// 	}
	// }

	function wsKikukawa1()
	{
		wstest = new WebSocket("ws://localhost:1880/ws/trigger/kikukawa");
		wstest.onerror = (e) => { console.log(e) }
		wstest.onopen = () => { console.log('connect') }
		wstest.onclose = () => {
			console.log('disconnect');
			setTimeout(()=> {
				wsKikukawa1();
			}, 1000);
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
		wsBulanan.onerror = (e) => { console.log(e) }
		wsBulanan.onopen  = () => { console.log('connect') }
		wsBulanan.onclose = () => {
			console.log('disconnect');
			setTimeout(()=> {
				wsMonthly();
			}, 1000);
		}
		wsBulanan.onmessage = (e) => {
			let data = $.parseJSON(e.data);
			console.log(data);

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

			console.log(dataPoints22Kikukawa);

			chart22.render();
		}
	}
</script>