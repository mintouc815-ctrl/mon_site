<?php
include("config.php");
include("header.php");

if(isset($_POST['payer'])){
$stmt = $conn->prepare("INSERT INTO Cotisation(DateCotis,Mois,Motif,Montant,Matricule) VALUES(?,?,?,?,?)");
$stmt->bind_param("sssdi", $_POST['date'], $_POST['mois'], $_POST['motif'], $_POST['montant'], $_POST['matricule']);
$stmt->execute();
echo "<div class='alert alert-success'>Paiement enregistré</div>";
}
?>

<div class="card shadow p-4">
<h3>Nouvelle Cotisation</h3>

<form method="POST">

<div class="mb-3">
<input type="date" name="date" class="form-control" required>
</div>

<div class="mb-3">
<select name="mois" class="form-select">
<?php
$mois = ["Janvier","Février","Mars","Avril","Mai","Juin",
"Juillet","Août","Septembre","Octobre","Novembre","Décembre"];
foreach($mois as $m){
echo "<option>$m</option>";
}
?>
</select>
</div>

<div class="mb-3">
<select name="motif" class="form-select">
<option>Inscription</option>
<option>Mensualité</option>
</select>
</div>

<div class="mb-3">
<input type="number" name="montant" class="form-control" placeholder="Montant" required>
</div>

<div class="mb-3">
<select name="matricule" class="form-select">
<?php
$res = $conn->query("SELECT * FROM Membre");
while($row = $res->fetch_assoc()){
echo "<option value='".$row['Matricule']."'>".$row['Nom']." ".$row['Prenom']."</option>";
}
?>
</select>
</div>

<button class="btn btn-success w-100" name="payer">Valider</button>
</form>
</div>

<?php include("footer.php"); ?>