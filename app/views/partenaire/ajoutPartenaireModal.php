
<form id="validation" class="form-inline form-validator" data-type="update" role="form" name="form"
      action="<?= WEBROOT ?>partenaire/ajoutPartenaire" method="post" enctype="multipart/form-data">
    <div class="modal-header" id="header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?php echo $this->lang['ajoutPartenaire']; ?></h4>
    </div>
    <div class="modal-body" id="modal">

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6" id="formulaire">

                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="email_responsable" class="control-label"><?php echo $this->lang['email_responsable'].' (*) :'; ?></label>
                        <input type="text" id="email_responsable" required onchange="verifeDoublon(this)" oninput="verifeDoublon(this)" name="email_responsable" class="form-control" placeholder="<?php echo $this->lang['email_responsable']; ?>"
                               style="width: 100%">
                        <span id="msg"></span>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="prenom_responsable" class="control-label"><?php echo $this->lang['p_responsable_partenaire'].' (*) :'; ?></label>
                        <input type="text" id="prenom_responsable" name="prenom_responsable" required class="form-control" placeholder="<?php echo $this->lang['p_responsable_partenaire']; ?>"
                               style="width: 100%">
                        <span class="help-block with-errors"> </span>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="nom_responsable" class="control-label"><?php echo $this->lang['n_responsable_partenaire'].' (*) :'; ?></label>
                        <input type="text" id="nom_responsable" name="nom_responsable" required class="form-control" placeholder="<?php echo $this->lang['n_responsable_partenaire']; ?>"
                               style="width: 100%">
                        <span id="msg2"></span>
                        <span class="help-block with-errors"> </span>
                    </div>

                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="nom" class="control-label"><?php echo $this->lang['tel_responsable'].' (*) :'; ?></label>
                        <input type="tel" id="telephone_responsable" required name="telephone_responsable" class="form-control" placeholder="<?php echo $this->lang['tel_responsable']; ?>"
                               style="width: 100%">
                        <span class="help-block with-errors"> </span>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="nom" class="control-label"><?php echo $this->lang['nom_partenaire'].' (*) :'; ?></label>
                        <input type="text" id="nom" name="nom" class="form-control" required placeholder="<?php echo $this->lang['nom_partenaire']; ?>"
                               style="width: 100%">
                        <span class="help-block with-errors"> </span>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="email" class="control-label"><?php echo $this->lang['email_partenaire'].' (*) :'; ?></label>
                        <input type="text" id="email" name="email" class="form-control" required placeholder="<?php echo $this->lang['email_partenaire']; ?>"
                               style="width: 100%">
                        <span class="help-block with-errors"> </span>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="telephone" class="control-label"><?php echo $this->lang['tel_partenaire'].' (*) :'; ?></label>
                        <input type="tel" id="telephone" name="telephone" required class="form-control" placeholder="<?php echo $this->lang['tel_partenaire']; ?>"
                               style="width: 100%">
                        <span class="help-block with-errors"> </span>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="nom" class="control-label"><?php echo $this->lang['labTaux'].' (*) :'; ?></label>
                        <input type="number" id="taux_reduction" name="taux_reduction" required class="form-control" placeholder="<?php echo $this->lang['taux_reduction']; ?>"
                               style="width: 100%">
                        <span class="help-block with-errors"> </span>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="entite_id" class="control-label"><?php echo $this->lang['entite'].' (*) :'; ?></label>

                        <select id="entite_id" name="entite_id" required class="form-control" style="width: 100%">
                            <option value=""> Selectionnez le type d'entité</option>

                            <?php foreach ($entite as $oneEntite) { ?>
                                <option value="<?php echo $oneEntite->id; ?>"> <?php echo $oneEntite->libelle; ?></option>
                            <?php } ?>
                        </select>
                        <span class="help-block with-errors"> </span>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="adresse" class="control-label"><?php echo $this->lang['adresse_partenaire'].' (*) :'; ?></label>
                        <textarea class="form-control" id="adresse" required name="adresse" placeholder="<?php echo $this->lang['adresse_partenaire']; ?>" style="margin: 0px; width: 374px; height: 70px;"></textarea>
                        <span class="help-block with-errors"> </span>
                    </div>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </div>
<!--        <input type="hidden" id="code" name="code">-->
<!--        <input type="hidden" id="id_user" name="id_user">-->
    </div>
    <div class="modal-footer" id="footer">
        <button class="btn btn-success confirm" data-form="my-form" id="valider" type="submit"><i class="fa fa-check"></i> <?php echo $this->lang['btnValider']; ?>
        </button>
        <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo $this->lang['btnFermer']; ?> </button>
    </div>
</form>


<script>

    $('input[type="tel"]').intlTelInput({
        utilsScript: '<?= ASSETS;?>plugins/telPlug/js/utils.js',
        autoPlaceholder: true,
        preferredCountries: [ 'sn', 'gn', 'gm', 'gb','ci'],
        initialDialCode: true,
        nationalMode: false
    });

    function verifeDoublon(element) {
        var nom = 'email' ;
        var valeur = element.value ;
        $('#code').val("")
        $.ajax({
            type: 'POST',
            data:{ champ : nom, valeur:valeur },
            url: '<?php echo WEBROOT ?>partenaire/verifie',
            success: function(data) {
                var donnee = JSON.parse(data);
                console.log(donnee)
                if (donnee.code === -1 ) {
                    $('#msg').html("<p style='color:#F00;display: inline; #F00'>Cet email est déjà utilisé</p>");
                    $("#valider").attr('disabled','disabled');
                }
                else {
                    $('#code').val(2)
                    $('#msg').html("");
                    $("#valider").removeAttr('disabled');
                }
            },
            error: function() {
                alert('no')
                alert('La requête n\'a pas abouti'); }

        });

        //alert(name+' '+value);  \app\core\Utils::ConvNumberLetter($transactT[0]->mnt,'','')
    }

</script>