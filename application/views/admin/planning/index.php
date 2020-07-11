<style>
	.main-wrapper {
		height: 100vh;  
	}

	.section {
		height: 100%;  
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
	}

	.half {
		background: #f9f9f9;
		height: 50%;  
		width: 100%;
		margin: 15px 0;
	}
</style>
<div class="main-wrapper">
	<div class="section col-xs-12">
		<form id="form_calendar1" action="<?=site_url();?>planning/update1" method="post">
			<div class="row justify-content-center">
				<div class="col-xs-12 text-center">
					<h2>Production Hour Planning Kikukawa</h2>
					<div id="vcalendar1"></div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-xs-12 text-center mt-2">
					<button type="submit" id="submit1" class="btn btn-primary" disabled>Confirm</button>
				</div>
			</div>
		</form>
	</div>
</div>