<?php include(ROOT."app/views/template/header_ep.php"); ?>
<style>
    .new-login-register, .new-login-box {
        margin: auto;
        width: 400px;
    }
    .white-box {
        background: #fff;
        padding: 25px;
        margin-bottom: 30px;
    }

    .new-login-register .new-login-box .new-lg-form {
        padding-top: 10px;
    }
    .box-title {
        font-size: 30px;
        text-transform: uppercase;
        font-weight: 700;
        color: #C6A47E;
        text-align: center;
        position: relative;
        margin-bottom: 0;
        margin-top: 8px;
        margin-bottom: 21px;
    }
    body{
        background: #fff!important;
    }
</style>
<body data-racine="<?= RACINE; ?>" data-webroot="<?= WEBROOT; ?>" data-assets="<?= ASSETS; ?>"  class="common-home res layout-1" style="background-color: #2B2B2B;">
<div id="wrapper" class="wrapper-fluid banners-effect-10">
    <!-- Main Container  -->
    <div id="content" style="margin-bottom: 0;">
        <div class="so-page-builder">
            <div class="row" style="margin-top: 35px">
                <div class="col-sm-offset-4 col-lg-offset-4 col-xs-offset-4 col-lg-4 col-sm-4 col-sm-4">
                <?php //echo $this->messageEnvoye; exit;
                if (isset($messageTokenInvalid) or isset($messageTokenNExistePas) or isset($messageTokenDejaUtilise)){ ?>
                    <div class="alert alert-danger" role="alert" id="message">
                        <?php echo $messageTokenInvalid; echo $messageTokenNExistePas; echo $messageTokenDejaUtilise;?>
                    </div>
                <?}?>
                </div>
            </div>
            <section class="section-style1" id="contact">
                <div class="container page-builder-ltr">
<!--                    <div class="row row-style row_a1" style="padding-top: 170px;">-->
                    <div class="row text-center" style="padding-top: 50px;padding-bottom: 50px;">
                        <img src="https://virtualtoursenegalsejour.com/senegalsejour/assets/MailTemplate/maison_ligne_graphique_toit_orange.png" alt="" style="width: 400px;">
                    </div>
                    <div class="row row-style row_a1">
                        <div class="new-login-box" style="width: 520px !important;">
                            <div class="white-box">
<!--                                <h3 class="box-title m-b-0">--><?//= $this->lang['connect']; ?><!--</h3>-->
                                <form class="form-horizontal new-lg-form" action="<?= WEBROOT ?>visite/visiteVirtuelle/" method="post" enctype="multipart/form-data">
                                    <div class="form-group  m-t-20">
                                        <div class="col-xs-12" style="border: solid 1px;border-radius: 5px;width: 500px;">
                                            <input type="text" name="transaction" id="transaction"  class="form-control" placeholder="Saisissez ici votre n° de ticket personnel" required style="border-bottom: 1px #dbdbdb solid;background: #eee0;color: #af4848;border-radius: 0;font-size: 18px;">
                                        </div>
                                    </div>
                                    <div class="form-group  m-t-20" style="width: 500px;">
                                        <div class="col-xs-12">
                                            <button class="btn" style="background-color: #E09E3A; color: black; font-size: 18px;border-radius: 5px; width: 100%;">Démarrez la visite</button>
                                        </div>
                                    </div>
                                </form>

                                <div align="center" style="width: 500px;">
                                    <div class="col-xs-12">
                                        <p>Powered by Sénégal Séjour & NUMHERIT</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>



</body>
<!-- //Main Container -->
<!-- Footer Container -->


<script>

    $(document).ready(function() {
        $("#message").fadeTo(3500, 500).slideUp(500, function() {
            $("#message").slideUp(500);
        });
    });

</script>



