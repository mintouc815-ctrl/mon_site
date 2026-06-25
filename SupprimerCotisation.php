<?php
include("config.php");
$id = $_GET['id'];
$conn->query("DELETE FROM Cotisation WHERE NumCotis='$id'");
header("Location: ListeCotisations.php");
?>