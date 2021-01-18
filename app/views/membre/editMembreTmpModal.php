<form id="my-form" class="form-inline form-validator" data-type="update" role="form" name="form"
      action="<?= WEBROOT ?>membre/editMembreTmp" method="post">
    <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?php echo $this->lang['modif_membre_tmp']; ?></h4>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="nom" class="control-label"><?php echo $this->lang['nom']; ?></label>
                        <input type="text" id="nom" name="nom" value="<?= $membre->nom ?>" class="form-control"
                               style="width: 100%" required>
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="prenom" class="control-label"><?php echo $this->lang['prenom']; ?></label>
                        <input type="text" id="prenom" name="prenom" value="<?= $membre->prenom ?>" class="form-control"
                               style="width: 100%">
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="email" class="control-label"><?php echo $this->lang['email']; ?></label>
                        <input type="email" id="email" name="email" value="<?= $membre->email?> " class="form-control"
                               style="width: 100%" required oninput="verifeDoublon(this)">
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="telephone" class="control-label"><?php echo $this->lang['tel']; ?></label>
                        <input type="tel" id="telephone" name="telephone" value="<?= $membre->telephone ?>" class="form-control"
                               style="width: 100%" required>
                    </div>

                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="date_naissance" class="control-label"><?php echo $this->lang['dateNaissance']; ?></label>
                        <input type="text" id="date_naissance" name="date_naissance" value="<?= $membre->date_naissance ?>" class="form-control"
                               style="width: 100%" required>
                    <input type="hidden" id="id" name="id" value="<?php echo base64_encode($membre->id)?>" >
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


<script>

    $('input[type="tel"]').intlTelInput({
        utilsScript: '<?= ASSETS;?>plugins/telPlug/js/utils.js',
        autoPlaceholder: true,
        preferredCountries: [ 'sn', 'gn', 'gm', 'gb','ci'],
        initialDialCode: true,
        nationalMode: false
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#date_naissance').datetimepicker({
            format:'d-m-Y',
            timepicker:false
        });
    });

</script>