<?= $this->include('template/header'); ?>
<?= $this->include('template/top_bar'); ?>
<?= $this->include('template/left_sidebar'); ?>

<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h4 class="page-title text-uppercase" style="color: #2E7D32; font-weight: 800;">
                        <i class="fa fa-gift"></i> Association RSE - Action Sociale Sococim
                    </h4>
                    <p class="text-muted">Enregistrement d'un don de matériel pour les organisations partenaires</p>
                </div>
            </div>

            <div class="row m-t-20">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-color panel-info" style="border-top: 3px solid #317eeb;">
                        <div class="panel-heading">
                            <h3 class="panel-title">Nouveau Don de Matériel</h3>
                        </div>
                        <div class="panel-body">
                            <form action="<?= site_url('StoreDonRse') ?>" method="post">
                                <?= csrf_field() ?>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Matériel à donner</label>
                                            <select class="form-control" name="produit_id" required>
                                                <option value="">-- Sélectionner le matériel --</option>
                                                <?php foreach($produits as $p): ?>
                                                    <option value="<?= $p['id'] ?>">
                                                        <?= $p['nom'] ?> (Dispo: <?= $p['quantite'] ?>)
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>École / Organisation Bénéficiaire</label>
                                            <select class="form-control" name="beneficiaire_id" required>
                                                <option value="">-- Sélectionner le bénéficiaire --</option>
                                                <?php foreach($beneficiaires as $b): ?>
                                                    <option value="<?= $b['id'] ?>"><?= $b['nom_organisation'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Quantité donnée</label>
                                            <input type="number" class="form-control" name="quantite_donnee" min="1" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date de remise</label>
                                            <input type="date" class="form-control" name="date_don" value="<?= date('Y-m-d') ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Note / Commentaire sur l'action</label>
                                    <textarea class="form-control" name="commentaire" rows="3" placeholder="Ex: Don de PC reconditionnés pour la salle informatique de Rufisque Est..."></textarea>
                                </div>

                                <hr>
                                <button type="submit" class="btn btn-info btn-block btn-lg waves-effect waves-light">
                                    <i class="fa fa-check m-r-5"></i> Valider et Sortir du Stock
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('template/footer'); ?>