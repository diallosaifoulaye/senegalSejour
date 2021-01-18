<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="row white-box" style="margin-top:0px; margin-bottom: 4px">
                <!--<div class="col-lg-2 col-sm-6 bg-theme text-white" style="height: 40px; vertical-align: middle; padding-top:10px;background-color: #0a7242 !important;">
                    <center><b><?php /*echo $this->lang['alaune'];*/?></b></center>
                </div>-->
                <div class="col-lg-10 col-sm-6 annulation">
                    <marquee>
                        <a href="">

                        </a>
                    </marquee>

                </div>
            </div>
        </div>
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title"><?php echo $this->lang['liste_passages']; ?></h4>
            </div>

            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12 text-right">
                <h4 class="page-title"><?php echo $this->lang['lab_espace_ca']; ?> : <?php echo \app\core\Utils::getFormatMoney($ChiffreAffaire->CA); ?> <?php echo $this->lang['currency_cfa']; ?></h4>
            </div>

            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="panel-title pull-right">
                                <!--<button type="button" class="open-modal btn btn-success"
                                        data-modal-controller="partenaire/ajoutPartenaireModal"
                                        data-modal-view="partenaire/ajoutPartenaireModal">
                                    <i class="fa fa-plus"></i> <?php /*echo $this->lang['btnAjouter']; */?>
                                </button>-->
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered table-hover table-responsive processing"
                                   data-url="<?= WEBROOT; ?>partenaire/listePassageProcessing">
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
                </div>
            </div>
        </div>
    </div>
</div>