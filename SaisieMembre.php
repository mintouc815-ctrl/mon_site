<?php
include("config.php");
include("header.php");

if(isset($_POST['ajouter'])){
$stmt = $conn->prepare("INSERT INTO Membre(Nom,Prenom,Adresse,Tel) VALUES(?,?,?,?)");
$stmt->bind_param("ssss", $_POST['nom'], $_POST['prenom'], $_POST['adresse'], $_POST['tel']);
$stmt->execute();
echo "<div class='alert alert-success'>Membre ajouté avec succès</div>";
}
?>

<div class="card shadow p-4">
<h3 class="mb-3">Ajouter un membre</h3>

<form method="POST">
<div class="mb-3">
<input type="text" name="nom" class="form-control" placeholder="Nom" required>
</div>

<div class="mb-3">
<input type="text" name="prenom" class="form-control" placeholder="Prénom" required>
</div>

<div class="mb-3">
<input type="text" name="adresse" class="form-control" placeholder="Adresse" required>
</div>

<div class="mb-3">
<input type="text" name="tel" class="form-control" placeholder="Téléphone" required>
</div>

<button class="btn btn-primary w-100" name="ajouter">Ajouter</button>
</form>
</div>

<?php include("footer.php"); ?>