<?= $this->include('template/header'); ?>
<?= $this->include('template/top_bar'); ?>
<?= $this->include('template/left_sidebar'); ?>

<style>
    /* Style Sococim existant */
    .mini-stat {
        border-radius: 8px;
        transition: transform 0.2s;
        border-bottom: 3px solid transparent;
    }
    .mini-stat:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
    }
    .stat-success { border-bottom-color: #2E7D32; }
    .stat-danger { border-bottom-color: #d9534f; }
    .stat-info { border-bottom-color: #317eeb; }
    .stat-primary { border-bottom-color: #605ca8; }
    
    .panel-sococim {
        border-top: 3px solid #2E7D32;
        border-radius: 5px;
    }
</style>

<div class="content-page">
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title text-uppercase" style="color: #2E7D32; font-weight: 700;">
                        <i class="fa fa-dashboard"></i> Tableau de Bord 
                        <small style="color: #666; font-size: 12px; text-transform: none;">
                            (Session : <?= ucfirst(session()->get('role')) ?>)
                        </small>
                    </h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="<?= base_url() ?>">StockMaster</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="mini-stat clearfix bx-shadow bg-white stat-success">
                        <span class="mini-stat-icon bg-success"><i class="fa fa-cubes"></i></span>
                        <div class="mini-stat-info text-right text-dark">
                            <span class="counter text-dark"><?= $totalProduits ?? '2,500' ?></span>
                            Total Produits
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="mini-stat clearfix bx-shadow bg-white stat-danger">
                        <span class="mini-stat-icon bg-danger"><i class="fa fa-warning"></i></span>
                        <div class="mini-stat-info text-right text-dark">
                            <span class="counter text-danger"><?= $alertesStock ?? '15' ?></span>
                            Alertes Stock
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="mini-stat clearfix bx-shadow bg-white stat-info">
                        <span class="mini-stat-icon bg-info"><i class="fa fa-truck"></i></span>
                        <div class="mini-stat-info text-right text-dark">
                            <span class="counter text-info"><?= $entreesJour ?? '48' ?></span>
                            Entrées du jour
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="mini-stat clearfix bx-shadow bg-white stat-primary">
                        <span class="mini-stat-icon bg-primary"><i class="fa fa-users"></i></span>
                        <div class="mini-stat-info text-right text-dark">
                            <span class="counter text-primary"><?= $totalUsers ?? '4' ?></span>
                            Utilisateurs actifs
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default panel-sococim">
                        <div class="panel-heading">
                            <h3 class="panel-title text-uppercase" style="font-size: 14px; font-weight: 600;">
                                <i class="fa fa-history m-r-5"></i> Derniers Mouvements de Stock
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover m-b-0">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Désignation</th>
                                            <th class="text-center">Type</th>
                                            <th class="text-center">Quantité</th>
                                            <th>Responsable</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?= date('d/m/Y') ?></td>
                                            <td><b>Ciment 42.5 (Sac 50kg)</b></td>
                                            <td class="text-center">
                                                <span class="label label-success" style="padding: 5px 10px;">Entrée</span>
                                            </td>
                                            <td class="text-center text-success"><b>+ 200</b></td>
                                            <td>Admin Sococim</td>
                                        </tr>
                                        <tr>
                                            <td><?= date('d/m/Y') ?></td>
                                            <td><b>Pièces de rechange broyeur</b></td>
                                            <td class="text-center">
                                                <span class="label label-danger" style="padding: 5px 10px;">Sortie</span>
                                            </td>
                                            <td class="text-center text-danger"><b>- 5</b></td>
                                            <td>Agent Logistique</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <div class="text-right">
                                <a href="<?= base_url('mouvStock') ?>" class="btn btn-sm btn-link" style="color: #2E7D32;">
                                    Voir tout l'historique <i class="fa fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div> 
    </div> 
</div>

<?= $this->include('template/footer'); ?>