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
<title>ULOAX</title>
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
                                <li><a href="read_penjualan.php" style="color: black;">Lihat Riwayat Transaksi</a></li>
                              </ul>
                            </li>
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
        <header class="col-12 text-center tm-bg-black-transparent p-5 tes">
          <br> <br>
              <h2 class="text-uppercase mb-3 tm-app-feature-header">Tambah Penjualan</h2>
              <form action="#" method="POST">
                <div class="form-group">
                <table width="1000px" style="item-align:left;">
                      <tr>
                          <td>ID Mobil</td>
                          <td>:</td>
                          <td>
                          <select style="item-align:left;" name="id_Mobil">
                          <?php
                              require "./koneksi.php";
                              
                              $sql="select * from mobil where stok_Mobil > 0";

                              $hasil=mysqli_query($con,$sql);
                              $no=0;
                              while ($data = mysqli_fetch_array($hasil)) {
                              $no++;
                          ?>
                              <option value="<?php echo htmlspecialchars($data['id_Mobil']);?>"><?php echo htmlspecialchars($data['nama_Mobil']);?></option>
                              <?php 
                              }
                          ?>
                          </select>
                          </td>
                      </tr>
                      <tr>
                      <td>Diskon</td>
                          <td>:</td>
                          <td>
                      <input type="radio" id="nol" name="diskon" value="0">0%</input>
                      &nbsp;
                      <input type="radio" id="lima" name="diskon" value="5">5%</input>
                      &nbsp;
                      <input type="radio" id="sepuluh" name="diskon" value="10">10%</input>
                          </td>
                      </tr>
                      <tr>
                          <td></td>
                          <td></td>
                          <td>
                            <br><br>
                          <button class="btn btn-primary" type="submit" name="submit" value="Tambah" >Tambah</button>
                          </td>
                      </tr>
                  </table>
          </form>
          <?php
              if(isset($_POST['submit']))
              {
                  require "./koneksi.php";

                  $query = mysqli_query($con, "SELECT max(id_penjualan) as kodeTerbesar FROM penjualan");
                  $data = mysqli_fetch_array($query);
                  $id_last = $data['kodeTerbesar'];

                  $urutan = (int) substr($id_last, 2, 3);
                  $urutan++;
                  $huruf = "PJ";
                  $new_id = $huruf . sprintf("%03s", $urutan);

                  $idMobil = $_POST['id_Mobil'];
                  
                  $tanggal = date("Y-m-d");
                  $diskon = $_POST['diskon'];

                  $error = false;
                  if(!isset($diskon)){
                    $message = "Jangan lupa tentukan diskon";
                    $error = true;
                  }

                  if($error === false){
                    $query = "select * from mobil where id_Mobil='$idMobil'";
                    $select = mysqli_query($con, $query);
                    $sel = mysqli_fetch_array($select);
  
                    $harga = $sel['harga_Mobil'];
                    $harga = $harga * ((100-$diskon)/100);
  
                    include 'koneksi.php';
                    $query="INSERT INTO penjualan VALUES (?, ?, ?, ?, ?)";
                    $stmt = $con->prepare($query);
                    $stmt->bind_param("ssssi", $new_id, $idMobil, $tanggal, $diskon, $harga);
                    $stmt->execute();
                    $stmt->close();
  
                    $query2="UPDATE mobil SET stok_Mobil = stok_Mobil - 1 WHERE id_Mobil= ?";
                    $stmt2 = $con->prepare($query2);
                    $stmt2->bind_param("s", $idMobil);
                    $stmt2->execute();
                    $stmt2->close();
                    echo "<script>alert('Data berhasil ditambah');window.location.href = 'read_penjualan.php';</script>";
                  }
                  else{
                    echo "<script>alert('$message');window.history.go(-1);</script>";
                  }
              }
              ?>
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