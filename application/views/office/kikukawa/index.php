<div class="d-flex toggled" id="wrapper">
	<div class="bg-dark border-right" id="sidebar-wrapper">
		<div class="sidebar-heading">Andon APP</div>
		<div class="list-group list-group-flush">
			<a href="<?=site_url();?>planning" target="_blank" class="list-group-item list-group-item-action bg-dark text-white">Production Hour Planning</a>
			<button type="button" class="list-group-item list-group-item-action bg-dark text-white">Export Excel</button>
			<a href="<?=site_url();?>logout" class="list-group-item list-group-item-action bg-dark text-white">Logout</a>
		</div>
	</div>

	<div id="page-content-wrapper">
		<nav class="navbar navbar-expand-lg">
			<button type="button" id="menu-toggle" class="btn btn-danger">
				<i class="fa fa-bars"></i>
			</button>
			<!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button> -->

			<!-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
					<li class="nav-item active">
						<button type="button" class="btn btn-primary mr-4" onclick="nextSlide();">
							<i class="fa fa-forward"></i>
						</button>
					</li>
					<li class="nav-item">
						<button type="button" class="btn btn-success mr-4" onclick="pausePlaySlide();">
							<i class="fa fa-play" id="button_play"></i>
							<i class="fa fa-pause" id="button_pause" style="display: none;"></i>
						</button>
					</li>
				</ul>
			</div> -->
		</nav>
		<div class="container-fluid">
			<div class="row" id="section1">
				<div class="col-12">
					<h2 class="text-warning" style="font-weight: bold;">Daily Machine Efficiency</h2>
					<p class="lead"><div class="text-warning realclock" style="font-weight: bold;"></div></p>
					<table class="table table-bordered mt-4">
						<thead class="bg-primary text-white">
							<tr>
								<th>Machine</th>
								<th>Cutting</th>
								<th>Dandori</th>
								<th>Man<br>Activity</th>
								<th>Idle</th>
								<th>Alarm</th>
								<th>Efficiency</th>
							</tr>
						</thead>
						<tbody class="text-white" style="font-weight: bold; font-size: 25px;">
							<tr>
								<td>Kikukawa</td>
								<td id="m1cutting">00:00</td>
								<td id="m1dandori">00:00</td>
								<td id="m1man">00:00</td>
								<td id="m1idle">00:00</td>
								<td id="m1alarm">00:00</td>
								<td id="m1eff">0.00%</td>
							</tr>
							<!-- <tr>
								<td>NCB3</td>
								<td id="m2cutting">00:00</td>
								<td id="m2dandori">00:00</td>
								<td id="m2man">00:00</td>
								<td id="m2idle">00:00</td>
								<td id="m2alarm">00:00</td>
								<td id="m2eff">0.00%</td>
							</tr>
							<tr>
								<td>NCB6</td>
								<td id="m3cutting">00:00</td>
								<td id="m3dandori">00:00</td>
								<td id="m3man">00:00</td>
								<td id="m3idle">00:00</td>
								<td id="m3alarm">00:00</td>
								<td id="m3eff">0.00%</td>
							</tr> -->
						</tbody>
					</table>
					<div class="row justify-content-center">
						<div class="col-auto">
							<span class="badge badge-dark cuttingLabel">&nbsp;</span>
						</div>
						<div class="col-auto mt-2">Cutting</div>

						<div class="col-auto ml-4">
							<span class="badge badge-dark dandoriLabel">&nbsp;</span>
						</div>
						<div class="col-auto mt-2">Dandori</div>

						<div class="col-auto ml-4">
							<span class="badge badge-dark manLabel">&nbsp;</span>
						</div>
						<div class="col-auto">Man<br>Activity</div>

						<div class="col-auto ml-4">
							<span class="badge badge-dark idleLabel">&nbsp;</span>
						</div>
						<div class="col-auto mt-2">Idle</div>

						<div class="col-auto ml-4">
							<span class="badge badge-dark alarmLabel">&nbsp;</span>
						</div>
						<div class="col-auto mt-2">Alarm</div>
					</div>
				</div>
			</div>
			<!-- <section id="section2" style="margin-top: -10px;">
				<div class="row">
					<div class="col-12">
						<h2 class="text-warning" style="font-weight: bold;">Daily Efficiency Chart</h2>
						<p class="lead" style="margin-top: -15px;"><div class="text-warning realclock" style="font-weight: bold;"></div></p>
						<p>
							<input type="text" class="input-sm text-center" id="datepicker" name="active_date" value="<?=$tgl_obj->format('M Y');?>" style="width:100px; font-weight: bold; height: 40px;" readonly>
						</p>
						<div class="row justify-content-center" style="margin-top: -15px;">
							<div class="col-auto">
								<span class="badge badge-dark kikukawa2Label triggerChart1">&nbsp;</span>
							</div>
							<div class="col-auto mt-2 triggerChart1">Kikukawa</div>

							<div class="col-auto">
								<span class="badge badge-dark ncb32Label triggerChart2">&nbsp;</span>
							</div>
							<div class="col-auto mt-2 triggerChart2">NCB3</div>

							<div class="col-auto">
								<span class="badge badge-dark ncb62Label triggerChart3">&nbsp;</span>
							</div>
							<div class="col-auto mt-2 triggerChart3">NCB6</div>

						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-6 p-1" id="kikukawaParent">
						<div id="kikukawa" class="chartShow" style="width: 100%; height: 230px;"></div>
					</div>
					<div class="col-6 p-1" id="ncb3Parent">
						<div id="ncb3" class="chartShow" style="width: 100%; height: 230px;"></div>
					</div>
					<div class="col-6 p-1" id="ncb6Parent">
						<div id="ncb6" class="chartShow" style="width: 100%; height: 230px;"></div>
					</div>
				</div>
			</section> -->
			<!-- <section id="section3" style="margin-top: -10px;">
				<div class="row">
					<div class="col-12">
						<h2 class="text-warning" style="font-weight: bold;">Monthly Efficiency Chart</h2>
						<p class="lead" style="margin-top: -15px;"><div class="text-warning realclock" style="font-weight: bold;"></div></p>
						<p>
							<input type="text" class="input-sm text-center" id="yearpicker" name="active_year" value="<?=$tgl_obj->format('Y');?>" style="width:100px; font-weight: bold; height: 40px;" readonly>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-12 p-1">
						<div id="monthly" style="width: 100% !important; height: 450px;"></div>
					</div>
				</div>
			</section> -->
		</div>
	</div>
</div>