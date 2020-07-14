<h2 class="text-warning" style="font-weight: bold;">Daily Efficiency Chart</h2>
<p class="lead" style="margin-top: -15px;"><div class="text-warning realclock" style="font-weight: bold;"></div></p>
<p>
	<input type="text" class="input-sm text-center" id="datepicker" name="active_date" value="<?=$tgl_obj->format('M Y');?>" style="width:100px; font-weight: bold; height: 40px;" readonly>
</p>
<div class="row justify-content-center" style="margin-top: -15px;">
	<div class="col-auto">
		<span class="badge badge-dark kikukawa2Label triggerChart1">&nbsp;</span>
	</div>
	<div class="col-auto mt-2 text-warning">Kikukawa</div>

	<div class="col-auto">
		<span class="badge badge-dark ncb32Label triggerChart2">&nbsp;</span>
	</div>
	<div class="col-auto mt-2 text-warning">NCB3</div>

	<div class="col-auto">
		<span class="badge badge-dark ncb62Label triggerChart3">&nbsp;</span>
	</div>
	<div class="col-auto mt-2 text-warning">NCB6</div>
</div>
<div class="row">
	<div class="col-6 p-2 text-center" id="kikukawaParent">
		<div id="kikukawa" class="chartShow" style="width: 100%; height: 240px;"></div>
	</div>
	<div class="col-6 p-2" id="ncb3Parent">
		<div id="ncb3" class="chartShow" style="width: 100%; height: 240px;"></div>
	</div>
	<div class="col-6 p-2" id="ncb6Parent">
		<div id="ncb6" class="chartShow" style="width: 100%; height: 240px;"></div>
	</div>
</div>