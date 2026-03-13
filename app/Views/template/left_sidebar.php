<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <div class="user-details">
            <div class="pull-left">
                <img src="<?= base_url() ?>assets/images/users/avatar-1.jpg" alt="" class="thumb-md img-circle">
            </div>
            <div class="user-info">
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <?= ucfirst(session()->get('nom')) ?> <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:void(0)"><i class="md md-face-unlock"></i> Profil</a></li>
                        <li><a href="javascript:void(0)"><i class="md md-settings"></i> Paramètres</a></li>
                        <li><a href="<?= base_url('logout') ?>"><i class="md md-lock"></i> Déconnexion</a></li>
                    </ul>
                </div>
                <p class="text-muted m-0"><i class="fa fa-circle text-success"></i> <?= ucfirst(session()->get('role')) ?></p>
            </div>
        </div>

        <div id="sidebar-menu">
            <ul>
                <li>
                    <a href="<?= base_url('index') ?>"
                       class="waves-effect <?= (current_url() == base_url('index')) ? 'active' : '' ?>">
                        <i class="md md-dashboard"></i><span> Accueil </span>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('produit') ?>" 
                       class="waves-effect <?= (current_url() == base_url('produit')) ? 'active' : '' ?>">
                        <i class="fa fa-cubes"></i> <span> Produits </span>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('categories') ?>"
                        class="waves-effect <?= (current_url() == base_url('categories')) ? 'active' : '' ?>">
                        <i class="fa fa-tags"></i><span> Catégories </span>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('fournisseurs') ?>"
                        class="waves-effect <?= (current_url() == base_url('fournisseurs')) ? 'active' : '' ?>">
                        <i class="fa fa-truck"></i><span> Fournisseurs </span>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('mouvStock') ?>"
                        class="waves-effect <?= (current_url() == base_url('mouvStock')) ? 'active' : '' ?>">
                        <i class="fa fa-exchange"></i><span> Mouvements Stock </span>
                    </a>
                </li>

                <?php if (session()->get('role') === 'admin'): ?>
                    
                    <li class="divider"></li>
                    <li class="text-muted menu-title">Administration</li>

                    <li class="has_sub">
                        <a href="securite" class="waves-effect <?= (current_url() == base_url('utilisateur') || current_url() == base_url('profil')) ? 'active' : '' ?>">
                            <i class="md md-security"></i><span> Sécurité </span>
                            <span class="pull-right"><i class="md md-add"></i></span>
                        </a>
                        <ul class="list-unstyled">
                            <li><a href="<?= base_url('utilisateur') ?>">Gestion Utilisateurs</a></li>
                            <li><a href="<?= base_url('profil') ?>">Gestion Profils</a></li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="#" class="waves-effect"><i class="md md-settings"></i><span> Configuration </span>
                            <span class="pull-right"><i class="md md-add"></i></span>
                        </a>
                        <ul class="list-unstyled">
                            <li><a href="<?= base_url('methode') ?>">Méthodes</a></li>
                            <li><a href="<?= base_url('format_donnee') ?>">Format de données</a></li>
                        </ul>
                    </li>

                <?php endif; ?>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>