<style>
        html{
            background: #2b2b2b;
        }

        .pricing .card {
            border: none;
            transition: all 0.2s;
            box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
            border: 1px solid;
            margin: 30px auto;
            height: 760px;
        }

        .pricing hr {
            margin: 1.5rem 0;
            color: #d4d4d4;
        }

        .pricing .card-title {
            margin: 0;
            font-size: 1.5rem;
            color: #ca9966;
        }

        .pricing .card-price {
            font-size: 3rem;
            color: #d4d4d4;
        }

        .pricing .card-price .period {
            font-size: 0.8rem;
        }

        .pricing ul li {
            margin-bottom: 1rem;
        }

        .pricing .text-muted {
            opacity: 0.7;
        }

        .pricing .btn {
            font-size: 80%;
            letter-spacing: .1rem;
            font-weight: bold;
            padding: 1rem;
            opacity: 0.7;
            transition: all 0.2s;
            width: 80%;
            margin: 12px auto;
            background: #c6a47e;
        }

        .ico{
            margin: 0 150px;
            top: -18px;
            position: relative;
        }
        .lis{
            text-align: center;
            padding: 2px;
            color: #d4d4d4;
        }
        .lisgri{
            text-align: center;
            padding: 2px;
        }
        .lhr{
            margin: 1.5rem !important;
        }

        /* Hover Effects on Card */

        @media (max-width: 1024px) {
            .ico{
                margin: 0 439px;
            }
        }
        @media (min-width: 992px) {
            .pricing .card:hover {
                box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.3);
            }
            .pricing .card:hover .btn {
                opacity: 1;
            }
        }

    </style>
<body data-racine="<?= RACINE; ?>" data-webroot="<?= WEBROOT; ?>" data-assets="<?= ASSETS; ?>"  class="common-home res layout-1">
<div id="content" style="margin-bottom: 100px;">
    <div class="so-page-builder">
        <?php include("nav.php"); ?>
        <section class="pricing py-5" style="background: #2b2b2b;padding-top: 60px;">
            <div class="container">
                <div class="row">
                    <?php
                    foreach ($formulesAvantages as $val){?>
                        <!-- Free Tier -->
                        <div class="col-lg-4">
                            <div class="card mb-5 mb-lg-0">
                                <div class="card-body">
                                    <h5 class="card-title text-muted text-uppercase text-center" style="margin-top: 30px; margin-bottom: 15px;"><?php echo $val["formules"]->libelle; ?></h5>
                                    <h6 class="card-price text-center"><sup>CFA</sup><?php echo \app\core\Utils::getFormatMoney($val["formules"]->montant); ?></h6>
                                    <ul class="fa-ul">
                                        <li class="lis"><span class="fa-li"></span><?php echo $val["formules"]->description; ?></li>
                                        <li class="lisgri"><span class="fa-li"></span>*<?php echo $val["formules"]->duree; ?> <span><?php echo $val["formules"]->type_duree; ?></li>
                                    </ul>
                                    <a href="<?= WEBROOT ?>home/register" class="btn btn-block btn-primary text-uppercase">Sélectionner</a>
                                    <hr>
                                    <ul class="fa-ul" style="margin-left: 0 !important;">
                                        <?php
                                            $lastElement = end($val["avantages"]);
                                            foreach ($val["avantages"] as $v){?>
                                                <li class="lis"><span class="fa-li"></span><?php echo $v->libelle; ?></li>
                                                <?php if($v != $lastElement) {?>
                                                        <hr class="lhr">
                                                <?php }?>
                                            <?php }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ;?>
                </div>
            </div>
        </section>
    </div>
</div>