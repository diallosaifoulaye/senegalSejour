<form id="validation" class="form-inline form-validator" data-type="update" role="form" action="<?= WEBROOT ?>utilisateur/updatePass" method="post">

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
                        <input type="password" id="password" name="password" class="form-control" onchange="verifePass(this)" onfocus="verifePass(this)" placeholder="Entrer votre ancien mot de passe"
                               value="" style="width: 100%" required>
                        <span id="msgpassword"></span>
                    </div>

                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="password" class="control-label">Nouveau mot de passe *(6 caracteres au minimum) :</label>
                        <input type="password" id="newpassword" name="newpassword" class="form-control"  placeholder="Entrer votre nouveau mot de passe"
                               value="" style="width: 100%" minlength="6" onkeyup="checkPass(); return false;" required>
                        <span id="msgnewpassword"></span>
                    </div>

                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="password" class="control-label"><?php echo 'Confirmation du nouveau mot de passe'; ?> :</label>
                        <input type="password" id="confirmpassword" name="confirmpassword" class="form-control"  onkeyup="checkPass(); return false;" placeholder="Confirmer votre nouveau mot de passe"
                               value="" style="width: 100%" minlength="6" required>
                        <span id="msgconfirmpassword"></span>
                    </div>

                    <input type="hidden" name="inc" id="inc" disabled value="0">
                    <input type="hidden" name="id" value="<?= $this->_USER->id; ?>">
                    <input type="hidden" name="type_profil" value="<?= $this->_USER->type_profil; ?>">
                </div>
                <div class="col-sm-2"></div>

            </div>
            <div class="row text-center">
                <p id="error" style='color:#F00;display: none; #F00'>Veuillez corriger les erreurs</p>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button class="btn btn-success confirm" data-form="my-form" type="button" id="bouton"><i class="fa fa-check"></i> <?php echo $this->lang['btnValider']; ?>
        </button>
        <button class="btn btn-default" type="button" data-dismiss="modal" ><i class="fa fa-times"></i> <?php echo $this->lang['btnFermer']; ?> </button>
    </div>

</form>

<script>

    function capitalizeFirstLetter(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }
    function checkPass()
    {

        var pass1 = document.getElementById('newpassword');
        var pass2 = document.getElementById('confirmpassword');
        var message = document.getElementById('msgnewpassword');
        var message_ = document.getElementById('msgconfirmpassword');
        var goodColor = "#66cc66";
        var badColor = "#ff6666";

        if(pass1.value.length > 5)
        {
            pass1.style.backgroundColor = goodColor;
            message.style.color = goodColor;
            message.innerHTML = ""
        }
        else
        {
            pass1.style.backgroundColor = badColor;
            message.style.color = badColor;
            message.innerHTML = " Vous devez rentrer au moins 6 caracteres!"
            return;
        }

        if(pass1.value == pass2.value)
        {
            pass2.style.backgroundColor = goodColor;
            message.style.color = goodColor;
            message_.style.color = goodColor;
            message_.innerHTML =""
        }
        else
        {
            pass2.style.backgroundColor = badColor;
            message_.style.color = badColor;
            message_.innerHTML = " Les mots de passe ne correspondent pas."
        }
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
                    if ($("#msgpassword").text() == "" && $("#msgconfirmpassword").text() == "" && $("#msgnewpassword").text() == "" ) {
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

    $( "#bouton" ).click(function( event ) {
        if ($("#msgpassword").text() == "" && $("#msgconfirmpassword").text() == "" && $("#msgnewpassword").text() == "")
        {
            $( "#validation" ).submit()
            $( "#error" ).hide()
        }else {
            $( "#error" ).show()
        }
    })

</script>
