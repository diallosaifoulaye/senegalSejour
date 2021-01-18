<form id="validation" class="form-inline form-validator" data-type="update" role="form" action="<?= WEBROOT ?>formule/<?= ((isset($formule->id)) ? "modifFormule" : "ajoutFormule") ?>" method="post">

    <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?= ((isset($formule->id)) ? $this->lang['update_Formule'] : $this->lang['ajout_Formule']) ; ?></h4>

    </div>

    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="type_formule" class="control-label"><?php echo $this->lang['types_formule'].' (*) :'; ?></label>

                        <select id="type_formule" name="type_formule" required class="form-control" style="width: 100%">
                            <option value=""> Selectionnez le type de formule</option>

                            <?php foreach ($type_formule as $oneEntite) { ?>
                                <option value="<?php echo $oneEntite->id; ?>" <?php if ($formule->type_formule == $oneEntite->id) echo "selected=selected" ?>> <?php echo $oneEntite->libelle; ?></option>
                            <?php } ?>
                        </select>
                        <span class="help-block with-errors"> </span>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="libelle" class="control-label"><?php echo $this->lang['labFormule']; ?> (*) :</label>
                        <input type="text" id="libelle" name="libelle" class="form-control" placeholder="<?php echo $this->lang['labFormule']; ?>"
                               value="<?= $formule->libelle; ?>" style="width: 100%" required>
                        <span class="help-block with-errors"> </span>
                    </div>

                    <label for="type_duree" class="control-label"><?php echo $this->lang['exclusivite_partenaire']; ?> (*) :</label>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label class="radio-inline">
                            <input type="radio" name="exclusive" value="0" checked required <?php echo ($formule->exclusive == "0" ? "checked" : " ");?> ><?php echo $this->lang['non']; ?>
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="exclusive" value="1" required <?php echo ($formule->exclusive == "1" ? "checked" : " ");?> ><?php echo $this->lang['oui']; ?>
                        </label>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="montant" class="control-label"><?php echo $this->lang['labMontant']; ?>  (<?php echo $this->lang['currency_cfa']; ?>) (*) :</label>
                        <input type="number" id="montant" name="montant" class="form-control" min="0" placeholder="<?php echo $this->lang['labMontant']; ?>"
                               value="<?= $formule->montant; ?>" style="width: 100%" required>
                        <span class="help-block with-errors"> </span>
                    </div>

                   <!-- <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="montant_devise" class="control-label"><?php /*echo $this->lang['montant_devise']; */?>  (<?php /*echo $this->lang['currency_euro']; */?>) (*) :</label>
                        <input type="number" id="montant_devise" name="montant_devise" class="form-control" placeholder="<?php /*echo $this->lang['montant_devise']; */?>"
                               value="<?/*= $formule->montant_devise; */?>" style="width: 100%" required>
                        <span class="help-block with-errors"> </span>
                    </div>-->
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="description" class="control-label"><?php echo $this->lang['labDescription']; ?> (*) :</label>
                        <input type="text" id="description" name="description" class="form-control" placeholder="<?php echo $this->lang['labDescription']; ?>"
                               value="<?= $formule->description; ?>" style="width: 100%" required>
                        <span class="help-block with-errors"> </span>
                    </div>
                    <label for="type_duree" class="control-label"><?php echo $this->lang['labTypeDuree']; ?> (*) :</label>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label class="radio-inline">
                            <input type="radio" name="type_duree" value="MOIS" required <?php echo ($formule->type_duree == "MOIS" ? "checked" : " ");?> ><?php echo $this->lang['mois']; ?>
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="type_duree" value="ANNEES" required <?php echo ($formule->type_duree == "ANNEES" ? "checked" : " ");?> ><?php echo $this->lang['annees']; ?>
                        </label>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="duree" class="control-label"><?php echo $this->lang['labDuree']; ?> (*) :</label>
                        <input type="number" id="duree" name="duree" min="1" class="form-control" placeholder="<?php echo $this->lang['labDuree']; ?>"
                               value="<?= $formule->duree; ?>" style="width: 100%" required>
                        <span class="help-block with-errors"> </span>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="nombre_point" class="control-label"><?php echo $this->lang['labNbrPoint']; ?> (*)</label>
                        <input type="number" id="nombre_point" min="0" name="nombre_point" class="form-control" placeholder="<?php echo $this->lang['labNbrPoint']; ?>"
                               value="<?= $formule->nombre_point; ?>" style="width: 100%" required>
                        <span class="help-block with-errors"> </span>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label  class="control-label" style="margin-bottom: 5px;"><?php echo $this->lang['labAvantages']; ?> :</label>
                        <diw class="row">
                            <?php
                                if (isset($formule_avantages)){
                                    foreach ($avantages  as $avantage ) {?>

                                            <div class="col-md-6">
                                                <input class="form-check-input" type="checkbox"
                                                       value="<?php echo $avantage->id; ?>" name="avantages[]"
                                                       id="Check_<?php echo $avantage->id; ?>"
                                                    <?php
                                                        foreach ( $formule_avantages as  $formule_avantage ) {
                                                            echo ($formule_avantage->avantage_id == $avantage->id ? "checked" : " ");
                                                        }
                                                         ?>
                                                >
                                                <label class="form-check-label" for="Check_<?php echo $avantage->id; ?>">
                                                    <?php echo $avantage->libelle; ?>
                                                </label>
                                            </div>
                                            <?php
                                    }
                                }else{
                                    foreach ($avantages as $avantage) { ?>
                                        <div class="col-md-6">
                                            <input class="form-check-input" type="checkbox"
                                                   value="<?php echo $avantage->id; ?>" name="avantages[]"
                                                   id="Check_<?php echo $avantage->id; ?>">
                                            <label class="form-check-label" for="Check_<?php echo $avantage->id; ?>">
                                                <?php echo $avantage->libelle; ?>
                                            </label>
                                        </div>
                                        <?php
                                    }
                                }
                            ?>
                        </diw>
                    </div>


                    <?php if(isset($formule->id)){  ?> <input type="hidden" name="id" value="<?= $formule->id; ?>"><?php } ?>
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