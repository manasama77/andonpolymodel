<?php
if ($total_slides > 0) {
	$i = 3;
	foreach ($data_slides as $data) {
?>
		<div class="slide_<?= $i; ?>">
			<h2 class="text-warning" style="font-weight: bold;"></h2>
			<p class="lead" style="margin-top: -15px;">
				<div class="text-warning realclock" style="font-weight: bold;"></div>
			</p>
			<img src="<?= base_url('public/img/' . $data->image); ?>" style="width: 100%; height: 100%;">
		</div>
<?php
		$i++;
	}
}
?>
