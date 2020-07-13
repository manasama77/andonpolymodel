<style>
	.slide_1 {
		position: absolute;
		width: 100%;
		height: 90vh;
		text-align: center;
		background-color: #fafafa;
		top: 0px;
		right: 0px;
	}

	.slide_2 {
		position: absolute;
		width: 100%;
		height: 90vh;
		text-align: center;
		background-color: #fafafa;
		top: 0px;
		right: 0px;
	}

	.slide_3 {
		position: absolute;
		width: 100%;
		height: 90vh;
		text-align: center;
		background-color: #fafafa;
		top: 0px;
		right: 0px;
	}
</style>

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
				<div class="col-12">
					<div class="slide_1" style="display: none;">
						<h2 class="text-warning" style="font-weight: bold;">Daily Machine Efficiency</h2>
					</div>
					<div class="slide_2" style="display: none;">
						<h2 class="text-warning" style="font-weight: bold;">Daily Efficiency Chart</h2>
					</div>
					<div class="slide_3" style="display: none;">
						<h2 class="text-warning" style="font-weight: bold;">Monthly Efficiency Chart</h2>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>