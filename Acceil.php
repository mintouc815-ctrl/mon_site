<?php
include("config.php");
include("header.php");

// Statistiques
$totalMembres = $conn->query("SELECT COUNT(*) as total FROM Membre")->fetch_assoc()['total'];
$totalCotisations = $conn->query("SELECT COUNT(*) as total FROM Cotisation")->fetch_assoc()['total'];
$totalMontant = $conn->query("SELECT SUM(Montant) as total FROM Cotisation")->fetch_assoc()['total'];
?>

<!-- Section Bienvenue -->
<div class="card shadow-lg p-5 text-center mb-4 bg-white">
    <h1 class="text-primary fw-bold">Bienvenue dans EspaceMembre</h1>
    <p class="lead text-muted">
        Application professionnelle de gestion des membres et cotisations
    </p>
</div>

<!-- Cartes Statistiques -->
<div class="row text-center mb-4">

    <div class="col-md-4 mb-3">
        <div class="card shadow border-0 bg-primary text-white">
            <div class="card-body">
                <h5>Total Membres</h5>
                <h2><?= $totalMembres ?></h2>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card shadow border-0 bg-success text-white">
            <div class="card-body">
                <h5>Total Cotisations</h5>
                <h2><?= $totalCotisations ?></h2>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card shadow border-0 bg-warning text-dark">
            <div class="card-body">
                <h5>Montant Total</h5>
                <h2><?= $totalMontant ? $totalMontant : 0 ?> FCFA</h2>
            </div>
        </div>
    </div>

</div>

<!-- Actions rapides -->
<div class="card shadow p-4">
    <h4 class="mb-3 text-center">Actions rapides</h4>
    
    <div class="d-flex justify-content-center gap-3 flex-wrap">
        <a href="SaisieMembre.php" class="btn btn-outline-primary btn-lg">
            Ajouter un membre
        </a>

        <a href="SaisieCotisation.php" class="btn btn-outline-success btn-lg">
            Nouvelle cotisation
        </a>

        <a href="ListeCotisations.php" class="btn btn-outline-dark btn-lg">
            Voir les paiements
        </a>
    </div>
</div>

