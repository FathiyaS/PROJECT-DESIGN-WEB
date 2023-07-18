<?php
// include database connection file
include_once("config.php");

$judul = $_GET['judul'];

// Escape the variable to prevent SQL injection
$escaped_judul = mysqli_real_escape_string($koneksi, $judul);

// Delete user row from table based on given id
$result = mysqli_query($koneksi, "DELETE FROM berita WHERE judul='$escaped_judul'");

// After delete redirect to Home, so that latest user list will be displayed.
header("Location:news.php?");
?>