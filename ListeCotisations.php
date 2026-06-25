<?php
include("config.php");
include("header.php");

$sql = "SELECT * FROM Cotisation
INNER JOIN Membre ON Cotisation.Matricule=Membre.Matricule";
$res = $conn->query($sql);
?>

<div class="card shadow p-4">
<h3>Liste des Paiements</h3>

<table class="table table-bordered table-striped">
<thead class="table-primary">
<tr>
<th>Nom</th>
<th>Mois</th>
<th>Motif</th>
<th>Montant</th>
<th>Action</th>
</tr>
</thead>

<tbody>
<?php while($row = $res->fetch_assoc()){ ?>
<tr>
<td><?= $row['Nom']." ".$row['Prenom'] ?></td>
<td><?= $row['Mois'] ?></td>
<td><?= $row['Motif'] ?></td>
<td><?= $row['Montant'] ?> FCFA</td>
<td>
<a href="ModifierPaiement.php?id=<?= $row['NumCotis'] ?>" class="btn btn-warning btn-sm">Modifier</a>
<a href="SupprimerCotisation.php?id=<?= $row['NumCotis'] ?>" class="btn btn-danger btn-sm">Supprimer</a>
</td>
</tr>
<?php } ?>
</tbody>

</table>
</div>

<?php include("footer.php"); ?>