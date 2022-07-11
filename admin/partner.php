<?php 
	session_start();
	include 'dbconnect.php';
?>

<head>
    <meta charset="utf-8">
	<link rel="icon" 
      type="image/png" 
      href="../favicon.png">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Kelola Mitra - DigitalTech</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
	
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
	<!-- Start datatable css -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
	
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
	<!-- preloader area start -->
	<div id="preloader">
		<div class="loader"></div>
	</div>
	<!-- preloader area end -->
	<!-- page container area start -->
	<div class="page-container">
		<?php include 'navigator.php' ?>
		<!-- main content area start -->
		<div class="main-content">
			<!-- header area start -->
			<div class="header-area">
				<div class="row align-items-center">
					<!-- nav and search button -->
					<div class="col-md-6 col-sm-8 clearfix">
						<div class="nav-btn pull-left">
							<span></span>
							<span></span>
							<span></span>
						</div>
					</div>
					<!-- profile info & task notification -->
					<div class="col-md-6 col-sm-4 clearfix">
						<ul class="notification-area pull-right">
							<li>
								<h3>
									<div class="date">
										<script type='text/javascript'>
											let months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
											let myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
											let date = new Date();
											let day = date.getDate();
											let month = date.getMonth();
											let thisDay = date.getDay(),
												thisDay = myDays[thisDay];
											let yy = date.getYear();
											let year = (yy < 1000) ? yy + 1900 : yy;
											document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
										</script>
									</div>
								</h3>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- header area end -->
			
			<!-- page title area end -->
			<div class="main-content-inner">
				<!-- market value area start -->
				<div class="row mt-5 mb-5">
					<div class="col-12">
						<div class="card">
							<div class="card-body">
								<div class="d-sm-flex justify-content-between align-items-center">
									<h2>Daftar Mitra</h2>
								</div>
								<div class="data-tables datatable-dark">
								<table id="dataTable3" class="display" style="width:100%">
									<thead class="thead-dark">
										<th>No</th>
										<th>Nama Mitra</th>
										<th>No. Telepon</th>
										<th>Alamat</th>
										<th>Email</th>
										<th>Status</th>
									</thead>
									<tbody>
										<?php 
											$brgs=mysqli_query($conn,"SELECT * from login where role='Partner' || (role='Member' && requestpartner=1) order by userid ASC");
											$no=1;
											while($p=mysqli_fetch_array($brgs)){
												$id = $p['userid'];
												if ($p['requestpartner']) {
													$status = "<button onclick='activate({$id})'>Aktivasi</button>";
												} else {
													$status = 'Aktif';
												};
												echo "
												<tr>
													<td>{$no}</td>
													<td>{$p['namalengkap']}</td>
													<td>{$p['notelp']}</td>
													<td>{$p['alamat']}</td>
													<td>{$p['email']}</td>
													<td>{$status}</td>
												</tr>	
												";
												$no++;
											}
										?>
									</tbody>
								</table>
							</div>
            </div>
          </div>
        </div>
      </div>
		</div>
		<!-- main content area end -->

		<!-- footer area start-->
		<footer>
			<div class="footer-area">
				<p>Digital Tech</p>
			</div>
		</footer>
		<!-- footer area end-->

	</div>
	<!-- page container area end -->

	<script>
		$(document).ready(function() {
			$('#dataTable3').DataTable( {
				dom: 'Bfrtip',
				buttons: [
					'print'
				]
			});
		});

		function activate(id) {
			$.ajax({
				type: "POST",
				url: "activate.php",
				data: { userId: "id" }
			});
		};
	</script>
	
	<!-- jquery latest version -->
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<!-- bootstrap 4 js -->
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/owl.carousel.min.js"></script>
	<script src="assets/js/metisMenu.min.js"></script>
	<script src="assets/js/jquery.slimscroll.min.js"></script>
	<script src="assets/js/jquery.slicknav.min.js"></script>
	<!-- Start datatable js -->
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
	<!-- start chart js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
	<!-- start highcharts js -->
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<!-- start zingchart js -->
	<script src="https://cdn.zingchart.com/zingchart.min.js"></script>
	<script>
	zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
	ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
	</script>
	<!-- all line chart activation -->
	<script src="assets/js/line-chart.js"></script>
	<!-- all pie chart -->
	<script src="assets/js/pie-chart.js"></script>
	<!-- others plugins -->
	<script src="assets/js/plugins.js"></script>
	<script src="assets/js/scripts.js"></script>
</body>

</html>
