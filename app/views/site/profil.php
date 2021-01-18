<body data-racine="<?= RACINE; ?>" data-webroot="<?= WEBROOT; ?>" data-assets="<?= ASSETS; ?>"  class="common-home res layout-1">
<style>
    .contact-bot .form-contact .form-group input, .contact-bot .form-contact .form-group textarea {
        background: #4b4a4a99;
        border-bottom: 1px #f9f9f9 solid;
        border-radius: 0;
        padding: 0 12px;
        font-size: 14px;
        color: #fff;
    }
    .form-infomation .your-infomation .form-item input {
        width: 100%;
        background: #f8f8f829;
        border-radius: 0;
        padding: 7px 20px;
        font-size: 14px;
        color: #fff;
    }
    .form-infomation .buttons input {
        font-weight: 400;
        text-transform: uppercase;
        font-size: 18px;
        background: #957b5f;
        border-radius: 0;
        padding: 0 30px;
        height: 50px;
        line-height: 50px;
    }
    .form-infomation .your-infomation .form-item label {
        display: block;
        font-size: 14px;
        text-transform: capitalize;
        color: #fff;
    }

</style>
    <div id="wrapper" class="wrapper-fluid banners-effect-10">
        <!-- Header Container  -->
        <?php include("nav.php"); ?>
        <!-- Main Container  -->
        <div id="content" style="margin-bottom: 0;">
            <div class="so-page-builder">
                <section class="section-style1" style="background-image: url('<?= WEBROOT;?>theme/image/tissu2.jpg');padding: 90px 0px 135px 0px;">
                    <div class="main-container container main-require" style="background: #2b2b2b;">
                        <div class="row">
                            <div id="content1" class="col-md-12">
                                <form action="<?=  WEBROOT ?>utilisateur/modifUtilisateurSite" method="post" enctype="multipart/form-data" class="form-infomation clearfix">
                                    <fieldset class="your-infomation clearfix" style="box-shadow: 0 0;">
                                        <!-- code start -->

                                        <!-- code end -->
                                        <h5 style="color: #fff;margin: 0 0 8px 0;font-size: 21px;">MON COMPTE</h5>
                                        <p style="color: #fff">Affichez et éditez vos informations personnelles ci-dessous</p>
                                        <hr>
                                        <div class="form-item item1">
                                            <h4>Email du compte:</h4>
                                            <?= $this->_USER->email;?>&nbsp;&nbsp;
                                            <button type="button" class="open-modal btn" data-modal-controller="utilisateur/updateEmailModal"
                                                                                             data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang['edit_email']; ?>" data-modal-view="utilisateur/updateEmailModal">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" class="open-modal btn" data-modal-controller="utilisateur/updatePassModal"
                                                                                             data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->lang['edit_pass']; ?>" data-modal-view="utilisateur/updatePassModal">
                                                <i class="fa fa-key"></i>
                                            </button>

                                        </div>
                                        <div class="form-item item1">
                                            <label class="control-label" for="input-firstname">Prénom</label>
                                            <input type="text" name="prenom" value="<?= $this->_USER->prenom?>" placeholder="" id="input-firstname">
                                        </div>
                                        <div class="form-item item2">
                                            <label class="control-label" for="input-lastname">Nom de famille</label>
                                            <input type="text" name="nom" value="<?= $this->_USER->nom?>" placeholder="" id="input-lastname">
                                        </div>
                                        <div class="form-item item1">
                                            <label class="control-label" for="input-email">Email de contact</label>
                                            <input type="email" name="email" disabled value="<?= $this->_USER->email?>" placeholder="" id="input-email">
                                        </div>
                                        <div class="form-item item2">
                                            <label class="control-label" for="input-telephone">Téléphone</label>
                                            <input type="tel" name="telephone" value="<?= $this->_USER->telephone?>" placeholder="" id="input-telephone">
                                        </div>
                                        <div class="buttons clearfix">
                                            <input type="submit" value="Actualiser les infos" class="btn btn-primary">
                                        </div>
                                    </fieldset>
                                    <input type="hidden" name="id" value="<?= $this->_USER->id; ?>">
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
