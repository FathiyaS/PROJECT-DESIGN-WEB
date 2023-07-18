<?php
// include database connection file
include("config.php");
include("sidebar.html"); 

// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['update']))
{
    $nama_user = $_POST['nama_user'];
    $tanggal = $_POST['tanggal'];
    $judul = $_POST['judul'];
    $inputberita = $_POST['inputberita'];



    $escaped_nama_user = mysqli_real_escape_string($koneksi, $nama_user);
    $escaped_tanggal = mysqli_real_escape_string($koneksi, $tanggal);
    $escaped_judul = mysqli_real_escape_string($koneksi, $judul);
    $escaped_inputberita = mysqli_real_escape_string($koneksi, $inputberita);

    // update user data
    $result = mysqli_query($koneksi, "UPDATE berita SET nama_user='$escaped_nama_user', tanggal='$escaped_tanggal', judul='$escaped_judul ', inputberita='$escaped_inputberita' WHERE judul='$judul'");

    // Redirect to homepage after update
    if ($result) {
        $message = 'Data berhasil dimasukkan. Klik <a href="news.php">di sini</a> untuk menuju ke tabel.';
        echo '<div class="notification">' . $message . '</div>';
        $url = 'news.php';
        echo '<script>setTimeout(function() { window.location.href = "' . $url . '"; }, 3000)</script>';
    } else {
        echo '<script>alert("Terjadi kesalahan dalam memasukkan data. Silakan coba lagi.")</script>';
    }
}

// Display selected user data based on id
// Getting id from url
if (isset($_GET['judul'])) {
    $judul = $_GET['judul'];

    // Fetch user data based on id
    $result = mysqli_query($koneksi, "SELECT * FROM berita WHERE judul='$judul'");

    while($user_data = mysqli_fetch_array($result)){
        $nama_user = $user_data['nama_user'];
        $tanggal = $user_data['tanggal'];
        $input_judul = $user_data['judul'];
        $inputberita = $user_data['inputberita'];

     
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style1.css">
</head>
<style>
.notification {
    position: fixed;
    top: 70px; /* Sesuaikan dengan tinggi navbar Anda */
    left: 50%;
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
    <div class="form">
        <p>Apa Berita hari ini??</p>
        <form action="editberita.php" method="post">
            <?php 
            include_once("config.php");
            $sql = mysqli_query($koneksi, "SELECT * FROM user ORDER BY id ASC");
            ?>
            <label>User</label><br>
            <select name="nama_user">
                <option>user</option>
                <?php
                while ($category = mysqli_fetch_array($sql,MYSQLI_ASSOC)):
                ?>
                <option value="<?php echo $category["id"];?>">
                    <?php echo $category["nama"];?>           
                </option>
                <?php
                endwhile;
                ?>
            </select><br>

            <label>Tanggal</label>
            <input type="date"  name="tanggal" >
                    
            <label>Judul</label>
            <input type="text"  name="judul" value="<?php echo isset($judul) ? $judul : ''; ?>">
                    
            <label>Berita</label>
            <div>
                <textarea name="inputberita"><?php echo isset($inputberita) ? $inputberita : ''; ?></textarea>    
            </div>
            <div>
            <input type="hidden" name="judul" value="<?php echo $judul ?>">
            </div>
            <input type="Submit" value="Update" name="update">
        </form>
    </div>
</body>
</html>