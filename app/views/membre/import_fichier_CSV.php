
<form id="validation" class="form-inline form-validator" data-type="update" role="form" name="form"
      action="<?= WEBROOT ?>membre/import_fichier_CSV" method="post" enctype="multipart/form-data">
    <div class="modal-header" id="header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?php echo $this->lang['import_fichier_csv']; ?></h4>
    </div>
    <div class="modal-body" id="modal">

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6" id="formulaire">

                    <div class="col-md-12">
                        <input type="file" name="csv" id="csv" accept=".csv" required>
                        <span id="msg1"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </div>

        </div>
        <div class="modal-footer" id="footer">
            <button class="btn btn-success confirm" data-form="my-form" id="valider" type="submit"><i class="fa fa-check"></i> <?php echo $this->lang['btnValider']; ?>
            </button>
            <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo $this->lang['btnFermer']; ?> </button>
        </div>
</form>
