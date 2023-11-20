<?php
  session_start();
  if(!isset($_SESSION['login'])){
    header("Location: ./index.php");
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
<!-- basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- mobile metas -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="initial-scale=1, maximum-scale=1">
<!-- site metas -->
<title>Riwayat Penjualan</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">	
<!-- bootstrap css -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<!-- style css -->
<link rel="stylesheet" type="text/css" href="css/style.css">
<!-- Responsive-->
<link rel="stylesheet" href="css/responsive.css">
<!-- fevicon -->
<link rel="icon" href="images/fevicon.png" type="image/gif" />
<!-- Scrollbar Custom CSS -->
<link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
<!-- Tweaks for older IEs-->
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
<!-- owl stylesheets --> 
<link rel="stylesheet" href="css/owl.carousel.min.css">
<link rel="stylesheet" href="css/owl.theme.default.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
<style>
    .diskon5 {
      background-color: #FFFF00;
    }
    .diskon10{
      background-color: #00FF00;
    }
    </style>

</head>
<body>

  <?php
      require "./koneksi.php";

      function cekDiskon ($disc)
      {
          if ($disc == 5)
          {
              echo "diskon5";
          }
          else if ($disc == 10)
          {
              echo "diskon10";
          }
      }
  ?>
</head>
<body>
	<!--header section start -->
    <div id="index.html" class="header_section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="logo"><a href="index.html"><img src="images/logo.png"></a></div>
                </div>
                <div class="col-sm-6 col-lg-9">
                    <div class="menu_text">
                        <ul>
                            <li><a href="index_Kasir.html">Home</a></li> 
                                                                             
                           
                            <li class="dropdown">
                              <a class="dropdown-toggle" data-toggle="dropdown" href="#">Transaksi
                              <span class="caret"></span></a>
                              <ul class="dropdown-menu">
                                <li><a href="read_penjualan.php" style="color: black;">Penjualan</a></li>
                                <li><a href="read_penjualan.php" style="color: black;">Riwayat</a></li>
                              </ul>
                            </li>
                            <li><a href="logout.php">Logout</a></li>  
                           
                            <div id="myNav" class="overlay">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <div class="overlay-content">
                  <a href="index_Kasir.html">Home</a>
                 
                  <li class="dropdown">
                              <a class="dropdown-toggle" data-toggle="dropdown" href="#">Transaksi
                              <span class="caret"></span></a>
                              <ul class="dropdown-menu">
                                <li><a href="read_penjualan.php" style="color: black;">Penjualan</a></li>
                                <li><a href="read_penjualan.php" style="color: black;">Lihat Riwayat Transaksi</a></li>
                              </ul>
                              
                </div>
                </div>
                <span  style="font-size:33px;cursor:pointer; color: #ffffff;" class="toggle_menu"></span>
                </div>  
                </li>
                        </ul>
                    </div>
            </div>
        </div>
    </div>
    <!-- header section end -->
    <main>
    <div class="page-section">
      <div class="container">
        <header class="col-12 text-center tm-bg-white-transparent p-5 tes">
            <br> <br>
          <h2 class="text-uppercase mb-3 tm-app-feature-header">Lihat Penjualan</h2>
          <button class="btn btn-primary" type="submit" name="submit" onClick='top.location="tambah_penjualan.php"' value="insert" >Tambah</button>
          <br><br><br><br>
          <div class="card-body">
              <table class="table table-sm table-bordered table-hover">
                  <tr>
                    <th>ID</th>
                    <th>Mobil</th>
                    <th>Tanggal</th>
                    <th>Diskon</th>
                    <th>Harga Mobil</th>
                  </tr>

                    <?php
                    include 'koneksi.php';

                    $query = "SELECT penjualan.id_penjualan, mobil.nama_Mobil, penjualan.tanggal_penjualan, penjualan.diskon_penjualan, penjualan.harga_penjualan FROM penjualan INNER JOIN mobil ON penjualan.id_Mobil = mobil.id_Mobil";

                    $baris = 1;
                    $view = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_array($view)) {
                        $id = $row['id_penjualan'];
                        $nama = $row['nama_Mobil'];
                        $tanggal = $row['tanggal_penjualan'];
                        $diskon = $row['diskon_penjualan'];
                        $harga = $row['harga_penjualan'];
                    ?>

                        <tr class="<?php cekDiskon($diskon) ?>">
                            <td><?php echo $id; ?></td>
                            <td><?php echo $nama; ?></td>
                            <td><?php echo $tanggal; ?></td>
                            <td><?php echo $diskon."%"; ?></td>
                            <td><?php echo "Rp. ".$harga; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
      </header>
      </div> <!-- .container -->
    </div> <!-- .page-section -->
  </main>
 
    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/plugin.js"></script>
    <!-- sidebar -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <!-- javascript --> 
    <script src="js/owl.carousel.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <script>
    $(document).ready(function(){
      $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
      });
        
        $(".zoom").hover(function(){
            
        $(this).addClass('transition');
        }, function(){
            
        $(this).removeClass('transition');
      });
    });
    </script> 
    <script>
    function openNav() {
    document.getElementById("myNav").style.width = "100%";
    }

    function closeNav() {
   document.getElementById("myNav").style.width = "0%";
   }
</script>   
</body>
</html>