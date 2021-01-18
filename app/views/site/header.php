<header id="header" class=" typeheader-1">
    <!-- Header Top -->
    <div class="header-bonus">
        <div class="container">
            <ul class="bonus-phone pull-left">
                <li><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:0123456789">+(221) 77 728 08 92</a></li>
                <li><i class="fa fa-envelope" aria-hidden="true"></i> <a href="tel:0123456789">contact@senegalsejour.com</a></li>
            </ul>
            <ul class="bonus-social pull-left">
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
            </ul>
            <div class="bonus-login pull-right">
                <a data-toggle="modal" data-target="#so_sociallogin" href="#"><i class="fa fa-user" aria-hidden="true"></i> Se connecter</a>
            </div>
        </div>
        <?php //var_dump($this->_USER);die;?>

    </div>
    <div class="header-top hidden-compact" style="box-shadow: -2.96px 6.34px 15px 4px rgba(0,0,0,0.61);">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-xs-3 header-logo pull-left">
                    <div class="navbar-logo">
                        <a href="<?= WEBROOT ?>home/index"><img src="image/catalog/demo/logo/logo.png" alt="Your Store" width="118" title="Sénégal séjour"></a>
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
                                                <ul class="megamenu" data-transition="slide" data-animationtime="500">
                                                    <li class="menu-home with-sub-menu hover">
                                                        <p class="close-menu"></p>
                                                        <a href="#" class="clearfix">
                                                            <strong>
                                                                Accueil
                                                            </strong>
                                                        </a>
                                                        <div class="sub-menu" style="width: 30%;">
                                                            <div class="content">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <ul class="row-list">
                                                                            <li><a class="subcategory_item" href="apropos.html">A propos</a></li>
                                                                            <li><a class="subcategory_item" href="decouvrir.html">Découvrir la visite virtuelle</a></li>
                                                                            <li><a class="subcategory_item" href="contact.html">Contact</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="style-page with-sub-menu hover">
                                                        <p class="close-menu"></p>
                                                        <a  href="https://www.senegalsejour.com/sejourner-sénégal" class="clearfix">
                                                            <strong>
                                                                Séjourner
                                                            </strong>
                                                            <span class="labelwordpress"></span>
                                                        </a>
                                                        <div class="sub-menu" style="width: 30%;">
                                                            <div class="content">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <ul class="row-list">
                                                                            <li><a class="subcategory_item" href="#">Les hôtels</a></li>
                                                                            <li><a class="subcategory_item" href="#">Maisons d'hôtes</a></li>
                                                                            <li><a class="subcategory_item" href="#">Les meublés</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="style-page with-sub-menu hover">
                                                        <p class="close-menu"></p>
                                                        <a  class="clearfix">
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
                                                                            <li><a class="subcategory_item" href="#">A vendre - A louer</a></li>
                                                                            <li><a class="subcategory_item" href="#">Réparer - rénover</a></li>
                                                                            <li><a class="subcategory_item" href="#">Tout pour la maison</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="style-page with-sub-menu hover">
                                                        <p class="close-menu"></p>
                                                        <a  class="clearfix">
                                                            <strong>
                                                                Se déplacer
                                                            </strong>
                                                        </a>
                                                        <div class="sub-menu" style="width: 30%;">
                                                            <div class="content">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <ul class="row-list">
                                                                            <li><a class="subcategory_item" href="#">Autos - motos</a></li>
                                                                            <li><a class="subcategory_item" href="#">Taxi - chauffeurs - bus</a></li>
                                                                            <li><a class="subcategory_item" href="#">Vols - Agences voyages</a></li>
                                                                            <li><a class="subcategory_item" href="#">Transport maritime</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="style-page with-sub-menu hover">
                                                        <p class="close-menu"></p>
                                                        <a href="#" class="clearfix">
                                                            <strong>
                                                                Se divertir
                                                            </strong>
                                                        </a>
                                                        <div class="sub-menu" style="width: 30%;">
                                                            <div class="content" >
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <ul class="row-list">
                                                                            <li><a class="subcategory_item" href="#">Bars & lounges</a></li>
                                                                            <li><a class="subcategory_item" href="#">Restaurants</a></li>
                                                                            <li><a class="subcategory_item" href="#">Activités</a></li>
                                                                            <li><a class="subcategory_item" href="#">Lieux d'intérêt</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="style-page with-sub-menu hover">
                                                        <p class="close-menu"></p>
                                                        <a  class="clearfix">
                                                            <strong>
                                                                Bien être
                                                            </strong>
                                                        </a>
                                                        <div class="sub-menu" style="width: 30%;">
                                                            <div class="content" >
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <ul class="row-list">
                                                                            <li><a class="subcategory_item" href="#">Instituts</a></li>
                                                                            <li><a class="subcategory_item" href="#">Bien être - spa</a></li>
                                                                            <li><a class="subcategory_item" href="#">Sport</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="style-page with-sub-menu hover">
                                                        <p class="close-menu"></p>
                                                        <a  class="clearfix">
                                                            <strong>
                                                                Education
                                                            </strong>
                                                        </a>
                                                        <div class="sub-menu" style="width: 30%;">
                                                            <div class="content" >
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <ul class="row-list">
                                                                            <li><a class="subcategory_item" href="#">Education supérieur</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="style-page with-sub-menu hover">
                                                        <p class="close-menu"></p>
                                                        <a  class="clearfix">
                                                            <strong>
                                                                Le club
                                                            </strong>
                                                        </a>
                                                        <div class="sub-menu" style="width: 30%;">
                                                            <div class="content" >
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <ul class="row-list">
                                                                            <li><a class="subcategory_item" href="#">Adhérer au club</a></li>
<!--                                                                            <li><a class="subcategory_item" href="<?/*= WEBROOT*/?>home/devenirPartenaire">Devenir partenaire</a></li>
-->                                                                            <li><a class="subcategory_item" href="https://nmedias.media/sejour/#contact"">Devenir partenaire</a></li>
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
