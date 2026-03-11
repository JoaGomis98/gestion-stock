<?= $this->include('template/header'); ?>
<?= $this->include('template/top_bar'); ?>
<?= $this->include('template/left_sidebar'); ?>

<div class="content-page">
    <div class="content">
        <div class="container">

            <!-- titre et breadcrumb -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title text-uppercase">Gestion des Utilisateurs</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="<?= base_url() ?>">StockMaster</a></li>
                        <li class="active">Utilisateurs</li>
                    </ol>
                </div>
            </div>

            <!-- messages flash -->
            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <!-- panel tableau utilisateurs -->
            <div class="panel panel-default" style="border-top: 3px solid #2E7D32;">
                <div class="panel-heading">
                    <h3 class="panel-title">Liste du Personnel</h3>
                </div>
                <div class="panel-body">

                    <!-- bouton ajouter -->
                    <div class="row m-b-20">
                        <div class="col-md-6">
                            <a href="<?= base_url('createUser') ?>" 
                               class="btn waves-effect waves-light" 
                               style="background-color:#2E7D32; color:white;">
                                <i class="fa fa-user-plus m-r-5"></i> Nouvel Utilisateur
                            </a>
                        </div>
                    </div>

                    <!-- tableau utilisateurs -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="datatable-editable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom Complet</th>
                                    <th>Email / Login</th>
                                    <th>Rôle</th>
                                    <th>Inscrit le</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($users)): ?>
                                    <?php foreach ($users as $user): ?>
                                        <tr class="gradeX" data-id="<?= $user['id'] ?>">
                                            <td><?= $user['id'] ?></td>
                                            <td><?= esc($user['nom']) ?></td>
                                            <td><?= esc($user['email']) ?></td>
                                            <td data-role="<?= $user['role'] ?>">
                                                <?php if ($user['role'] == 'admin'): ?>
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
                                                <a href="<?= site_url('DeleteUser/'.$user['id']) ?>" class="on-default remove-row text-danger m-l-5"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">Aucun utilisateur trouvé</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="panel-footer text-right" style="background:#fafafa;">
                    <a href="<?= base_url() ?>" class="btn btn-default waves-effect m-r-10">
                        <i class="fa fa-arrow-left"></i> Accueil
                    </a>
                </div>
            </div>

        </div>
    </div>

    <footer class="footer text-right">
        2026 © StockMaster - Gestion des Utilisateurs.
    </footer>
</div>

<script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap.js"></script>

<script>
$(document).ready(function () {
    var table = $('#datatable-editable').DataTable({
        "order": [[0, "desc"]],
        "columnDefs": [{ "orderable": false, "targets": 5 }]
    });

    $('#datatable-editable').on('click', '.edit-row', function(e){
        e.preventDefault();
        var $row = $(this).closest('tr');
        $row.find('.on-default').addClass('hidden');
        $row.find('.on-editing').removeClass('hidden');
        $row.children('td').each(function(i){
            var $td = $(this);
            if (!$td.hasClass('actions')) {
                var val = $td.text().trim();
                if(i===0||i===4) return;
                if(i===3){
                    var role = $td.attr('data-role');
                    $td.html('<select class="form-control input-sm">' +
                        '<option value="admin" '+(role=='admin'?'selected':'')+'>Admin</option>' +
                        '<option value="user" '+(role=='user'?'selected':'')+'>User</option></select>');
                }else{
                    $td.html('<input type="text" class="form-control input-sm" value="'+val+'">');
                }
            }
        });
    });

    $('#datatable-editable').on('click', '.save-row', function(e){
        e.preventDefault();
        var $row = $(this).closest('tr');
        var data = {
            id: $row.attr('data-id'),
            nom: $row.find('td:eq(1) input').val(),
            email: $row.find('td:eq(2) input').val(),
            role: $row.find('td:eq(3) select').val()
        };
        $row.find('td:eq(1)').text(data.nom);
        $row.find('td:eq(2)').text(data.email);
        var label = (data.role=='admin')?'label-inverse':'label-info';
        $row.find('td:eq(3)').attr('data-role', data.role).html('<span class="label '+label+'">'+data.role.toUpperCase()+'</span>');
        $row.find('.on-editing').addClass('hidden');
        $row.find('.on-default').removeClass('hidden');
    });

    $('#datatable-editable').on('click', '.cancel-row', function(e){
        e.preventDefault();
        location.reload();
    });
});
</script>