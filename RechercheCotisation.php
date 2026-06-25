<?php
include("config.php");
include("header.php");
?>

<div class="card shadow p-4">
<h3 class="mb-3">Recherche des cotisations par mois</h3>

<form method="POST">
<div class="row">

<div class="col-md-8 mb-3">
<select name="mois" class="form-select" required>
<option value="">-- Choisir un mois --</option>
<?php
$mois = ["Janvier","Février","Mars","Avril","Mai","Juin",
"Juillet","Août","Septembre","Octobre","Novembre","Décembre"];

foreach($mois as $m){
echo "<option>$m</option>";
}
?>
</select>
</div>

<div class="col-md-4 mb-3">
<button class="btn btn-primary w-100" name="rechercher">
Rechercher
</button>
</div>

</div>
</form>

<?php
if(isset($_POST['rechercher'])){

$stmt = $conn->prepare("SELECT * FROM Cotisation
INNER JOIN Membre ON Cotisation.Matricule=Membre.Matricule
WHERE Mois=?");

$stmt->bind_param("s", $_POST['mois']);
$stmt->execute();
$res = $stmt->get_result();

if($res->num_rows > 0){
?>

<hr>

<table class="table table-bordered table-striped mt-3">
<thead class="table-primary">
<tr>
<th>Nom</th>
<th>Mois</th>
<th>Motif</th>
<th>Montant</th>
</tr>
</thead>
<tbody>

<?php while($row = $res->fetch_assoc()){ ?>
<tr>
<td><?= $row['Nom']." ".$row['Prenom'] ?></td>
<td><?= $row['Mois'] ?></td>
<td><?= $row['Motif'] ?></td>
<td><?= $row['Montant'] ?> FCFA</td>
</tr>
<?php } ?>

</tbody>
</table>

<?php
}else{
echo "<div class='alert alert-warning mt-3'>
Aucune cotisation trouvée pour ce mois.
</div>";
}
}
?>

</div>

<?php include("footer.php"); ?>