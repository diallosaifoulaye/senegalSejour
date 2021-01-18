<head>
    <script src="https://www.google.com/recaptcha/api.js"></script>
</head>
<body data-racine="<?= RACINE; ?>" data-webroot="<?= WEBROOT; ?>" data-assets="<?= ASSETS; ?>"
      class="common-home res layout-1" xmlns="http://www.w3.org/1999/html">

<style>
    .contact-bot .form-contact .form-group input, .contact-bot .form-contact .form-group textarea, .form-group input {
        background: #4b4a4a99;
        border-bottom: 1px #f9f9f9 solid;
        border-radius: 0;
        padding: 0 12px;
        font-size: 14px;
        color: #fff;
        height: 41px;
        line-height: 41px;
    }

    .form-infomation .your-infomation .form-item input {

        width: 100%;
        background: #fff0;
        border-radius: 0;
        padding: 7px 20px;
        font-size: 14px;
        color: #191919;

    }
    .connect {
        font-size: 30px;
        font-weight: 900;
        font-family: sarina,cursive;
        text-shadow: rgba(0, 0, 0, 0.4) 0px 4px 5px;
        color: lightgrey;
    }
    .connect-mini {
        font-size: 16px;
        font-weight: 800;
        font-family: sarina,cursive;
        text-shadow: rgba(0, 0, 0, 0.4) 0px 4px 5px;
        color: lightgrey;
    }
    .log {
        float: right;
        position: relative;
        left: 275px;
        bottom: 55px;
        font-size: 16px;
        font-weight: bold;
        color: #000;
    }

    @media only screen and (max-width: 425px) {
        #reg {
            padding: 0px !important;
        }

        /*.connect_ {*/
        /*    font-size: 28px;*/
        /*    font-weight: 900;*/
        /*    font-family: sarina,cursive;*/
        /*    text-shadow: rgba(0, 0, 0, 0.4) 0px 4px 5px;*/
        /*    color: #000;*/
        /*}*/

        .form-infomation {
            padding-top: 20px;
        }

        /*.log_ {*/
        /*    left: 275px;*/
        /*    bottom: 55px;*/
        /*    font-size: 16px;*/
        /*    font-weight: bold;*/
        /*    color: #000;*/
        /*}*/

        #btn_custom_bottom{
            display: block !important;
        }
    }

    .connect_ {
        font-size: 28px;
        font-weight: 900;
        font-family: sarina,cursive;
        text-shadow: rgba(0, 0, 0, 0.4) 0px 4px 5px;
        color: lightgrey;
    }

    .log_ {
        left: 275px;
        bottom: 55px;
        font-size: 16px;
        font-weight: bold;
        color: #ffffff;
    }



</style>

<div id="wrapper" class="wrapper-fluid banners-effect-10">
    <!-- Main Container  -->
    <div id="content" style="margin-bottom: 0;">
        <div class="so-page-builder">
            <section class="section-style1" style="background-image: url('<?= WEBROOT;?>theme/image/tissu2.jpg')/*! padding: 90px 0px 200px 0px; */">
                <div class="container page-builder-ltr">
                    <div id="reg" class="row row-style row_a1" style="background-image: url('<?= WEBROOT;?>theme/image/flow.jpg');background-size: cover;background-repeat: no-repeat;padding: 123px;height: 774px;">
<!--                        <span class="connect">Déja membre?</span>-->
<!--                        <a class="log" href="--><?//= WEBROOT;?><!--home/loginpage">se connecter</a>-->
                        <div class="col-lg-12">
                            <form action="<?= WEBROOT;?>home/ajoutMembre" method="post" enctype="multipart/form-data" class="form-infomation clearfix">
                                <?php //echo $this->messageEnvoye; exit;
                                //var_dump($messageAddMembre);die;
                                if (isset($messageEchecInscription) or isset($autorisation_inscription)){ ?>
                                    <div class="alert alert-success" role="alert" id="message">
                                        <?php echo $messageEchecInscription; echo $autorisation_inscription; ?>
                                    </div>
                                <?}?>
                                <fieldset class="your-infomation clearfix" style="box-shadow: 0 0;">
                                    <div class="buttons clearfix" style="text-align: center; margin-bottom: 10px;">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <span class="connect">Rejoignez le club <br/>Senegalsejour </span>
                                            </div>
                                            <div class="col-xs-12">
                                                <span class="connect-mini">et bénéficier de <br/>nombreux avantages </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" name="prenom" value="" class="form-control" placeholder="Prénom" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" name="nom" value="" class="form-control" placeholder="Nom de famille" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <input type="tel" id="telephone" name="telephone" required class="form-control" placeholder="<?php echo $this->lang['telephone']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" name="email" value="" class="form-control" onfocus="verifeDoublon(this)" onchange="verifeDoublon(this)" oninput="verifeDoublon(this)"  placeholder="Votre email" required>
                                            <span id="msgemail" style="background-color: white;"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <input type="password" name="password" value="" class="form-control" placeholder="Mot de passe" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <input id="dateNaissance" type="text" name="dateNaissance" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#dateNaissance" placeholder="Date de naissance">
                                        </div>
                                    </div>

                                    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                                    <input type="hidden" name="action" value="validate_captcha">

                                    <div class="buttons clearfix" style="text-align: center;">
                                        <input type="submit" value="S'inscrire" id="subscribe" class="btn btn-primary" style="background: #c6a47e;">
                                    </div>
                                    <div id="btn_custom_bottom" class="buttons clearfix" style="text-align: center; margin-top: 60px;">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <span class="connect_">Déja membre?</span>
                                            </div>
                                            <div class="col-xs-12">
                                                <a class="log_" href="<?= WEBROOT;?>home/loginpage">se connecter</a>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>

                            <script src="https://www.google.com/recaptcha/api.js?render=6LfYWQoaAAAAAIRbIre9FOBK7T6rHGm_37QNBneD"></script>

                            <script>

                                grecaptcha.ready(function() {
                                    // do request for recaptcha token
                                    // response is promise with passed token
                                    grecaptcha.execute('6LfYWQoaAAAAAIRbIre9FOBK7T6rHGm_37QNBneD', {action:'validate_captcha'})
                                        .then(function(token) {
                                            // add token value to form
                                            document.getElementById('g-recaptcha-response').value = token;
                                        });
                                });
                            </script>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!-- //Main Container -->
<!-- Footer Container -->

<script src="<?= ASSETS ?>plugins/telPlug/js/intlTelInput.js"></script>
<script>
    $(document).ready(function() {
        $("#message").fadeTo(3500, 500).slideUp(500, function() {
            $("#message").slideUp(500);
        });
    });
</script>
<script>

    $('input[type="tel"]').intlTelInput({
        utilsScript: '<?= ASSETS;?>plugins/telPlug/js/utils.js',
        autoPlaceholder: true,
        preferredCountries: [ 'sn', 'gn', 'gm', 'gb','ci'],
        initialDialCode: true,
        nationalMode: false
    });
</script>
<script type="text/javascript">

    $(function () {
        $('#dateNaissance').datetimepicker(
            {
                format : 'DD-MM-YYYY',
                locale:'fr'
            }
        );
    });
</script>
<script>
    function verifeDoublon(element) {

        var nom = element.name ;
        var valeur = element.value ;
        $.ajax({
            type: 'POST',
            data:{ champ : nom, valeur:valeur },
            url: '<?php echo WEBROOT ?>home/verifie',
            success: function(data) {

                var donnees = JSON.parse(data);
                if (parseInt(donnees) != 0) {
                    $('#msg'+nom).html("<p style='color:#F00;display: inline; #F00'><?php echo $this->lang['email_exsitant'];?></p>");
                    $("#subscribe").attr('disabled','disabled');
                }
                else {
                    $('#msg'+nom).html("");
                    $("#subscribe").removeAttr('disabled');
                }
            },
            error: function() {
                alert('La requête n\'a pas abouti'); }

        });
        //alert(name+' '+value);
    }
</script>
<?php include("footer.php"); ?>