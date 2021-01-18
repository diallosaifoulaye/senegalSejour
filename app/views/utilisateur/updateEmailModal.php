<form id="validation" class="form-inline form-validator" data-type="update" role="form" action="<?= WEBROOT ?>utilisateur/updateEmail" method="post">

    <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?= $this->lang['modif_email']; ?></h4>

    </div>

    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-md-8">
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="password" class="control-label"><?php echo 'Entrer votre mot de passe'; ?> :</label>
                        <input type="password" id="password" name="password" class="form-control" onchange="verifePass(this)" placeholder="Entrer votre mot de passe"
                               value="" style="width: 100%" required>
                        <span id="msgpassword"></span>
                    </div>

                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="email" class="control-label"><?php echo 'Entrez votre nouveau email'; ?> :</label>
                        <input type="text" id="email" name="email" class="form-control" onchange="verifeDoublon(this)" oninput="verifeDoublon(this)" placeholder="Entrez votre nouveau email"
                                style="width: 100%"  required>
                        <span id="msgemail"></span>
                    </div>

                    <input type="hidden" name="id" value="<?= $this->_USER->id; ?>">
                    <input type="hidden" name="type_profil" value="<?= $this->_USER->type_profil; ?>">
                </div>
                <div class="col-sm-2"></div>

            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button class="btn btn-success confirm" data-form="my-form" type="submit" id="bouton"><i class="fa fa-check"></i> <?php echo $this->lang['btnValider']; ?>
        </button>
        <button class="btn btn-default" type="button" data-dismiss="modal" ><i class="fa fa-times"></i> <?php echo $this->lang['btnFermer']; ?> </button>
    </div>

</form>

<script>

    function capitalizeFirstLetter(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }

    function verifePass(element) {
        // alert(element) ;
        var nom = element.name ;
        var valeur = element.value ;
        $.ajax({
            type: 'POST',
            data:{ champ : nom, valeur:valeur, id: <?= $this->_USER->id; ?> },
            url: '<?php echo WEBROOT ?>utilisateur/verifiePass',
            success: function(data) {
                var donnees = JSON.parse(data);
                if (parseInt(donnees) == 1) {
                    $('#msg'+nom).html("");
                    if ($("#msgpassword").text() == "" && $("#msgemail").text() == "" ) {
                        $("#bouton").removeAttr('disabled');
                    }else {
                        $("#bouton").attr('disabled','disabled');
                    }
                }
                else {
                    $('#msg'+nom).html("<p style='color:#F00;display: inline; #F00'>Mot de passe incorrect</p>");
                    $("#bouton").attr('disabled','disabled');
                }
            },
            error: function() {
                alert('La requête n\'a pas abouti'); }

        });
        //alert(name+' '+value);  \app\core\Utils::ConvNumberLetter($transactT[0]->mnt,'','')
    }

    function verifeDoublon(element) {
        // alert(element) ;
        var nom = element.name ;
        var valeur = element.value ;
        $.ajax({
            type: 'POST',
            data:{ champ : nom, valeur:valeur },
            url: '<?php echo WEBROOT ?>utilisateur/verifie',
            success: function(data) {
                var donnees = JSON.parse(data);
                if (parseInt(donnees) == 0) {
                    $('#msg'+nom).html("");
                    if ($("#msgpassword").text() == "" && $("#msgemail").text() == "" ) {
                        $("#bouton").removeAttr('disabled');
                    }else {
                        $("#bouton").attr('disabled','disabled');
                    }
                }
                else {
                    $('#msg'+nom).html("<p style='color:#F00;display: inline; #F00'>"+capitalizeFirstLetter(nom)+" est déjà utilisé</p>");
                    $("#bouton").attr('disabled','disabled');
                }
            },
            error: function() {
                alert('La requête n\'a pas abouti'); }

        });
        //alert(name+' '+value);  \app\core\Utils::ConvNumberLetter($transactT[0]->mnt,'','')
    }
</script>