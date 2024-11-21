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
  Nama Website      : Meet Us - IsiOnlen
  Deskripsi         : Halaman untuk memberikan feedback pengalaman pengguna pada Editor.
  Tanggal Rilis     : 1 Oktober 2020
-->


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="isionlen, cara mendaftarkan ktp secara online, daftar ktp online">
    <meta name="description" content="Meet Us - IsiOnlen">
    <meta name="author" content="Khenjy Johnelson">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Meet Us - IsiOnlen</title>
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



    <!--Isi - Meet Us - IsiOnlen-->
    <div class="jumbotron">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8 text-center my-4">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <h1>Aman Membuat KTP</h1>
                </div>
                <div class="carousel-item">
                  <h1>Mudah Membuat KTP</h1>
                </div>
                <div class="carousel-item">
                  <h1>Nyaman Membuat KTP</h1>
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8 offset-md-2">
            <h1 id="Judul">Meet Us</h1>
            <label for="Judul">Berikan FeedBack Anda Pada Kami Agar Website Ini Dapat Lebih Berkembang Lagi</label>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8 offset-md-2">
            <form action="meetus.php" method="post">
                <div class="row form-row">
                  <div class="col-md">
                    <label for="FormMeetUsName">Nama : </label>
                  </div>
                </div>
                <div class="row form-row" id="FormMeetUsName">
                  <div class="col-md">
                    <input type="name" name="txtnama" class="form-control" required="" placeholder="Nama">
                  </div>
                </div>


                <div class="row form-row">
                  <div class="col-md-4 mt-4">
                    <label for="FormMeetUsEmail">Email : </label>
                  </div>
                </div>
                <div class="row form-row" id="FormMeetUsEmail">
                  <div class="col-md">
                    <input type="name" name="txtemail" class="form-control" required="" placeholder="Email">
                  </div>
                </div>


                <div class="row form-row">
                  <div class="col-md mt-4">
                    <label for="FormMeetUsFeedBack">FeedBack : </label>
                  </div>
                </div>
                <div class="row form-row" id="FormMeetUsFeedBack">
                  <div class="col-md">
                    <textarea name="txtfeedback" placeholder="FeedBack" required="" class="form-control"></textarea>
                  </div>
                </div>


                <div class="row form-row">
                  <div class="col-md-2 mt-4">
                    <button class="btn btn-danger btn-block" type="reset">Batal</button>
                  </div>
                  <div class="col-md-2 offset-md-8 mt-4">
                    <button class="btn btn-success btn-block" type="submit">Kirim</button>
                  </div>
                </div>
                
              
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
