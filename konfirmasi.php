<?php
session_start();
if(!isset($_SESSION['log'])){
	header('location:login.php');
} else {
	
};

$idorder = $_GET['id'];

include 'dbconnect.php';

if(isset($_POST['confirm'])){		
	$userid = $_SESSION['id'];
	$veriforderid = mysqli_query($conn,"select * from cart where orderid='$idorder'");
	$fetch = mysqli_fetch_array($veriforderid);
	$liat = mysqli_num_rows($veriforderid);
	
	if($fetch>0){
		$nama = $_POST['nama'];
		$metode = $_POST['metode'];
		$tanggal = $_POST['tanggal'];
		
		$nama_file = $_FILES['uploadgambar']['name'];
		$ext = pathinfo($nama_file, PATHINFO_EXTENSION);
		$random = crypt($nama_file, time());
		$ukuran_file = $_FILES['uploadgambar']['size'];
		$tipe_file = $_FILES['uploadgambar']['type'];
		$tmp_file = $_FILES['uploadgambar']['tmp_name'];
		$path = "bukti/".$random.'.'.$ext;
		$pathdb = "bukti/".$random.'.'.$ext;

		if(explode("/", $tipe_file)[0] === "image"){
			if($ukuran_file <= 5000000){ 
				if(move_uploaded_file($tmp_file, $path)){ 
				
					$kon = mysqli_query($conn,"insert into konfirmasi (orderid, userid, payment, namarekening, gambar, tglbayar) 
					values('$idorder','$userid','$metode','$nama','$pathdb','$tanggal')");
					if ($kon){
					
					$up = mysqli_query($conn,"update cart set status='Confirmed' where orderid='$idorder'");
					
					echo " <div class='alert alert-success'>
						Terima kasih telah melakukan konfirmasi, team kami akan melakukan verifikasi.
						Informasi selanjutnya akan dikirim via Email
						</div>
					<meta http-equiv='refresh' content='7; url= index.php'/>  ";
					} else {
						echo "<div class='alert alert-warning'>
						Gagal Submit, silakan ulangi lagi.
						</div>
						<meta http-equiv='refresh' content='3; url= konfirmasi.php'/> ";
					}
				}else{
					// Jika gambar gagal diupload, Lakukan :
					echo "Sorry, there's a problem while uploading the file.";
					echo "<br><meta http-equiv='refresh' content='5; URL=konfirmasi.php'> You will be redirected to the form in 5 seconds";
				}
			}else{
				// Jika ukuran file lebih dari 1MB, lakukan :
				echo "Sorry, the file size is not allowed to more than 1mb";
				echo "<br><meta http-equiv='refresh' content='5; URL=konfirmasi.php'> You will be redirected to the form in 5 seconds";
			}
		}else{
			// Jika tipe file yang diupload bukan JPG / JPEG / PNG, lakukan :
			echo "Sorry, the image format should be JPG/PNG.";
			echo "The current format is <strong>{$tipe_file}</strong>";
		}
			
	} else {
		echo "<div class='alert alert-danger'>
		Kode Order tidak ditemukan, harap masukkan kembali dengan benar
		</div>
		<meta http-equiv='refresh' content='4; url= konfirmasi.php'/> ";
	}
	
	
};

?>

<!DOCTYPE html>
<html>
<head>
<title>Moy Comp - Konfirmasi Pembayaran</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Tokopekita, Richard's Lab" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<!-- js -->
<script src="js/jquery-1.11.1.min.js"></script>
<!-- //js -->
<link href='//fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->
</head>
	
<body>
	<?php include 'header.php' ?>
	<?php include 'navigator.php' ?>
<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Konfirmasi</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<!-- register -->
	<div class="register">
		<div class="container">
			<h2>Konfirmasi</h2>
			<div class="login-form-grids">
				<h3>Kode Order</h3>
				<form method="post" enctype="multipart/form-data">
					<strong>
						<input type="text" name="orderid" value="<?php echo $idorder ?>" disabled>
					</strong>
					<h6>Informasi Pembayaran</h6>
					<input type="text" name="nama" placeholder="Nama Pemilik Rekening" required>
					<br>

					<h6>Alamat</h6>
					<input type="text" name="alamat" placeholder="Alamat Rumah Anda" required>
					<br>

					<h6>Rekening Tujuan</h6>
					<select name="metode" class="form-control">
						<?php
						$metode = mysqli_query($conn,"select * from pembayaran");
						
						while($a=mysqli_fetch_array($metode)){
						?>
							<option value="<?php echo $a['metode'] ?>"><?php echo $a['metode'] ?> | <?php echo $a['norek'] ?></option>
							<?php
						};
						?>
					</select>

					<h6>Bukti Pembayaran</h6>
					<input type="file" name="uploadgambar" accept="image/*">
					<br>
					<h6>Tanggal Bayar</h6>
					<input type="date" class="form-control" name="tanggal">
					<input type="submit" name="confirm" value="Submit">
				</form>
			</div>
			<div class="register-home">
				<a href="index.php">Batal</a>
			</div>
		</div>
	</div>
<!-- //register -->
<!-- //footer -->
<div class="footer">
		<div class="container">
			<div class="w3_footer_grids">
				<div class="col-md-4 w3_footer_grid">
					<h3>Hubungi Kami</h3>
					
					<ul class="address">
						<li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>Moy Comp, Semarang.</li>
						<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a href="mailto:moycomp@gmail.com">info@email</a></li>
						<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>+62 8223 033 728</li>
					</ul>
				</div>
				<div class="col-md-3 w3_footer_grid">
					<h3>Tentang Kami</h3>
					<ul class="info"> 
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="about.html">About Us</a></li>
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="about.html">How To</a></li>
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="about.html">FAQ</a></li>
					</ul>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		
		<div class="footer-copy">
			
			<div class="container">
				<p>© 2022 Moy Comp</p>
			</div>
		</div>
		
	</div>	
	<div class="footer-botm">
			<div class="container">
				<div class="w3layouts-foot">
					<ul>
						<li><a href="#" class="w3_agile_instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
						<li><a href="#" class="w3_agile_facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						<li><a href="#" class="agile_twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
					</ul>
				</div>
				<div class="payment-w3ls">	
					<img src="images/card.png" alt=" " class="img-responsive">
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
<!-- //footer -->	
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- top-header and slider -->
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 4000,
				easingType: 'linear' 
				};
			
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->

<!-- main slider-banner -->
<script src="js/skdslider.min.js"></script>
<link href="css/skdslider.css" rel="stylesheet">
<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('#demo1').skdslider({'delay':5000, 'animationSpeed': 2000,'showNextPrev':true,'showPlayButton':true,'autoSlide':true,'animationType':'fading'});
						
			jQuery('#responsive').change(function(){
			  $('#responsive_wrapper').width(jQuery(this).val());
			});
			
		});
</script>	
<!-- //main slider-banner --> 
</body>
</html>