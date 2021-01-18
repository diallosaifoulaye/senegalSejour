<body data-racine="<?= RACINE; ?>" data-webroot="<?= WEBROOT; ?>" data-assets="<?= ASSETS; ?>" class="common-home res layout-1">

<div id="wrapper" class="wrapper-fluid banners-effect-10">
		<!-- Main Container  -->
		<div id="content" style="margin-bottom: 0;">
			<div class="so-page-builder">
                <?php include("nav.php"); ?>
                <section class="section-style1" style="background-image: url('<?= WEBROOT ?>MAIL/image/tissu2.jpg');/*! padding: 80px 0px 100px 0px; */">
                    <div class="container page-builder-ltr">
                        <div class="how-section1" style="background: #ba7a32;padding: 35px;">
                            <h3 style="color: #000;font-size: 28px;text-align: center;top: -25px;position: relative;font-family: sarina,cursive;">les avantages Membre du CLUB</h3>
                            <div class="row">
                                <div class="col-md-6 how-img">
                                    <img src="<?= WEBROOT ?>MAIL/image/fam.jpg" class="rounded-circle img-fluid" alt="" style="height: 200px;"/>
                                </div>
                                <div class="col-md-6 text-muted"  style="font-size: 12px;color: #FFF;text-align: center;margin: 0 0 0px;font-family: covesbold;">
                                    <h4 class="tia" style="font-family: lulo_cleanoutline_bold,sans-serif;  font-size: 20px;">Qui est concerné?</h4>
                                    <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: center;">
                                        Senegal Séjour propose ses services à toute personne désirant séjourner ou vivre  au Sénégal sur une longue ou courte période ou simplement découvrir ce fabuleux pays d'Afrique En famille, entre amis ou en couple ? Résidants ou touristes ?
                                    </p>
                                    <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: center;">
                                        Nous nous chargeons de vous faire découvrir et vivre le pays de la Teranga * dans toute sa splendeur !*pays de l'hospitalité
                                    </p>
                                    <div class="buttons clearfix" style="text-align: center;">
                                        <?php
                                        if (isset($this->_USER)){ ?>
                                            <a href="<?= WEBROOT ?>membre/differentesformules" class="btn btn-primary" style="background-color: rgba(99, 82, 63, 1);cursor: pointer !important;box-shadow: 6.18px 3.29px 13px 2px rgba(0,0,0,0.6);border-radius: 10px 10px 10px 10px;margin-top: 20px;font-family:coveslight; font-size: 10px;">Acheter PASS & CARTES</a>
                                        <?php }
                                        else { ?>
                                            <a href="<?= WEBROOT ?>home/register" class="btn btn-primary" style="background-color: rgba(99, 82, 63, 1);cursor: pointer !important;box-shadow: 6.18px 3.29px 13px 2px rgba(0,0,0,0.6);border-radius: 10px 10px 10px 10px;margin-top: 20px;font-family:coveslight; font-size: 10px;">Acheter PASS & CARTES</a>
                                        <?php }
                                        ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </section>
                <section class="section-style1" style="background-image: url('<?= WEBROOT ?>MAIL/image/tissu2.jpg');/*! padding: 80px 0px 100px 0px; */">
                    <div class="container page-builder-ltr">
                        <div class="how-section1" style="background: #ba7a32;padding: 35px;">
                            <div class="row">
                                <div class="col-md-6 text-muted"  style="font-size: 15px;color: #FFF;margin: 0 0 25px;font-family: coveslightt;">
                                    <h4 class="tia" style="font-family: lulo_cleanoutline_bold,sans-serif;  font-size: 20px; text-align: left">Pourquoi Devenir Membre ?</h4>
                                    <p class="text-muted"  style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: center; ">
                                        SénégalSéjour  vous fera découvrir le Sénégal à travers les visites virtuelles interactives des sites de nos partenaires, comme si vous y étiez et sans vous déplacer !
                                    </p>
                                    <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold; text-align: center;">
                                        Nous sélectionnons avec soin les lieux à visiter pour vos vacances , vos loisirs mais aussi tous les établissements et services indispensables pour séjourner ou vivre au Sénégal, en vous donnant accès à toutes les informations avant votre venue. Plus de surprises !!!!!
                                    </p>
                                    <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: center;">
                                        Bénéficiez de  l'entraide de l'ensemble de la communauté en partageant vous aussi vos expériences pour vous aider à mieux choisir vos destinations .
                                    </p>
                                    <div class="buttons clearfix" style="text-align: center;">
                                        <a href="https://www.senegalsejour.com/avantages-membres" class="btn btn-primary" style="background-color: rgba(99, 82, 63, 1);cursor: pointer !important;box-shadow: 6.18px 3.29px 13px 2px rgba(0,0,0,0.6);border-radius: 10px 10px 10px 10px;margin-top: 20px;font-family:coveslight; font-size: 10px;">Acheter PASS & CARTES</a>

                                    </div>
                                </div>
                                <div class="col-md-6 how-img">
                                    <img src="<?= WEBROOT ?>MAIL/image/Groupe_Smilling.png" class="rounded-circle img-fluid" alt="" style="height: 200px;"/>
                                </div>
                            </div>

                        </div>
                    </div>

                </section>
                <section class="section-style1" style="background-image: url('<?= WEBROOT ?>MAIL/image/tissu2.jpg');/*! padding: 80px 0px 100px 0px; */">
                    <div class="container page-builder-ltr">
                        <div class="how-section1" style="background: #ba7a32;padding: 35px;">

                            <div class="row">
                                <div class="col-md-6 how-img">
                                    <img src="<?= WEBROOT ?>MAIL/image/Jeunes_femmes.png" class="rounded-circle img-fluid" alt="" style="height: 200px;"/>
                                </div>
                                <div class="col-md-6 text-muted"  style="font-size: 12px;color: #FFF;text-align: center;margin: 0 0 0px;font-family: covesbold;">
                                    <h4 class="tia" style="font-family: lulo_cleanoutline_bold,sans-serif;  font-size: 20px;">Faites le plein d'avantages</h4>
                                    <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: center;">
                                        Inscrivez vous grâce au formulaire et choisissez une  de nos formules PASS ou CARTE Vous accéderez en illimité durant toute la durée de votre abonnement à tous les avantages négociés chez tous nos partenaires, avec des réductions allant de 5 à 30 % sur l’achat de prestations, produits et services.
                                    </p>
                                    <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: center;">
                                        Restaurant, hôtel, salle de sport, instituts de beauté, santé, déplacements, musées et activités culturelles ou loisirs .... SénegalSéjour Boost votre pouvoir d’achat au quotidien pour votre plus grand plaisir !
                                    </p>
                                    <div class="buttons clearfix" style="text-align: center;"
                                        Restaurant, hôtel, salle de sport, instituts de beauté, santé, déplacements, musées et activités culturelles ou loisirs .... SénegalSéjour Boost votre pouvoir d’achat au quotidien pour votre plus grand plaisir !
                                    </p>
                                    <div class="buttons clearfix" style="text-align: center;">
                                        <?php
                                            if (isset($this->_USER)){ ?>
                                                <a href="<?= WEBROOT ?>membre/differentesformules" class="btn btn-primary" style="background-color: rgba(99, 82, 63, 1);cursor: pointer !important;box-shadow: 6.18px 3.29px 13px 2px rgba(0,0,0,0.6);border-radius: 10px 10px 10px 10px;margin-top: 20px;font-family:coveslight; font-size: 10px;">Acheter PASS & CARTES</a>
                                            <?php }
                                            else { ?>
                                                <a href="<?= WEBROOT ?>home/register" class="btn btn-primary" style="background-color: rgba(99, 82, 63, 1);cursor: pointer !important;box-shadow: 6.18px 3.29px 13px 2px rgba(0,0,0,0.6);border-radius: 10px 10px 10px 10px;margin-top: 20px;font-family:coveslight; font-size: 10px;">Acheter PASS & CARTES</a>
                                            <?php }
                                        ?>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6 text-muted"  style="font-size: 15px;color: #FFF;margin: 0 0 25px;font-family: coveslightt;">
                                    <h4 class="tia" style="font-family: lulo_cleanoutline_bold,sans-serif;  font-size: 20px; text-align: left">GAGNEZ PLUS EN DEPENSANT MOINS </h4>
                                    <p class="text-muted"  style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: left; ">
                                        Bénéficiez également d’avantages supplémentaires avec notre programme de fidélité :
                                    </p>

                                    <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold; text-align: left;">
                                        Plus vous dépensez chez nos partenaires, plus vous cumulez des points qui vous permettront d’accéder avec des prix encore plus réduits ou même gratuitement à  des offres spécialement négociées par le Club auprès de nos partenaires !
                                    </p>

                                    <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold; text-align: left;">
                                        exemple : Pour 1000 CFA dépensés, 1 point s’ajoute à votre solde. Cumulez les points et gagnez des récompenses comme une nuit d’hôtel, un diner à deux, une prestation de beauté ou un week-end découverte ….
                                    </p>
                                    <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold; text-align: left;">
                                        A partir de 100 points cumulés, profitez de -25% sur le renouvellement de votre PASS ou CARTE Dès votre inscription, 10 points de bienvenue vous sont offerts.
                                    </p>
                                    <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold; text-align: left;">
                                        Recevez également notre newsletter exclusivement réservée à nos abonnés avec des offres promotionnelles inédites de tous nos partenaires.
                                    </p>
                                    <div class="buttons clearfix" style="text-align: center;">
                                        <a href="https://www.senegalsejour.com/avantages-membres" class="btn btn-primary" style="background-color: rgba(99, 82, 63, 1);cursor: pointer !important;box-shadow: 6.18px 3.29px 13px 2px rgba(0,0,0,0.6);border-radius: 10px 10px 10px 10px;margin-top: 20px;font-family:coveslight; font-size: 10px;">Acheter PASS & CARTES</a>

                                    </div>
                                </div>
                                <div class="col-md-6 how-img">
                                    <img src="<?= WEBROOT ?>MAIL/image/Famille_heureuse.png" class="rounded-circle img-fluid" alt="" style="height: 200px;"/>
                                </div>
                                <!-- </div>
                                -->

                            </div>
                        </div>

                </section>
                <section class="section-style1" style="background-image: url('<?= WEBROOT ?>MAIL/image/tissu2.jpg');/*! padding: 90px 0px 200px 0px; */">
                    <div class="container page-builder-ltr">
                        <div class="how-section1" style="background: #ba7a32;padding: 35px;">
                            <h4 class="tia" style="font-family: lulo_cleanoutline_bold,sans-serif;  font-size: 20px; text-align: center">Comment Devenir membre?</h4>
                            <div class="row maxrow" style="font-size: 17px;color: #FFF;text-align: center;margin: 0 0 25px;font-family: covesbold; background-color:initial;">
                                <div class="col-md-4 maxcol">
                                    <div class="card mb-4 maxcard" style="background-color: rgba(99, 82, 63, 1);    height: 500px;">
                                        <img  src="<?= WEBROOT ?>MAIL/image/icon/bg-call.png"  alt="">
                                        <div style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: center;">
                                            <h5 class="card-title">Inscrivez vous sur le site</h5>
                                            <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: center;"> Remplissez le Formulaire d'inscription</p>
                                            <hr><br>
                                            <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: center;">Vous recevez un Email de confirmation d'inscription et votre  espace de membre sera créé avec vos informations, login et mot de passe.​​</p>
                                            <hr><br>
                                            <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: center;">Vous pourrez modifier toutes vos informations et retrouver toute l’historique de votre activité au sein du CLUB</p>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 maxcol">
                                    <div class="card mb-4 maxcard" style="background-color: rgba(99, 82, 63, 1);    height: 500px;">
                                        <img class="card-img-top" src="<?= WEBROOT ?>MAIL/image/icon/bg-call.png" alt="">
                                        <div style="font-size: 10x;color: #FFF;font-family:covesbold;text-align: center;">
                                            <h5 class="card-title">Achetez un Pass ou une Carte</h5>
                                            <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: center;">Choisissez la formule la plus adaptée à vos besoins </p>
                                            <hr><br>
                                            <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: center;">le PASS de 2 mois pour des courts séjours ou tester nos avantages</p>
                                            <hr><br>
                                            <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: center;">la Carte de 1 an : pour bénéficier tout au long de l'année en illimité de nos avantages et cumuler des points </p>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 maxcol">
                                    <div class="card mb-4 maxcard" style="background-color: rgba(99, 82, 63, 1);    height: 500px;">
                                        <img class="card-img-top" src="<?= WEBROOT ?>MAIL/image/icon/bg-call.png" alt="Card image cap">
                                        <div style="font-size: 10x;color: #FFF;font-family: covesbold;text-align: center;">
                                            <h5 class="card-title">Faites vous plaisir !</h5>
                                            <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: center;"> Vous recevrez un email de confirmation de votre transaction et de validité de votre abonnement .</p>
                                            <hr><br>
                                            <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: center;">Conservez bien dans votre smartphone ou imprimez  votre carte digitale nominative  que vous devrez impérativement présenter à nos partenaires pour pouvoir bénéficier de vos avantages </p>
                                            <hr><br>
                                            <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: center;">Parcourez les différentes rubriques pour découvrir vos remises chez nos partenaires .  </p>

                                        </div>
                                    </div>
                                </div>
                                <div class="buttons clearfix" style="text-align: center;">
                                    <a href="https://www.senegalsejour.com/avantages-membres" class="btn btn-primary" style="background-color: rgba(99, 82, 63, 1);cursor: pointer !important;box-shadow: 6.18px 3.29px 13px 2px rgba(0,0,0,0.6);border-radius: 10px 10px 10px 10px;margin-top: 20px;font-family:coveslight; font-size: 10px;">Acheter PASS & CARTES</a>
                                </div>
                            </div>
                        </div>
                    </div>


                </section>
                <section class="section-style1" style="background-image: url('<?= WEBROOT ?>MAIL/image/tissu2.jpg');/*! padding: 90px 0px 200px 0px; */">
                    <div class="container page-builder-ltr">
                        <div class="how-section1" style="background: #ba7a32;padding: 35px;">
                            <h4 class="tia" style="font-family: lulo_cleanoutline_bold,sans-serif;  font-size: 20px; text-align: center">Bénéficiez de vos remises</h4>
                            <div class="row maxrow" style="font-size: 17px;color: #FFF;text-align: center;margin: 0 0 25px;font-family: coveslight; background-color:initial;">
                                <div class="col-md-4 maxcol">
                                    <div class="card mb-4 maxcard" style="background-color: #627b5c ;  height: 500px;">
                                        <img  src="<?= WEBROOT ?>MAIL/image/icon/bg-call.png"  alt="">
                                        <div style="font-size: 10x;color: #FFF;font-family: covesbold;text-align: center;">
                                            <h5 class="card-title">RDV chez un Partenaire</h5>
                                            <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: center;">Identifiez nos partenaires facilement sur le site ou à l'aide du logo Sénégalséjour présent sur les lieux</p>
                                            <hr><br>
                                            <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: center;">Présentez votre carte nominative sur votre smartphone au moment de régler</p>
                                            <hr><br>
                                            <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: center;">Présentez votre mail d'inscription si vous  n'avez pas de smartphone</p>


                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 maxcol">
                                    <div class="card mb-4 maxcard" style="background-color: #627b5c; height: 500px;">
                                        <img class="card-img-top" src="<?= WEBROOT ?>MAIL/image/icon/bg-call.png" alt="">
                                        <div style="font-size: 10x;color: #FFF;font-family: covesbold;text-align: center;>
												<h5 class="card-title">Validation </h5>
                                        <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: center;">Le partenaire dans son espace dédié sur notre site va vérifier la validité de votre carte ou PASS</p>
                                        <hr><br>
                                        <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: center;">Une fois la vérification effectuée, il lui suffit de saisir avec vous le montant de la facture que vous deviez régler</p>
                                        <hr><br>
                                        <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: center;">Vous aurez instantanément l’affichage de la somme que vous devrez payer après déduction automatique de l’avantage enregistré dans notre base partenaire </p>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 maxcol">
                                <div class="card mb-4 maxcard" style="background-color: #627b5c;    height: 500px;">
                                    <img class="card-img-top" src="<?= WEBROOT ?>MAIL/image/icon/bg-call.png" alt="Card image cap">
                                    <div style="font-size: 10x;color: #FFF;font-family: covesbold;text-align: center;">
                                        <h5 class="card-title">Enregistrement</h5>
                                        <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: center;">  En validant la transaction, nous l’enregistrons automatiquement sur votre profil de membre et aussi celui du Partenaire. </p>
                                        <hr><br>
                                        <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: center;">Vous avez ainsi une totale visibilité sur les économies réaliséesgrâce à l’achat de votre carte</p>
                                        <hr><br>
                                        <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: center;">Vos points de fidélité sont automatiquement enregistrés en fonction du montant dépensé que vous pourrez retrouver dans votre profil de membre </p>
                                    </div>
                                </div>
                            </div>
                            <div class="buttons clearfix" style="text-align: center;">
                                <a href="https://www.senegalsejour.com/avantages-membres" class="btn btn-primary" style="background-color: rgba(99, 82, 63, 1);cursor: pointer !important;box-shadow: 6.18px 3.29px 13px 2px rgba(0,0,0,0.6);border-radius: 10px 10px 10px 10px;margin-top: 20px;font-family:coveslight; font-size: 10px;">Acheter PASS & CARTES</a>
                            </div>
                        </div>
                    </div>
            </div>
            </section>
            <section class="section-style1" style="background-image: url('<?= WEBROOT ?>MAIL/image/tissu2.jpg');/*! padding: 80px 0px 100px 0px; */">
                <div class="container page-builder-ltr">
                    <div class="how-section1" style="background: #ba7a32;padding: 35px;">

                        <div class="row">
                            <div class="col-md-6 how-img">
                                <img src="<?= WEBROOT ?>MAIL/image/Discussion.png" class="rounded-circle img-fluid" alt="" style="height: 200px;"/>
                            </div>
                            <div class="col-md-6 text-muted"  style="font-size: 12px;color: #FFF;text-align: center;margin: 0 0 0px;font-family: covesbold;">
                                <h4 class="tia" style="font-family: lulo_cleanoutline_bold,sans-serif;  font-size: 20px;">Partagez vos expériences !</h4>
                                <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: left;">
                                    Félicitations ! En tant que membre et abonné, nous sommes heureux de vous compter au sein de notre communauté de résidents et voyageurs.
                                </p>
                                <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: left;">
                                    Partagez votre expérience avec tous nos membres ! Parce que le réel ne remplacera jamais le virtuel, toute la communauté SénegalSéjour compte sur vous pour parfaire leur connaissance de tous nos partenaires actuels et futurs.
                                </p>
                                <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: left;">
                                    Aidez les autres membres (et aussi nos Partenaires) à faire leur choix en partageant le commentaire de votre propre expérience à chacune de vos visites de l’une des nombreuses adresses disponibles sur notre site !
                                </p>
                                <div class="buttons clearfix" style="text-align: center;">
                                    <a href="https://www.senegalsejour.com/avantages-membres" class="btn btn-primary" style="background-color: rgba(99, 82, 63, 1);cursor: pointer !important;box-shadow: 6.18px 3.29px 13px 2px rgba(0,0,0,0.6);border-radius: 10px 10px 10px 10px;margin-top: 20px;font-family:coveslight; font-size: 10px;">Acheter PASS & CARTES</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </section>
            <section class="section-style1" style="background-image: url('<?= WEBROOT ?>MAIL/image/tissu2.jpg');/*! padding: 80px 0px 100px 0px; */">
                <div class="container page-builder-ltr">
                    <div class="how-section1" style="background: #ba7a32;padding: 35px;">
                        <div class="row">
                            <div class="col-md-6 text-muted"  style="font-size: 15px;color: #FFF;margin: 0 0 25px;font-family: covesbold;">
                                <h4 class="tia" style="font-family: lulo_cleanoutline_bold,sans-serif;  font-size: 20px;text-align: left">offre de parrainage:</h4>
                                <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: left;">Promoteurs, Agences immobilières </p>
                                <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: left;">
                                    Avec notre programme de parrainage, faites profiter vos amis et proches de nos offres exceptionnelles ! Dès votre inscription sur notre site et votre adhésion au CLUB confirmée, Vous avez la possibilité d’inviter d’autres personnes à rejoindre le club en cliquant sur le bouton INVITER, ces dernières recevront le lien du site qui leur permettra de s’inscrire à leur tour et d’adhérer à l’une de nos formules
                                </p>
                            </div>

                            <div class="col-md-6 how-img">
                                <img src="<?= WEBROOT ?>MAIL/image/Collage_Groupe.png" class="rounded-circle img-fluid" alt="" style="height: 200px;"/>
                            </div>

                        </div>
                    </div>
                    <div class="container page-builder-ltr">
                        <div class="how-section1" style="background: #ba7a32;padding: 35px;">
                            <div class="row">
                                <div class="col-md-6 how-img">
                                    <img src="<?= WEBROOT ?>MAIL/image/Groupe_amis.png" class="rounded-circle img-fluid" alt="" style="height: 200px;"/>
                                </div>
                                <div class="col-md-6 text-muted"  style="font-size: 12px;color: #FFF;text-align: center;margin: 0 0 0px;font-family: covesbold;">
                                    <h4 class="tia" style="font-family: lulo_cleanoutline_bold,sans-serif;  font-size: 20px;">pour Quels avantages ? </h4>
                                    <div class="col-md-6 maxcol">
                                        <div class="card mb-4 maxcard" style="background-color: rgba(99, 82, 63, 1);    height: 500px;">
                                            <div style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: center;">
                                                <h5 class="card-title">Pour le Parrain</h5>
                                                <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: center;"> 5 points de fidélité à chaque inscription suite à une invitation envoyée </p>
                                                <hr><br>
                                                <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: center;">Dès que de votre filleul achète une de nos formules, vous recevez une réduction sur votre prochain abonnement de :​​</p>
                                                <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: center;">.  10 % après 10 adhésions de filleuls</p>
                                                <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: center;">.  30 % après 30 adhésions de filleuls</p>
                                                <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: center;">. 50 % après 50 adhésions de filleuls</p>

                                            </div>
                                        </div>
                                    </div>
                                    <div></div>
                                    <div class="col-md-6 maxcol">
                                        <div class="card mb-4 maxcard" style="background-color: rgba(99, 82, 63, 1);    height: 500px;">
                                            <div style="font-size: 10x;color: #FFF;font-family:covesbold;text-align: center;">
                                                <h5 class="card-title">Pour le Filleul</h5>
                                                <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: center;">10 % de réduction sur son premier abonnement </p>
                                                <hr><br>
                                                <p style="font-size: 17x;color: #FFF;margin: 0 0 25px;font-family:covesbold;text-align: center;">​il bénéficiera des mêmes avantages en parrainant d’autres membres </p>

                                            </div>
                                        </div>
                                    </div>
                                    <div></div>
                                    <div class="buttons clearfix" style="text-align: center;">
                                        <a href="https://www.senegalsejour.com/nous-contacter" class="btn btn-primary" style="background-color: rgba(99, 82, 63, 1);cursor: pointer !important;box-shadow: 6.18px 3.29px 13px 2px rgba(0,0,0,0.6);border-radius: 10px 10px 10px 10px;margin-top: 20px; font-family:coveslight;font-size: 10px;">Contactez-nous!</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>
		</div>