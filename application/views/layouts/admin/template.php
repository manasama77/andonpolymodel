<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="<?=base_url();?>vendor/bootstrap4/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url();?>vendor/datepickerjs/css/bootstrap-datepicker.min.css">
	<title><?=$title;?></title>
</style>
</head>
<body>
	<?php $this->load->view('admin/'.$content); ?>

	<script src="<?=base_url();?>vendor/jquery/jquery-3.5.1.min.js"></script>
	<script src="<?=base_url();?>vendor/popper/popper.min.js"></script>
	<script src="<?=base_url();?>vendor/bootstrap4/js/bootstrap.bundle.min.js"></script>
	<script src="<?=base_url();?>vendor/momentjs/moment.js"></script>
	<script src="<?=base_url();?>vendor/blockuijs/jquery.blockUI.js"></script>
	<script src="<?=base_url();?>vendor/inputmaskjs/jquery.inputmask.js"></script>
	<script src="<?=base_url();?>vendor/datepickerjs/js/bootstrap-datepicker.js"></script>
	<script src="https://kit.fontawesome.com/8462962064.js" crossorigin="anonymous"></script>
	<?php $this->load->view('admin/'.$vitamin); ?>
</body>
</html>