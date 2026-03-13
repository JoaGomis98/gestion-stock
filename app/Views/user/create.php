<?= $this->include('template/header'); ?>
<?= $this->include('template/top_bar'); ?>
<?= $this->include('template/left_sidebar'); ?>

<style>
    .panel-user {
        border-top: 3px solid #2E7D32;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .form-control:focus {
        border-color: #2E7D32;
        box-shadow: none;
    }
    .input-group-addon {
        background-color: #f8f9fa;
    }
    /* Responsive adjustment for buttons on mobile */
    @media (max-width: 480px) {
        .panel-footer .btn {
            width: 100%;
            margin-bottom: 10px;
        }
    }
</style>

<div class="content-page">
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title text-uppercase" style="color: #2E7D32;">
                        <i class="fa fa-user-plus m-r-5"></i> Nouveau Compte Utilisateur
                    </h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="<?= base_url() ?>">StockMaster</a></li>
                        <li><a href="<?= site_url('gestionUtilisateur') ?>">Personnel</a></li>
                        <li class="active">Création</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <?php if(session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <i class="fa fa-check m-r-5"></i> <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>

                    <?php if(session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <i class="fa fa-ban m-r-5"></i> <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default panel-user">
                        
                        <div class="panel-heading">
                            <h3 class="panel-title">Informations de profil</h3>
                        </div>

                        <form action="<?= site_url('AjoutUser') ?>" method="post">
                            <?= csrf_field() ?>

                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label">Nom Complet <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <input type="text" class="form-control" name="nom" placeholder="Prénom et Nom" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Email Professionnel <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                <input type="email" class="form-control" name="email" placeholder="nom.prenom@sococim.sn" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label">Niveau d'accès (Rôle)</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-shield"></i></span>
                                                <select class="form-control select2" name="role">
                                                    <option value="user">Utilisateur Standard (Lecture/Mouvement)</option>
                                                    <option value="admin">Administrateur (Gestion complète)</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Mot de passe temporaire <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                <input type="password" class="form-control" name="password" placeholder="Mot de passe" required>
                                            </div>
                                            <small class="text-muted">Minimum 6 caractères recommandé.</small>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-info" style="background-color:#e8f5e9; border-left: 5px solid #2E7D32; color:#2E7D32;">
                                            <i class="fa fa-lightbulb-o m-r-10"></i>
                                            <b>Note :</b> Un email de confirmation sera envoyé à l'adresse indiquée dès la création du compte.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-footer">
                                <div class="row">
                                    <div class="col-sm-6 text-left">
                                        <a href="<?= site_url('gestionUtilisateur') ?>" class="btn btn-default waves-effect">
                                            <i class="fa fa-arrow-left m-r-5"></i> Annuler
                                        </a>
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <button type="submit" class="btn btn-success waves-effect waves-light">
                                            <i class="fa fa-check m-r-5"></i> Enregistrer l'utilisateur
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div> </div> <footer class="footer text-right">
        2026 © StockMaster - Sococim Industrie.
    </footer>
</div>

<?= $this->include('template/footer'); ?>