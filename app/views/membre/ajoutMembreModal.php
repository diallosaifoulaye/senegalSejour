
<form id="validation" class="form-inline form-validator" data-type="update" role="form" name="form"
      action="<?= WEBROOT ?>membre/ajoutMembre" method="post" enctype="multipart/form-data">
    <div class="modal-header" id="header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?php echo $this->lang['ajoutMembre']; ?></h4>
    </div>
    <div class="modal-body" id="modal">

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6" id="formulaire">

                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="prenom" class="control-label"><?php echo $this->lang['labprenom'].' (*) :'; ?></label>
                        <input type="text" id="prenom" name="prenom" required class="form-control" placeholder="<?php echo $this->lang['labprenom']; ?>"
                               style="width: 100%">
                        <span class="help-block with-errors"> </span>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="nom" class="control-label"><?php echo $this->lang['labnom'].' (*) :'; ?></label>
                        <input type="text" id="nom" name="nom" required class="form-control" placeholder="<?php echo $this->lang['labnom']; ?>"
                               style="width: 100%">
                        <span id="msg2"></span>
                        <span class="help-block with-errors"> </span>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="email" class="control-label"><?php echo $this->lang['labemail'].' (*) :'; ?></label>
                        <input type="text" id="email" name="email" class="form-control" required onchange="verifeDoublon(this)" oninput="verifeDoublon(this)" placeholder="<?php echo $this->lang['labemail']; ?>"
                               style="width: 100%">
                        <span id="msg"></span>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="telephone" class="control-label"><?php echo $this->lang['telephone'].' (*) :'; ?></label>
                        <input type="tel" id="telephone" name="telephone" required class="form-control" placeholder="<?php echo $this->lang['telephone']; ?>"
                               style="width: 100%">
                        <span class="help-block with-errors"> </span>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="dateNaissance" class="control-label"><?php echo $this->lang['dateNaissance'].' (*) :'; ?></label>
                        <input id="dateNaissance" type="text" name="dateNaissance" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#dateNaissance" placeholder="Date de naissance">
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

<script type="text/javascript">
    $(document).ready(function() {
        $('#dateNaissance').datetimepicker({
            format:'d-m-Y',
            timepicker:false
        });
    });

</script>

<script src="<?= ASSETS; ?>plugins/telPlug/js/intlTelInput.js"></script>
<script src="<?= ASSETS; ?>plugins/telPlug/js/utils.js">


</script>

<script>

    $('input[type="tel"]').intlTelInput({
        utilsScript: '<?= ASSETS;?>plugins/telPlug/js/utils.js',
        autoPlaceholder: true,
        preferredCountries: [ 'sn', 'gn', 'gm', 'gb','ci'],
        initialDialCode: true,
        nationalMode: false
    });

    function verifeDoublon(element) {
        var nom = 'login' ;
        var valeur = element.value ;
        $('#code').val("")
        $.ajax({
            type: 'POST',
            data:{ champ : nom, valeur:valeur },
            url: '<?php echo WEBROOT ?>home/verifie',
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