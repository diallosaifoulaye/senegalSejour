
<form id="validation" class="form-inline form-validator" data-type="update" role="form" name="form"
      action="<?= WEBROOT ?>reporting/receptionChoix" method="post" enctype="multipart/form-data">
    <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?php echo $this->lang['choixPartenaire']; ?></h4>
    </div>
    <div class="modal-body">

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">

                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="partenaire" class="control-label"><?php echo $this->lang['partenaire'].' (*) :'; ?></label>
                        <select id="partenaire" name="partenaire" class="form-control select2" style="width: 100%" required>
                            <option value=""> <?php echo $this->lang["selectionnerUnPartenaire"]?></option>

                            <?php foreach ($partenaires as $partenaire) { ?>
                                <option value="<?php echo $partenaire->id; ?>"> <?php echo $partenaire->nom; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-success confirm" data-form="my-form" id="valider" type="submit"><i class="fa fa-check"></i> <?php echo $this->lang['btnValider']; ?>
        </button>
        <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo $this->lang['btnFermer']; ?> </button>
    </div>
</form>
