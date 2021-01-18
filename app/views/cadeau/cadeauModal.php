<form id="validation" class="form-inline form-validator" data-type="update" role="form" action="<?= WEBROOT ?>cadeau/<?= ((isset($cadeaux->id)) ? "modifCadeau" : "ajoutCadeau") ?>" method="post">

    <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?= ((isset($cadeaux->id)) ? $this->lang['update_Cadeau'] : $this->lang['ajout_Cadeau']) ; ?></h4>

    </div>

    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-md-8">
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="nb_point" class="control-label"><?php echo $this->lang['labNbrPoint']; ?> :</label>
                        <input type="number" id="nb_point" name="nb_point" class="form-control" placeholder="<?php echo $this->lang['labNbrPoint']; ?>"
                               value="<?= $cadeaux->nb_point; ?>" style="width: 100%" required>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="cadeau" class="control-label"><?php echo $this->lang['labCadeau']; ?> :</label>
                        <input type="text" id="cadeau" name="cadeau" class="form-control" placeholder="<?php echo $this->lang['labCadeau']; ?>"
                               value="<?= $cadeaux->cadeau; ?>" style="width: 100%" required>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label class="radio-inline">
                            <input type="radio" name="en_temps" value="JOURS" required <?php echo ($cadeaux->en_temps == "JOURS" ? "checked" : " ");?> ><?php echo $this->lang['jours']; ?>
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="en_temps" value="MOIS" required <?php echo ($cadeaux->en_temps == "MOIS" ? "checked" : " ");?> ><?php echo $this->lang['mois']; ?>
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="en_temps" value="ANNEES" required <?php echo ($cadeaux->en_temps == "ANNEES" ? "checked" : " ");?> ><?php echo $this->lang['annees']; ?>
                        </label>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="cadeau" class="control-label"><?php echo $this->lang['validite']; ?> :</label>
                        <input type="number" id="validite" name="validite" class="form-control" placeholder="<?php echo $this->lang['validite']; ?>"
                               value="<?= $cadeaux->validite; ?>" style="width: 100%" required>
                    </div>

                    <?php if(isset($cadeaux->id)){  ?> <input type="hidden" name="id" value="<?= $cadeaux->id; ?>"><?php } ?>
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