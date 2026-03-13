<?= $this->include('template/header'); ?>
<?= $this->include('template/top_bar'); ?>
<?= $this->include('template/left_sidebar'); ?>

<div class="content-page">
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title text-uppercase" style="color: #2E7D32; font-weight: 700;">
                        <i class="fa fa-plus-circle"></i> Ajouter un nouveau produit
                    </h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="<?= base_url() ?>">StockMaster</a></li>
                        <li><a href="<?= base_url('produit') ?>">Produits</a></li>
                        <li class="active">Nouveau</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <form action="<?= site_url('EnregistrerProduit') ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-default" style="border-top: 3px solid #2E7D32;">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Identification de l'article</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label>Code / Référence <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="code_produit" placeholder="Ex: SOC-2026-X" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Désignation <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="nom" placeholder="Ex: Ciment 42.5N - Sac 50kg" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Catégorie <span class="text-danger">*</span></label>
                                            <select class="form-control" name="categorie_id" required>
                                                <option value="">-- Sélectionner la catégorie --</option>
                                                <?php if (!empty($categories)): ?>
                                                    <?php foreach($categories as $cat): ?>
                                                        <option value="<?= $cat['id'] ?>"><?= esc($cat['nom']) ?></option>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <option value="" disabled>Aucune catégorie trouvée</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="panel panel-default" style="border-top: 3px solid #2E7D32;">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Paramètres de Stock</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Quantité Initiale</label>
                                                    <input type="number" class="form-control" name="quantite" value="0" min="0">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label style="color: #d9534f;">Seuil d'Alerte</label>
                                                    <input type="number" class="form-control" name="stock_min" value="10" min="1">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Prix d'Achat Unitaire (FCFA) <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="prix" placeholder="0" required>
                                                <span class="input-group-addon">CFA</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Fournisseur <span class="text-danger">*</span></label>
                                            <select class="form-control" name="fournisseur_id" required>
                                                <option value="">-- Sélectionner le fournisseur --</option>
                                                <?php if (!empty($fournisseurs)): ?>
                                                    <?php foreach($fournisseurs as $f): ?>
                                                        <option value="<?= $f['id'] ?>"><?= esc($f['nom']) ?></option>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <option value="" disabled>Aucun fournisseur trouvé</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row m-t-20">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-lg waves-effect waves-light" style="background-color: #2E7D32; color: white; width: 48%;">
                                    <i class="fa fa-save"></i> Valider l'entrée en stock
                                </button>
                                <a href="<?= base_url('gestionProduit') ?>" class="btn btn-lg btn-default waves-effect" style="width: 48%;">
                                    <i class="fa fa-times"></i> Annuler
                                </a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div> </div> <footer class="footer text-right">
        2026 © StockMaster - Sococim Industrie.
    </footer>
</div>

<?= $this->include('template/footer'); ?>