<body data-racine="<?= RACINE; ?>" data-webroot="<?= WEBROOT; ?>" data-assets="<?= ASSETS; ?>"  class="common-home res layout-1">
<style>
	.contact-bot .form-contact .form-group input, .contact-bot .form-contact .form-group textarea {
		/*//background: #4b4a4a99;*/
		background: #000000;
		border-bottom: 1px #f9f9f9 solid;
		border-radius: 0;
		padding: 0 12px;
		font-size: 14px;
		color: #fff;
	}
	.tia{
		color: #FFFFFF;
		text-shadow: rgba(0, 0, 0, 0.4) 0px 4px 5px;
		text-align: center;
		font-size: 28px;
		text-transform: uppercase;
        font-family: LuloCleanW01-OneBold;
        font-size: 20px;
	}
    p{
        letter-spacing: 0.1em;
        font-family: brandon-grot-w01-light,sans-serif;
    }

    @media only screen and (max-width: 375px) {
        .custom-img-accueil {
            height: 30vh !important;
        }
    }
</style>
	<div id="wrapper" class="wrapper-fluid banners-effect-10">
		<!-- Main Container  -->
		<div id="content" style="margin-bottom: 0;">
			<div class="so-page-builder">
                <?php include("nav.php"); ?>
				<section class="section-style1" <!--style="background-image: url('<?/*= WEBROOT;*/?>theme/image/tissu2.jpg');-->/*! padding: 90px 0px 200px 0px; */">
					<div class="container page-builder-ltr">
						<div class="how-section1" style="background: #ba7a32;padding: 35px;">
							<h3 style="color: #000;font-size: 28px;text-align: center;top: -25px;position: relative;font-family: sarina,cursive;">Bienvenue dans la communauté!</h3>
							<div class="row">
								<div class="col-md-6 how-img">
									<img src="<?= WEBROOT;?>theme/image/mains.png" class="custom-img-accueil rounded-circle img-fluid" alt="" style="height: 39vh;"/>
								</div>
								<div class="col-md-6">
									<h2 class="tia"">ADHÉREZ AU CLUB</h2>
									<h2 class="tia">Faites le plein d'avantages</h2>
									<h4 class="tia">au quotidien !</h4>
									<p class="text-muted" style="color: #fff;text-align: center;margin: 0 0 25px;font-family: BrandonGrotW01-Light,sans-serif;">Bénéficiez immédiatement* et en illimité
										de remises allant de 10 à 30%
										chez tous nos Partenaires !</p>
									<span style="color: #322920;margin: 0 95px;">
                                        <p class="text-center">* Après inscription et achat d'un PASS ou une CARTE</p>
                                    </span>
									<div class="buttons clearfix" style="text-align: center;">
										<a href="https://www.senegalsejour.com/avantages-membres" class="btn btn-primary" style="background-color: rgba(99, 82, 63, 1);cursor: pointer !important;box-shadow: 6.18px 3.29px 13px 2px rgba(0,0,0,0.6);border-radius: 10px 10px 10px 10px;margin-top: 20px; font-family:BrandonGrotW01-Light;font-size: 10px;">En savoir Plus</a>
<!--										<a href="<?/*= WEBROOT */?><?/*= ((isset($this->_USER)) ? "membre/differentesformules" : "home/differentesformules") */?>" class="btn btn-primary" style="background-color: rgba(99, 82, 63, 1);cursor: pointer !important;box-shadow: 6.18px 3.29px 13px 2px rgba(0,0,0,0.6);border-radius: 10px 10px 10px 10px;margin-top: 20px; font-family:BrandonGrotW01-Light;font-size: 10px;">En savoir Plus</a>
-->									</div>
								</div>
							</div>
							<div class="row" style="margin-top: 20px;margin-bottom: 20px;">
								<div class="col-md-6">
									<h4 class="tia">DEVENez PARTENAIRE</h4>
									<h4 class="tia">et BOOSTEZ VOTRE ACTIVITÉ</h4>
									<p class="text-muted" style="color: #fff;text-align: center;margin: 0 0 25px;font-family: BrandonGrotW01-Light,sans-serif;">Découvrez votre programme Partenaires
										et vos nombreux services et avantages </p>
									<div class="buttons clearfix" style="text-align: center;margin-bottom: 20px;">
										<a href="https://www.senegalsejour.com/avantages-partenaires" class="btn btn-primary" style="background-color: rgba(99, 82, 63, 1);cursor: pointer !important;box-shadow: 6.18px 3.29px 13px 2px rgba(0,0,0,0.6);border-radius: 10px 10px 10px 10px;margin-top: 20px; font-family:BrandonGrotW01-Light;font-size: 10px;">En savoir Plus</a>
									</div>
<!--									<span style="color: #322920;margin: 0 95px;">* Contactez nous via <a href="https://nmedias.media/sejour/#contact" style="color: #fff;"> ce formulaire </a>pour y avoir accès</span>-->
								</div>
								<div class="col-md-6 how-img">
									<img src="<?= WEBROOT;?>theme/image/fille.png" class="custom-img-accueil rounded-circle img-fluid" alt="" style="height: 39vh;float: right;"/>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
		<!-- //Main Container -->
		<!-- Footer Container -->
