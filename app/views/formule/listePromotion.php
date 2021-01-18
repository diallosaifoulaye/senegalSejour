    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="row white-box" style="margin-top:0px; margin-bottom: 4px">
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
                    <h4 class="page-title"><?php echo $this->lang['liste_promotions']; ?></h4> </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">

                        <!--<h3 class="box-title">Blank Starter page</h3> </div>-->

                        <div class="row">
                            <div class="col-lg-12">
                                <h3 class="panel-title pull-right">

                                    <button type="button" class="open-modal btn btn-success"
                                            data-modal-controller="promotion/promotionModal"
                                            data-modal-view="formule/promotionModal">
                                        <i class="fa fa-plus"></i> <?php echo $this->lang['btnAjouterPromotion']; ?>
                                    </button>
                                </h3>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-bordered table-hover table-responsive processing"
                                       data-url="<?= WEBROOT; ?>promotion/listePromotionProcessing">
                                    <thead>
                                    <tr>
                                        <th><?php echo $this->lang['libelle']; ?></th>
                                        <th><?php echo $this->lang['labDebut']; ?></th>
                                        <th><?php echo $this->lang['labFin']; ?></th>
                                        <th><?php echo $this->lang['taux_promotion']; ?></th>
                                        <th><?php echo $this->lang['labEtat']; ?></th>
                                        <th><?php echo $this->lang['labAction']; ?></th>
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



