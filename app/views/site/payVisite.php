<?php include(ROOT."app/views/template/header_ep.php"); ?>
<style>
    .new-login-register, .new-login-box {
        margin: auto;
        width: 400px;
    }
    .white-box {
        background: #fff;
        padding: 25px;
        margin-bottom: 30px;
    }

    .new-login-register .new-login-box .new-lg-form {
        padding-top: 20px;
    }
    .box-title {
        font-size: 30px;
        text-transform: uppercase;
        font-weight: 700;
        color: #C6A47E;
        text-align: center;
        position: relative;
        margin-bottom: 0;
        margin-top: 8px;
        margin-bottom: 21px;
    }
    body{
        background: #fff!important;
    }
</style>
<body data-racine="<?= RACINE; ?>" data-webroot="<?= WEBROOT; ?>" data-assets="<?= ASSETS; ?>"  class="common-home res layout-1" style="background-color: #2B2B2B;">
<div id="wrapper" class="wrapper-fluid banners-effect-10">
    <!-- Main Container  -->
    <div id="content" style="margin-bottom: 0;">
        <div class="so-page-builder">
            <section class="section-style1" id="contact">
                <div class="container page-builder-ltr">
                    <div class="row row-style row_a1" style="padding-top: 300px;">
                        <div class="new-login-box">
                            <div class="white-box">
<!--                                <h3 class="box-title m-b-0">--><?//= $this->lang['connect']; ?><!--</h3>-->
                                <form class="form-horizontal new-lg-form" id="loginform" action="<?= WEBROOT ?>home/login" method="post" enctype="multipart/form-data">
                                    <div class="form-group  m-t-20">
                                        <div class="col-xs-12">
                                            <input type="text" name="login" id="email"  oninput="setUrl(this)" value="" class="form-control" placeholder="Email" required style="border-bottom: 1px #dbdbdb solid;background: #eee0;color: #af4848;border-radius: 0;">
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkbox" disabled>
                                        <label class="form-check-label" for="checkbox">Cocher pour activer les options de paiement</label>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="col-xs-6" style="width: 50%;">
                                            <a id="paypal" style="display: none">
                                                <img style="width: 100%; height: 100%;" src="<?= WEBROOT ?>theme/image/paypal.png" alt="">
                                            </a>
                                        </div>
                                        <div class="col-xs-6" style="width: 50%;">
                                            <a href="" id="paydunya" style="display: none">
                                                <img src="<?= WEBROOT ?>theme/image/payduna.jpg" alt="" style="width: 100%; height: 100%;">
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>



</body>
<!-- //Main Container -->
<!-- Footer Container -->
<?php include(ROOT."app/views/template/footer_ep.php"); ?>


<script>
    $("#checkbox").click( function(){
        var payP = "<?= WEBROOT ?>visite/souscrirePayP/3/";
        var payD = "<?= WEBROOT ?>visite/souscrirePayD/2/";
        if( $(this).is(':checked') ) {
            var mail = $("#email").val()
            if (ValidateEmail(mail)) {
                $("#email").attr('readonly', true);
                $("#paypal").attr("href", payP+btoa(mail));
                $("#paydunya").attr("href", payD+btoa(mail));
                $("#paypal").show();
                $("#paydunya").show();
            }else {
                $("#email").removeAttr('readonly');
                $("#paypal").removeAttr('href');
                $("#paydunya").removeAttr('href');
                $("#paypal").hide();
                $("#paydunya").hide();
            }
        }else {
            $("#email").removeAttr('readonly');
            $("#paypal").removeAttr('href');
            $("#paydunya").removeAttr('href');
            $("#paypal").hide();
            $("#paydunya").hide();
        }
    });

    function setUrl(element) {
        var val = element.value
        console.log(val.length)
        if (val.length > 6){
            $("#checkbox").removeAttr("disabled");
        }else {
            $("#checkbox").attr("disabled", true);
        }
    }

    function ValidateEmail(mail)
    {
        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))
        {
            return (true)
        }
        alert("You have entered an invalid email address!")
        return (false)
    }

</script>


