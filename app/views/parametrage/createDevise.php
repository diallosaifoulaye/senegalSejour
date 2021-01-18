<form id="validation" class="form-inline form-validator" data-type="update" role="form" action="<?= WEBROOT ?>parametrage/<?= ((isset($devise->id)) ? "edit" : "create") ?>" method="post">

    <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?= ((isset($devise->id)) ? $this->lang['devise_edit'] : $this->lang['devise_new']) ; ?></h4>
    </div>

    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="label" class="control-label"><?php echo $this->lang['libelle']; ?></label>
                        <input type="text" id="libelle" name="libelle" class="form-control" placeholder="<?php echo $this->lang['libelle']; ?>"
                               value="<?= $devise->libelle; ?>" style="width: 100%" required>
                        <span class="help-block with-errors"> </span>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="label" class="control-label"><?php echo $this->lang['valeur']; ?></label>
                        <input type="number" id="libelle" name="valeur" class="form-control" placeholder="<?php echo $this->lang['valeur']; ?>"
                               value="<?= $devise->valeur; ?>" style="width: 100%" required>
                        <span class="help-block with-errors"> </span>
                    </div>
                    <?php if(isset($devise->id)) {  ?> <input type="hidden" name="id" value="<?= $devise->id; ?>"><?php } ?>
                </div>
                <div class="col-sm-3"></div>

            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button class="btn btn-success confirm" data-form="my-form" type="submit"><i class="fa fa-check"></i> <?php echo $this->lang['btnValider']; ?>
        </button>
        <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo $this->lang['btnFermer']; ?> </button>
    </div>

</form>