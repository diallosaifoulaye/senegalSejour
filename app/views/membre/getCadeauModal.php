
<form id="validation" class="form-inline form-validator" data-type="update" role="form" action="#" method="post">

    <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?= $this->lang['cadeau']; ?></h4>

    </div>

    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-md-6">
                    <h2><?= $cadeaux->cadeau;?></h2>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-md-6">
                    <h4><?php echo $this->lang['nbre_pnt_requis']; ?></h4>
                </div>
                <div class="col-sm-offset-4">
                    <?= $cadeaux->nb_point;?>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-md-6">
                    <h4><?php echo $this->lang['validite']; ?></h4>
                </div>
                <div class="col-sm-offset-4">
                    <?= $cadeaux->validite.' '.$cadeaux->en_temps;?>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-md-6">
                    <h4 id="total_point"><?php echo $this->lang['total_point']; ?></h4>
                </div>
                <div class="col-sm-offset-4">
                    <?= $this->_USER->point_fidelite;?>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <?php if($this->_USER->point_fidelite < $cadeaux->nb_point){?>
            <button class="btn btn-success disabled confirm" data-form="my-form" type="submit"><i class="fa fa-check"></i> <?php echo $this->lang['btnValider']; ?>
            </button>
            <?php }
            else {?>
            <button class="btn btn-success confirm" data-form="my-form" type="submit"><i class="fa fa-check"></i> <?php echo $this->lang['btnValider']; ?>
            </button>
            <?php } ?>
            <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo $this->lang['btnFermer']; ?> </button>
        </div>

</form>
<script>

    function verifeDoublon(element) {
        // alert(element) ;
        var nom = 'email' ;
        var valeur = element.value ;
        $.ajax({
            type: 'POST',
            data:{ champ : nom, valeur:valeur },
            url: '<?php echo WEBROOT ?>partenaire/verifie',
            success: function(data) {
                var donnees = JSON.parse(data);
                if (parseInt(donnees) === 1) {

                    $('#msg').html("<p style='color:#F00;display: inline; #F00'>Cet email est déjà utilisé</p>");
                    $("#valider").attr('disabled','disabled');
                }
                else {
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
