<div class="main-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<h2 class="text-center">Export Excel</h2>
			</div>
			<div class="col-6 offset-3">
				<form>
					<table class="table">
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
													<span class="input-group-text">Start</span>
												</div>
												<input type="date" class="form-control col-8">
											</div>
										</div>
										<div class="col-sm-5">
											<div class="input-group form-row">
												<div class="input-group-append">
													<span class="input-group-text">End</span>
												</div>
												<input type="date" class="form-control col-8">
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

				<form>
					<table class="table">
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
													<span class="input-group-text">Year</span>
												</div>
												<input type="number" class="form-control" pattern="\d*" min="1970" max="3000">
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