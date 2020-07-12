<div class="d-flex toggled" id="wrapper">
	<div class="bg-dark border-right" id="sidebar-wrapper">
		<div class="sidebar-heading">Andon APP</div>
		<div class="list-group list-group-flush">
			<button type="button" id="tPlan" class="list-group-item list-group-item-action bg-dark text-white">Production Hour Planning</button>
			<button type="button" id="tExport" class="list-group-item list-group-item-action bg-dark text-white">Export Excel</button>
			<a href="<?=site_url();?>logout" class="list-group-item list-group-item-action bg-dark text-white">Logout</a>
		</div>
	</div>

	<div id="page-content-wrapper">
		<nav class="navbar navbar-expand-lg">
			<button type="button" id="menu-toggle" class="btn btn-danger">
				<i class="fa fa-bars"></i>
			</button>

			<!-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
					<li class="nav-item active">
						<button type="button" id="next_slide" class="btn btn-primary mr-4">
							<i class="fa fa-forward"></i>
						</button>
					</li>
					<li class="nav-item">
						<button type="button" id="pause_play" class="btn btn-success mr-4" data-state="play">
							<i class="fa fa-play" id="button_play"></i>
							<i class="fa fa-pause" id="button_pause" style="display: none;"></i>
						</button>
					</li>
				</ul>
			</div> -->
		</nav>


		<div class="container-fluid">
			<div id="section1" class="row">
				<div class="col-12">
					<h2 class="text-warning" style="font-weight: bold;">Daily Machine Efficiency</h2>
					<p class="lead"><div class="text-warning realclock" style="font-weight: bold;"></div></p>
					<table class="table table-bordered mb-5" id="t1">
						<thead class="bg-secondary text-dark">
							<tr>
								<th class="text-warning">Machine</th>
								<th class="text-warning">Cutting</th>
								<th class="text-warning">Dandori</th>
								<th class="text-warning">Man<br>Activity</th>
								<th class="text-warning">Idle</th>
								<th class="text-warning">Alarm</th>
								<th class="text-warning">Efficiency</th>
							</tr>
						</thead>
						<tbody class="text-white" style="font-weight: bold; font-size: 25px;">
							<!-- <tr>
								<td>Kikukawa</td>
								<td id="m1cutting">00:00</td>
								<td id="m1dandori">00:00</td>
								<td id="m1man">00:00</td>
								<td id="m1idle">00:00</td>
								<td id="m1alarm">00:00</td>
								<td id="m1eff">0.00%</td>
							</tr> -->
							<tr>
								<td>NCB3</td>
								<td id="m2cutting">00:00</td>
								<td id="m2dandori">00:00</td>
								<td id="m2man">00:00</td>
								<td id="m2idle">00:00</td>
								<td id="m2alarm">00:00</td>
								<td id="m2eff">0.00%</td>
							</tr>
							<!-- <tr>
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
						<div class="col-auto mt-2"><h3>Cutting</h3></div>

						<div class="col-auto ml-4">
							<span class="badge badge-dark dandoriLabel">&nbsp;</span>
						</div>
						<div class="col-auto mt-2"><h3>Dandori</h3></div>

						<div class="col-auto ml-4">
							<span class="badge badge-dark manLabel">&nbsp;</span>
						</div>
						<div class="col-auto"><h3>Man<br>Activity</h3></div>

						<div class="col-auto ml-4">
							<span class="badge badge-dark idleLabel">&nbsp;</span>
						</div>
						<div class="col-auto mt-2"><h3>Idle</h3></div>

						<div class="col-auto ml-4">
							<span class="badge badge-dark alarmLabel">&nbsp;</span>
						</div>
						<div class="col-auto mt-2"><h3>Alarm</h3></div>
					</div>
				</div>
			</div>
			<!-- <div id="section2" class="slide" style="margin-top: -10px; display: none;">
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
					</div>
				</div>
				<div class="row">
					<div class="col-6 p-1" id="kikukawaParent">
						<div id="kikukawa" class="chartShow" style="width: 100%; height: 260px;"></div>
					</div>
					<div class="col-6 p-1" id="ncb3Parent">
						<div id="ncb3" class="chartShow" style="width: 100%; height: 260px;"></div>
					</div>
					<div class="col-6 p-1" id="ncb6Parent">
						<div id="ncb6" class="chartShow" style="width: 100%; height: 260px;"></div>
					</div>
				</div>
			</div>
			<div id="section3" class="slide" style="margin-top: -10px; display: none;">
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
						<div id="monthly" style="width: 100% !important; height: 550px;"></div>
					</div>
				</div>
			</div> -->
		</div>
	</div>
</div>

<div id="modal-planning" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content bg-dark">
			<div class="modal-header">
				<h6 class="modal-title">Production Hour Planning</h6>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"><i class="fa fa-times"></i></span>
				</button>
			</div>
			<div class="modal-body" id="vPlan">
				<div class="main-wrapper">
					<div class="section col-xs-12">

						<nav>
							<div class="nav nav-tabs" id="nav-tab" role="tablist">
								<!-- <a class="nav-item nav-link active" data-toggle="tab" href="#nav-kikukawa" role="tab" aria-controls="nav-kikukawa" aria-selected="true">Kikukawa</a> -->
								<a class="nav-item nav-link active" data-toggle="tab" href="#nav-ncb3" role="tab" aria-controls="nav-ncb3" aria-selected="false">NCB3</a>
								<!-- <a class="nav-item nav-link" data-toggle="tab" href="#nav-ncb6" role="tab" aria-controls="nav-ncb6" aria-selected="false">NCB6</a> -->
							</div>
						</nav>

						<div class="tab-content" id="nav-tabContent">
							<div class="tab-pane fade show" id="nav-kikukawa" role="tabpanel" aria-labelledby="nav-kikukawa-tab">

								<form id="form_calendar1">
									<div class="row justify-content-center">
										<div class="col-xs-12 text-center">
											<div id="vcalendar1"></div>
										</div>
									</div>
									<div class="row justify-content-center">
										<div class="col-xs-12 text-center mt-2">
											<button type="submit" id="submit1" class="btn btn-success btn-sm" disabled>Confirm</button>
										</div>
									</div>
								</form>

							</div>

							<div class="tab-pane fade show active" id="nav-ncb3" role="tabpanel" aria-labelledby="nav-ncb3-tab">
								<form id="form_calendar2">
									<div class="row justify-content-center">
										<div class="col-xs-12 text-center">
											<div id="vcalendar2"></div>
										</div>
									</div>
									<div class="row justify-content-center">
										<div class="col-xs-12 text-center mt-2">
											<button type="submit" id="submit2" class="btn btn-success btn-sm" disabled>Confirm</button>
										</div>
									</div>
								</form>
							</div>

							<div class="tab-pane fade" id="nav-ncb6" role="tabpanel" aria-labelledby="nav-ncb6-tab">
								<form id="form_calendar3">
									<div class="row justify-content-center">
										<div class="col-xs-12 text-center">
											<div id="vcalendar3"></div>
										</div>
									</div>
									<div class="row justify-content-center">
										<div class="col-xs-12 text-center mt-2">
											<button type="submit" id="submit3" class="btn btn-success btn-sm" disabled>Confirm</button>
										</div>
									</div>
								</form>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="modal-export" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content bg-dark">
			<div class="modal-header">
				<h6 class="modal-title">Export Excel</h6>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"><i class="fa fa-times"></i></span>
				</button>
			</div>
			<div class="modal-body">
				<div class="main-wrapper">
					<div class="section col-xs-12">
						
						<form id="daily_export">
							<table class="table bg-light">
								<thead>
									<tr>
										<th>Daily</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<div class="form-row align-items-center">
												<div class="col-sm-5">
													<div class="input-group form-row">
														<div class="input-group-prepend">
															<span class="input-group-text">From</span>
														</div>
														<input type="text" class="form-control col-8 datepickerexport" id="export_start" name="export_start" placeholder="dd/mm/yyyy">
													</div>
													<div class="help-block"></div>
												</div>
												<div class="col-sm-5">
													<div class="input-group form-row">
														<div class="input-group-append">
															<span class="input-group-text">To</span>
														</div>
														<input type="text" class="form-control col-8 datepickerexport" id="export_end" name="export_end" placeholder="dd/mm/yyyy">
													</div>
													<div class="help-block"></div>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-success">Export</button>
												</div>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</form>

						<form id="monthly_export">
							<table class="table bg-light">
								<thead>
									<tr>
										<th>Monthly</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<div class="form-row align-items-center">
												<div class="col-sm-5">
													<div class="input-group form-row">
														<div class="input-group-prepend">
															<span class="input-group-text">Month / Year</span>
														</div>
														<input type="text" class="form-control yearpickerexport" id="my" name="my" placeholder="mm/yyyy">
													</div>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-primary">Export</button>
												</div>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>