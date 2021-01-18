<?php
// Program to display current page URL.

$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?
        "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .
    $_SERVER['REQUEST_URI'];
//echo $link;
?>

<style>
    .dropbtn {
        background-color: #4CAF50;
        color: white;
        padding: 16px;
        font-size: 16px;
        border: none;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: black;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: #9090;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {background-color: #ddd;}

    .dropdown:hover .dropdown-content {display: block;}

    .dropdown:hover .dropbtn {background-color: #3e8e41;}
    .typeheader-1 .megamenu-style-dev .horizontal ul.megamenu > li > a {
        color: #191919;
        font-size: 12px;
        height: auto;
        padding: 28px 8px !important;
        text-transform: uppercase;
        text-shadow: none;
        font-weight: 900;
        font-family: BrandonGrotW01-Light !important;
    }

    .row-list {
        font-family: BrandonGrotW01-Light !important;
    }

    @media only screen and (max-width: 425px) {
        #show-megamenu{
            margin-top: -93px;
        }
        .navbar-logo{
            margin-left: -203px;
        }
    }
</style>

<header id="header" class=" typeheader-1">
    <!-- Header Top -->
    <div class="header-bonus"  style="background-color: #d1bb84;">
        <div class="container" style="margin-top: 5px; height: 37px;">
            <ul class="bonus-phone pull-left">
                <li><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:0123456789">+(221) 77 728 08 92</a></li>
                <li><i class="fa fa-envelope" aria-hidden="true"></i> <a href="tel:0123456789">contact@senegalsejour.com</a></li>
            </ul>
            <!--            <ul class="bonus-social pull-left">-->
            <!--                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>-->
            <!--                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>-->
            <!--            </ul>-->
            <?php //var_dump($this->_USER); die;?>
            <div class="bonus-login pull-right">
                <?php if ($this->_USER) {?>
                    <div class="dropdown">
                        <span class="" style="color: #c6a47e;"><?= 'Hello'.' '.$this->_USER->nom?></span>
                        <b class="caret"></b>
                        <div class="dropdown-content" style="z-index: 3">
                            <a class="fa fa-user" href="<?= WEBROOT; ?>utilisateur/profil">&nbsp;&nbsp;&nbsp;<?= $this->lang['profils']?></a>
                        </div>
                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                          <!--                    <i class="fa fa-user" aria-hidden="true"></i> </i>
                          -->
                    <a href="#" class="twPc-avatarLink">
                        <img alt="" src="https://ui-avatars.com/api/?name=<?= $this->_USER->prenom ;?>+<?= $this->_USER->nom ;?>" class="twPc-avatarImg" style="border-radius: 50px; width: 30px;">
                    </a>

                    <a  href="<?= WEBROOT; ?>home/logoutEspace"> Se deconnecter</a>
                <?php }
                else {?>
                    <a  href="<?= WEBROOT?>home/loginpage"><i class="bi bi-circle" aria-hidden="true"></i> Se connecter</a>
                    <!--                <a data-toggle="modal" data-target="#so_sociallogin" href="#"><i class="fa fa-user" aria-hidden="true"></i> Se connecter</a>
-->                <?php }?>
            </div>
        </div>
    </div>
    <div class="header-top hidden-compact" style="box-shadow: 0px 6.34px 20px -5px rgba(0,0,0,0.61);position: relative;z-index: 2;">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-xs-3 header-logo pull-left">
                    <div class="navbar-logo">
                        <a href="https://www.senegalsejour.com"><img src="<?= WEBROOT;?>theme/image/catalog/demo/logo/logo.png" alt="Your Store" width="118" title="Sénégal séjour"></a>
                    </div>
                </div>
                <!-- Menuhome -->
                <div class="header-menu pull-right">
                    <div class="megamenu-style-dev megamenu-dev">
                        <div class="responsive">
                            <nav class="navbar-default">
                                <div class="container-megamenu horizontal">
                                    <div class="navbar-header">
                                        <button type="button" id="show-megamenu" data-toggle="collapse" class="navbar-toggle">
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                        </button>
                                    </div>
                                    <div class="megamenu-wrapper">
                                        <span id="remove-megamenu" class="fa fa-times"></span>
                                        <div class="megamenu-pattern">
                                            <div class="container">
                                                <ul class="megamenu" data-transition="slide" data-animationtime="500" style="font-family: montserratlight !important;">
                                                    <li class="with-sub-menu hover">
                                                        <p class="close-menu"></p>
                                                        <a href="https://www.senegalsejour.com/" class="clearfix">
                                                            <strong>
                                                                Accueil
                                                            </strong>
                                                        </a>
                                                        <div class="sub-menu" style="width: 30%;">
                                                            <div class="content">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <ul class="row-list">
                                                                            <li><a class="subcategory_item" href="https://www.senegalsejour.com/a-propos">A propos</a></li>
                                                                            <li><a class="subcategory_item" href="https://www.senegalsejour.com/nous-contacter">Nous contacter</a></li>
                                                                            <li><a class="subcategory_item" href="https://www.senegalsejour.com/decouvrir-la-visite-virtuelle">Découvrir la visite virtuelle</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="style-page menu-home  with-sub-menu hover">
                                                        <p class="close-menu"></p>
                                                        <a  class="clearfix" href="#">
                                                            <strong>
                                                                Le club
                                                            </strong>
                                                        </a>
                                                        <div class="sub-menu" style="width: 30%;">
                                                            <div class="content" >
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <ul class="row-list">
                                                                            <?php
                                                                            if (intval($this->_USER->type_profil) == 3){?>
                                                                                <li class="subcategory_item"><a  href="<?= WEBROOT?>home/leClub"><?php echo strtoupper($this->lang['accueil']); ?></a></li>
                                                                                <li class="subcategory_item" ><a  href="https://www.senegalsejour.com/avantages-membres"><?php echo $this->lang['avantage_membre']; ?></a></li>
                                                                                <li  class="subcategory_item" ><a  href="<?= WEBROOT ?>membre/differentesformules"><?php echo strtoupper($this->lang['achat_pass']); ?></a></li>
                                                                                <li  class="subcategory_item" ><a  href="<?= WEBROOT ?>membre/listePassageMembre"><?php echo $this->lang['mes_passages']; ?></a></li>
                                                                                <li class="subcategory_item" ><a  href="<?= WEBROOT ?>membre/listeTransactionMembre"><?php echo $this->lang['ma_carte']; ?></a></li>
                                                                                <li class="subcategory_item" ><a  href="<?= WEBROOT ?>membre/listeCadeaux"><?php echo $this->lang['avantage_fidelite']; ?></a></li>
                                                                                <li class="subcategory_item"><a  href="https://www.senegalsejour.com/avantages-partenaires"><?php echo $this->lang['avantage_partenaire']; ?></a></li>
                                                                            <?php } elseif (intval($this->_USER->type_profil) == 2){?>
                                                                                <li class="subcategory_item"><a  href="<?= WEBROOT?>home/leClub"><?php echo $this->lang['accueil']; ?></a></li>
                                                                                <li class="subcategory_item" ><a  href="<?= WEBROOT ?>partenaire/scanPage"><?php echo $this->lang['scan_qrCode']; ?></a></li>
                                                                                <li class="subcategory_item"><a  href="<?php echo WEBROOT . "partenaire/listePassage" ?>"><?php echo $this->lang['historique_passage']; ?> </a></li>
                                                                            <?php } else {?>
                                                                                <li class="subcategory_item"><a  href="<?= WEBROOT?>home/leClub"><?php echo strtoupper($this->lang['accueil']); ?></a></li>
                                                                                <li class="subcategory_item" ><a  href="https://www.senegalsejour.com/avantages-membres"><?php echo $this->lang['avantage_membre']; ?></a></li>
                                                                                <li class="subcategory_item" ><a  href="<?= WEBROOT ?>home/differentesformules"><?php echo strtoupper($this->lang['achat_pass']); ?></a></li>
                                                                                <li class="subcategory_item" ><a  href="https://www.senegalsejour.com/avantages-partenaires"><?php echo $this->lang['avantage_partenaire']; ?></a></li>
<!--                                                                                <li class="subcategory_item"><a  href="#">--><?php //echo $this->lang['service_club']; ?><!--</a></li>-->
                                                                            <?php }
                                                                            ?>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="style-page with-sub-menu hover">
                                                        <p class="close-menu"></p>
                                                        <a href="https://www.senegalsejour.com/sejourner-s%C3%A9n%C3%A9gal" class="clearfix">
                                                            <strong>
                                                                Sejourner
                                                            </strong>
                                                            <span class="labelwordpress"></span>
                                                        </a>
                                                        <div class="sub-menu" style="width: 30%;">
                                                            <div class="content">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <ul class="row-list">
                                                                            <li><a class="subcategory_item" href="https://www.senegalsejour.com/sejourner-les-hotels">Les hôtels</a></li>
                                                                            <li><a class="subcategory_item" href="https://www.senegalsejour.com/sejourner-maisons-d-hotes">Maisons d'hôtes</a></li>
                                                                            <li><a class="subcategory_item" href="https://www.senegalsejour.com/immobilier-location-par-jour">Les meublés</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="style-page with-sub-menu hover">
                                                        <p class="close-menu"></p>
                                                        <a href="https://www.senegalsejour.com/sedivertir" class="clearfix">
                                                            <strong>
                                                                Se divertir
                                                            </strong>
                                                        </a>
                                                        <div class="sub-menu" style="width: 30%;">
                                                            <div class="content" >
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <ul class="row-list">
                                                                            <li><a class="subcategory_item" href="https://www.senegalsejour.com/sedivertir-bar-lounges" style="text-transform: uppercase">Bars & lounges</a></li>
                                                                            <li><a class="subcategory_item" href="https://www.senegalsejour.com/sedivertir-restaurants" style="text-transform: uppercase">Restaurants</a></li>
                                                                            <li><a class="subcategory_item" href="https://www.senegalsejour.com/sedivertir-loisirs-lieux-d-interet" style="text-transform: uppercase">Lieux d'intérêt</a></li>
                                                                            <li><a class="subcategory_item" href="https://www.senegalsejour.com/sedivertir-activités" style="text-transform: uppercase">Activités</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="style-page with-sub-menu hover">
                                                        <p class="close-menu"></p>
                                                        <a href="https://www.senegalsejour.com/bien-etre" class="clearfix">
                                                            <strong>
                                                                Bien être
                                                            </strong>
                                                        </a>
                                                        <div class="sub-menu" style="width: 30%;">
                                                            <div class="content" >
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <ul class="row-list">
                                                                            <li><a class="subcategory_item" href="https://www.senegalsejour.com/bien-etre-instituts" style="text-transform: uppercase">Instituts</a></li>
                                                                            <li><a class="subcategory_item" href="https://www.senegalsejour.com/bien-etre-spa" style="text-transform: uppercase">Bien être - spas</a></li>
                                                                            <li><a class="subcategory_item" href="https://www.senegalsejour.com/bien-etre-sport" style="text-transform: uppercase">Sport</a></li>
                                                                            <li><a class="subcategory_item" href="https://www.senegalsejour.com/bien-etre-santé" style="text-transform: uppercase">Santé</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="style-page with-sub-menu hover">
                                                        <p class="close-menu"></p>
                                                        <a href="https://www.senegalsejour.com/sedeplacer" class="clearfix">
                                                            <strong>
                                                                Se deplacer
                                                            </strong>
                                                        </a>
                                                        <div class="sub-menu" style="width: 30%;">
                                                            <div class="content">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <ul class="row-list">
                                                                            <li><a class="subcategory_item" href="https://www.senegalsejour.com/automobile-concessions" style="text-transform: uppercase">Autos - motos</a></li>
                                                                            <li><a class="subcategory_item" href="https://www.senegalsejour.com/taxis-bus-chauffeurs" style="text-transform: uppercase">Taxis - chauffeurs - bus</a></li>
                                                                            <li><a class="subcategory_item" href="https://www.senegalsejour.com/agences-voyages-compagnies-navette" style="text-transform: uppercase">Vols - agences voyage</a></li>
                                                                            <li><a class="subcategory_item" href="https://www.senegalsejour.com/transport-maritime" style="text-transform: uppercase">Transports maritime</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="style-page with-sub-menu hover">
                                                        <p class="close-menu"></p>
                                                        <a href="https://www.senegalsejour.com/s-installer"  class="clearfix">
                                                            <strong>
                                                                S'installer
                                                            </strong>
                                                            <span class="labelNew"></span>
                                                        </a>
                                                        <div class="sub-menu" style="width: 30%;">
                                                            <div class="content">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <ul class="row-list">
                                                                            <li><a class="subcategory_item" href="https://www.senegalsejour.com/immobilier-vente-location">A Vendre - A Louer</a></li>
                                                                            <li><a class="subcategory_item" href="https://www.senegalsejour.com/immobilier-reparer-renover">Réparer - Rénover</a></li>
                                                                            <li><a class="subcategory_item" href="https://www.senegalsejour.com/immobilier-decoration">Tout pour la maison</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="style-page with-sub-menu hover">
                                                        <p class="close-menu"></p>
                                                        <a href="https://www.senegalsejour.com/education" class="clearfix">
                                                            <strong>
                                                                éducation
                                                            </strong>
                                                        </a>
                                                        <div class="sub-menu" style="width: 30%;">
                                                            <div class="content" >
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <ul class="row-list">
<!--                                                                            <li><a class="subcategory_item" href="https://www.senegalsejour.com/education-petite-enfance">Petite enfamce</a></li>-->
<!--                                                                            <li><a class="subcategory_item" href="https://www.senegalsejour.com/education-primaire">Primaire</a></li>-->
<!--                                                                            <li><a class="subcategory_item" href="https://www.senegalsejour.com/education-secondaire">Secondaire</a></li>-->
                                                                            <li><a class="subcategory_item" href="https://www.senegalsejour.com/education-superieur" style="text-transform: uppercase">éducation - Supérieur</a></li>
<!--                                                                            <li><a class="subcategory_item" href="https://www.senegalsejour.com/education-formations">Formation Pro</a></li>-->
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="style-page with-sub-menu hover">
                                                        <p class="close-menu"></p>
                                                        <a href="https://www.senegalsejour.com/education" class="clearfix">
                                                            <strong>
                                                                NOS SERVICES
                                                            </strong>
                                                        </a>
                                                        <div class="sub-menu" style="width: 30%;">
                                                            <div class="content" >
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <ul class="row-list">
                                                                            <li><a class="subcategory_item" href="https://www.senegalsejour.com/scan-3d">SCAN 3D</a></li>
                                                                            <li><a class="subcategory_item" href="https://www.senegalsejour.com/visites-virtuelles">VISITES VIRTUELLES</a></li>
                                                                            <li><a class="subcategory_item" href="https://www.senegalsejour.com/marketing-360">MARKETING 360</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //Header Top -->
</header>