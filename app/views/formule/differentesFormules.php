
<!-- Team -->
<section id="team" class="pb-5">
    <div class="container">
        <br/><br/><br/>
        <div class="row">
            <!-- Team member -->
            <?php
            foreach ($formulesAvantages as $val){?>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="image-flip" >
                        <div class="mainflip flip-0">
                            <div class="frontside">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <br/>
                                        <h4 class="card-title"><?php echo $val["formules"]->libelle; ?></h4>
                                        <p align="left" style="margin-left: 22px;" class="card-text">CFA</p>
                                        <h3  style="font-size: 65px" class="card-text"><?php echo $val["formules"]->montant; ?></h3>
                                        <p  style="font-size: 25px; margin-top: 40px;" class="card-text"><?php echo $val["formules"]->description; ?></p>
                                        <p  style="font-size: 12px; margin-top: 5px;" class="card-text"><?php echo $val["formules"]->duree; ?> <span><?php echo $val["formules"]->type_duree; ?></span></p>
                                        <div class="text-center" style="margin-top: 40px;">
                                            <?php
                                            echo $AllReadySusbcribe;
                                            if ($AllReadySusbcribe == '1'){ ?>
                                                <button class="open-modal btn btn-success" >VOUS AVEZ DEJA UN ABONNEMENT EN COURS</button>
                                            <?php }
                                            else { ?>
                                                <button class="open-modal btn btn-success" data-modal-controller="membre/souscriptionModal" data-modal-view="membre/souscriptionModal" data-modal-param ="<?php echo base64_encode($val["formules"]->id); ?>">Sélectionner</button>
                                            <?php }
                                            ?>
                                        </div>

                                        <ul class="list-group list-group-flush" style="margin-top: 30px;">
                                            <?php
                                            foreach ($val["avantages"] as $v){?>
                                                <li class="list-group-item"><?php echo $v->libelle; ?></li>
                                            <?php }
                                            ?>
                                        </ul>

                                        <tr><td></td></tr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php

            }
            ;?>
            <!-- ./Team member -->
        </div>
    </div>
</section>
<!-- Team -->

<style>
    /* FontAwesome for working BootSnippet :> */

    #team {
        background: #eee !important;
    }

    .btn-primary:hover,
    .btn-primary:focus {
        background-color: #108d6f;
        border-color: #108d6f;
        box-shadow: none;
        outline: none;
    }

    .btn-primary {
        color: #fff;
        background-color: #007b5e;
        border-color: #007b5e;
    }

    section {
        padding: 60px 0;
    }

    section .section-title {
        text-align: center;
        color: #007b5e;
        margin-bottom: 50px;
        text-transform: uppercase;
    }

    #team .card {
        border: none;
        background: #ffffff;
        height: 520px;
    }

    .image-flip:hover .backside,
    .image-flip.hover .backside {
        -webkit-transform: rotateY(0deg);
        -moz-transform: rotateY(0deg);
        -o-transform: rotateY(0deg);
        -ms-transform: rotateY(0deg);
        transform: rotateY(0deg);
        border-radius: .25rem;
    }

    /*.image-flip:hover .frontside,
    .image-flip.hover .frontside {
        -webkit-transform: rotateY(180deg);
        -moz-transform: rotateY(180deg);
        -o-transform: rotateY(180deg);
        transform: rotateY(180deg);
    }

    .mainflip {
        -webkit-transition: 1s;
        -webkit-transform-style: preserve-3d;
        -ms-transition: 1s;
        -moz-transition: 1s;
        -moz-transform: perspective(1000px);
        -moz-transform-style: preserve-3d;
        -ms-transform-style: preserve-3d;
        transition: 1s;
        transform-style: preserve-3d;
        position: relative;
    }*/

    .frontside {
        position: relative;
        -webkit-transform: rotateY(0deg);
        -ms-transform: rotateY(0deg);
        z-index: 2;
        margin-bottom: 30px;
    }

    /*.backside {
        position: absolute;
        top: 0;
        left: 0;
        background: white;
        -webkit-transform: rotateY(-180deg);
        -moz-transform: rotateY(-180deg);
        -o-transform: rotateY(-180deg);
        -ms-transform: rotateY(-180deg);
        transform: rotateY(-180deg);
        -webkit-box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
        -moz-box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
        box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
    }*/

    .frontside,
    .backside {
        -webkit-backface-visibility: hidden;
        -moz-backface-visibility: hidden;
        -ms-backface-visibility: hidden;
        backface-visibility: hidden;
        -webkit-transition: 1s;
        -webkit-transform-style: preserve-3d;
        -moz-transition: 1s;
        -moz-transform-style: preserve-3d;
        -o-transition: 1s;
        -o-transform-style: preserve-3d;
        -ms-transition: 1s;
        -ms-transform-style: preserve-3d;
        transition: 1s;
        transform-style: preserve-3d;
    }

    .frontside .card,
    .backside .card {
        min-height: 312px;
    }

    .backside .card a {
        font-size: 18px;
        color: #007b5e !important;
    }

    .frontside .card .card-title,
    .backside .card .card-title {
        color: #007b5e !important;
    }

    .frontside .card .card-body img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
    }
</style>
