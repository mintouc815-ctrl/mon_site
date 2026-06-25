<?php
include("config.php");
include("header.php");

if(!isset($_GET['id'])){
    header("Location: ListeCotisations.php");
}

$id = $_GET['id'];

// Récupérer la cotisation
$stmt = $conn->prepare("SELECT * FROM Cotisation WHERE NumCotis=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if(!$data){
    echo "<div class='alert alert-danger'>Paiement introuvable.</div>";
    include("footer.php");
    exit();
}

// Modifier
if(isset($_POST['modifier'])){
    $stmt = $conn->prepare("UPDATE Cotisation 
        SET Mois=?, Motif=?, Montant=? 
        WHERE NumCotis=?");

    $stmt->bind_param("ssdi",
        $_POST['mois'],
        $_POST['motif'],
        $_POST['montant'],
        $id
    );

    $stmt->execute();

    echo "<div class='alert alert-success'>
            Paiement modifié avec succès.
          </div>";

    // Recharger les nouvelles données
    $data['Mois'] = $_POST['mois'];
    $data['Motif'] = $_POST['motif'];
    $data['Montant'] = $_POST['montant'];
}
?>

<div class="row justify-content-center">
<div class="col-md-6">

<div class="card shadow p-4">
<h3 class="text-center mb-4">Modifier la Cotisation</h3>

<form method="POST">

<div class="mb-3">
<label class="form-label">Mois</label>
<select name="mois" class="form-select" required>
<?php
$mois = ["Janvier","Février","Mars","Avril","Mai","Juin",
"Juillet","Août","Septembre","Octobre","Novembre","Décembre"];

foreach($mois as $m){
$selected = ($data['Mois'] == $m) ? "selected" : "";
echo "<option $selected>$m</option>";
}
?>
</select>
</div>

<div class="mb-3">
<label class="form-label">Motif</label>
<select name="motif" class="form-select">
<option <?= ($data['Motif']=="Inscription")?"selected":"" ?>>Inscription</option>
<option <?= ($data['Motif']=="Mensualité")?"selected":"" ?>>Mensualité</option>
</select>
</div>

<div class="mb-3">
<label class="form-label">Montant</label>
<input type="number" name="montant"
       class="form-control"
       value="<?= $data['Montant'] ?>"
       required>
</div>

<div class="d-flex justify-content-between">
<a href="ListeCotisations.php" class="btn btn-secondary">
Retour
</a>

<button class="btn btn-warning" name="modifier">
Modifier
</button>
</div>

</form>
</div>

</div>
</div>

<?php include("footer.php"); ?>