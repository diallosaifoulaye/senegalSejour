<style>
    html{
        background: #f4f4f4;
    }
</style>
<body data-racine="<?= RACINE; ?>" data-webroot="<?= WEBROOT; ?>" data-assets="<?= ASSETS; ?>" class="common-home res layout-1">
<div class="so-page-builder">
    <?php include("nav.php"); ?>
    <section class="section-style4" style="background: #f4f4f4;">
        <div class="container page-builder-ltr" style=" margin-top: 20px;">
            <div class="row maxrow">
                <table class="table table-striped custab table-responsive processing table-hover" data-url="<?= WEBROOT; ?>membre/listePassageProcessing">
                    <thead>
                    <tr>
                        <th><?php echo $this->lang['partenaire']; ?></th>
                        <th><?php echo $this->lang['date']; ?></th>
                        <th><?php echo $this->lang['montant']; ?></th>
                        <th><?php echo $this->lang['lab_montant_economise']; ?></th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
</div>