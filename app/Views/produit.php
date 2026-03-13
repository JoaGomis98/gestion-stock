<?= $this->include('template/header'); ?>
<?= $this->include('template/top_bar'); ?>
<?= $this->include('template/left_sidebar'); ?>

<style>
    .dataTables_wrapper .pagination > li > a, .dataTables_wrapper .pagination > li > span { color: #2E7D32 !important; }
    .dataTables_wrapper .pagination > .active > a, .dataTables_wrapper .pagination > .active > span { background-color: #2E7D32 !important; border-color: #2E7D32 !important; color: white !important; }
    .badge-status { font-size: 11px; padding: 6px 10px; border-radius: 12px; font-weight: 600; text-transform: uppercase; }
    .modal-body label { font-weight: 600; color: #555; }
</style>

<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title text-uppercase" style="color: #2E7D32; font-weight: 700;">Gestion des Produits & Stock</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="<?= base_url() ?>">StockMaster</a></li>
                        <li class="active">Inventaire</li>
                    </ol>
                </div>
            </div>

            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade in" style="background-color: #e8f5e9; color: #2e7d32; border: 1px solid #c8e6c9;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <i class="fa fa-check-circle m-r-5"></i> <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <div class="panel panel-default" style="border-top: 3px solid #2E7D32;">
                <div class="panel-heading">
                    <h3 class="panel-title">Liste du Stock Sococim</h3>
                </div>
                <div class="panel-body">
                    <div class="row m-b-20">
                        <div class="col-md-6">
                            <a href="<?= base_url('produit/create') ?>" class="btn waves-effect waves-light" style="background-color:#2E7D32; color:white;">
                                <i class="fa fa-plus m-r-5"></i> Ajouter un Nouveau Produit
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="datatable-produits">
                            <thead>
                                <tr style="background-color: #f9f9f9;">
                                    <th>Code</th>
                                    <th>Désignation</th>
                                    <th>Catégorie</th>
                                    <th>Fournisseur</th>
                                    <th>Prix (FCFA)</th>
                                    <th class="text-center">Quantité</th>
                                    <th class="text-center">Statut</th>
                                    <th class="text-center" style="width: 100px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($produits)): ?>
                                    <?php foreach ($produits as $p): ?>
                                        <tr>
                                            <td class="text-uppercase" style="color: #2E7D32; font-weight:bold;"><?= $p['code_produit'] ?></td>
                                            <td><?= esc($p['nom']) ?></td>
                                            <td><?= esc($p['cat_nom'] ?? 'N/A') ?></td>
                                            <td><?= esc($p['fourn_nom'] ?? 'N/A') ?></td>
                                            <td><?= number_format($p['prix'], 0, ',', ' ') ?></td>
                                            <td class="text-center"><b><?= $p['quantite'] ?></b></td>
                                            <td class="text-center">
                                                <?php if ($p['quantite'] <= $p['stock_min']): ?>
                                                    <span class="label label-danger badge-status">Alerte</span>
                                                <?php else: ?>
                                                    <span class="label label-success badge-status" style="background-color: #2E7D32 !important;">OK</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-xs btn-rounded edit-btn" 
                                                        style="background-color: #2E7D32; color: white;"
                                                        data-toggle="modal" data-target="#editProduitModal"
                                                        data-id="<?= $p['id'] ?>"
                                                        data-code="<?= $p['code_produit'] ?>"
                                                        data-nom="<?= esc($p['nom']) ?>"
                                                        data-prix="<?= $p['prix'] ?>"
                                                        data-quantite="<?= $p['quantite'] ?>"
                                                        data-min="<?= $p['stock_min'] ?>"
                                                        data-cat="<?= $p['categorie_id'] ?>"
                                                        data-fourn="<?= $p['fournisseur_id'] ?>">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                                <a href="<?= site_url('produit/delete/'.$p['id']) ?>" class="btn btn-danger btn-xs btn-rounded" onclick="return confirm('Supprimer ce produit ?');">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="editProduitModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border-top: 4px solid #2E7D32; border-radius: 6px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" style="color: #2E7D32;">MODIFIER LE PRODUIT</h4>
                </div>
                
                <form action="<?= site_url('produit/update') ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" id="edit_prod_id">
                    
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Code Produit</label>
                                    <input type="text" class="form-control" name="code_produit" id="edit_prod_code" required>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Désignation / Nom</label>
                                    <input type="text" class="form-control" name="nom" id="edit_prod_nom" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Catégorie</label>
                                    <select class="form-control" name="categorie_id" id="edit_prod_cat" required>
                                        <?php foreach($categories as $cat): ?>
                                            <option value="<?= $cat['id'] ?>"><?= $cat['nom'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fournisseur</label>
                                    <select class="form-control" name="fournisseur_id" id="edit_prod_fourn" required>
                                        <?php foreach($fournisseurs as $f): ?>
                                            <option value="<?= $f['id'] ?>"><?= $f['nom'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Prix de vente (FCFA)</label>
                                    <input type="number" class="form-control" name="prix" id="edit_prod_prix" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Stock Actuel</label>
                                    <input type="number" class="form-control" name="quantite" id="edit_prod_quantite" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label style="color:#d9534f;">Stock Min</label>
                                    <input type="number" class="form-control" name="stock_min" id="edit_prod_min" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer" style="background: #f8f9fa;">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn" style="background-color: #2E7D32; color: white;">
                            <i class="fa fa-save m-r-5"></i> Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap.js"></script>

<script>
$(document).ready(function () {
    $('#datatable-produits').DataTable({
        "language": { "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json" }
    });

    $('.edit-btn').on('click', function() {
        // Remplissage des champs
        $('#edit_prod_id').val($(this).data('id'));
        $('#edit_prod_code').val($(this).data('code'));
        $('#edit_prod_nom').val($(this).data('nom'));
        $('#edit_prod_prix').val($(this).data('prix'));
        $('#edit_prod_quantite').val($(this).data('quantite'));
        $('#edit_prod_min').val($(this).data('min'));
        $('#edit_prod_cat').val($(this).data('cat'));
        $('#edit_prod_fourn').val($(this).data('fourn'));
    });
});
</script>

<?= $this->include('template/footer'); ?>