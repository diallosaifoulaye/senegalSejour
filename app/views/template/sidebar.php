<!-- ============================================================== -->
<!-- Wrapper -->
<!-- ============================================================== -->
<!--<meta http-equiv="content-type" content="text/html; charset=utf-8" />
--><!--<meta name="viewport" content="width = 720" />
-->
<!--<meta name="viewport" content="width=device-width, initial-scale=1.0 ">
-->
<!--<style>
    @media only screen and (max-width: 812px) {
        #side-menu {width=8.33%;}
    }
</style>-->
<div id="wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <nav class="navbar navbar-default navbar-static-top m-b-0">
        <div class="navbar-header" style="background: #f6f6f6">

            <div class="top-left-part" style="background: #f6f6f6">
                <!-- Logo -->
                <?php
                if($this->_USER->type_profil == 1){?>
                <a class="logo" href="<?php echo WEBROOT . 'utilisateur/listeAll'; ?>">
                    <!-- Logo text image you can use text also -->
                    <span class="">
                        <!--This is dark logo text-->
                        <img src="<?= WEBROOT;?>theme/image/catalog/demo/logo/logo.png" alt="home" class="dark-logo">
                        <!--This is light logo text-->
                        <img src="<?= WEBROOT;?>theme/image/catalog/demo/logo/logo.png"  width="70" style="margin-left: 65px;" alt="home" class="light-logo">
                     </span>
                </a>
                <?php }
                if($this->_USER->type_profil == 3){?>
                <a class="logo" href="<?php echo WEBROOT . 'membre/differentesFormules'; ?>">
                    <!-- Logo text image you can use text also -->
                    <span class="">
                        <!--This is dark logo text-->
                        <img src="<?php echo ASSETS; ?>plugins/images/admin-text.png" alt="home" class="dark-logo">
                        <!--This is light logo text-->
                        <img src="<?php echo ASSETS; ?>plugins/images/LogoPosteFinances.png" style="margin-left: 30px; width: 162px; height: 62px;" alt="home" class="light-logo">
                     </span>
                </a>
                <?php }?>
            </div>


            <!-- /Logo -->
            <!-- Search input and Toggle icon -->
            <ul class="nav navbar-top-links navbar-left">
                <li><a href="javascript:void(0)" class="open-close waves-effect waves-light">
                        <i class="ti-menu" style="color: #582900"></i>
                    </a>
                </li>
                <?php //require_once (ROOT . 'app/views/notify.php'); ?>

            </ul>

            <ul class="nav navbar-top-links navbar-right pull-right">
                <li class="dropdown">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">
                        <b class=""
                           style="color: #582900"><?php echo $this->_USER->prenom . ' ' . $this->_USER->nom; ?> , </b>
                        <b class="" style="color: #582900"> <?php echo $this->lang['lagence'].' '. $_SESSION['nomAgence']; ?></b>
                        <span class="caret"></span> </a>
                    <ul class="dropdown-menu dropdown-user animated flipInY">
                        <li>
                            <div class="dw-user-box">
                                <div class="u-text">
                                    <h4 style="color: #582900"><?php echo $this->_USER->prenom . ' ' . $this->_USER->nom ?></h4>
                                    <p class="text-muted"><?php echo $this->_USER->email; ?></p>
                                </div>
                            </div>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <a href="<?php echo WEBROOT . "utilisateur/myProfil/" . base64_encode($this->_USER->id) ?>">
                                <i class="ti-user"></i>&nbsp;&nbsp;<?php echo $this->lang['mon_profil']; ?>
                            </a>
                        </li>

                        <li><a href="<?= WEBROOT ?>home/logout"><i
                                        class="fa fa-power-off"></i>&nbsp;&nbsp;<?php echo $this->lang['se_deconnecter']; ?>
                            </a></li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>

                <!-- /.dropdown -->
            </ul>
        </div>
        <!-- /.navbar-header -->
        <!-- /.navbar-top-links -->
        <!-- /.navbar-static-side -->
    </nav>
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <div class="navbar-default sidebar" role="navigation" style="background: #582900">
        <div class="sidebar-nav slimscrollsidebar">
            <div class="sidebar-head">
                <h3>
                <span class="fa-fw open-close"><i class="ti-menu "></i>
                    <i class="ti-close visible-xs"></i>
                </span>
                    <span class="hide-menu">Navigation</span>
                </h3>
            </div>

            <div class="user-profile" style="background: #ffffff">
                <div class="dropdown user-pro-body">
                    <a href="#" class="dropdown-toggle u-dropdown" style="color: #582900" data-toggle="dropdown"
                       role="button" aria-haspopup="true" aria-expanded="false">
                        <?php echo $this->_USER->prenom . ' ' . $this->_USER->nom; ?>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu animated flipInY">
                        <li>
                            <a href="<?= WEBROOT . "utilisateur/myProfil/" . base64_encode($this->_USER->id) ?>">
                                <i class="ti-user"></i>&nbsp;&nbsp;<?php echo $this->lang['mon_profil']; ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo WEBROOT . "home/logout" ?>">
                                <i class="fa fa-power-off"></i>&nbsp;&nbsp;
                                <?php echo $this->lang['se_deconnecter']; ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <ul class="nav" id="side-menu">



                <?php
                if($this->_USER->type_profil == 1){?>
                    <li>
                        <a href="#" class="waves-effect">
                            <i class="mdi mdi-memory fa-fw" data-icon="v"></i>
                            <span class="hide-menu"> <?php echo $this->lang['gestion_membre']; ?> <span
                                        class="fa arrow"></span> </span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo WEBROOT . "membre/liste" ?>">
                                    <i data-icon="/" class="fa fa-user fa-fw"></i>
                                    <span class="hide-menu"><?php echo $this->lang['liste_membre']; ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo WEBROOT . "membre/liste_tmpMembre" ?>">
                                    <i data-icon="/" class="fa fa-user fa-fw"></i>
                                    <span class="hide-menu"><?php echo $this->lang['liste_membre_tmp']; ?></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="waves-effect">
                            <i class="mdi mdi-memory fa-fw" data-icon="v"></i>
                            <span class="hide-menu"> <?php echo $this->lang['gestion_partenaire']; ?> <span
                                        class="fa arrow"></span> </span>
                        </a>
                        <ul class="nav nav-second-level">

                            <li>
                                <a href="<?php echo WEBROOT . "partenaire/liste" ?>">
                                    <i data-icon="/" class="fa fa-user fa-fw"></i>
                                    <span class="hide-menu"><?php echo $this->lang['liste_partenaire']; ?></span>
                                </a>
                            </li>

                            <li>
                                <a href="<?php echo WEBROOT . "entite/liste" ?>">
                                    <i data-icon="/" class="fa fa-street-view fa-fw"></i>
                                    <span class="hide-menu"><?php echo $this->lang['liste_entites']; ?></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="waves-effect">
                            <i class="mdi mdi-memory fa-fw" data-icon="v"></i>
                            <span class="hide-menu"> <?php echo $this->lang['gestion_formule']; ?> <span
                                        class="fa arrow"></span> </span>
                        </a>
                        <ul class="nav nav-second-level">

                            <li>
                                <a href="<?php echo WEBROOT . "formule/liste" ?>">
                                    <i data-icon="/" class="fa fa-user-secret fa-fw"></i>
                                    <span class="hide-menu"><?php echo $this->lang['liste_formules']; ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo WEBROOT . "typeformules/liste" ?>">
                                    <i data-icon="/" class="fa fa-user-secret fa-fw"></i>
                                    <span class="hide-menu"><?php echo $this->lang['types_formule']; ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo WEBROOT . "avantage/liste" ?>">
                                    <i data-icon="/" class="fa fa-street-view fa-fw"></i>
                                    <span class="hide-menu"><?php echo $this->lang['liste_avantages']; ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo WEBROOT . "paiement/liste" ?>">
                                    <i data-icon="/" class="fa fa-street-view fa-fw"></i>
                                    <span class="hide-menu"><?php echo $this->lang['liste_modes_paiement']; ?></span>
                                </a>
                            </li>

                            <li>
                                <a href="<?php echo WEBROOT . "cadeau/liste" ?>">
                                    <i data-icon="/" class="fa fa-street-view fa-fw"></i>
                                    <span class="hide-menu"><?php echo $this->lang['liste_cadeaux']; ?></span>
                                </a>
                            </li>

                            <li>
                                <a href="<?php echo WEBROOT . "promotion/liste" ?>">
                                    <i data-icon="/" class="fa fa-street-view fa-fw"></i>
                                    <span class="hide-menu"><?php echo $this->lang['liste_promotions']; ?></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="waves-effect">
                            <i class="mdi mdi-memory fa-fw" data-icon="v"></i>
                            <span class="hide-menu"> <?php echo $this->lang['parametrages']; ?> <span
                                        class="fa arrow"></span> </span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo WEBROOT . "parametrage/listeDevise" ?>">
                                    <i data-icon="/" class="fa fa-user-secret fa-fw"></i>
                                    <span class="hide-menu"><?php echo $this->lang['liste_devise']; ?></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                   <!-- <li>
                        <a style="cursor:pointer;" class="open-modal waves-effect"
                           data-modal-controller="reporting/choixPartenaire"
                           data-modal-view="<?/*= base64_encode("reporting") */?>/<?/*= base64_encode("choixPartenaire") */?>">
                            <i class="mdi mdi-memory fa-fw" data-icon="v"></i>
                            <span class="hide-menu"> <?php /*echo $this->lang['reporting']; */?> </span>
                        </a>

                    </li>-->
                <?php } ?>



            </ul>

        </div>
    </div>
