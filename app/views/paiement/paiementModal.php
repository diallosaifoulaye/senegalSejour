<form id="validation" class="form-inline form-validator" data-type="update" role="form" action="<?= WEBROOT ?>paiement/<?= ((isset($paiement->id)) ? "modifPaiement" : "ajoutPaiement") ?>" method="post">

    <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?= ((isset($paiement->id)) ? $this->lang['update_ModePaiement'] : $this->lang['ajout_ModePaiement']) ; ?></h4>

    </div>

    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-md-8">
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="libelle" class="control-label"><?php echo $this->lang['labModePaiement']; ?> :</label>
                        <input type="text" id="libelle" name="libelle" class="form-control" placeholder="<?php echo $this->lang['labModePaiement']; ?>"
                               value="<?= $paiement->libelle; ?>" style="width: 100%" required>
                    </div>
                    <?php if(isset($paiement->id)){  ?> <input type="hidden" name="id" value="<?= $paiement->id; ?>"><?php } ?>
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