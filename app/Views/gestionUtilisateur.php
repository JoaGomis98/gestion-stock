<?= $this->include('template/header'); ?>
<?= $this->include('template/top_bar'); ?>
<?= $this->include('template/left_sidebar'); ?>

<div class="content-page">
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title text-uppercase">Gestion des Utilisateurs</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="<?= base_url() ?>">StockMaster</a></li>
                        <li class="active">Utilisateurs</li>
                    </ol>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Liste du Personnel</h3>
                </div>
                <div class="panel-body">
                    <div class="row m-b-30">
                        <div class="col-sm-6">
                            <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#modal-ajout-user">
                                <i class="fa fa-user-plus m-r-5"></i> Nouvel Utilisateur
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="datatable-editable">
                            <thead>
                                <tr>
                                    
                                    <th>Nom Complet</th>
                                    <th>Email / Login</th>
                                    <th>Rôle</th>
                                    <th>Inscrit le</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($users)): ?>
                                    <?php foreach($users as $user): ?>
                                    <tr class="gradeX" data-id="<?= $user['id'] ?>">
                                        <td><?= $user['id'] ?></td>
                                        <td><?= esc($user['nom']) ?></td>
                                        <td><?= esc($user['email']) ?></td>
                                        <td data-role="<?= $user['role'] ?>">
                                            <?php if($user['role'] == 'admin'): ?>
                                                <span class="label label-inverse">ADMIN</span>
                                            <?php else: ?>
                                                <span class="label label-info">USER</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= date('d/m/Y', strtotime($user['created_at'])) ?></td>
                                        <td class="actions text-center">
                                            <a href="#" class="hidden on-editing save-row text-success"><i class="fa fa-save"></i></a>
                                            <a href="#" class="hidden on-editing cancel-row text-danger"><i class="fa fa-times"></i></a>
                                            
                                            <a href="#" class="on-default edit-row text-primary"><i class="fa fa-pencil"></i></a>
                                            <a href="#" class="on-default remove-row text-danger m-l-5"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div> </div> <footer class="footer text-right">
        2026 © StockMaster - Gestion des Utilisateurs.
    </footer>
</div>

<div id="modal-ajout-user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content p-0 b-0">
            <div class="panel panel-color panel-primary">
                <div class="panel-heading"> 
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                    <h3 class="panel-title">Créer un nouveau compte</h3> 
                </div> 
                <form action="<?= base_url('users/store') ?>" method="post">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="nom">Nom Complet</label>
                            <input type="text" class="form-control" name="nom" placeholder="Ex: Jean Dupont" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email / Login</label>
                            <input type="email" class="form-control" name="email" placeholder="email@exemple.com" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role">Rôle</label>
                                    <select class="form-control" name="role">
                                        <option value="user">Utilisateur (Simple)</option>
                                        <option value="admin">Administrateur</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Mot de passe</label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Enregistrer</button>
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
$(document).ready(function() {
    
    // 1. Initialisation DataTable
    var table = $('#datatable-editable').DataTable({
        "order": [[ 0, "desc" ]],
        "columnDefs": [{ "orderable": false, "targets": 5 }]
    });

    // 2. ACTION : MODIFIER
    $('#datatable-editable').on('click', '.edit-row', function(e) {
        e.preventDefault();
        var $row = $(this).closest('tr');
        $row.find('.on-default').addClass('hidden');
        $row.find('.on-editing').removeClass('hidden');

        $row.children('td').each(function(i) {
            var $td = $(this);
            if (!$td.hasClass('actions')) {
                var val = $td.text().trim();
                if (i === 0 || i === 4) return; // ID et Date non modifiables

                if (i === 3) { // Colonne Rôle
                    var role = $td.attr('data-role');
                    $td.html('<select class="form-control input-sm">' +
                             '<option value="admin" '+(role=='admin'?'selected':'')+'>Admin</option>' +
                             '<option value="user" '+(role=='user'?'selected':'')+'>User</option></select>');
                } else {
                    $td.html('<input type="text" class="form-control input-sm" value="' + val + '">');
                }
            }
        });
    });

    // 3. ACTION : SAUVEGARDER (Simulé ou AJAX)
    $('#datatable-editable').on('click', '.save-row', function(e) {
        e.preventDefault();
        var $row = $(this).closest('tr');
        var data = {
            id: $row.attr('data-id'),
            nom: $row.find('td:eq(1) input').val(),
            email: $row.find('td:eq(2) input').val(),
            role: $row.find('td:eq(3) select').val()
        };

        // Optionnel : Ajouter ici l'appel AJAX vers votre Controller
        
        $row.find('td:eq(1)').text(data.nom);
        $row.find('td:eq(2)').text(data.email);
        var label = (data.role == 'admin') ? 'label-inverse' : 'label-info';
        $row.find('td:eq(3)').attr('data-role', data.role).html('<span class="label '+label+'">'+data.role.toUpperCase()+'</span>');

        $row.find('.on-editing').addClass('hidden');
        $row.find('.on-default').removeClass('hidden');
    });

    // 4. ACTION : SUPPRIMER
    $('#datatable-editable').on('click', '.remove-row', function(e) {
        e.preventDefault();
        var $row = $(this).closest('tr');
        if (confirm("Supprimer cet utilisateur ?")) {
            // Ici appel AJAX pour supprimer en base avec $row.attr('data-id')
            $row.fadeOut(function() { table.row($row).remove().draw(); });
        }
    });

    // 5. ACTION : ANNULER
    $('#datatable-editable').on('click', '.cancel-row', function(e) {
        e.preventDefault();
        location.reload();
    });
});
</script>