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

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
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
			</div>
		</nav>
		<div class="container-fluid">
			<div class="row">
				<div id="slideshow" class="col-12">
					<div class="slide_1">
						<?php $this->load->view('office/main/slide_1'); ?>
					</div>
					<div class="slide_2">
						<?php $this->load->view('office/main/slide_2'); ?>
					</div>
					<div class="slide_3">
						<?php $this->load->view('office/main/slide_3'); ?>
					</div>
				</div>
			</div>
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
								<a class="nav-item nav-link active" data-toggle="tab" href="#nav-kikukawa" role="tab" aria-controls="nav-kikukawa" aria-selected="true">Kikukawa</a>
								<a class="nav-item nav-link" data-toggle="tab" href="#nav-ncb3" role="tab" aria-controls="nav-ncb3" aria-selected="false">NCB3</a>
								<a class="nav-item nav-link" data-toggle="tab" href="#nav-ncb6" role="tab" aria-controls="nav-ncb6" aria-selected="false">NCB6</a>
							</div>
						</nav>

						<div class="tab-content" id="nav-tabContent">
							<div class="tab-pane fade show active" id="nav-kikukawa" role="tabpanel" aria-labelledby="nav-kikukawa-tab">

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

							<div class="tab-pane fade" id="nav-ncb3" role="tabpanel" aria-labelledby="nav-ncb3-tab">
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