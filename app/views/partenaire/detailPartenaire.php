<?php
/**
 * Created by PhpStorm.
 * User: bayedame
 * Date: 31/08/2018
 * Time: 10:57
 */
use app\core\Utils;
?>



<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title"><?= $this->lang['DetailLocation']; ?></h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                <ol class="breadcrumb">
                    <li><a href="<?= WEBROOT.'partenaire/liste'; ?>"><?= $this->lang['gestion_partenaires']; ?></a></li>

                    <li><?= $this->lang['detail']; ?></li>

                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">

            <div class="white-box">
                <!--                    <div class="user-bg"> <img width="100%" alt="user" src="../plugins/images/large/img1.jpg"> </div>-->
                <div class="col-sm-7" align="center"> <img class="img-circle" width="200"  > </div>
                <div class="user-btm-box">

                    <div class="row text-center m-t-10">
                        <div class="col-md-6 b-r"><strong><?= $this->lang['partenaire']; ?></strong>
                            <p><?= $partenaire->nom; ?></p>
                        </div>
                        <div class="col-md-6"><strong><?= $this->lang['email_partenaire']; ?></strong>
                            <p><?= $partenaire->email; ?></p>
                        </div>

                    </div>
                    <hr>
                    <div class="row text-center m-t-10">
                        <div class="col-md-6 b-r"><strong><?= $this->lang['p_responsable_partenaire']; ?></strong>
                            <p><?= $partenaire->prenom_responsable; ?></p>
                        </div>
                        <div class="col-md-6"><strong><?= $this->lang['n_responsable_partenaire']; ?></strong>
                            <p><?= $partenaire->nom_responsable; ?></p>
                        </div>
                    </div>
                    <!-- /.row -->
                    <hr>
                    <!-- .row -->
                    <div class="row text-center m-t-10">
                        <div class="col-md-6 b-r"><strong><?= $this->lang['email_partenaire']; ?></strong>
                            <p><?= $partenaire->email; ?></p>
                        </div>
                        <div class="col-md-6"><strong><?= $this->lang['email_responsable']; ?></strong>
                            <p><?= $partenaire->email_responsable; ?></p>
                        </div>
                    </div>
                    <!-- /.row -->
                    <hr>
                    <!-- .row -->
                    <div class="row text-center m-t-10">
                        <div class="col-md-6 b-r"><strong><?= $this->lang['tel_partenaire']; ?></strong>
                            <p><?= $partenaire->telephone; ?></p>
                        </div>
                        <div class="col-md-6"><strong><?= $this->lang['tel_responsable']; ?></strong>
                            <p><?= $partenaire->telephone_responsable; ?></p>
                        </div>
                    </div>
                    <!-- /.row -->
                    <hr>
                    <!-- .row -->
                    <div class="row text-center m-t-10">
                        <div class="col-md-6 b-r"><strong><?= $this->lang['labTaux']; ?></strong>
                            <p><?= $partenaire->taux_reduction; ?></p>
                        </div>
                        <div class="col-md-6"><strong><?= $this->lang['entite']; ?></strong>
                            <p><?= $partenaire->libelle; ?></p>
                        </div>
                    </div>
                    <!-- /.row -->
                    <hr>
                    <!-- .row -->

                    <!-- /.row -->
                    <hr>
                    <!-- .row -->
                    <div class="row text-center m-t-10">
                        <div class="col-md-6 b-r"><strong><?= $this->lang['adresse']; ?></strong>
                            <p><?= $partenaire->adresse; ?></p>
                        </div>
                        <div class="col-md-6 b-r"><strong><?= $this->lang['labetat']; ?></strong>
                            <p>
                            <?php

                            if ($partenaire->etat == 1 ){
                                echo strtoupper($this->lang['activer']);

                            }else{
                                echo strtoupper($this->lang['desactiver']);

                            }
                            ?>
                            </p>
                        </div>
                    </div>
                    <hr>

                </div>



            </div>

        </div>
        </div>
    </div>







    <script>

        $(function () {
            $("#from").datepicker({
                dateFormat: 'yy-mm-dd',
                defaultDate: "+0w",
                changeMonth: true,
                numberOfMonths: 1,
                onClose: function (selectedDate) {
                    $("#to").datepicker("option", "minDate", "dateFormat", selectedDate);
                }
            });
        }

    </script>


