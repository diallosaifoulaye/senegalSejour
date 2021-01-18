<body data-racine="<?= RACINE; ?>" data-webroot="<?= WEBROOT; ?>" data-assets="<?= ASSETS; ?>" class="common-home res layout-1">
<style>
	.contact-bot .form-contact .form-group input, .contact-bot .form-contact .form-group textarea {
		background: #4b4a4a99;
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
        font-family: LuloCleanW01-OneBold,sans-serif;
	}

    p{
        letter-spacing: 0.1em;
        font-family: brandon-grot-w01-light,sans-serif;
        font-weight: 300;
        padding: 12px;
    }
    .card {
        border: none
    }

    .btn-outline-dark {
        border-radius: 35px;
        font-size: 10px;
        box-shadow: none
    }

    .col-md-4 {
        margin-top: 5px
    }
    .maxcard{
        background: #00000085;
        padding: 12px;
        margin: 0 0 60px;
        color: #fff;
        height: 500px;
    }
    .maxcard2{
        background: #00000085;
        padding: 12px;
        margin: 20px;
        color: #fff;
        height: 350px;
    }
    .maxcard1{
        background: #5f8056;
        padding: 12px;
        margin: 0 0 60px;
        color: #fff;
        height: 500px;
    }
    .card-title{
        margin-bottom: 25px;
    }
    hr{
        width: 50%;
    }
    p{
        text-align: left !important;
    }
    .card-img-top{
        margin-top: -70px;
    }

    @media only screen and (max-width: 1024px) {
        .tia {
            font-size: 23px;
        }
    }

    @media only screen and (max-width: 768px) {
        .custom-img {
            padding-right: 200px !important;
        }
        .custom-img-left {
            padding-left: 200px !important;
        }
        .custom-btn {
            padding-left: 280px!important;
        }
    }

    @media only screen and (max-width: 425px) {
        .custom-img {
            padding-right: 50px !important;
        }
        .custom-img-left {
            padding-left: 50px !important;
        }
        .custom-btn {
            padding-left: 135px!important;
        }
    }

    @media only screen and (max-width: 320px) {
        .custom-btn {
            padding-left: 76px!important;
        }
        .tia {
            font-size: 18px;
        }
    }
    @font-face {font-family: "BrandonGrotW01-Light"; src: url("//db.onlinewebfonts.com/t/6dd2f2510b4a00a5461b2455928209c2.eot"); src: url("//db.onlinewebfonts.com/t/6dd2f2510b4a00a5461b2455928209c2.eot?#iefix") format("embedded-opentype"), url("//db.onlinewebfonts.com/t/6dd2f2510b4a00a5461b2455928209c2.woff2") format("woff2"), url("//db.onlinewebfonts.com/t/6dd2f2510b4a00a5461b2455928209c2.woff") format("woff"), url("//db.onlinewebfonts.com/t/6dd2f2510b4a00a5461b2455928209c2.ttf") format("truetype"), url("//db.onlinewebfonts.com/t/6dd2f2510b4a00a5461b2455928209c2.svg#BrandonGrotW01-Light") format("svg"); }
    @font-face {font-family: "LuloCleanW01-OneBold"; src: url("//db.onlinewebfonts.com/t/39a2c7f346d5cfae7045aeb2fb50d9ad.eot"); src: url("//db.onlinewebfonts.com/t/39a2c7f346d5cfae7045aeb2fb50d9ad.eot?#iefix") format("embedded-opentype"), url("//db.onlinewebfonts.com/t/39a2c7f346d5cfae7045aeb2fb50d9ad.woff2") format("woff2"), url("//db.onlinewebfonts.com/t/39a2c7f346d5cfae7045aeb2fb50d9ad.woff") format("woff"), url("//db.onlinewebfonts.com/t/39a2c7f346d5cfae7045aeb2fb50d9ad.ttf") format("truetype"), url("//db.onlinewebfonts.com/t/39a2c7f346d5cfae7045aeb2fb50d9ad.svg#LuloCleanW01-OneBold") format("svg"); }

</style>
	<div id="wrapper" class="wrapper-fluid banners-effect-10" style="background-image: url('<?= WEBROOT;?>theme/image/tissu2.jpg');background-size: contain;">
		<!-- Main Container  -->
		<div id="content" style="margin-bottom: 0;">
			<div class="so-page-builder">
                <?php include("nav.php"); ?>
				<section class="section-style1">
					<div class="container page-builder-ltr">
						<div class="how-section1">
							<div class="row" style="background: #ba7a32;padding-bottom: 20px;">
                                <?php
                                if (isset($this->_USER)){ ?>
                                    <h3 style="color: #000;font-size: 28px;text-align: center;top: -15px;position: relative;font-family: sarina,cursive;">Bienvenue dans la communauté!</h3>
                                <?php }
                                else { ?>
                                    <h3 style="color: #000;font-size: 28px;text-align: center;top: -15px;position: relative;font-family: sarina,cursive;">les avantages Membre du CLUB</h3>
                                <?php }
                                ?>
								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 how-img">
                                    <p class="custom-img" style="text-align: center">
                                        <img src="<?= WEBROOT;?>theme/image/Famille_souriante.png" class="rounded-circle img-fluid" alt="" style="height: 245px;float: right;"/>
                                    </p>
								</div>
								<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
									<h4 class="tia">QUi est concerné ?</h4>
									<p class="text-muted" style="color: #fff;text-align: center !important;margin: 0;font-family: BrandonGrotW01-Light">SenegalSéjour propose ses services à toute personne désirant séjourner ou vivre  au Sénégal sur une longue ou courte période ou simplement découvrir ce fabuleux pays d'Afrique

                                        En famille, entre amis ou en couple ? Résidants ou touristes ?

                                        Nous nous chargeons de vous faire découvrir et vivre <span style="color: #322920;">le pays de la Teranga *</span> dans toute sa splendeur !</p>
                                    <span style="color: #322920;float: right;font-family: BrandonGrotW01-Light;">*pays de l'hospitalité</span>
                                    <div class="buttons clearfix" style="text-align: center;">
                                        <?php
                                        if (isset($this->_USER)){ ?>
                                            <a href="<?= WEBROOT ?>membre/differentesformules" class="btn btn-primary" style="background-color: rgba(99, 82, 63, 1);cursor: pointer !important;box-shadow: 6.18px 3.29px 13px 2px rgba(0,0,0,0.6);border-radius: 10px 10px 10px 10px;margin-top: 20px;font-family: BrandonGrotW01-Light;"><span style="text-transform: capitalize">Acheter</span> pass & carte</a>
                                        <?php }
                                        else { ?>
                                            <a href="<?= WEBROOT ?>home/register" class="btn btn-primary" style="background-color: rgba(99, 82, 63, 1);cursor: pointer !important;box-shadow: 6.18px 3.29px 13px 2px rgba(0,0,0,0.6);border-radius: 10px 10px 10px 10px;margin-top: 20px;font-family: BrandonGrotW01-Light;"><span style="text-transform: capitalize">Acheter</span> pass & carte</a>
                                        <?php }
                                        ?>
<!--                                        <a href="--><?//= WEBROOT ?><!--membre/differentesformules" class="btn btn-primary" style="background-color: rgba(99, 82, 63, 1);cursor: pointer !important;box-shadow: 6.18px 3.29px 13px 2px rgba(0,0,0,0.6);border-radius: 10px 10px 10px 10px;margin-top: 20px;font-family: BrandonGrotW01-Light;"><span style="text-transform: capitalize">Acheter</span> pass & carte</a>-->
                                    </div>

								</div>
							</div>
							<div class="row" style="margin-top: 20px;margin-bottom: 20px;background: #ba7a32;">
								<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
									<h4 class="tia">Pourquoi devenir membre ?</h4>
									<p class="text-muted" style="color: #fff;text-align: center !important;margin: 0;font-family: BrandonGrotW01-Light;">SénégalSéjour  vous fera découvrir le Sénégal à travers les visites virtuelles interactives des sites de nos partenaires, comme si vous y étiez et sans vous déplacer !

                                        Nous sélectionnons avec soin les lieux à visiter pour vos vacances , vos loisirs mais aussi tous les établissements et services indispensables pour séjourner ou vivre au Sénégal, en vous donnant accès à toutes les informations avant votre venue. Plus de surprises !!!!!

                                        Bénéficiez de  l'entraide de l'ensemble de la communauté en partageant vous aussi vos expériences pour vous aider à mieux choisir vos destinations . </p>
								</div>
								<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 how-img">
									<p class="custom-img-left">
                                        <img src="<?= WEBROOT;?>theme/image/Etudiants_Smilling.png" class="rounded-circle img-fluid" alt="" style="height: 245px;"/>
                                    </p>
								</div>
                                <div class="buttons clearfix custom-btn" style="padding-bottom: 30px; padding-left: 180px;">
                                    <?php
                                    if (isset($this->_USER)){ ?>
                                        <a href="<?= WEBROOT ?>membre/differentesformules" class="btn btn-primary" style="background-color: rgba(99, 82, 63, 1);cursor: pointer !important;box-shadow: 6.18px 3.29px 13px 2px rgba(0,0,0,0.6);border-radius: 10px 10px 10px 10px;margin-top: 20px;font-family: BrandonGrotW01-Light;"><span style="text-transform: capitalize">Acheter</span> pass & carte</a>
                                    <?php }
                                    else { ?>
                                        <a href="<?= WEBROOT ?>home/register" class="btn btn-primary" style="background-color: rgba(99, 82, 63, 1);cursor: pointer !important;box-shadow: 6.18px 3.29px 13px 2px rgba(0,0,0,0.6);border-radius: 10px 10px 10px 10px;margin-top: 20px;font-family: BrandonGrotW01-Light;"><span style="text-transform: capitalize">Acheter</span> pass & carte</a>
                                    <?php }
                                    ?>
<!--                                    <a href="--><?//= WEBROOT ?><!--membre/differentesformules" class="btn btn-primary" style="background-color: rgba(99, 82, 63, 1);cursor: pointer !important;box-shadow: 6.18px 3.29px 13px 2px rgba(0,0,0,0.6);border-radius: 10px 10px 10px 10px;margin-top: 20px;font-family: BrandonGrotW01-Light"><span style="text-transform: capitalize">Acheter</span> pass & carte</a>-->
                                </div>
							</div>
						</div>
                        <div class="how-section1" style="background: #ba7a32;">
                            <div class="row" style="background: #ba7a32;">
                                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 how-img">
                                    <p class="custom-img">
                                        <img src="<?= WEBROOT;?>theme/image/Femme_souriante.png" class="rounded-circle img-fluid" alt="" style="height: 245px;float: right;"/>
                                    </p>
                                </div>
                                <div class="col-md-7">
                                    <h4 class="tia">Faites le plein d'avantages</h4>
                                    <p class="text-muted" style="color: #fff;text-align: center;margin: 0;font-family: BrandonGrotW01-Light;">Inscrivez vous grâce au formulaire et choisissez une  de nos formules d’adhésion.

                                        Vous accéderez en illimité durant toute la durée de votre abonnement à tous les avantages négociés chez tous nos partenaires, avec des réductions allant de 5 à 30 % sur l’achat de prestations, produits et services.

                                        Restaurant, hôtel, salle de sport, instituts de beauté, santé, déplacements, musées et activités culturelles ou loisirs .... SénegalSéjour Boost votre pouvoir d’achat au quotidien pour votre plus grand plaisir !  </p>
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 100px;background: #ba7a32;">
                                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                    <h4 class="tia">GAGNEZ PLUS EN DEPENSANT MOINS</h4>
                                    <p class="text-muted" style="color: #fff;text-align: center;margin: 0;font-family: BrandonGrotW01-Light;">Bénéficiez également d’avantages supplémentaires avec notre programme de fidélité :

                                        Plus vous dépensez chez nos partenaires, plus vous cumulez des points qui vous permettront d’accéder avec des prix encore plus réduits ou même gratuitement à  des offres spécialement négociées par le Club auprès de nos partenaires !

                                        exemple : Pour 1000 CFA dépensés, 1 point s’ajoute à votre solde. Cumulez les points et gagnez des récompenses comme une nuit d’hôtel, un diner à deux, une prestation de beauté ou un week-end découverte ….

                                        A partir de 200 points cumulés, profitez de -25% sur le renouvellement de votre PASS ou CARTE

                                        Dès votre inscription, 10 points de bienvenue vous sont offerts.

                                        Recevez également notre newsletter exclusivement réservée à nos abonnés avec des offres promotionnelles inédites de tous nos partenaires. </p>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 how-img">
                                    <p class="custom-img-left">
                                        <img src="<?= WEBROOT;?>theme/image/Famille_heureuse.png" class="rounded-circle img-fluid" alt="" style="height: 245px;"/>
                                    </p>
                                </div>

                                <div class="buttons clearfix custom-btn" style="padding-bottom: 30px; padding-left: 180px;">
                                    <?php
                                    if (isset($this->_USER)){ ?>
                                        <a href="<?= WEBROOT ?>membre/differentesformules" class="btn btn-primary" style="background-color: rgba(99, 82, 63, 1);cursor: pointer !important;box-shadow: 6.18px 3.29px 13px 2px rgba(0,0,0,0.6);border-radius: 10px 10px 10px 10px;margin-top: 20px;font-family: BrandonGrotW01-Light;"><span style="text-transform: capitalize">Acheter</span> pass & carte</a>
                                    <?php }
                                    else { ?>
                                        <a href="<?= WEBROOT ?>home/register" class="btn btn-primary" style="background-color: rgba(99, 82, 63, 1);cursor: pointer !important;box-shadow: 6.18px 3.29px 13px 2px rgba(0,0,0,0.6);border-radius: 10px 10px 10px 10px;margin-top: 20px;font-family: BrandonGrotW01-Light;"><span style="text-transform: capitalize">Acheter</span> pass & carte</a>
                                    <?php }
                                    ?>
<!--                                    <a href="--><?//= WEBROOT ?><!--membre/differentesformules" class="btn btn-primary" style="background-color: rgba(99, 82, 63, 1);cursor: pointer !important;box-shadow: 6.18px 3.29px 13px 2px rgba(0,0,0,0.6);border-radius: 10px 10px 10px 10px;margin-top: 20px;font-family: BrandonGrotW01-Light;"><span style="text-transform: capitalize">Acheter</span> pass & carte</a>-->
                                </div>
                            </div>

                        </div>
                        <div class="how-section1" style="background: #ba7a32;margin-bottom: 100px;margin-top: -66px;">
                            <div class="row d-flex justify-content-center" style="background: #ba7a32;">
                                <h4 class="tia" style="margin-bottom:55px; ">Comment DEVENIR MEMBRE ?</h4>
                                <div class="col-md-4">
                                    <div class="card p-2  maxcard">
                                        <div class="text-center mt-2 p-3">
                                            <img class="card-img-top" src="<?= WEBROOT;?>MAIL/image/card_4.svg" alt="">
                                            <h4 class="card-title">Inscrivez vous sur le site</h4>
                                            <span style="font-family: BrandonGrotW01-Light;">Remplissez le Formulaire d'inscription</span>
                                            <hr>
                                            <span style="font-family: BrandonGrotW01-Light;">Vous recevez un Email de confirmation d'inscription et votre  espace de membre sera créé avec vos informations, login et mot de passe.</span>
                                            <hr>
                                            <span style="font-family: BrandonGrotW01-Light;">Vous pourrez modifier toutes vos informations et retrouver toute l’historique de votre activité au sein du CLUB</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card p-2  maxcard">
                                        <div class="text-center mt-2 p-3">
                                            <img class="card-img-top" src="<?= WEBROOT;?>MAIL/image/card_5.svg" alt="">
                                            <h4 class="card-title">Achetez un Pass ou une Carte</h4>
                                            <span style="font-family: BrandonGrotW01-Light;">Choisissez la formule la plus adaptée à vos besoins</span>
                                            <hr>
                                            <span style="font-family: BrandonGrotW01-Light;">le PASS de 2 mois pour des courts séjours ou tester nos avantages</span>
                                            <hr>
                                            <span style="font-family: BrandonGrotW01-Light;">la Carte de 1 an : pour bénéficier tout au long de l'année en illimité de nos avantages et cumuler des points</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card p-2  maxcard">
                                        <div class="text-center mt-2 p-3">
                                            <img class="card-img-top" src="<?= WEBROOT;?>MAIL/image/card_6.svg" alt="">
                                            <h4 class="card-title">Faites vous plaisir!</h4>
                                            <span style="font-family: BrandonGrotW01-Light;">Vous recevrez un email de confirmation de votre transaction et de validité de votre abonnement .</span>
                                            <hr>
                                            <span style="font-family: BrandonGrotW01-Light;">Conservez bien dans votre smartphone ou imprimez  votre carte digitale nominative  que vous devrez impérativement présenter à nos partenaires pour pouvoir bénéficier de vos avantages</span>
                                            <hr>
                                            <span style="font-family: BrandonGrotW01-Light;">Parcourez les différentes rubriques pour découvrir vos remises chez nos partenaires.</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="buttons clearfix" style="text-align: center; padding-bottom: 20px;">
                                    <?php
                                    if (isset($this->_USER)){ ?>
                                        <a href="<?= WEBROOT ?>membre/differentesformules" class="btn btn-primary" style="background-color: rgba(99, 82, 63, 1);cursor: pointer !important;box-shadow: 6.18px 3.29px 13px 2px rgba(0,0,0,0.6);border-radius: 10px 10px 10px 10px;margin-top: 20px;font-family: BrandonGrotW01-Light;"><span style="text-transform: capitalize">Acheter</span> pass & carte</a>
                                    <?php }
                                    else { ?>
                                        <a href="<?= WEBROOT ?>home/register" class="btn btn-primary" style="background-color: rgba(99, 82, 63, 1);cursor: pointer !important;box-shadow: 6.18px 3.29px 13px 2px rgba(0,0,0,0.6);border-radius: 10px 10px 10px 10px;margin-top: 20px;font-family: BrandonGrotW01-Light;"><span style="text-transform: capitalize">Acheter</span> pass & carte</a>
                                    <?php }
                                    ?>
<!--                                    <a href="--><?//= WEBROOT ?><!--membre/differentesformules" class="btn btn-primary" style="background-color: rgba(99, 82, 63, 1);cursor: pointer !important;box-shadow: 6.18px 3.29px 13px 2px rgba(0,0,0,0.6);border-radius: 10px 10px 10px 10px;margin-top: 20px;font-family: BrandonGrotW01-Light;"><span style="text-transform: capitalize">Acheter</span> pass & carte</a>-->
                                </div>
                            </div>
                        </div>
                        <div class="how-section1" style="background: #ba7a32;margin-bottom: 20px;margin-top: -66px;">
                            <div class="row d-flex justify-content-center" style="background: #ba7a32;">
                                <h4 class="tia" style="margin-bottom: 55px;">Bénéficiez de vos remises</h4>
                                <div class="col-md-4">
                                    <div class="card p-2  maxcard1">
                                        <div class="text-center mt-2 p-3">
                                            <img class="card-img-top" src="<?= WEBROOT;?>MAIL/image/card_1.svg"  alt="">
                                            <h4 class="card-title">RDV chez un Partenaire</h4>
                                            <span style="font-family: BrandonGrotW01-Light;">Identifiez nos partenaires facilement sur le site ou à l'aide du logo Sénégalséjour présent sur les lieux​</span>
                                            <hr>
                                            <span style="font-family: BrandonGrotW01-Light;">Présentez votre carte nominative sur votre smartphone au moment de régler</span>
                                            <hr>
                                            <span style="font-family: BrandonGrotW01-Light;">Présentez votre mail d'inscription si vous  n'avez pas de smartphone</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card p-2  maxcard1">
                                        <div class="text-center mt-2 p-3">
                                            <img class="card-img-top" src="<?= WEBROOT;?>MAIL/image/card_2.svg"  alt="">
                                            <h4 class="card-title">Validation</h4>
                                            <span style="font-family: BrandonGrotW01-Light;">Le partenaire dans son espace dédié sur notre site va vérifier la validité de votre carte ou PASS</span>
                                            <hr>
                                            <span style="font-family: BrandonGrotW01-Light;">Une fois la vérification effectuée, il lui suffit de saisir avec vous le montant de la facture que vous deviez régler</span>
                                            <hr>
                                            <span style="font-family: BrandonGrotW01-Light;">Vous aurez instantanément l’affichage de la somme que vous devrez payer après déduction automatique de l’avantage enregistré dans notre base partenaire</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card p-2  maxcard1">
                                        <div class="text-center mt-2 p-3">
                                            <img class="card-img-top" src="<?= WEBROOT;?>MAIL/image/card_3.svg"  alt="">
                                            <h4 class="card-title">Enregistrement</h4>
                                            <span style="font-family: BrandonGrotW01-Light;">En validant la transaction, nous l’enregistrons automatiquement sur votre profil de membre et aussi celui du Partenaire.</span>
                                            <hr>
                                            <span style="font-family: BrandonGrotW01-Light;">Vous avez ainsi une totale visibilité sur les économies réalisées grâce à l’achat de votre carte</span>
                                            <hr>
                                            <span style="font-family: BrandonGrotW01-Light;">Vos points de fidélité sont automatiquement enregistrés en fonction du montant dépensé que vous pourrez retrouver dans votre profil de membre</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="buttons clearfix" style="text-align: center; padding-bottom: 20px;">
                                    <?php
                                    if (isset($this->_USER)){ ?>
                                        <a href="<?= WEBROOT ?>membre/differentesformules" class="btn btn-primary" style="background-color: rgba(99, 82, 63, 1);cursor: pointer !important;box-shadow: 6.18px 3.29px 13px 2px rgba(0,0,0,0.6);border-radius: 10px 10px 10px 10px;margin-top: 20px;font-family: BrandonGrotW01-Light;"><span style="text-transform: capitalize">Acheter</span> pass & carte</a>
                                    <?php }
                                    else { ?>
                                        <a href="<?= WEBROOT ?>home/register" class="btn btn-primary" style="background-color: rgba(99, 82, 63, 1);cursor: pointer !important;box-shadow: 6.18px 3.29px 13px 2px rgba(0,0,0,0.6);border-radius: 10px 10px 10px 10px;margin-top: 20px;font-family: BrandonGrotW01-Light;"><span style="text-transform: capitalize">Acheter</span> pass & carte</a>
                                    <?php }
                                    ?>
<!--                                    <a href="--><?//= WEBROOT ?><!--membre/differentesformules" class="btn btn-primary" style="background-color: rgba(99, 82, 63, 1);cursor: pointer !important;box-shadow: 6.18px 3.29px 13px 2px rgba(0,0,0,0.6);border-radius: 10px 10px 10px 10px;margin-top: 20px;font-family: BrandonGrotW01-Light;"><span style="text-transform: capitalize">Acheter</span> pass & carte</a>-->
                                </div>
                            </div>
                        </div>
                        <div class="how-section1" style="background: #ba7a32;margin-bottom: 20px;">
                            <div class="row" style="background: #ba7a32;">
                                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 how-img">
                                    <p class="custom-img">
                                        <img src="<?= WEBROOT;?>theme/image/Discuter_equipe.png" class="rounded-circle img-fluid" alt="" style="height: 245px;float: right;"/>
                                    </p>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                    <h4 class="tia">Partagez vos expériences !</h4>
                                    <p class="text-muted" style="color: #fff;text-align: center;margin: 0;font-family: BrandonGrotW01-Light;">Félicitations ! En tant que membre et abonné, nous sommes heureux de vous compter au sein de notre communauté de résidents et voyageurs.

                                        Partagez votre expérience avec tous nos membres ! Parce que le réel ne remplacera jamais le virtuel, toute la communauté SénegalSéjour compte sur vous pour parfaire leur connaissance de tous nos partenaires actuels et futurs.

                                        Aidez les autres membres (et aussi nos Partenaires) à faire leur choix en partageant le commentaire de votre propre expérience à chacune de vos visites de l’une des nombreuses adresses disponibles sur notre site !</p>
                                    <div class="buttons clearfix" style="text-align: center; padding-bottom: 20px;">
                                        <?php
                                        if (isset($this->_USER)){ ?>
                                            <a href="<?= WEBROOT ?>membre/differentesformules" class="btn btn-primary" style="background-color: rgba(99, 82, 63, 1);cursor: pointer !important;box-shadow: 6.18px 3.29px 13px 2px rgba(0,0,0,0.6);border-radius: 10px 10px 10px 10px;margin-top: 20px;font-family: BrandonGrotW01-Light;"><span style="text-transform: capitalize">Acheter</span> pass & carte</a>
                                        <?php }
                                        else { ?>
                                            <a href="<?= WEBROOT ?>home/register" class="btn btn-primary" style="background-color: rgba(99, 82, 63, 1);cursor: pointer !important;box-shadow: 6.18px 3.29px 13px 2px rgba(0,0,0,0.6);border-radius: 10px 10px 10px 10px;margin-top: 20px;font-family: BrandonGrotW01-Light;"><span style="text-transform: capitalize">Acheter</span> pass & carte</a>
                                        <?php }
                                        ?>
<!--                                        <a href="--><?//= WEBROOT ?><!--membre/differentesformules" class="btn btn-primary" style="background-color: rgba(99, 82, 63, 1);cursor: pointer !important;box-shadow: 6.18px 3.29px 13px 2px rgba(0,0,0,0.6);border-radius: 10px 10px 10px 10px;margin-top: 20px;font-family: BrandonGrotW01-Light;"><span style="text-transform: capitalize">Acheter</span> pass & carte</a>-->
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="how-section1" style="background: #ba7a32;margin-bottom: 100px;">
                            <div class="row" style="background: #ba7a32;">
                                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                    <h4 class="tia">offre de parrainage</h4>
                                    <p class="text-muted" style="color: #fff;text-align: center;margin: 0;font-family: BrandonGrotW01-Light;">Vous aimez Sénégalséjour ? dites-le à votre entourage
                                        <br>
                                        Avec notre programme de parrainage, faites profiter vos amis et proches de nos offres exceptionnelles ! Dès votre inscription sur notre site et votre adhésion au CLUB confirmée, Vous avez la possibilité d’inviter d’autres personnes à rejoindre le club en cliquant sur le bouton INVITER, ces dernières recevront le lien du site qui leur permettra de s’inscrire à leur tour et d’adhérer à l’une de nos formules</p>
                                    <div class="buttons clearfix" style="text-align: center; padding-bottom: 20px;">
                                        <?php
                                        if (isset($this->_USER)){ ?>
                                            <a href="<?= WEBROOT ?>membre/differentesformules" class="btn btn-primary" style="background-color: rgba(99, 82, 63, 1);cursor: pointer !important;box-shadow: 6.18px 3.29px 13px 2px rgba(0,0,0,0.6);border-radius: 10px 10px 10px 10px;margin-top: 20px;font-family: BrandonGrotW01-Light;"><span style="text-transform: capitalize">Acheter</span> pass & carte</a>
                                        <?php }
                                        else { ?>
                                            <a href="<?= WEBROOT ?>home/register" class="btn btn-primary" style="background-color: rgba(99, 82, 63, 1);cursor: pointer !important;box-shadow: 6.18px 3.29px 13px 2px rgba(0,0,0,0.6);border-radius: 10px 10px 10px 10px;margin-top: 20px;font-family: BrandonGrotW01-Light;"><span style="text-transform: capitalize">Acheter</span> pass & carte</a>
                                        <?php }
                                        ?>
<!--                                        <a href="--><?//= WEBROOT ?><!--membre/differentesformules" class="btn btn-primary" style="background-color: rgba(99, 82, 63, 1);cursor: pointer !important;box-shadow: 6.18px 3.29px 13px 2px rgba(0,0,0,0.6);border-radius: 10px 10px 10px 10px;margin-top: 20px;font-family: BrandonGrotW01-Light;"><span style="text-transform: capitalize">Acheter</span> pass & carte</a>-->
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 how-img">
                                    <p class="custom-img-left">
                                        <img src="<?= WEBROOT;?>theme/image/Collage_groupe.png" class="rounded-circle img-fluid" alt="" style="height: 245px;"/>
                                    </p>
                                </div>
                            </div>
                            <div class="row" style="background: #ba7a32;">
                                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 how-img">
                                    <p class="custom-img">
                                        <img src="<?= WEBROOT;?>theme/image/Groupe_amis.png" class="rounded-circle img-fluid" alt="" style="height: 245px;float: right;margin-top: 62px;"/>
                                    </p>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                    <h4 class="tia">pour Quels avantages ?</h4>
                                    <div class="row d-flex justify-content-center" style="background: #ba7a32;">
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                            <div class="card p-2  maxcard2">
                                                <div class="text-center mt-2 p-3">
                                                    <h4 class="card-title">Pour le Parrain</h4>
                                                    <span style="font-family: BrandonGrotW01-Light;">5 points de fidélité à chaque inscription suite à une invitation envoyée</span>
                                                    <hr>
                                                    <span style="font-family: BrandonGrotW01-Light;">Dès que de votre filleul achète une de nos formules, vous recevez une réduction sur votre prochain abonnement de :</span>
                                                    <ul>
                                                        <li style="font-family: BrandonGrotW01-Light;"> - 10 % après 10 adhésions de filleuls</li>
                                                        <li style="font-family: BrandonGrotW01-Light;"> - 30 % après 30 adhésions de filleuls</li>
                                                        <li style="font-family: BrandonGrotW01-Light;"> - 50 % après 50 adhésions de filleuls</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                            <div class="card p-2  maxcard2">
                                                <div class="text-center mt-2 p-3">
                                                    <h4 class="card-title">Pour le Filleul</h4>
                                                    <span style="font-family: BrandonGrotW01-Light;">10 % de réduction sur son premier abonnement</span>
                                                    <hr>
                                                    <span style="font-family: BrandonGrotW01-Light;">il bénéficiera des mêmes avantages en parrainant d’autres membres</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
				</section>
			</div>
		</div>