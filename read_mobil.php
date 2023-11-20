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
                            <li><a href="index.html">Home</a></li>                                                    
                            <li><a href="read_mobil.php">Mobil</a></li>
                            <li><a href="read_jenis.php">Jenis Mobil</a></li>
                            <li><a href="logout.php">Logout</a></li>
                            <div id="myNav" class="overlay">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <div class="overlay-content">
                  <a href="index.html">Home</a>
                  <a href="read_mobil.php">Mobil</a>
                  <a href="read_jenis.php">Jenis Mobil</a>
                  <a href="logout.php">Logout</a>
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
          <h2 class="text-uppercase mb-3 tm-app-feature-header">Lihat Mobil</h2>
          <button class="btn btn-primary" type="submit" name="submit" onClick='top.location="tambah_mobil.php"' value="insert" >Tambah</button>
          <br><br><br><br>
              <table class="table table-hover" style="width: 100%">
                <thead class="table-success">
                  <tr>
                  <th scope="col" style="width: 5%;">No</th>
                  <th scope="col" >ID Mobil</th>
                  <th scope="col" >Jenis Mobil</th>
                  <th scope="col" >Nama Mobil</th>
                  <th scope="col" >Stok Mobil</th>
                  <th scope="col" >Harga Mobil</th>
                  <th scope="col" >Status Ketersediaan</th>
                  <th scope="col" style="width: 20%;text-align:center;">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                      include 'koneksi.php';
                      $baris=1;
                      
                      $query = "SELECT Mobil.id_Mobil, jenis_Mobil.nama_jenis_Mobil, mobil.nama_Mobil, mobil.stok_Mobil, mobil.harga_Mobil FROM mobil INNER JOIN jenis_Mobil ON mobil.id_jenis_Mobil = jenis_Mobil.id_jenis_Mobil";
                      $view = mysqli_query($con, $query);
                      while($row = mysqli_fetch_array($view))
                      {
              ?>
              <tr class="table-light">
                  <td><?php echo $baris ?></td>
                  <td><?php echo $row['id_Mobil'] ?></td>
                  <td><?php echo $row['nama_jenis_Mobil'] ?></td>
                  <td><?php echo $row['nama_Mobil'] ?></td>
                  <td><?php echo $row['stok_Mobil'] ?></td>
                  <td><?php echo $row['harga_Mobil'] ?></td>
                  <td><?php if($row['stok_Mobil']>0){echo 'Tersedia';}else{echo 'Tidak Tersedia';} ?></td>
                  <td style="text-align:center">
                      <a  href="ubah_mobil.php?id_Mobil=<?php echo $row['id_Mobil'] ?>">Ubah</a> |
                      &nbsp;
                      <a href="#" onClick="confirm_modal('./controllers/deleteVehicleController.php?id_Mobil=<?php echo $row['id_Mobil'] ?>');">Hapus</a>
                  </td>
              </tr>
              <?php
                  $baris++;
                }
              ?>
                </tbody>
          </header>
      </div> <!-- .container -->
    </div> <!-- .page-section -->
  </main>

    <!-- Modal Popup untuk delete-->
    <div class="modal fade" id="modal_delete">
    <div class="modal-dialog">
      <div class="modal-content" style="margin-top:100px;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" style="text-align:center;">Anda yakin akan menghapus data ini?</h4>
        </div>
                  
        <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
          <a href="hapus_mobil.php" class="btn btn-danger btn-sm" id="delete_link">Hapus</a>
          <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

    <!-- Javascript untuk popup modal Delete-->
    <script type="text/javascript">
      function confirm_modal(delete_url)
      {
        $('#modal_delete').modal('show', {backdrop: 'static'});
        document.getElementById('delete_link').setAttribute('href' , delete_url);
      }
  </script>  

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