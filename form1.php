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
  Nama Website      : Form 1 - IsiOnlen
  Deskripsi         : Halaman pertama pengisian data diri pengguna pada IsiOnlen.
  Tanggal Rilis     : 29 September 2020
-->


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="isionlen, cara mendaftarkan ktp secara online, daftar ktp online">
    <meta name="description" content="Form 1 - IsiOnlen">
    <meta name="author" content="Khenjy Johnelson">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Masukkan Data Diri Anda! - IsiOnlen</title>
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



    <!--Isi - Form 1 - IsiOnlen-->
	<form action="form2.php" method="post">
		<div class="jumbotron">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md text-center my-4">
						<h1 id="Judul">Selamat Datang di Form Data Penduduk</h1>
						<label class="h4" for="Judul">Daftarkan Diri Anda</label>
					</div>
				</div>


				<div class="row form-row">
					<div class="col-md-3 offset-md-2 my-1">
						<label for="FormControlNama">Nama Lengkap : </label>
					</div>
				</div>


				<div class="row form-row" id="FormControlNama">
					<div class="col-md-4 offset-md-2 my-1">
						<input type="name" name="txtnamadepan" class="form-control" placeholder="Nama Depan" required="">
					</div>

					<div class="col-md-4 my-1">
						<input type="name" name="txtnamabelakang" class="form-control" placeholder="Nama Belakang">
					</div>
				</div>


				<div class="row form-row">
					<div class="col-md-4 offset-md-2 form-group my-1">
						<label for="validationTextarea">Alamat : </label>
						<textarea class="form-control" id="validationTextarea" name="alamat" placeholder="Alamat" required=""></textarea>
					</div>

					<div class="col-md-2 form-group my-1">
							<label for="FormControlRT">RT : </label>
							<input type="number" name="nomorrt" class="form-control" id="FormControlRT" required="" placeholder="RT">
					</div>

					<div class="col-md-2 form-group my-1">
							<label for="FormControlRW">RW : </label>
							<input type="number" name="nomorrw" class="form-control" id="FormControlRW" required="" placeholder="RW">
					</div>
				</div>


				<div class="row form-row">
					<div class="col-md-4 offset-md-2 form-group my-1">
						<label for="FormControlKelDesa">Kelurahan/Desa : </label>
						<input type="name" name="keldesa" class="form-control" id="FormControlKelDesa" placeholder="Kelurahan/Desa" required="">
					</div>

					<div class="col-md-4 form-group my-1">
						<label for="FormControlKecamatan">Kecamatan : </label>
						<input type="name" name="kecamatan" class="form-control" id="FormControlKecamatan" placeholder="Kecamatan" required="">
					</div>
				</div>
				<!-- <div class="row form-row">
					<div class="col-2 offset-2 form-group">
			    		<label for="exampleFormControlSelect1">Tanggal Lahir : </label>
			    		<select class="form-control" id="exampleFormControlSelect1" name="tgllahir">
			    			<option selected> </option>
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
							<option>6</option>
							<option>7</option>
							<option>8</option>
							<option>9</option>
							<option>10</option>
							<option>11</option>
							<option>12</option>
							<option>13</option>
							<option>14</option>
							<option>15</option>
							<option>16</option>
							<option>17</option>
							<option>18</option>
							<option>19</option>
							<option>20</option>
							<option>21</option>
							<option>22</option>
							<option>23</option>
							<option>24</option>
							<option>25</option>
							<option>26</option>
							<option>27</option>
							<option>28</option>
							<option>29</option>
							<option>30</option>
							<option>31</option>
						</select>
					</div>
					<div class="col-3 form-group">
						<label for="exampleFormControlSelect1">Bulan Lahir : </label>
						<select class="form-control" id="exampleFormControlSelect1" name="blnlahir">
						    <option selected> </option>
						    <option>Januari</option>
						    <option>Februari</option>
						    <option>Maret</option>
						    <option>April</option>
						    <option>Mei</option>
						   	<option>Juni</option>
						    <option>Juli</option>
						    <option>Agustus</option>
						    <option>September</option>
						    <option>Oktober</option>
						    <option>November</option>
						    <option>Desember</option>
						</select>
					</div>
					<div class="col-3 form-group">
					    <label for="exampleFormControlSelect1">Tahun Lahir : </label>
					    <select class="form-control" id="exampleFormControlSelect1" name="tahunlahir">
						    <option selected> </option>
						    <option>1981</option>
						    <option>1982</option>
						    <option>1983</option>
						    <option>1984</option>
						    <option>1985</option>
						    <option>1986</option>
						    <option>1987</option>
						    <option>1988</option>
						    <option>1989</option>
						    <option>1990</option>
						    <option>1991</option>
						    <option>1992</option>
						    <option>1993</option>
						    <option>1994</option>
						    <option>1995</option>
						    <option>1996</option>
						    <option>1997</option>
						    <option>1998</option>
						    <option>1999</option>
						    <option>2000</option>
						    <option>2001</option>
						    <option>2002</option>
						    <option>2003</option>
						    <option>2004</option>
						</select>
					</div>
				</div>
			-->


				<div class="row">
					<div class="col-md-4 offset-md-4 form-group my-1">
						<label for="validatedInputGroupCustomFile">Foto Diri : </label>
						<div class="custom-file">
							<input type="file" class="custom-file-input" id="validatedInputGroupCustomFile" name="fotodiri" accept="image/*">
							<label class="custom-file-label" for="validatedInputGroupCustomFile">Pilih file...</label>
						</div>
					</div>
				</div>


				<div class="row">
					<div class="col-md-4 offset-md-4 form-group my-1">
						<label for="validatedInputGroupCustomFile">Foto Kartu Keluarga : </label>
						<div class="custom-file">
							<input type="file" class="custom-file-input" id="validatedInputGroupCustomFile" name="fotokk" accept="image/*">
							<label class="custom-file-label" for="validatedInputGroupCustomFile">PilihFile...</label>
						</div>
					</div>
				</div>


				<div class="row form-row">
					<div class="col-md-1 offset-md-2 mt-4">
						<button class="btn btn-danger btn-block" type="reset">Batal</button>
					</div>
					
					<div class="col-md-1 offset-md-6 mt-4">
						<button class="btn btn-success btn-block" type="submit">Kirim</button>
					</div>
				</div>
			</div>
		</div>		
	</form>



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


<title>Ayo Login</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
