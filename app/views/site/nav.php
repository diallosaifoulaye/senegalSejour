<?php
// Program to display current page URL.

$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?
        "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .
    $_SERVER['REQUEST_URI'];

$_pattern = "/\/senegalsejour\/[a-zA-Z0-9\/_]*/i";
preg_match($_pattern,$link, $matches);
$link = $matches[0];
?>

<style>
    .sub-nav-custom {
        color: #b47137 !important;
        text-decoration: underline !important;
    }
    @media only screen and (max-width: 1199px) and (min-width: 769px){
        #mini-nav {
            margin: 0 6vw !important;
        }
    }
    #mini-nav > li > a{
        font-family: BrandonGrotW01-Light;
    }
</style>

<section class="section-style1" style="background: #fff;z-index: 0;position: relative;">
    <div class="container page-builder-ltr">
        <div class="row row-style row_a1">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_a1c about-text">
                <h3 style="color: #000; font-family: LuloCleanW01-OneBold !important;">LE CLUB <span style="color: #C6A47E;">SENEGALSEJOUR</span></h3>
            </div>
        </div>

        <?php
            if(intval($this->_USER->type_profil) == 2){ ?>
                <ul id="mini-nav" class="nav navbar-nav hidden-xs hidden-sm" style="margin: 0 14vw;">
                    <li><a class="<?php echo ($link == WEBROOT."home/leClub") ? "sub-nav-custom text-uppercase": "text-uppercase" ;?>"  href="<?= WEBROOT ?>home/leClub"><?php echo $this->lang['accueil']; ?></a></li>
                    <li class="sep"> | </li>
                    <li><a class="<?php echo ($link == WEBROOT."partenaire/scanPage") ? "sub-nav-custom text-uppercase": "text-uppercase" ;?>"  href="<?php echo WEBROOT . "partenaire/scanPage" ?>"><?php echo $this->lang['scan_qrCode']; ?> </a></li>
                    <li class="sep"> | </li>
                    <li><a class="<?php echo ($link == WEBROOT."partenaire/listePassage") ? "sub-nav-custom text-uppercase": "text-uppercase" ;?>"  href="<?php echo WEBROOT . "partenaire/listePassage" ?>"><?php echo $this->lang['historique_passage']; ?> </a></li>
                </ul>
            <?php }
            elseif(intval($this->_USER->type_profil) == 3){ ?>
                <ul id="mini-nav" class="nav navbar-nav hidden-xs hidden-sm" style="margin: 0 -1vw;">
                    <li><a class="<?php echo ($link == WEBROOT."home/leClub") ? "sub-nav-custom text-uppercase": "text-uppercase" ;?>"  href="<?= WEBROOT ?>home/leClub"><?php echo $this->lang['accueil']; ?></a></li>
                    <li class="sep"> | </li>
                    <li><a class="<?php echo ($link == WEBROOT."home/rejoindreClub") ? "sub-nav-custom text-uppercase": "text-uppercase" ;?>"  href="<?= WEBROOT ?>home/rejoindreClub"><?php echo $this->lang['avantage_membre']; ?></a></li>
                    <li class="sep"> | </li>
                    <li><a class="<?php echo ($link == WEBROOT."membre/differentesformules") ? "sub-nav-custom text-uppercase": "text-uppercase" ;?>"  href="<?= WEBROOT ?>membre/differentesformules"><?php echo $this->lang['achat_pass']; ?></a></li>

                    <li class="sep"> | </li>
                    <li><a class="<?php echo ($link == WEBROOT."membre/listePassageMembre") ? "sub-nav-custom text-uppercase": "text-uppercase" ;?>"  href="<?= WEBROOT ?>membre/listePassageMembre"><?php echo $this->lang['mes_passages']; ?></a></li>
                    <li class="sep"> | </li>
                    <li><a class="<?php echo ($link == WEBROOT."membre/listeTransactionMembre") ? "sub-nav-custom text-uppercase": "text-uppercase" ;?>"  href="<?= WEBROOT ?>membre/listeTransactionMembre"><?php echo $this->lang['ma_carte']; ?></a></li>
<!--                    <li class="sep"> | </li>-->
<!--                    <li class="text-uppercase"><a href="#">--><?php //echo $this->lang['ma_carte']; ?><!--</a></li>-->
                    <li class="sep"> | </li>
                    <li><a class="<?php echo ($link == WEBROOT."membre/listeCadeaux") ? "sub-nav-custom text-uppercase": "text-uppercase" ;?>"  href="<?= WEBROOT ?>membre/listeCadeaux"><?php echo $this->lang['avantage_fidelite']; ?></a></li>
                    <li class="sep"> | </li>
                    <li><a class="<?php echo ($link == WEBROOT."home/rejoindrePartenaire") ? "sub-nav-custom text-uppercase": "text-uppercase" ;?>"  href="<?= WEBROOT ?>home/rejoindrePartenaire"><?php echo $this->lang['avantage_partenaire']; ?></a></li>
                </ul>
            <?php }
                else{
                ?>
                <ul id="mini-nav" class="nav navbar-nav hidden-xs hidden-sm" style="margin: 0 7vw; ">
                    <li><a class="<?php echo ($link == WEBROOT."home/leClub") ? "sub-nav-custom text-uppercase": "text-uppercase" ;?>" href="<?= WEBROOT ?>home/leClub"><?php echo $this->lang['accueil']; ?></a></li>
                    <li class="sep"> | </li>
                    <li><a class="<?php echo ($link == WEBROOT."home/rejoindreClub") ? "sub-nav-custom text-uppercase": "text-uppercase" ;?>" href="<?= WEBROOT ?>home/rejoindreClub"><?php echo $this->lang['avantage_membre']; ?></a></li>
                    <li class="sep"> | </li>
                    <li><a class="<?php echo ($link == WEBROOT."home/differentesformules") ? "sub-nav-custom text-uppercase": "text-uppercase" ;?>" href="<?= WEBROOT ?>home/differentesformules"><?php echo $this->lang['achat_pass']; ?></a></li>
                    <li class="sep"> | </li>
                    <li><a class="<?php echo ($link == WEBROOT."home/rejoindrePartenaire") ? "sub-nav-custom text-uppercase": "text-uppercase" ;?>" href="<?= WEBROOT ?>home/rejoindrePartenaire"><?php echo $this->lang['avantage_partenaire']; ?></a></li>
                    <li class="sep"> | </li>
                    <li><a class="text-uppercase" href="#"><?php echo $this->lang['service_club']; ?></a></li>
                </ul>
           <?php }
        ?>
    </div>
</section>