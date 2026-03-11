<?= $this->include('template/header'); ?>
<?= $this->include('template/top_bar'); ?>
<?= $this->include('template/left_sidebar'); ?>

<div class="content-page">
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title text-uppercase">Nouveau Compte Utilisateur</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="<?= base_url() ?>">StockMaster</a></li>
                        <li><a href="<?= site_url('gestionUtilisateur') ?>">Utilisateurs</a></li>
                        <li class="active">Création</li>
                    </ol>
                </div>
            </div>

            <!-- message succès -->
            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <!-- message erreur -->
            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default" style="border-top: 3px solid #2E7D32;">
                        
                        <div class="panel-heading">
                            <h3 class="panel-title">Informations du Personnel</h3>
                        </div>

                        <form action="<?= site_url('AjoutUser') ?>" method="post">

                        <?= csrf_field() ?>

                            <div class="panel-body">

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="control-label">Nom Complet</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-user"></i>
                                                </span>
                                                <input type="text"
                                                       class="form-control"
                                                       name="nom"
                                                       placeholder="Ex: Jean Dupont"
                                                       required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Email / Identifiant de connexion</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-envelope"></i>
                                                </span>
                                                <input type="email"
                                                       class="form-control"
                                                       name="email"
                                                       placeholder="email@exemple.com"
                                                       required>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="control-label">Niveau d'accès (Rôle)</label>
                                            <select class="form-control select2" name="role">
                                                <option value="user">Utilisateur Standard</option>
                                                <option value="admin">Administrateur</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Mot de passe temporaire</label>

                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-lock"></i>
                                                </span>

                                                <input type="password"
                                                       class="form-control"
                                                       name="password"
                                                       placeholder="••••••••"
                                                       required>
                                            </div>

                                            <small class="text-muted">
                                                L'utilisateur pourra modifier son mot de passe après connexion.
                                            </small>
                                        </div>

                                    </div>

                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="alert alert-info"
                                            style="background-color:#f0f7f0;border-color:#2E7D32;color:#2E7D32;">

                                            <i class="fa fa-info-circle"></i>

                                            Assurez-vous que l'adresse email est valide pour que l'utilisateur
                                            puisse recevoir ses notifications.

                                        </div>

                                    </div>
                                </div>

                            </div>


                            <div class="panel-footer text-right" style="background:#fafafa;">

                                <a href="<?= site_url('gestionUtilisateur') ?>"
                                   class="btn btn-default waves-effect m-r-10">

                                    <i class="fa fa-arrow-left"></i> Retour

                                </a>

                                <button type="submit"
                                        class="btn btn-primary waves-effect waves-light">

                                    <i class="fa fa-save"></i> Créer le compte utilisateur

                                </button>

                            </div>

                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <footer class="footer text-right">
        2026 © StockMaster - Sococim Industrie.
    </footer>

</div>

<?= $this->include('template/footer'); ?>