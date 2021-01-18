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
</style>
<body data-racine="<?= RACINE; ?>" data-webroot="<?= WEBROOT; ?>" data-assets="<?= ASSETS; ?>"  class="common-home res layout-1" style="background-color: #2B2B2B;">
<div id="wrapper" class="wrapper-fluid banners-effect-10">
    <!-- Main Container  -->
    <div id="content" style="margin-bottom: 0;">
        <div class="so-page-builder">
            <section class="section-style1" id="contact">
                <div class="container page-builder-ltr">
                    <div class="row row-style row_a1" style="padding-top: 300px;">
                        <div class="new-login-box">
                            <div class="white-box">
                                <h3 class="box-title m-b-0"><?= $this->lang['connect']; ?></h3>
                                <form action="<?= WEBROOT ?>scan/login" method="post" enctype="multipart/form-data" class="form-horizontal new-lg-form" >
                                    <div class="form-group m-t-20 required">
                                        <div class="col-xs-12">
                                            <input type="text" name="login" value="" class="form-control" placeholder="Email" required style="border-bottom: 1px #dbdbdb solid;background: #eee0;color: #fff;border-radius: 0;">
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <div class="col-xs-12">
                                            <input type="password" name="password" value="" class="form-control" required placeholder="Mot de passe" style="border-bottom: 1px #dbdbdb solid;background: #eee0;color: #fff;border-radius: 0;">
                                        </div>
                                    </div>
                                    <div class="form-group text-center m-t-20">
                                        <div class="col-xs-12">
                                            <button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="submit" style="background: #c6a47e;margin-top: 16px;"><?= $this->lang['connect']; ?></button>
                                        </div>
                                        <?php if(isset($code)) { ?> <input type="hidden" name="code" value="<?= $code; ?>"><?php } ?>
                                    </div>
                                </form>
                                <div class="text-center">
                                    <span style="font-size: medium; color: red;"> <?php echo $message ;?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- //Main Container -->
    <!-- Footer Container -->

    <?php include(ROOT."app/views/template/footer_ep.php"); ?>
