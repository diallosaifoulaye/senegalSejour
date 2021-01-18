
<form id="validation" class="form-inline form-validator" data-type="update" role="form" action="<?= WEBROOT ?>utilisateur/<?= ((isset($utilisateur->id)) ? "modifUtilisateur" : "ajoutUtilisateur") ?>" method="post">

    <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?= ((isset($utilisateur->id)) ? $this->lang['btnEditUser'] : $this->lang['btnAjouterUtilisateur']) ?></h4>
    </div>

    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <!--<div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="type_profil" class="control-label"><?php /*echo $this->lang['profils'].'   (*)'; */?></label>
                        <select name="type_profil" id="type_profil" class="form-control select2" style="width: 100%" onchange="authorized(this.value);">
                            <option value=""><?php /*echo $this->lang['select_profil']; */?></option>
                            <?php /*foreach ($profil as $item) { */?>
                                <option <?/*= ($utilisateur->type_profil == $item->id) ? "selected" : "" */?> value="<?/*= $item->id */?>"><?/*= $item->profil */?></option>
                            <?php /*} */?>
                        </select>
                        <span class="help-block with-errors"> </span>
                    </div>-->

                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="email" class="control-label"><?php echo $this->lang['labemail']; ?> (*)</label>
                        <input type="email" id="email" onchange="verifeDoublon(this)" name="email" class="form-control" placeholder="<?php echo $this->lang['labemail']; ?>"
                               value="<?= $utilisateur->email; ?>" style="width: 100%" required>
                        <span id="msgemail"></span>
                    </div>

                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="prenom" class="control-label"><?php echo $this->lang['labprenom']; ?> (*)</label>
                        <input type="text" id="prenom" name="prenom" class="form-control" placeholder="<?php echo $this->lang['labprenom']; ?>"
                               value="<?= $utilisateur->prenom; ?>" style="width: 100%" required>
                        <span class="help-block with-errors"> </span>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="nom" class="control-label"><?php echo $this->lang['labnom']; ?> (*)</label>
                        <input type="text" id="nom" name="nom" class="form-control" placeholder="<?php echo $this->lang['labnom']; ?>"
                               value="<?= $utilisateur->nom; ?>" style="width: 100%" required>
                        <span class="help-block with-errors"> </span>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="telephone" class="control-label"><?php echo $this->lang['telephone']; ?> (*)</label>
                        <input type="number" id="telephone" name="telephone" onchange="verifeDoublon(this)" class="form-control" placeholder="<?php echo $this->lang['telephone']; ?>"
                               value="<?= $utilisateur->telephone; ?>" style="width: 100%" required>
                        <span id="msgtelephone"></span>
                    </div>

                    <?php if(isset($utilisateur->id)) { ?> <input type="hidden" name="id" value="<?= $utilisateur->id; ?>"><?php } ?>
                    <?php if(!isset($utilisateur->id)) { ?> <input type="hidden" id="flag_authorized" name="flag_authorized"> <?php } ?>
                </div>
                <div class="col-sm-3"></div>

            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button class="btn btn-success confirm" data-form="my-form" type="submit"><i class="fa fa-check"></i> <?php echo $this->lang['btnValider']; ?></button>
        <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo $this->lang['btnFermer']; ?> </button>
    </div>

</form>
<script>
    $(".select2").select2();
</script>
<script>

    function authorized(a) {
        console.log('0==> '+a);
        if (parseInt(a) !== 2 && parseInt(a) !== 3){
            $("#flag_authorized").val('1');
            $("#codecollecteur").css("display","none");
            $("#code_collecteur").removeAttr("name");
        }
        if (parseInt(a) === 2){
            console.log('1==> '+a);
            $("#flag_authorized").val('0');
            $("#codecollecteur").css("display","block");
        }
        if (parseInt(a) === 3){
            $("#flag_authorized").val('2');
            $("#codecollecteur").css("display","block");
        }
    }
</script>
<script>


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
                    if ($("#msgemail").text() == "" && $("#msgtelephone").text() == "" ) {
                        $("#boutton").removeAttr('disabled');
                    }else {
                        $("#boutton").attr('disabled','disabled');
                    }
                }
                else {
                    $('#msg'+nom).html("<p style='color:#F00;display: inline; #F00'>"+nom+" est déjà utilisé</p>");
                    $("#boutton").attr('disabled','disabled');
                }
            },
            error: function() {
                alert('La requête n\'a pas abouti'); }

        });
        //alert(name+' '+value);  \app\core\Utils::ConvNumberLetter($transactT[0]->mnt,'','')
    }


</script>






<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>

<!--<script type="text/javascript">
    $(document).ready(function () {
        $( "#boutton" ).click(function() {
            $( "#validation" ).submit();
        });
    });
</script-->>