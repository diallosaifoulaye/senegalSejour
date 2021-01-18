<style>
    html{
        background: #f4f4f4;
    }
</style>
<body data-racine="<?= RACINE; ?>" data-webroot="<?= WEBROOT; ?>" data-assets="<?= ASSETS; ?>"  class="common-home res layout-1">

<!--<body data-racine="--><?//= RACINE; ?><!--" data-webroot="--><?//= WEBROOT; ?><!--" data-assets="--><?//= ASSETS; ?><!--" class="common-home res layout-1">-->
<div class="so-page-builder">
    <?php include("nav.php"); ?>
    <section class="section-style4" style="background: #f4f4f4;">
        <div class="container page-builder-ltr" style=" margin-top: 20px;">
            <div class="row maxrow">
                <table class="table table-striped custab table-responsive processing table-hover" data-url="<?= WEBROOT; ?>membre/getListSouscription">
                    <thead>
                    <tr>
                        <th><?php echo $this->lang['numero_carte']; ?></th>
                        <th><?php echo $this->lang['labDebut']; ?></th>
                        <th><?php echo $this->lang['labFin']; ?></th>
                        <th><?php echo $this->lang['formule']; ?></th>
                        <th><?php echo $this->lang['montant']; ?></th>
                        <th><?php echo $this->lang['labModePaiement']; ?></th>
                        <th><?php echo $this->lang['labEtat']; ?></th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
</div>