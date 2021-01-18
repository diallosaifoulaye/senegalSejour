<style>
    html{
        background: #2f2d2d;
    }
    .table thead > tr > th {
        background: #fff;
        border: 0;
    }
    .table-striped > tbody > tr:nth-of-type(2n+1) {
        background-color: #fff;
    }
    .bd-7 {
        border: 2px solid #f0f0f0;
        border-radius: 10px;
    }
    ul.confirm li span {
        color: #555;
        font-size: 14px;
        text-transform: capitalize;
        width: 50%;
        float: left;
    }
    ul.confirm li label {
        color: #909090;
        font-size: 14px;
        margin-bottom: 0;
        width: 50%;
        float: left;
    }
    ul.payment li label {
        display: initial;
    }
    @media only screen and (max-width:375px) {
        ul.confirm li span {
            font-size:13px;
        }
        ul.confirm li label   {
            font-size:13px;
        }
    }

    @media only screen and (max-width:320px) {
        ul.confirm li span  {
            font-size:13px;
        }
        ul.confirm li label   {
            font-size:13px;
        }
    }


</style>

<form id="validation" class="form-inline form-validator" data-type="update" role="form" action="<?= WEBROOT ?>membre/souscrireFormule" method="post">

    <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?= $this->lang['souscription_formule'] ; ?></h4>

    </div>

    <div class="modal-body">
        <div class="container-fluid">
            <div class="row maxrow" style="background: #fff;margin: 7px 0 0 0;padding: 0px;">
                <div  style="margin-bottom: 25px">
                    <h3 style="color: #707070;font-size: 18px;text-align: left;margin: 20px;">COMMANDE</h3>
                    <div class="row" style="padding: 0px;border-top: 1px solid #979494;margin: 20px;" class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                        <ul class="confirm">
                            <h3 style="color: #707070;font-size: 18px;text-align: left;">Résumé de la commande</h3>
                            <li>
                                <span>FORMULE</span>
                                <label><?= $formule->libelle; ?></label>
                            </li>
                            <li>
                                <span>Durée</span>
                                <label><?= $formule->duree; ?>  <?= $formule->type_duree; ?></label>
                            </li>
                            <li >
                                <span>Total</span>
                                <label> <span id="montant" ><?= \app\core\Utils::getFormatMoney($formule->montant); ?></span> <?= $this->lang['currency_cfa']; ?> </label>
                            </li>
                            <li><br/><br/><br/></li>

                            <li>
                                <hr style="border-top: 1px solid black;">
                            </li>

                            <li>
                                <span style="text-transform: uppercase">Code Promo : </span>
                                <label>OUI&nbsp;<input id="YES" type="radio" name="confirmation" value="oui"> &nbsp;
                                NON &nbsp;<input id="NON" type="radio" name="confirmation" value="non" checked></label>
                            </li>
                            <li><br/><br/></li>
                            <li style="display: none" id="code_promo">
<!--                                <div class="form-horizontal form-material" id="codePromo">-->
<!--                                    <input class="form-control" id="promotion" onchange="verifeCode(this)" oninput="verifeCode(this)" name="promotion" type="text" placeholder="CODE PROMO">-->
<!--                                    <i id="msgValid"  class="fa fa-check-circle fa-2x" aria-hidden="true" style="margin-left: 3px;color: green; visibility: hidden;"></i>-->
<!--                                    <i id="msgInValid" class="fa fa-times fa-2x" aria-hidden="true" style="margin-left: 3px;color: red; visibility: hidden;"></i>-->
<!--                                </div>-->
                                <div class="form-group">
                                    <input class="form-control" id="promotion" name="promotion" type="text" placeholder="CODE PROMO">
                                    <i id="msgValid"  class="fa fa-check-circle fa-2x" aria-hidden="true" style="margin-left: 3px;color: green; visibility: hidden;"></i>
                                    <i id="msgInValid" class="fa fa-times fa-2x" aria-hidden="true" style="margin-left: 3px;color: red; visibility: hidden;"></i>
                                </div>
                                <div class="form-group" style="margin-top: 5px;">
                                    <button type="button" class="btn btn-success" id="activateCode"> ACTIVER </button>
                                </div>
                            </li>
                            <li><br/></li>
                            <li style="display: none" id="montant_promo">
                                <div class="form-horizontal form-material">
                                    <label>TOTAL A PAYER AVEC VOTRE CODE PROMO</label>
                                    <input class="form-control" id="promotionValue" readonly name="promotionValue" type="text" placeholder="">
                                </div>
                            </li>

                        </ul>
                        <div >
                            <span style="display: none" id="msg"></span>
                        </div>

                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <h3 style="color: #707070;font-size: 18px;margin: 20px;">PAIEMENT</h3>
                    <div class="row" style="padding: 23px;background: #fff;border: 1px solid #979494;margin: 20px;">
                        <div class="col-md-12">
                            <ul class="payment">
                                <li style="margin: 20px auto;">
                                    <input type="radio" name="mode" value="paypal" id="payP" required>
                                    <label for="payP"><img style="width: 70%;" src="<?= WEBROOT ?>theme/image/paypal.png" alt=""></label>

                                </li>
                                <li>
                                    <input type="radio" name="mode" value="paydunia" id="payD" required>
                                    <label for="payD"><img style="width: 70%;" src="<?= WEBROOT ?>theme/image/payduna.jpg" alt=""></label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php if(isset($formule->id)){  ?> <input type="hidden" name="id" value="<?= $formule->id; ?>"><?php } ?>
    <input type="hidden" name="promotion_id" id="promotion_id">
    <div class="modal-footer">
        <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo $this->lang['btnFermer']; ?> </button>
        <button id="validatePay" class="btn btn-success confirm" data-form="my-form" type="submit"><i class="fa fa-check"></i> <?php echo $this->lang['btnValider'];?>
        </button>
    </div>

</form>


<script src="<?= ASSETS;?>js/notify.min.js"></script>

<script>
    $('#validation input:radio[name="confirmation"]').on('change', function() {
        if ($('#YES').prop( "checked" )){
            $('#code_promo').show()
            $('#payP').prop( "disabled", true );
            $('#payD').prop( "disabled", true );
            $('#validatePay').prop( "disabled", true );
            $('#msgValid').css("visibility","hidden");
            $('#msgInValid').css("visibility","hidden");
        }else if ($('#NON').prop( "checked" )){
            $('#code_promo').hide()
            $('#payP').prop( "disabled", false );
            $('#payD').prop( "disabled", false );
            $('#validatePay').prop( "disabled", false );
            $('#promotion').val('');
            $('#montant_promo').hide();
            $('#promotionValue').val('');
        }
    });


</script>
<script>
    function verifeCode(element) {

        var nom = 'libelle' ;
        var id = '<?php echo $formule->id ?>';
        var valeur = element ;
        $.ajax({
            type: 'POST',
            data:{ champ : nom, valeur:valeur, formule_id: id },
            url: '<?php echo WEBROOT ?>formule/verifie',
            success: function(data) {
                var donnees = JSON.parse(data);
                if (parseInt(donnees.code) === 1) {
                    $('#msgValid').css("visibility","visible");
                    $('#msgInValid').css("visibility","hidden");
                    $('#promotionValue').val(donnees.somme + ' F CFA');
                    $('#promotion_id').val(donnees.id);
                    $('#montant_promo').show();
                    $('#payP').prop( "disabled", false );
                    $('#payD').prop( "disabled", false );
                    $('#validatePay').prop( "disabled", false );
                }
                else {
                    $('#msgInValid').css("visibility","visible");
                    $('#msgValid').css("visibility","hidden");
                    $('#payP').prop( "disabled", true );
                    $('#payD').prop( "disabled", true );
                    $('#montant_promo').hide();
                    $('#promotionValue').val('');
                    $('#promotion_id').val('');
                    $('#validatePay').prop( "disabled", true );
                    var this_ = $;
                    Swal.fire({
                        title: 'Alerte!',
                        text: 'Le code promo renseigne est invalide !!',
                        icon: 'info',
                        confirmButtonText: 'OK',
                        onClose: (e) =>{
                            this_('#YES').prop( "checked", false)
                            this_('#NON').prop( "checked", true)
                            this_('#code_promo').hide()
                            this_('#payP').prop( "disabled", false );
                            this_('#payD').prop( "disabled", false );
                            this_('#validatePay').prop( "disabled", false );
                            this_('#promotion').val('');
                            this_('#montant_promo').hide();
                            this_('#promotionValue').val('');
                            this_('#msgInValid').css("visibility","hidden");
                        }
                    })
                }
            },
            error: function() {
                alert('no')
                alert('La requête n\'a pas abouti');
            }

        });
    }

    $('#activateCode').on('click', function () {
        console.log($('#promotion').val())
        verifeCode($('#promotion').val())
    })
</script>



