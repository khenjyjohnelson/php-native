<!-- Informasi Mengenai Website
  Informasi Umum
  ==================
  Nama Website      : IsiOnlen
  Deskripsi         : Situs layanan jasa yang melayani pembuatan KTP bagi warga negara Indonesia yang setidaknya berusia 17 tahun.
  Nama Editor       : Khenjy Johnelson
  Awal Pengembangan : 29 September 2020
  Alasan Dibuat     : Untuk menyelesaikan tugas mata pelajaran pemrograman web untuk kelas XI RPL.
  Aplikasi Editor   : Sublime Text Unregistered, XAMPP, dan Chrome
  
  Informasi Khusus
  ==================
  Nama Website      : Form 2 - IsiOnlen
  Deskripsi         : Halaman kedua pengisian data diri pengguna pada IsiOnlen.
  Tanggal Rilis     : 29 September 2020
-->


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="isionlen, cara mendaftarkan ktp secara online, daftar ktp online">
    <meta name="description" content="Form 2 - IsiOnlen">
    <meta name="author" content="Khenjy Johnelson">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Konfirmasi Data Diri Anda! - IsiOnlen</title>
  </head>
  <body>
  	<!--Header - IsiOnlen-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
      <div class="container-fluid">
        <a href="index.html" class="navbar-brand">IsiOnlen</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-item nav-link active" href="index.html">Home <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link active" href="form1.php">Daftar</a>
            <a class="nav-item nav-link active" href="aboutus.html">About Us</a>
            <a class="nav-item nav-link active" href="meetus.php">Meet Us</a>
          </div>
        </div>
      </div>
    </nav>

  	

  	<!--Isi - Form 2 - IsiOnlen-->
	<div class="jumbotron">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md text-center my-4">
					<h1 id="Judul">Konfirmasi Data Diri Anda!</h1>
					<label class="h4" for="Judul">Periksa Data Diri Anda</label>
				</div>
			</div>


			<div class="row">
				<div class="col-md-4 offset-md-4 text-center">
					<div class="card" style="width: 100%;">
						<img src="
						<?php
						$fotodiri = $_POST['fotodiri'];
						echo $fotodiri;
						?>">
						<div class="card-body">
							<p class="card-text text-break">
							<?php
							$namadepan = $_POST['txtnamadepan'];
							$namabelakang = $_POST['txtnamabelakang'];
							echo $namadepan." ".$namabelakang;
							?>
							</p>
						</div>
					</div>
				</div>
			</div>


			<div class="row">
				<div class="col-md-8 offset-md-2">
					<div class="form-group">
						<label for="FormControlName">Nama Lengkap : </label>
						<span class="input-group-text text-break" id="FormControlName">
							<?php
							$namadepan = $_POST['txtnamadepan'];
							$namabelakang = $_POST['txtnamabelakang'];
							echo $namadepan." ".$namabelakang;
							?>
						</span>
					</div>
				</div>
			</div>


			<div class="row">
				<div class="col-md-8 offset-md-2">
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label for="FormControlAlamat">Alamat : </label>
								<textarea class="form-control" id="FormControlAlamat" disabled><?php $alamat = $_POST['alamat']; echo $alamat; ?></textarea>
							</div>
						</div>
					</div>	
				</div>
			</div>


			<div class="row">
				<div class="col-md-2 offset-md-2">
					<div class="form-group">
						<label for="FormControlRT">RT : </label>
						<span class="input-group-text" id="FormControlRT">
							<?php
							$rt = $_POST['nomorrt'];
							echo $rt;
							?>
						</span>
					</div>
				</div>

				<div class="col-md-2 offset-md-2">
					<div class="form-group">
						<label for="FormControlRW">RW : </label>
						<span class="input-group-text" id="FormControlRW">
							<?php
							$rw = $_POST['nomorrw'];
							echo $rw;
							?>
						</span>
					</div>
				</div>

				<div class="col-md-3 offset-md-2">
					<div class="form-group">
						<label for="FormControlKelDesa">Kelurahan/Desa : </label>
						<span class="input-group-text" id="FormControlKelDesa">
							<?php
							$keldesa = $_POST['keldesa'];
							echo $keldesa;
							?>
						</span>
					</div>
				</div>

				<div class="col-md-3 offset-md-1">
					<div class="form-group">
						<label for="FormControlKelDesa">Kecamatan : </label>
						<span class="input-group-text" id="FormControlKelDesa">
							<?php
							$kecamatan = $_POST['kecamatan'];
							echo $kecamatan;
							?>
						</span>
					</div>
				</div>
			</div>


			<div class="row">
				<div class="col-md-6 offset-md-3 text-center">
					<div class="card card-bl" style="width: 100%;">
						<img src=<?php
						$fotokk = $_POST['fotokk'];
						echo $fotokk;
						?>>
						<div class="card-body">
							<p class="card-text">
							<?php
							$namadepan = $_POST['txtnamadepan'];
							$namabelakang = $_POST['txtnamabelakang'];
							echo "Kartu Keluarga "."<br>".$namadepan." ".$namabelakang;
							?>
							</p>
						</div>
					</div>
				</div>
			</div>


			<div class="row">
				<div class="col text-center mt-4">
					<h2 id="SubJudul">Isilah Salah Satu Form Berikut</h2>
					<label class="h4" for="SubJudul">Email atau Nomor HP?</label>
				</div>
			</div>


			<div class="row">
				<div class="col-md-4 offset-md-2">
					<form action="done.php" method="post">
						<div class="row form-row">
							<div class="col-md form-group my-1">
								<label for="FormIsiEmail">Email : </label>
								<input type="name" name="txtemail" class="form-control" id="FormIsiEmail" placeholder="Email">
							</div>
						</div>


						<div class="row form-row">
							<div class="col-md form-group my-1">
								<label for="FormIsiPassword">Password : </label>
								<input type="password" name="txtpassword" class="form-control" id="FormIsiPassword" placeholder="Password">
							</div>
					</div>

						<div class="row form-row">
							<div class="col-md-8 my-4">
								<button type="submit" class="btn btn-success btn-block">Konfirmasi Dengan Email</button>
							</div>
						</div>
					</form>
				</div>

				<div class="col-md-4">
					<form action="done.php" method="post">
						<div class="row form-row">
							<div class="col-md form-group my-1">
								<label for="FormIsiNoHP">No HP : </label>
								<input type="name" name="txtnohp" class="form-control" id="FormIsiNoHP" placeholder="Nomor HP">
							</div>
						</div>

						<div class="row form-row">
							<div class="col-md-8 my-4">
								<button type="submit" class="btn btn-success btn-block">Konfirmasi Dengan No HP</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 offset-md-4 my-4">
					<form action="form1.php">
						<button type="submit" class="btn btn-danger btn-block">Batal Konfirmasi</button>
					</form>
				</div>
			</div>
		</div>
	</div>


	<!--Footer - IsiOnlen-->
    <footer class="jumbotron">
      <div class="container">
        <div class="row">
          <div class="col text-center text-monospace">
            <label>Copyright ©2020 IsiOnlen. All Rights Reserved.</label>
          </div>
        </div>


        <div class="row justify-content-center">
          <div class="col text-right">
            <a href="aboutus.html">About Us</a>
          </div>

          <div class="col text-left">
            <a href="meetus.php">Meet Us</a>
          </div>
        </div>
      </div>
    </footer>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>
