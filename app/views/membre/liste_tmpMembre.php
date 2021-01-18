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
                <h4 class="page-title"><?php echo $this->lang['liste_membre_tmp']; ?></h4></div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                <ol class="breadcrumb">

                    <li class="active"><?php echo $this->lang['liste_membre_tmp']; ?></li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <div class="row">

                       <!-- <div class="col-lg-12">
                            <h3 class="panel-title pull-right ">
                                <a href="<?/*= WEBROOT.'membre/ajoutMembreTmpAll'; */?>"  title="Ajouter" class=" btn btn-success fa fa-plus" style="color: #ffffff"> <?php /*echo $this->lang['btnAjouter']; */?></a>

                            </h3>
                    </div>-->
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered table-hover table-responsive processing"
                                   data-url="<?= WEBROOT; ?>membre/listeProcessing_tmp">
                                <thead>
                                <tr>
                                    <th><?php echo $this->lang['nom']; ?></th>
                                    <th><?php echo $this->lang['prenom']; ?></th>
                                    <th><?php echo $this->lang['email_four']; ?></th>
                                    <th><?php echo $this->lang['tel_four']; ?></th>
                                    <th><?php echo $this->lang['dateNaissance']; ?></th>
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

<script src='https://kit.fontawesome.com/a076d05399.js'></script>
