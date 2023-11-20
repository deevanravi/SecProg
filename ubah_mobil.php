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
<?php
        if(isset($_GET['id_Mobil']))
        {
            $id = $_GET['id_Mobil'];
            require "./koneksi.php";

            $query = "select * from mobil where id_Mobil='$id'";
            $select = mysqli_query($con, $query);
            $sel = mysqli_fetch_array($select);
        } 
  ?>
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
                  <a href="index.html">Home</a>
                  <a href="read_mobil.php">Mobil</a>
                  <a href="read_jenis.php">Jenis Mobil</a>
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
                    <h2 class="text-uppercase mb-3 tm-app-feature-header">Ubah Mobil</h2>
                    <form method="post" action="./controllers/changeCarsController.php?id_Mobil=<?php echo $id ?>">
                      <div class="form-group">
                      <table width="1000px" style="item-align:left;">
                            <tr>
                                <td>Jenis Mobil</td>
                                <td>:</td>
                                <td>
                                <select style="item-align:left;" name="jenis">
                                <?php
                                    include 'koneksi.php';
                                    $sql="select * from jenis_Mobil where status_jenis_Mobil> 0";

                                    $hasil=mysqli_query($con,$sql);
                                    $no=0;
                                    while ($data = mysqli_fetch_array($hasil)) {
                                    $no++;
                                ?>
                                    <option value="<?php echo $data['id_jenis_Mobil'];?>"><?php echo $data['nama_jenis_Mobil'];?></option>
                                    <?php 
                                    }
                                ?>
                                </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Nama Mobil</td>
                                <td>:</td>
                                <td><input value="<?php echo $sel['nama_Mobil'] ?>"class="form-control rounded-0 border-top-0 border-right-0 border-left-0" type="text" name="nama" size="35"/></td>
                            </tr>
                            <tr>
                                <td>Stok Mobil</td>
                                <td>:</td>
                                <td><input value="<?php echo $sel['stok_Mobil'] ?>" class="form-control rounded-0 border-top-0 border-right-0 border-left-0" type="text" name="stok" size="35"/></td>
                            </tr>
                            <tr>
                                <td>Harga Mobil</td>
                                <td>:</td>
                                <td><input value="<?php echo $sel['harga_Mobil'] ?>" class="form-control rounded-0 border-top-0 border-right-0 border-left-0" type="text" name="harga" size="35"/></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                  <br><br>
                                <button class="btn btn-primary" type="submit" name="submit" value="Tambah" >Update</button>
                                </td>
                            </tr>
                        </table>
                </form>
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
          <a href="#" class="btn btn-danger btn-sm" id="delete_link">Hapus</a>
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