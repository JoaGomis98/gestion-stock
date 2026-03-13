<?= $this->include('template/header'); ?>
<?= $this->include('template/top_bar'); ?>
<?= $this->include('template/left_sidebar'); ?>
<style>
    /* Couleur du texte des boutons de pagination */
    .dataTables_wrapper .pagination > li > a,
    .dataTables_wrapper .pagination > li > span {
        color: #2E7D32 !important;
    }

    /* Couleur du bouton actif (le numéro de page sélectionné) */
    .dataTables_wrapper .pagination > .active > a,
    .dataTables_wrapper .pagination > .active > span,
    .dataTables_wrapper .pagination > .active > a:hover,
    .dataTables_wrapper .pagination > .active > span:hover,
    .dataTables_wrapper .pagination > .active > a:focus,
    .dataTables_wrapper .pagination > .active > span:focus {
        background-color: #2E7D32 !important;
        border-color: #2E7D32 !important;
        color: white !important;
    }

    /* Effet au survol des boutons non-actifs */
    .dataTables_wrapper .pagination > li > a:hover {
        background-color: #e8f5e9 !important; /* Vert très clair au survol */
        border-color: #2E7D32 !important;
        color: #1b5e20 !important;
    }
</style>

<div class="content-page">
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title text-uppercase" style="color: #2E7D32; font-weight: 700;">Gestion des Utilisateurs</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="<?= base_url() ?>">StockMaster</a></li>
                        <li class="active">Utilisateurs</li>
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
                    <h3 class="panel-title">Liste du Personnel Sococim</h3>
                </div>
                <div class="panel-body">

                    <div class="row m-b-20">
                        <div class="col-md-6">
                            <a href="<?= base_url('user/create') ?>" 
                               class="btn waves-effect waves-light" 
                               style="background-color:#2E7D32; color:white; border-radius: 4px;">
                                <i class="fa fa-user-plus m-r-5"></i> Nouvel Utilisateur
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="datatable-users">
                            <thead>
                                <tr>
                                    <th>Nom Complet</th>
                                    <th>Email / Login</th>
                                    <th>Rôle</th>
                                    <th>Inscrit le</th>
                                    <th class="text-center" style="width: 100px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($users)): ?>
                                    <?php foreach ($users as $user): ?>
                                        <tr>
                                            <td class="font-600"><?= esc($user['nom']) ?></td>
                                            <td><?= esc($user['email']) ?></td>
                                            <td>
                                                <?php if ($user['role'] == 'admin'): ?>
                                                    <span class="label label-inverse">ADMIN</span>
                                                <?php else: ?>
                                                    <span class="label" style="background-color: #2E7D32;">USER</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= date('d/m/Y', strtotime($user['created_at'])) ?></td>
                                            <td class="text-center" style="white-space: nowrap;">
                                                
                                                <button class="btn btn-xs btn-rounded waves-effect waves-light edit-btn" 
                                                        style="background-color: #2E7D32; color: white;"
                                                        data-toggle="modal" 
                                                        data-target="#updateUserModal"
                                                        data-id="<?= $user['id'] ?>"
                                                        data-nom="<?= esc($user['nom']) ?>"
                                                        data-email="<?= esc($user['email']) ?>"
                                                        data-role="<?= $user['role'] ?>"
                                                        title="Modifier">
                                                    <i class="fa fa-pencil"></i>
                                                </button>

                                                <a href="<?= site_url('DeleteUser/'.$user['id']) ?>" 
                                                   class="btn btn-danger btn-xs btn-rounded waves-effect waves-light m-l-5" 
                                                   onclick="return confirm('Attention ! Supprimer cet utilisateur ?');"
                                                   title="Supprimer">
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

    <div id="updateUserModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border-top: 4px solid #2E7D32; border-radius: 6px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" style="color: #2E7D32;">MODIFIER LE COMPTE</h4>
                </div>
                
                <form action="<?= site_url('user/update') ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" id="edit_id">

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nom Complet</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user" style="color: #2E7D32;"></i></span>
                                <input type="text" class="form-control" name="nom" id="edit_nom" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email / Identifiant</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope" style="color: #2E7D32;"></i></span>
                                <input type="email" class="form-control" name="email" id="edit_email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Rôle</label>
                            <select class="form-control" name="role" id="edit_role">
                                <option value="user">Utilisateur Standard (USER)</option>
                                <option value="admin">Administrateur (ADMIN)</option>
                            </select>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label>Réinitialiser le mot de passe <small class="text-muted">(Laissez vide si inchangé)</small></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock" style="color: #2E7D32;"></i></span>
                                <input type="password" class="form-control" name="password" placeholder="••••••••">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="background: #f8f9fa;">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn waves-effect waves-light" style="background-color: #2E7D32; color: white;">
                            <i class="fa fa-save m-r-5"></i> Enregistrer les modifications
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
    $('#datatable-users').DataTable();

    $('.edit-btn').on('click', function() {
        var id = $(this).data('id');
        var nom = $(this).data('nom');
        var email = $(this).data('email');
        var role = $(this).data('role');

        $('#edit_id').val(id);
        $('#edit_nom').val(nom);
        $('#edit_email').val(email);
        $('#edit_role').val(role);
    });
});

</script>

<?= $this->include('template/footer'); ?>