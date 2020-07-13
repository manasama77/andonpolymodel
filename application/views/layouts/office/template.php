<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="<?=base_url();?>vendor/bootstrap4/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url();?>vendor/datepickerjs/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="<?=base_url();?>vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?=base_url();?>public/css/cover.css">
	<link rel="stylesheet" href="<?=base_url();?>public/css/style.css">
	<title><?=$title;?></title>
</style>
</head>
<body class="text-center" style="width: 1920px: height: 1080px;">
	<?php $this->load->view('office/'.$content); ?>

	<script src="<?=base_url();?>vendor/jquery/jquery-3.5.1.min.js"></script>
	<script src="<?=base_url();?>vendor/popper/popper.min.js"></script>
	<script src="<?=base_url();?>vendor/bootstrap4/js/bootstrap.min.js"></script>
	<!-- <script src="<?=base_url();?>vendor/bootstrap4/js/bootstrap.bundle.min.js"></script> -->
	<script src="<?=base_url();?>vendor/momentjs/moment.js"></script>
	<script src="<?=base_url();?>vendor/blockuijs/jquery.blockUI.js"></script>
	<script src="<?=base_url();?>vendor/inputmaskjs/jquery.inputmask.js"></script>
	<script src="<?=base_url();?>vendor/datepickerjs/js/bootstrap-datepicker.js"></script>
	<script src="<?=base_url();?>vendor/jtimer/jquery.timer.js"></script>
	<script src="<?=base_url();?>vendor/canvasjs/canvasjs.min.js"></script>
	<script src="<?=base_url();?>vendor/validate/jquery.validate.min.js"></script>
	<script src="<?=base_url();?>vendor/validate/additional-methods.min.js"></script>
	<script src="<?=base_url();?>vendor/jscookies/js.cookie.min.js"></script>
	<?php $this->load->view('office/'.$vitamin); ?>
</body>
</html>