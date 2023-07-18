<?php
include_once("config.php");
$result = mysqli_query($koneksi, "SELECT * FROM berita INNER JOIN user ON user.id = berita.nama_user");

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <!--Sidebar dan Navbar-->
<?php
include("sidebar.html")
?>

<!--News-->
<?php
include_once("config.php");

while($user_data = mysqli_fetch_array($result)){
    echo "
        <div class='box-berita'>
            <div class='box-1nya'>
                <div class='atas'>
                    <img src='assets/admin.png'  class='adm-icon'>
                    <span class='adm'>".$user_data['nama']."</span>
                    <p>".$user_data['tanggal']."</p>
                </div>
                <div class='isi'>
                    <h1>".$user_data['judul']."</h1>
                    <p>".$user_data['inputberita']."</p>   
                </div>      
                <a href='editberita.php?judul=".$user_data['judul']."' class='ubah'>Edit</a>
                <a href='hapus_berita.php?judul=".$user_data['judul']."' class='hapus'>Delete</a>
            </div>
        </div>";
}
?>

</body>
</html>