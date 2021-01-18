<form id="validation" class="form-inline form-validator" data-type="update" role="form">

    <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?= $this->lang['details_formule']; ?></h4>

    </div>

    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border"><h3 class="box-title text-center"><?= $this->lang['details_formule']; ?></h3></legend>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="col-md-4"><span style="font-weight: bold;" ><?php echo $this->lang['labFormule']; ?></span>:</label>
                            <div class="col-md-7">
                                <p class="form-control-plaintext"> <?= $formule->libelle; ?> </p>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <label class="col-md-4"><span style="font-weight: bold;" ><?php echo $this->lang['labMontant']; ?></span>:</label>
                            <div class="col-md-7">
                                <p class="form-control-plaintext"> <?= $formule->montant; ?> </p>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    <div class="row">
                        <div class="col-md-6">
                            <label class="control-label col-md-4"><span style="font-weight: bold;" ><?php echo $this->lang['labTypeDuree']; ?></span>:</label>
                            <div class="col-md-7">
                                <p class="form-control-plaintext"> <?= $formule->type_duree; ?> </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label col-md-4"><span style="font-weight: bold;" ><?php echo $this->lang['labDuree']; ?></span>:</label>
                            <div class="col-md-7">
                                <p class="form-control-plaintext"> <?= $formule->duree; ?> </p>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    <div class="row">
                        <div class="col-md-6">
                            <label class="control-label col-md-4"><span style="font-weight: bold;" ><?php echo $this->lang['labDescription']; ?></span>:</label>
                            <div class="col-md-7">
                                <p class="form-control-plaintext"> <?= $formule->description; ?> </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border"><h3 class="box-title text-center"><?= $this->lang['labAvantages']; ?></h3></legend>
                            <ul>
                                <?php
                                foreach ($avantages  as $avantage ) {?>

                                    <div class="col-md-12">
                                        <li>
                                            <p class="form-control-plaintext"> <?= $avantage->libelle; ?> </p>
                                        </li>
                                    </div>
                                    <?php
                                }
                                ?>
                            </ul>
                        </fieldset>
                    </div>
                </fieldset>


            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo $this->lang['btnFermer']; ?> </button>
    </div>

</form>

