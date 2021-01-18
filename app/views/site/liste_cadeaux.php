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
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <h3 style="color: #707070;font-size: 18px;text-align: right;"><?php echo $this->lang['lab_espace_point']; ?> : <?php echo \app\core\Utils::getFormatMoney($point_fidelite->point_fidelite); ?></h3>
                </div>
                <table class="table table-striped custab table-responsive processing table-hover" data-url="<?= WEBROOT; ?>membre/listeCadeauProcessing">
                    <thead>
                    <tr>
                        <th><?php echo $this->lang['nombre_point']; ?></th>
                        <th><?php echo $this->lang['cadeau']; ?></th>
                        <th><?php echo $this->lang['labDuree']; ?></th>
                        <th><?php echo $this->lang['temps']; ?></th>
<!--                        <th><?php /*echo $this->lang['labEtat']; */?></th>
-->                        <th><?php echo $this->lang['labAction']; ?></th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
</div>