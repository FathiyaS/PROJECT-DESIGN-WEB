<!---Sidebar Dan Navbar-->
<?php
include("sidebar.html");


// Check If form submitted, insert form data into users table.
if (isset($_POST['Submit'])) {
  $id_user= $_POST['id_user'];
  $kode = $_POST['kode'];
  $nama_obat = $_POST['nama_obat'];
  $harga = $_POST['harga'];
  $stok = $_POST['stok'];
  $satuan = $_POST['satuan'];
  $tanggal_masuk = $_POST['tanggal_masuk'];
  $deskripsi_obat = $_POST['deskripsi_obat'];

  // include database connection file
  include_once("config.php");

  // Insert user data into table
  $result = mysqli_query($koneksi, "INSERT INTO data_obat(id_user,kode,nama_obat,harga,stok,satuan,tanggal_masuk,deskripsi_obat) VALUES('$id_user','$kode','$nama_obat','$harga','$stok','$satuan','$tanggal_masuk','$deskripsi_obat')");

  if ($result) {
      $message = 'Data berhasil dimasukkan. Klik <a href="tabelobat.php">di sini</a> untuk menuju ke tabel.';
      echo '<div class="notification">' . $message . '</div>';
      $url = 'tabelobat.php';
      echo '<script>setTimeout(function() { window.location.href = "' . $url . '"; }, 3000)</script>';
  } else {
      echo '<script>alert("Terjadi kesalahan dalam memasukkan data. Silakan coba lagi.")</script>';
  }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link rel="stylesheet" href="style2.css">
</head>
<style>
.notification {
  position: fixed;
  top: 70px; /* Sesuaikan dengan tinggi navbar Anda */
  left: 60%;
  transform: translateX(-50%);
  padding: 10px 20px;
  background-color: #f8f9fa;
  border: 1px solid #dee2e6;
  border-radius: 4px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  z-index: 9999;
}
</style>
<body>

<!---form-->
       <!---form-->
       <div class="obat">
                <div class="box">
                    <form action="inputobat.php" method="post">
                        <div class="user">
                        <div class="input">
                        <?php 
                    include_once("config.php");
                    $sql = mysqli_query($koneksi, "SELECT * FROM  user ORDER BY id ASC");
                    ?>
                    <span class="isi">User</span>
                                <select name="id_user">
                                <option>user</option>
                      
            <?php
            while ($category = mysqli_fetch_array(
                $sql,MYSQLI_ASSOC)):;
                ?>
                <option value="<?php echo $category["id"];?>">
                    <?php echo $category["nama"];?>           
                    <?php
                endwhile; ?>
                               
                                </select>
                            </div>



                            <div class="input">
                                <span class="isi">Kode</span>
                                <input type="text" name="kode">
                            </div>
                            <div class="input">
                                <span class="isi">Nama obat</span>
                                <input type="text" name="nama_obat">
                            </div>
                            <div class="input">
                                <span class="isi">Harga</span>
                                <input type="text" name="harga">
                            </div>
                            <div class="input">
                                <span class="isi">Stok</span>
                                <input type="text" name="stok">
                            </div>
                            <div class="input">
                                <span class="isi">Satuan</span>
                                <select id="" name="satuan">
                                    <option value="??">==========Pilih Satuan=========</option>
                                    <option value="box">Box</option>
                                    <option value="botol">Botol</option>
                                </select>
                            </div>
                            <div class="input">
                                <span class="isi">Tanggal Masuk</span>
                                <input type="date" name="tanggal_masuk" >
                            </div>
                            <div class="input">
                                <p class="isi">Deskripsi</p>
                                <textarea placeholder="" name="deskripsi_obat"></textarea>
                            </div>
                        </div> 
                        <div class="ready">
                            <input name="Submit" type="Submit" value="Submit">
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</body>
</html>