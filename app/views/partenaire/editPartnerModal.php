<form id="my-form" class="form-inline form-validator" data-type="update" role="form" name="form"
      action="<?= WEBROOT ?>partenaire/updatePartenaire" method="post">
    <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?php echo $this->lang['modification_partenaire']; ?></h4>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="nom" class="control-label"><?php echo $this->lang['nom']; ?></label>
                        <input type="text" id="nom" name="nom" value="<?= $partenaire->nom ?>" class="form-control"
                                style="width: 100%">
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="nom_responsable" class="control-label"><?php echo $this->lang['n_responsable_partenaire']; ?></label>
                        <input type="text" id="nom_responsable" name="nom_responsable" value="<?= $partenaire->nom_responsable ?>" class="form-control"
                                style="width: 100%">
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="email" class="control-label"><?php echo $this->lang['email']; ?></label>
                        <input type="text" id="email" name="email" value="<?= $partenaire->email?> " class="form-control"
                               style="width: 100%">
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="telephone" class="control-label"><?php echo $this->lang['tel']; ?></label>
                        <input type="text" id="telephone" name="telephone" value="<?= $partenaire->telephone ?>" class="form-control"
                               style="width: 100%">
                    </div>

                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="prenom_responsable" class="control-label"><?php echo $this->lang['p_responsable_partenaire']; ?></label>
                        <input type="text" id="prenom_responsable" name="prenom_responsable" value="<?= $partenaire->prenom_responsable ?>" class="form-control"
                                style="width: 100%">
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="email_responsable" class="control-label"><?php echo $this->lang['email_responsable']; ?></label>
                        <input type="text" id="email_responsable" name="email_responsable" readonly value="<?= $partenaire->email_responsable ?> " class="form-control"
                                style="width: 100%">
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="telephone_responsable" class="control-label"><?php echo $this->lang['tel_responsable']; ?></label>
                        <input type="text" id="telephone_responsable" name="telephone_responsable" value="<?= $partenaire->telephone_responsable ?>" class="form-control"
                                style="width: 100%">
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="taux_reduction" class="control-label"><?php echo $this->lang['labTaux']; ?></label>
                        <input type="text" id="taux_reduction" name="taux_reduction" value="<?= $partenaire->taux_reduction ?>" class="form-control"
                                style="width: 100%">
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="entite_id" class="control-label"><?php echo $this->lang['entite'].' (*) :'; ?></label>

                        <select id="entite_id" name="entite_id" required class="form-control" style="width: 100%">
                            <?php foreach ($entite as $oneEntite) { ?>
                                <option value="<?php echo $oneEntite->id; ?>" <?php if ($partenaire->entite_id == $oneEntite->id) echo "selected=selected" ?> > <?php echo $oneEntite->libelle; ?></option>

                            <?php } ?>
                        </select>
                        <span class="help-block with-errors"> </span>
                    </div>
                    <input type="hidden" id="id" name="id" value="<?php echo base64_encode($partenaire->parte)?>" >
                </div>

                <div class="col-sm-3"></div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-success confirm" data-form="my-form" type="submit"><i class="fa fa-check"></i> <?php echo $this->lang['btnValider']; ?>
        </button>
        <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo $this->lang['btnFermer']; ?></button>
    </div>
</form>


