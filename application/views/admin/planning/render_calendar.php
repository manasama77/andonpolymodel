<style>
	/*******************************Calendar Top Navigation*********************************/
	div#calendar1{
		margin:0px auto;
		padding:0px;
		width: 535px;
		font-family:Helvetica, "Times New Roman", Times, serif;
	}

	div#calendar1 div.box{
		position:relative;
		top:0px;
		left:0px;
		width:100%;
		height:40px;
		background-color:   #787878 ;      
	}

	div#calendar1 div.header{
		line-height:40px;  
		vertical-align:middle;
		position:absolute;
		left:11px;
		top:0px;
		width:510px;
		height:40px;   
		text-align:center;
	}

	div#calendar1 div.header a.prev, div#calendar1 div.header a.next{ 
		position:absolute;
		top:0px;   
		height: 17px;
		display:block;
		cursor:pointer;
		text-decoration:none;
		color:#FFF;
	}

	div#calendar1 div.header span.title{
		color:#FFF;
		font-size:15px;
	}


	div#calendar1 div.header a.prev{
		left:0px;
	}

	div#calendar1 div.header a.next{
		right:0px;
	}




	/*******************************Calendar Content Cells*********************************/
	div#calendar1 div.box-content{
		border:1px solid #787878 ;
		border-top:none;
	}



	div#calendar1 ul.label{
		float:left;
		margin: 0px;
		padding: 0px;
		margin-top:5px;
		margin-left: 5px;
	}

	div#calendar1 ul.label li{
		margin:0px;
		padding:0px;
		margin-right:5px;  
		float:left;
		list-style-type:none;
		width:70px;
		height:20px;
		line-height:22px;
		vertical-align:middle;
		text-align:center;
		color:#fff;
		font-size: 15px;
		background-color: transparent;
	}


	div#calendar1 ul.dates{
		float:left;
		margin: 0px;
		padding: 0px;
		margin-left: 5px;
		margin-bottom: 5px;
	}

	/** overall width = width+padding-right**/
	div#calendar1 ul.dates li{
		margin:0px;
		padding:0px;
		margin-right:5px;
		margin-top: 5px;
		line-height:30px;
		vertical-align:middle;
		float:left;
		list-style-type:none;
		width:70px;
		height:70px;
		font-size:15px;
		background-color: #DDD;
		color:#000;
		text-align:center; 
	}

	div.clear{
		clear:both;
	}

	.fdate{
		text-align: center;
		width: 70px;
		height: 39px;
		font-size: 14px;
	}
</style>
<?php echo $calendar; ?>
<!-- debug only -->
<!-- <link rel="stylesheet" href="<?=base_url();?>public/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?=base_url();?>public/font-awesome/4.5.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="<?=base_url();?>public/css/fonts.googleapis.com.css" />
<link rel="stylesheet" href="<?=base_url();?>public/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
<link rel="stylesheet" href="<?=base_url();?>public/css/ace-skins.min.css" />
<link rel="stylesheet" href="<?=base_url();?>public/css/ace-rtl.min.css" />
<link rel="stylesheet" href="<?=base_url();?>public/css/jquery-ui.custom.min.css" />
<link rel="stylesheet" href="<?=base_url();?>public/css/fullcalendar.min.css" />
<script src="<?=base_url();?>public/js/ace-extra.min.js"></script>
<script src="<?=base_url();?>public/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
	if('ontouchstart' in document.documentElement) document.write(`
		<script src="<?=base_url();?>public/js/jquery.mobile.custom.min.js"><\/script>`);
</script>
<script src="<?=base_url();?>public/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>public/js/ace-elements.min.js"></script>
<script src="<?=base_url();?>public/js/ace.min.js"></script>
<script src="<?=base_url();?>vendor/blockui/jquery.blockUI.js"></script>

<script src="<?=base_url();?>public/js/jquery-ui.custom.min.js"></script>
<script src="<?=base_url();?>public/js/jquery.ui.touch-punch.min.js"></script>
<script src="<?=base_url();?>public/js/moment.min.js"></script>
<script src="<?=base_url();?>public/js/fullcalendar.min.js"></script>
<script src="<?=base_url();?>public/js/bootbox.js"></script> -->
<!-- end debug only -->