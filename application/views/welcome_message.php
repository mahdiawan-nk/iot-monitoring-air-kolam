<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Star Admin2 </title>
	<!-- plugins:css -->
	<link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/feather/feather.css">
	<link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/mdi/css/materialdesignicons.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/ti-icons/css/themify-icons.css">
	<link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/typicons/typicons.css">
	<link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/simple-line-icons/css/simple-line-icons.css">
	<link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/css/vendor.bundle.base.css">
	<!-- endinject -->
	<!-- inject:css -->
	<link rel="stylesheet" href="<?= base_url('assets/') ?>css/vertical-layout-light/style.css">
	<!-- endinject -->
	<link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
	<div class="container-scroller">
		<!-- partial:partials/_navbar.html -->
		<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
			<div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
				<div class="ms-2">
					<a class="navbar-brand brand-logo" href="index.html">
						<img src="<?= base_url('assets/images/logo.png') ?>" alt="logo" class="w-50 img-fluid" style="height: max-content;" />
					</a>
					<a class="navbar-brand brand-logo-mini" href="index.html">
						<img src="<?= base_url('assets/images/logo.png') ?>" alt="logo" class="w-100 img-fluid" style="height: max-content;" />
					</a>
				</div>
			</div>
			<div class="navbar-menu-wrapper d-flex justify-content-center align-items-center">
				<ul class="navbar-nav">
					<li class="nav-item font-weight-semibold d-sm-block d-lg-block ms-0">
						<h1 class="welcome-text ">
							<span class="text-black fw-bold d-none d-lg-block">DASHBOARD PUSAT PELATIHAN MANDIRI KELAUTAN DAN PERIKANAN</span>
							<span class="text-black fw-bold d-lg-none d-sm-block"> DASHBOARD P2MKP</span>
						</h1>
					</li>
				</ul>
			</div>
		</nav>
		<!-- partial -->
		<div class="container-fluid page-body-wrapper">
			<!-- partial -->
			<div class="main-panel" style="width: 100%;">
				<div class="content-wrapper">
					<div class="row">
						<div class="col-sm-12 mb-4">
							<div class="statistics-details d-flex align-items-center justify-content-between">
								<div>
									<p class="statistics-title">SUHU</p>
									<h3 class="rate-percentage"><span id="suhu"></span> <span>&#8451;</span></h3>
								</div>
								<div>
									<p class="statistics-title">LEVEL PH</p>
									<h3 class="rate-percentage"><span id="ph"></span></h3>
								</div>
								<div>
									<p class="statistics-title">KELEMBAPAN</p>
									<h3 class="rate-percentage"><span id="kelembapan"></span> %</h3>
								</div>
								<div class="d-none d-md-block">
									<p class="statistics-title">KEKERUAHAN</p>
									<h3 class="rate-percentage"><span id="kekeruhan"></span> NTU</h3>
								</div>
							</div>
							<hr>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 d-flex flex-column">
							<div class="row flex-grow">
								<div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
									<div class="card card-rounded">
										<div class="card-body">
											<div class="d-sm-flex justify-content-between align-items-start">
												<div>
													<h4 class="card-title card-title-dash">Grafik Suhu</h4>
												</div>
											</div>
											<div class="chartjs-wrapper">
												<div id="grafikSuhu" style="height: 370px; width:100%;"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 d-flex flex-column">
							<div class="row flex-grow">
								<div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
									<div class="card card-rounded">
										<div class="card-body">
											<div class="d-sm-flex justify-content-between align-items-start">
												<div>
													<h4 class="card-title card-title-dash">Grafik Level PH</h4>
												</div>
											</div>
											<div class="chartjs-wrapper">
												<div id="grafikPh" style="height: 370px; width:100%;"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 d-flex flex-column">
							<div class="row flex-grow">
								<div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
									<div class="card card-rounded">
										<div class="card-body">
											<div class="d-sm-flex justify-content-between align-items-start">
												<div>
													<h4 class="card-title card-title-dash">Grafik Kelembapan</h4>
												</div>
											</div>
											<div class="chartjs-wrapper">
												<div id="grafikKelembapan" style="height: 370px; width:100%;"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 d-flex flex-column">
							<div class="row flex-grow">
								<div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
									<div class="card card-rounded">
										<div class="card-body">
											<div class="d-sm-flex justify-content-between align-items-start">
												<div>
													<h4 class="card-title card-title-dash">Grafik kekeruhan Air</h4>
												</div>
											</div>
											<div class="chartjs-wrapper">
												<div id="grafikKekeruhan" style="height: 370px; width:100%;"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- content-wrapper ends -->
				<!-- partial:partials/_footer.html -->
				<footer class="footer">
					<div class="d-sm-flex justify-content-center justify-content-sm-between">
						<span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash.</span>
						<span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All rights reserved.</span>
					</div>
				</footer>
				<!-- partial -->
			</div>
			<!-- main-panel ends -->
		</div>
		<!-- page-body-wrapper ends -->
	</div>
	<!-- container-scroller -->

	<!-- plugins:js -->
	<script src="<?= base_url('assets/') ?>vendors/js/vendor.bundle.base.js"></script>
	<!-- endinject -->
	<!-- Plugin js for this page -->
	<script src="<?= base_url('assets/') ?>vendors/progressbar.js/progressbar.min.js"></script>

	<!-- End plugin js for this page -->
	<!-- inject:js -->
	<script src="<?= base_url('assets/') ?>js/off-canvas.js"></script>
	<script src="<?= base_url('assets/') ?>js/hoverable-collapse.js"></script>
	<script src="<?= base_url('assets/') ?>js/template.js"></script>
	<script src="<?= base_url('assets/') ?>js/settings.js"></script>
	<script src="<?= base_url('assets/') ?>js/todolist.js"></script>
	<!-- endinject -->
	<!-- Custom js for this page-->
	<!-- End custom js for this page-->
	<!-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> -->
	<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
	<script>
		var typeChart = 'spline'
		var dps_suhu = new Array();
		var dps_ph = new Array();
		var dps_kelembapan = new Array();
		var dps_kekeruhan = new Array();
		let yValSuhu = 0;
		let xValSuhu = 0;
		let yValPh = 0;
		let xValPh = 0;
		let yValKelembapan = 0;
		let xValKelembapan = 0;
		let yValKekeruhan = 0;
		let xValKekeruhan = 0;
		var dataLength = 15;
		var updateInterval = 1000;
		var suhu = new CanvasJS.Chart("grafikSuhu", {
			axisX: {
				valueFormatString: "####",
				interval: 1,
			},
			axisY: [{
				title: "",
				lineColor: "#369EAD",
				titleFontColor: "#369EAD",
				labelFontColor: "#369EAD",
				labelFontSize: 10,
			}, ],
			data: [{
				type: typeChart,
				showInLegend: true,
				name: "TEMP Suhu",
				xValueFormatString: "####",
				indexLabel: " {y}",
				indexLabelPlacement: "outside",
				indexLabelOrientation: "horizontal",
				markerSize: 1,
				dataPoints: dps_suhu,
			}, ],
		});
		var ph = new CanvasJS.Chart("grafikPh", {
			axisX: {
				valueFormatString: "####",
				interval: 1,
			},
			axisY: [{
				title: "",
				lineColor: "#369EAD",
				titleFontColor: "#369EAD",
				labelFontColor: "#369EAD",
				labelFontSize: 10,
			}, ],
			data: [{
				type: typeChart,
				showInLegend: true,
				name: "TEMP Suhu",
				xValueFormatString: "####",
				indexLabel: " {y}",
				indexLabelPlacement: "outside",
				indexLabelOrientation: "horizontal",
				markerSize: 1,
				dataPoints: dps_ph,
			}, ],
		});
		var kelembapan = new CanvasJS.Chart("grafikKelembapan", {
			axisX: {
				valueFormatString: "####",
				interval: 1,
			},
			axisY: [{
				title: "",
				lineColor: "#369EAD",
				titleFontColor: "#369EAD",
				labelFontColor: "#369EAD",
				labelFontSize: 10,
			}, ],
			data: [{
				type: typeChart,
				showInLegend: true,
				name: "TEMP Suhu",
				xValueFormatString: "####",
				indexLabel: " {y}",
				indexLabelPlacement: "outside",
				indexLabelOrientation: "horizontal",
				markerSize: 1,
				dataPoints: dps_kelembapan,
			}, ],
		});
		var kekeruhan = new CanvasJS.Chart("grafikKekeruhan", {
			axisX: {
				valueFormatString: "####",
				interval: 1,
			},
			axisY: [{
				title: "",
				lineColor: "#369EAD",
				titleFontColor: "#369EAD",
				labelFontColor: "#369EAD",
				labelFontSize: 10,
			}, ],
			data: [{
				type: typeChart,
				showInLegend: true,
				name: "TEMP Suhu",
				xValueFormatString: "####",
				indexLabel: " {y}",
				indexLabelPlacement: "outside",
				indexLabelOrientation: "horizontal",
				markerSize: 1,
				dataPoints: dps_kekeruhan,
			}, ],
		});
		let GetSetChart_suhu = function(count) {
			$.getJSON('<?= base_url('welcome/api_show') ?>', function(json, textStatus) {
				let temp_c = json.s_suhu;
				let temp_ph = json.s_ph;
				let temp_kelembapan = json.s_kelembapan;
				let temp_kekeruhan = json.s_kekeruhan;

				yValSuhu = parseFloat(temp_c);
				yValPh = parseFloat(temp_ph);
				yValKelembapan = parseFloat(temp_kelembapan);
				yValKekeruhan = parseFloat(temp_kekeruhan);

				$('#suhu').text(yValSuhu);
				$('#ph').text(yValPh);
				$('#kelembapan').text(yValKelembapan);
				$('#kekeruhan').text(yValKekeruhan);

				count = count || 1;

				for (let a = 0; a < count; a++) {
					
					dps_suhu.push({
						x: xValSuhu,
						y: yValSuhu,
						label: json.created_at,
					});
					dps_ph.push({
						x: xValPh,
						y: yValPh,
						label: json.created_at,
					});
					dps_kelembapan.push({
						x: xValKelembapan,
						y: yValKelembapan,
						label: json.created_at,
					});
					dps_kekeruhan.push({
						x: xValKekeruhan,
						y: yValKekeruhan,
						label: json.created_at,
					});
					xValSuhu++;
					xValPh++;
					xValKelembapan++;
					xValKekeruhan++;
				}

				if (dps_suhu.length > dataLength) {
					dps_suhu.shift();
				}
				if (dps_ph.length > dataLength) {
					dps_ph.shift();
				}
				if (dps_kelembapan.length > dataLength) {
					dps_kelembapan.shift();
				}
				if (dps_kekeruhan.length > dataLength) {
					dps_kekeruhan.shift();
				}
			});
			suhu.render();
			ph.render();
			kelembapan.render();
			kekeruhan.render();

		};

		GetSetChart_suhu(dataLength);
		setInterval(function() {
			GetSetChart_suhu();
		}, updateInterval);
	</script>


</body>

</html>