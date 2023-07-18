<?php
// include database connection file
include_once("config.php");
include("sidebar.html");

// Check if form is submitted for user update, then redirect to homepage after update
if (isset($_POST['update'])) {
    $id_user = $_POST['id_user'];
    $kode = $_POST['kode'];
    $nama_obat = $_POST['nama_obat'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $satuan = $_POST['satuan'];
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $deskripsi_obat = $_POST['deskripsi_obat'];

    // Escape the variables to prevent SQL injection
    $escaped_id_user = mysqli_real_escape_string($koneksi, $id_user);
    $escaped_kode = mysqli_real_escape_string($koneksi, $kode);
    $escaped_nama_obat = mysqli_real_escape_string($koneksi, $nama_obat);
    $escaped_harga = mysqli_real_escape_string($koneksi, $harga);
    $escaped_stok = mysqli_real_escape_string($koneksi, $stok);
    $escaped_satuan = mysqli_real_escape_string($koneksi, $satuan);
    $escaped_tanggal_masuk = mysqli_real_escape_string($koneksi, $tanggal_masuk);
    $escaped_deskripsi_obat = mysqli_real_escape_string($koneksi, $deskripsi_obat);

    // Update user data
    $result = mysqli_query($koneksi, "UPDATE data_obat SET id_user='$escaped_id_user',kode='$escaped_kode', nama_obat='$escaped_nama_obat', harga='$escaped_harga', stok='$escaped_stok', satuan='$escaped_satuan', tanggal_masuk='$escaped_tanggal_masuk', deskripsi_obat='$escaped_deskripsi_obat' WHERE kode='$kode'");

    // Redirect to homepage to display updated user in list
    if ($result) {
        $message = 'Data berhasil dimasukkan. Klik <a href="tabelobat.php">di sini</a> untuk menuju ke tabel.';
        echo '<div class="notification">' . $message . '</div>';
        $url = 'tabelobat.php';
        echo '<script>setTimeout(function() { window.location.href = "' . $url . '"; }, 3000)</script>';
    } else {
        echo '<script>alert("Terjadi kesalahan dalam memasukkan data. Silakan coba lagi.")</script>';
    }
}

// Display selected user data based on id_user
// Getting id_user from url
if (isset($_GET['kode'])) {
    $kode = $_GET['kode'];

    // Fetch obat data based on id_user
    $result = mysqli_query($koneksi, "SELECT * FROM data_obat WHERE kode='$kode'");

    while ($user_data = mysqli_fetch_array($result)) {
        $id_user= $user_data['id_user'];
        $kode = $user_data['kode'];
        $nama_obat = $user_data['nama_obat'];
        $harga = $user_data['harga'];
        $stok = $user_data['stok'];
        $satuan = $user_data['satuan'];
        $tanggal_masuk = $user_data['tanggal_masuk'];
        $deskripsi_obat = $user_data['deskripsi_obat'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Obat</title>
    <link rel="stylesheet" href="style2.css">
</head>
<style>
.notification {
    position: fixed;
    top: 70px; /* Sesuaikan dengan tinggi navbar Anda */
    left: 55%;
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
    <!-- MULAI FORM -->
    <div class="obat">
        <div class="box">
            <form action="edit_obat.php" method="post">
                <div class="user">
                    <div class="input">
                        <?php 
                            include_once("config.php");
                            $sql = mysqli_query($koneksi, "SELECT * FROM user ORDER BY id ASC");
                        ?>
                        <span class="isi">User</span>
                        <select name="id_user">
                            <option>user</option>
                            <?php
                                while ($category = mysqli_fetch_array($sql, MYSQLI_ASSOC)):
                            ?>
                            <option value="<?php echo $category['id']; ?>">
                                <?php echo $category['nama']; ?>           
                            </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="input">
                        <span class="isi">Kode</span>
                        <input type="text" name="kode" value="<?php echo $kode; ?>">
                    </div>
                    <div class="input">
                        <span class="isi">Nama obat</span>
                        <input type="text" name="nama_obat" value="<?php echo $nama_obat; ?>">
                    </div>
                    <div class="input">
                        <span class="isi">Harga</span>
                        <input type="text" name="harga" value="<?php echo $harga; ?>">
                    </div>
                    <div class="input">
                        <span class="isi">Stok</span>
                        <input type="text" name="stok" value="<?php echo $stok; ?>">
                    </div>
                    <div class="input">
                        <span class="isi">Satuan</span>
                        <select id="" name="satuan">
                            <option value="??">==========Pilih Satuan=========</option>
                            <option value="box" <?php if ($satuan == "box") echo "selected"; ?>>Box</option>
                            <option value="botol" <?php if ($satuan == "botol") echo "selected"; ?>>Botol</option>
                        </select>
                    </div>
                    <div class="input">
                        <span class="isi">Tanggal Masuk</span>
                        <input type="date" name="tanggal_masuk" value="<?php echo $tanggal_masuk; ?>">
                    </div>
                    <div class="input">
                        <p class="isi">Deskripsi</p>
                        <textarea placeholder="" name="deskripsi_obat"><?php echo $deskripsi_obat; ?></textarea>
                    </div>
                </div>
                <div>
                    <input type="hidden" name="kode" value="<?php echo $kode; ?>">
                </div>
                <div class="ready">
                    <input name="update" type="submit" value="Update">
                </div>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>
