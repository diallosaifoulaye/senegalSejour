<?php include(ROOT."app/views/template/header_ep.php"); ?>
<style>
    .new-login-register, .new-login-box {
        margin: auto;
        width: 400px;
    }
    .white-box {
        background: #fff0;
        padding: 25px;
        margin-bottom: 30px;
    }

    .new-login-register .new-login-box .new-lg-form {
        padding-top: 20px;
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

    /*@media screen and  (max-width: 700px) {*/
    /*    #custom-form-padding{*/
    /*        padding-top: 200px !important;*/
    /*    }*/
    /*}*/
    @media screen and  (max-width: 375px) {
        #custom-form-padding{
            padding-top: 170px !important;
        }
        .new-lg-form{
            width: 333px !important;
        }
    }

    @media screen and (max-width: 320px) {
        #custom-form-padding{
            padding-top: 170px !important;
        }
        .new-lg-form{
            width: 270px !important;
        }
        #custom-white-box{
            width: 300px !important;
        }
    }
</style>
<body data-racine="<?= RACINE; ?>" data-webroot="<?= WEBROOT; ?>" data-assets="<?= ASSETS; ?>"  class="common-home res layout-1" style="background-color: #2B2B2B;">
<div id="wrapper" class="wrapper-fluid banners-effect-10">
    <!-- Main Container  -->
    <div id="content" style="margin-bottom: 0;">
        <div class="so-page-builder">
            <section class="section-style1" id="contact" >
                <div class="container page-builder-ltr">
                    <div id="custom-form-padding" class="row row-style row_a1" style="padding-top: 100px;">
                        <div class="new-login-box">
                            <div id="custom-white-box" class="white-box">
                                <h3 class="box-title m-b-0"><?= $this->lang['connect']; ?></h3>
                                <form class="form-horizontal new-lg-form" id="loginform" action="<?= WEBROOT ?>home/login" method="post" enctype="multipart/form-data">

                                    <?php //echo $this->messageEnvoye; exit;
                                    //var_dump($messageAddMembre);die;
                                    if (isset($messageEnvoye) or isset($updatePassword) or isset($emailNonExistant) or isset($updateEmail)){ ?>
                                        <div class="alert alert-success" role="alert" id="message">
                                            <?php echo $messageEnvoye; echo $updatePassword; echo $emailNonExistant; echo $updateEmail;?>
                                        </div>
                                    <?}?>

                                    <?php if ($message) { ?>
                                        <div class="form-group text-center m-t-20">
                                            <div class="col-xs-12" id="msg1">
                                                <label id="msg" style="color: red" ><?php echo $message;?></label>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <?php if (isset($messageAddMembre) or isset($messageEchec) ){ ?>
                                        <div class="alert alert-success" role="alert" id="message">
                                            <?php echo $messageAddMembre; echo $messageEchec;?>
                                        </div>
                                    <?php } ?>


                                    <div class="form-group  m-t-20">
                                        <div class="col-xs-12">
                                            <input type="text" name="login" value="" class="form-control" placeholder="Email" required style="border-bottom: 1px #dbdbdb solid;background: #eee0;color: #fff;border-radius: 0;">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <input type="password" name="password" value="" class="form-control" placeholder="Mot de passe" required style="border-bottom: 1px #dbdbdb solid;background: #eee0;color: #fff;border-radius: 0;">

                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 0;">
                                        <a href="javascript:password(this.value)" title="Face Book" style="text-decoration: underline;padding-left: 15px;" id="forgotPassword" value="forget"><?= $this->lang['mdp_forget']; ?></a>

                                    </div>

                                   <!-- <div class="g-recaptcha form-group" data-sitekey="6LdYEtwZAAAAAF8wLsQ9oErvpaGpQCPa2ftSnJN_" ></div>-->

                                    <div class="form-group text-center m-t-20">
                                        <div class="col-xs-12">
                                            <button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="submit" style="background: #c6a47e;margin-top: 16px;"><?= $this->lang['connect']; ?></button>
                                        </div>
                                    </div>


                                    <div class="form-group m-b-0">
                                        <div class="col-sm-12 text-center">
                                            <p>Vous n'avez pas de compte? <a href="<?= WEBROOT ?>home/register" class="text-primary m-l-5"><b style="color: #C6A47E;">S'inscrire</b></a></p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section-style1" id="forgotPwd" style="display: none">
                <div class="container page-builder-ltr">
                    <div class="row row-style row_a1" style="padding-top: 300px;">

                        <div class="new-login-box">
                            <div class="white-box">
                                <h3 class="box-title m-b-0"><?= $this->lang['connect']; ?></h3>
                                <form class="form-horizontal new-lg-form" id="loginform" action="<?= WEBROOT ?>home/receptionMail" method="post" enctype="multipart/form-data">

                                    <div class="form-group  m-t-20">
                                        <div class="col-xs-12">
                                            <input type="email" name="email" value="" class="form-control" placeholder="Email" required style="border-bottom: 1px #dbdbdb solid;background: #eee0;color: #fff;border-radius: 0;">

                                        </div>
                                    </div>
                                    <div class="form-group text-center m-t-20">
                                        <div class="col-xs-12">
                                            <button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="submit" style="background: #c6a47e;margin-top: 16px;">Valider</button>
                                            <a href="<?= WEBROOT ?>home/loginpage" class="previous">&laquo; Retour</a>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<?php /*include(ROOT."app/views/template/footer_ep.php"); */?>


</body>
<!-- //Main Container -->
<!-- Footer Container -->
 <footer class="footer-container typefooter-1">
       <div class="footer-bottom ">
           <div class="container">
               <div class="row">
                   <div class="col-md-6 col-sm-6 copyright">
                       Sénégal Séjour ©2020. by <a href="#" target="_blank">Numherit</a>
                   </div>
                   <div class="col-md-6 col-sm-6 social">
                       <h3>Suivez-nous:</h3>
                       <ul>
                           <li><a href=#" title="Face Book"><span class="fa fa-facebook"></span></a></li>
                           <li><a href="#" title="Instagram"><span class="fa fa-instagram"></span></a></li>
                       </ul>
                   </div>
               </div>
           </div>
       </div>
   </footer>

<!--<script src="https://www.google.com/recaptcha/api.js" async defer></script>-->
<script>
    function password(){
        var link = document.getElementById('forgotPassword');
        var  changePassword = link.getAttribute('value');

        if (changePassword == 'forget'){
            document.getElementById("contact").style.display = "none";
            document.getElementById("forgotPwd").style.display = "block";

        }
    }

    $(document).ready(function() {
        $("#message").fadeTo(3500, 500).slideUp(500, function() {
            $("#message").slideUp(500);
        });
    });

</script>

