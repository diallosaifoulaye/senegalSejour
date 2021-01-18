<style type="text/css">

    .tia{
        color: #FFFFFF;
        text-shadow: rgba(0, 0, 0, 0.4) 0px 4px 5px;
        text-align: center;
        font-size: 28px;

    }

    @font-face {
        font-family: 'coveslight';
        src: url('https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/font/coves_light-webfont.woff2') format('woff2'),
        url('https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/font/coves_light-webfont.woff') format('woff');
        font-weight: normal;
        font-style: normal;


    }

    @font-face {
        font-family: 'covesbold';
        src: url('https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/font/coves_bold-webfont.woff2') format('woff2'),
        url('https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/font/coves_bold-webfont.woff') format('woff');
        font-weight: normal;
        font-style: normal;


    }


    .form-control{
        width: 30% !important;
    }
    @media only screen and (min-width: 1024px) {
        #pass{
            width: 80% !important;
            margin-left: 30px !important;
        }
    }

</style>
<div id="wrapper" class="wrapper-fluid banners-effect-10">

    <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?= ((isset($avantage->id)) ? $this->lang['update_Avantage'] : $this->lang['ajout_Avantage']) ; ?></h4>

    </div>
    <!-- Main Container  -->
    <div id="content" style="margin-bottom: 0;">
        <div class="so-page-builder">
            <section class="section-style1" style="padding: 90px 0px 200px 0px;">
                <div id="container-custom" class="container page-builder-ltr" style="width: 68%;">
                    <div class="how-section1" style="background: #fff;opacity: 0.95;padding: 35px;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-8 col-sm-12">
                                    <div id="pass" style="font-size: 17px;text-align: center;font-family: coveslight; background-color:#3a3229; width: 50%; margin: auto;">
                                        <h4 id="titleP" class="tia" style="font-family:lulo_cleanoutline_bold;font-size: 16px; color: #C6A47E; padding-top: 17px;">
                                            <span>DIGITAL CLUB CARD</span>
                                        </h4><br>
                                        <img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/codeqr.png" class="img-responsive" alt="" style="height: 11em; margin-bottom: 8px;margin-top: -22px;" />
                                        <div style="font-family:coveslight; font-size: 20px;">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col">
                                                        <span class="eltLabel" style="margin-bottom: 0px !important ;color: #C6A47E;">Prénom-Nom</span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <span class="eltText" style="margin-bottom: 0px !important ;">Mr.Michel Salmeron</span>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <span class="eltLabel" style="margin-bottom: 0px !important ;color: #C6A47E;">Numéro de carte</span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <span class="eltText" style="margin-bottom: 0px !important ;">1023252260</span>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <span class="eltLabel" style="margin-bottom: 0px !important ;color: #C6A47E;">Date de création</span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <span class="eltText" style="margin-bottom: 0px !important ;">22 Sept 2020</span>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <span class="eltLabel" style="margin-bottom: 0px !important ;color: #C6A47E;">Date d'expiration</span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <span class="eltText" style="margin-bottom: 0px !important ;">22 Sept 2021</span>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <h4 id="titleF" class="tia" style="font-family:lulo_cleanoutline_bold;font-size: 20px;color: #20140a; background-color: #ab9e89; margin-bottom: 0px;">CARTE VIP</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12" style="height: 180px;">
                                                <img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/logo_tissu.png" class="img-responsive" alt="" style="height: 100%; width: 100%;" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <form action="#" style="padding: 49px 5px;font-size: 40px;">

                                        <div class="form-group">
                                            <label for="corpForm">CORPS</label>
                                            <input type="color" class="form-control" id="titlePForm" value="#3a3229" onchange="MyColor(this,'corp')" />
                                        </div>
                                        <div class="form-group">
                                            <label for="titlePForm">DIGITAL CLUB CARD</label>
                                            <input type="color" class="form-control" id="titlePForm" value="#C6A47E" onchange="MyColor(this,'titre1')">
                                        </div>
                                        <div class="form-group">
                                            <label for="titleLForm">LABELS</label>
                                            <input type="color" class="form-control" id="titleLForm" value="#C6A47E" onchange="MyColor(this,'label')">
                                        </div>
                                        <div class="form-group">
                                            <label for="EltForm">TEXTS</label>
                                            <input type="color" class="form-control" id="EltForm" value="#FFFFFF" onchange="MyColor(this,'text')">
                                        </div>
                                        <div class="form-group">
                                            <label for="FormuleForm">CARTE VIP</label>
                                            <input type="color" class="form-control" id="FormuleForm" value="#20140a" onchange="MyColor(this,'titre2')">
                                        </div>
                                        <div class="form-group">
                                            <label for="FormuleForm">COULEUR ARRIERE PLAN DE CARTE VIP</label>
                                            <input type="color" class="form-control" id="FormuleForm" value="#ab9e89" onchange="MyColor(this,'Atitre2')">
                                        </div>
                                        <br>

                                        <button type="submit" class="btn btn-primary">VALIDER</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- //Main Container -->

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $( document ).ready(function() {
        var col = $("#titlePForm").val()
    });

    function MyColor(e,v){
        var color = e.value
        if(v == "corp"){
            $("#pass").css("background-color",color)
        }
        if(v == "titre1"){
            $("#titleP").css("color",color)
        }
        if(v == "label"){
            $(".eltLabel").css("color",color)
        }
        if(v == "text"){
            $(".eltText").css("color",color)
        }
        if(v == "titre2"){
            $("#titleF").css("color",color)
        }
        if(v == "Atitre2"){
            $("#titleF").css("background-color",color)
        }
    }
</script>
