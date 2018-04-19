<?php
// Her gentager jeg sessionen. (Det var her jeg nåede til i opgaven)
session_start();
?>
<?php include "header.html"?>
<?php
$g=$_SESSION['sub'];
echo "<img src='$g'>";
?>