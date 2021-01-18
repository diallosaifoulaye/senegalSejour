<form id="validation" class="form-inline form-validator" data-type="update" role="form" action="<?= WEBROOT ?>avantage/<?= ((isset($avantage->id)) ? "modifAvantage" : "ajoutAvantage") ?>" method="post">

    <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?= ((isset($avantage->id)) ? $this->lang['update_Avantage'] : $this->lang['ajout_Avantage']) ; ?></h4>

    </div>

    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-md-8">
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="libelle" class="control-label"><?php echo $this->lang['labAvantage']; ?> :</label>
                        <textarea class="form-control" id="libelle" name="libelle" style="margin: 0px; width: 579px; height: 357px;"><?= ((isset($avantage)) ? $avantage->libelle : "") ?></textarea>
                    </div>
                    <?php if(isset($avantage->id)){  ?> <input type="hidden" name="id" value="<?= $avantage->id; ?>"><?php } ?>
                </div>
                <div class="col-sm-2"></div>

            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button class="btn btn-success confirm" data-form="my-form" type="submit"><i class="fa fa-check"></i> <?php echo $this->lang['btnValider']; ?>
        </button>
        <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo $this->lang['btnFermer']; ?> </button>
    </div>

</form>

<script>
//    $('#validation').formValidation({
//            framework: 'bootstrap',
//            fields: {
//                libelle: {
//                    validators: {
//                        notEmpty: {
//                            message: '<?//= $this->lang['droitObligatoire']; ?>//'
//                        }
//                    }
//                }
//            }
//        }
//    );
</script>










<section class="section-style1" style="background-image: url('<?= WEBROOT;?>theme/image/tissu2.jpg');/*! padding: 90px 0px 200px 0px; */">

    <div class="container page-builder-ltr">
        <div class="how-section1" style="background: #ba7a32;padding: 35px; width: 83%; margin-left: 8%;">
            <h4 class="tia" style="font-family: lulo_cleanoutline_bold,sans-serif;  font-size: 20px; text-align: center">accordez votre remise à nos membres</h4>
            <div class="row maxrow" style="font-size: 17px;color: #FFF;text-align: center;margin: 0 0 25px;font-family: coveslight; background-color:initial;">
                <div class="col-md-4 maxcol">
                    <style> .style-kddyudzs1_comp-kddzfjwp svg [data-color="1"] {fill: rgba(213, 213, 213, 1);}
                    </style>
                    <div id="comp-kddzfjwplink" class="style-kddyudzs1link">
                        <div style="opacity:1; " class="style-kddyudzs1_comp-kddzfjwp style-kddyudzs1_non-scaling-stroke style-kddyudzs1svg" id="comp-kddzfjwpsvg">
                            <svg preserveAspectRatio="xMidYMid meet" id="comp-kddzfjwpsvgcontent" data-bbox="52 28 96 144" viewBox="52 28 96 144" height="200" width="200" xmlns="http://www.w3.org/2000/svg" data-type="color" role="img" style="height: 73px;">
                                <g>
                                    <path d="M145 172H55c-1.658 0-3-1.342-3-3V46c0-1.658 1.342-3 3-3h24v6H58v117h84V49h-21v-6h24c1.658 0 3 1.342 3 3v123c0 1.658-1.342 3-3 3z" fill="##3940B2" data-color="1"></path>
                                    <path d="M130 130H70c-1.658 0-3-1.342-3-3V70c0-1.658 1.342-3 3-3h60c1.658 0 3 1.342 3 3v57c0 1.658-1.342 3-3 3zm-57-6h54V73H73v51z" fill="##3940B2" data-color="1"></path>
                                    <path d="M118 130H82c-1.658 0-3-1.342-3-3v-12c0-.618.19-1.222.548-1.729 1.688-2.394 11.713-7.178 20.452-7.178s18.765 4.784 20.452 7.178c.357.507.548 1.11.548 1.729v12c0 1.658-1.342 3-3 3zm-33-6h30v-7.556c-2.323-1.427-8.789-4.351-15-4.351s-12.677 2.924-15 4.351V124z" fill="#ffffff" data-color="1"></path>
                                    <path d="M100 103.094c-6.618 0-12-5.426-12-12.094v-2.906C88 81.426 93.382 76 100 76s12 5.426 12 12.094V91c0 6.668-5.382 12.094-12 12.094zM100 82c-3.308 0-6 2.733-6 6.094V91c0 3.36 2.692 6.094 6 6.094s6-2.733 6-6.094v-2.906c0-3.361-2.692-6.094-6-6.094z" fill="#ffffff" data-color="1"></path>
                                    <path fill="#ffffff" d="M124 55v6H76v-6h48z" data-color="1"></path>
                                    <path fill="#ffffff" d="M70 55v6h-6v-6h6z" data-color="1"></path>
                                    <path fill="#ffffff" d="M136 55v6h-6v-6h6z" data-color="1"></path>
                                    <path d="M112 61H88c-1.658 0-3-1.342-3-3V31c0-1.658 1.342-3 3-3h24c1.658 0 3 1.342 3 3v27c0 1.658-1.342 3-3 3zm-21-6h18V34H91v21z" fill="#3940B2" data-color="1"></path>
                                    <path fill="#ffffff" d="M121 139v6H79v-6h42z" data-color="1"></path>
                                    <path fill="#ffffff" d="M112 151v6H88v-6h24z" data-color="1"></path>
                                </g>
                            </svg>
                        </div>
                    </div>
                    <div class="card mb-4 maxcard" style="background-color: #627b5c ;  height: 500px; margin-top: -13px;">
                        <!--											<img src="<?/*= WEBROOT;*/?>theme/image/icon/bg-call.png" alt="">
-->											<div style="font-size: 10x;color: #FFF;font-family:coveslight;>
												 <h5 class="card-title">A chaque visite d'un Membre</h5>
                        <p>Revendiquez votre statut  de partenaire sur votre site ou à l'aide du logo Sénégalséjour que vous afficherez à l'accueil de votre établissement​</p>
                        <hr><br>
                        <p>le Membre doit vous présenter sa carte nominative sur son smartphone au moment de régler</p>
                        <hr><br>
                        <p>A défaut, il vous présentera son mail d'inscription si il n'a pas de  smartphone</p>


                    </div>
                </div>
            </div>
            <div class="col-md-4 maxcol">
                <div class="card mb-4 maxcard" style="background-color: #627b5c; height: 500px;">
                    <img class="card-img-top" src="<?= WEBROOT;?>theme/image/icon/bg-call.png" alt="">
                    <div style="font-size: 10x;color: #FFF;font-family:coveslight;>
												<h5 class="card-title">Validation </h5>
                    <p>Dans votre espace partenaire dédié sur notre site vous vérifiez la validité de sa carte ou PASS à l'aide du QR CODE</p>
                    <hr><br>
                    <p>Une fois la vérification effectuée, vous  saisissez avec lui le montant de la facture qu'il doit vous régler</p>
                    <hr><br>
                    <p>Vous aurez instantanément l’affichage de la somme que vous devrez faire payer après déduction automatique de l’avantage enregistré dans notre base partenaire </p>

                </div>
            </div>
        </div>
        <div class="col-md-4 maxcol">
            <div class="card mb-4 maxcard" style="background-color: #627b5c;    height: 500px;">
                <img class="card-img-top" src="<?= WEBROOT;?>theme/image/icon/bg-call.png" alt="Card image cap">
                <div style="font-size: 10x;color: #FFF;font-family:coveslight;>
												<h5 class="card-title">Enregistrement</h5>
                <p>
                    En validant la transaction, nous l’enregistrons automatiquement sur votre profil de membre et aussi celui du Partenaire. </p>
                <hr><br>
                <p>Vous avez ainsi une totale visibilité sur le chiffre d'affaire généré grâce à notre Partenariat</p>
                <hr><br>
                <p>les points de fidélité du Membre sont automatiquement enregistrés en fonction du montant dépensé qu'il pourra retrouver dans son profil de membre </p>


            </div>
        </div>
    </div>
    <div class="buttons clearfix" style="text-align: center;">
        <a href="https://www.senegalsejour.com/nous-contacter" class="btn btn-primary" style="background-color: rgba(99, 82, 63, 1);cursor: pointer !important;box-shadow: 6.18px 3.29px 13px 2px rgba(0,0,0,0.6);border-radius: 10px 10px 10px 10px;margin-top: 20px; font-family:coveslight;font-size: 10px;">Contactez-nous!</a>
    </div>
    </div>
    </div>
</section>
