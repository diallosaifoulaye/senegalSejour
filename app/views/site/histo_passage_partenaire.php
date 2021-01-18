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
        <div class="container page-builder-ltr">
            <div class="row maxrow">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <h3 style="color: #707070;font-size: 18px;text-align: right;"><?php echo $this->lang['lab_espace_ca']; ?> : <?php echo \app\core\Utils::getFormatMoney($ChiffreAffaire->CA); ?> <?php echo $this->lang['currency_cfa']; ?></h3>
                </div>
                <table class="table table-striped custab table-responsive processing table-hover" data-url="<?= WEBROOT; ?>partenaire/listePassageProcessing">
                    <thead>
                    <tr>
                        <th><?php echo $this->lang['lab_espace_date']; ?></th>
                        <th><?php echo $this->lang['lab_espace_prenoms']; ?></th>
                        <th><?php echo $this->lang['lab_espace_noms']; ?></th>
                        <th><?php echo $this->lang['lab_espace_carte']; ?></th>
                        <th><?php echo $this->lang['lab_espace_montants']; ?></th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
</div>