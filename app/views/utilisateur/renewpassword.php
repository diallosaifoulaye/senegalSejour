<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="row white-box" style="margin-top:0px; margin-bottom: 4px">
                <div class="col-lg-2 col-sm-6 bg-theme text-white"
                     style="height: 40px; vertical-align: middle; padding-top:10px;background-color: #325186 !important;">
                    <center><b>A la une SunuSVA</b></center>
                </div>
                <div class="col-lg-10 col-sm-6 annulation">
                    <marquee>
                        <a href="">

                        </a>
                    </marquee>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="white-box">
                    <form method="post" action="<?php echo WEBROOT ?>utilisateur/saveNewPassword"
                          id="formDegagementfonds">
                        <fieldset style="display: block;" class="scheduler-border">
                            <legend class="scheduler-border"><?= $this->lang['edit_pwd']; ?></legend>

                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-6">
                                        <div class="form-group" style="width: 100%;padding: 10px;">
                                            <label for="oldpwd" class="control-label"><?php echo $this->lang['edit_pwd1']; ?></label>
                                            <input type="text" id="oldpwd" name="oldpwd" class="form-control" placeholder="<?php echo $this->lang['edit_pwd1']; ?>"
                                                   style="width: 100%" required>
                                            <span class="help-block with-errors"> </span>
                                        </div>
                                        <div class="form-group" style="width: 100%;padding: 10px;">
                                            <label for="newpwd" class="control-label"><?php echo $this->lang['edit_pwd2']; ?></label>
                                            <input type="text" id="newpwd" name="newpwd" class="form-control" placeholder="<?php echo $this->lang['edit_pwd2']; ?>"
                                                   style="width: 100%" required>
                                            <span class="help-block with-errors"> </span>
                                        </div>
                                        <div class="form-group" style="width: 100%;padding: 10px;">
                                            <label for="confirmpwd" class="control-label"><?php echo $this->lang['edit_pwd3']; ?></label>
                                            <input type="text" id="confirmpwd" name="confirmpwd" class="form-control" placeholder="<?php echo $this->lang['edit_pwd3']; ?>"
                                                   style="width: 100%" required>
                                            <span class="help-block with-errors"> </span>
                                        </div>
                                        <input type="hidden" name="id" value="<?= $rowid; ?>">
                                    </div>
                                    <div class="col-sm-3"></div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <button class="btn btn-success confirm" data-form="my-form" type="submit"><i class="fa fa-check"></i> <?php echo $this->lang['btnValider']; ?>
                                        </button>
                                        <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo $this->lang['btnFermer']; ?> </button>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>