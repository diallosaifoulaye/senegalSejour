
<?php //echo'<pre>', var_dump($this->data["message"]);die;?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= WEBROOT;?>assets/plugins/images/logoPF.jpg">
    <title><?php echo $this->lang['pf'];?></title>
    <!-- Bootstrap Core CSS -->
    <link href="<?= WEBROOT;?>assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="<?= WEBROOT;?>assets/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= WEBROOT;?>assets/css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?= WEBROOT;?>assets/css/colors/blue.css" id="theme"  rel="stylesheet">

    <link href="<?= ASSETS ?>plugins/select2/select2.min.css" rel="stylesheet">

    <link href="<?= ASSETS; ?>plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" >

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- Preloader -->
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>

<section id="wrapper" class="login-register">
    <div class="login-box login-sidebar">
        <div class="white-box">


            <!--            --><?php //$a == 1; if ($a == '1') {  ?>
            <form class="form-horizontal form-material" id="loginform" action="<?php echo WEBROOT; ?>home/ajoutMembre" method="post">
               <!-- <div class="row pull-right">
                    <select id="lang" onchange="choisirLangue()"  class="select2"  name="lang">
                        <option  value="fr">FR</option>
                        <option value="us">ENG</option>
                    </select>
                </div>
-->

                <a href="javascript:void(0)" class="text-center db">
                    <h3><?php echo $this->lang['inscription']; ?></h3>
                </a>

                <div class="form-group m-t-40">
                    <div class="col-xs-12">
                        <label for="nom" class="control-label"><?php echo $this->lang['nom'].' (*) :'; ?></label>
                        <input class="form-control" id="nom" required name="nom" type="text" placeholder="<?php echo $this->lang['nom'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label for="prenom" class="control-label"><?php echo $this->lang['prenom'].' (*) :'; ?></label>
                        <input class="form-control" id="prenom" required name="prenom" type="text" placeholder="<?php echo $this->lang['prenom'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label for="email" class="control-label"><?php echo $this->lang['email'].' (*) :'; ?></label>
                        <input class="form-control" id="email" required onchange="verifeDoublon(this)" name="email" type="email" placeholder="<?php echo $this->lang['email'];?>">
                        <span id="msg"></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label for="telephone" class="control-label"><?php echo $this->lang['telephone'].' (*) :'; ?></label>
                        <input class="form-control" id="telephone" required name="telephone" type="telephone" placeholder="<?php echo $this->lang['telephone'];?>">
                    </div>
                </div>
                <div class="form-group" style="width: 100%;padding: 10px;">
                    <label for="adresse" class="control-label"><?php echo $this->lang['adresse'].' (*) :'; ?></label>
                    <textarea class="form-control" id="adresse" required name="adresse" placeholder="<?php echo $this->lang['adresse']; ?>" style="margin: 0px; width: 374px; height: 70px;"></textarea>
                    <span class="help-block with-errors"> </span>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12" id="msg"></div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-success confirm" data-form="my-form" id="valider" type="submit"><i class="fa fa-check"></i> <?php echo $this->lang['s_inscrire']; ?>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <footer class="footer text-center" style="background-color:white;color: white">`
            <a href="http://www.numherit.com/v2" target="_blank">
                <img src="<?php echo ASSETS ?>plugins/images/numherit.png" class="img-responsive" title="<?php echo $this->lang['numheritby'] ; ?>" style="height: 35px; display: block; margin-left: auto; margin-right: auto;">
            </a>
        </footer>
    </div>
</section>




<script>



    function verifeDoublon(element) {
        // alert(element) ;
        var nom = 'email' ;
        var valeur = element.value ;
        $.ajax({
            type: 'POST',
            data:{ champ : nom, valeur:valeur },
            url: '<?php echo WEBROOT ?>home/verifie',
            success: function(data) {
                var donnees = JSON.parse(data);
                if (parseInt(donnees) === 1) {

                    $('#msg').html("<p style='color:#F00;display: inline; #F00'>Cet email est déjà utilisé</p>");
                    $("#valider").attr('disabled','disabled');
                }
                else {
                    $('#msg').html("");
                    $("#valider").removeAttr('disabled');
                }
            },
            error: function() {
                alert('no')
                alert('La requête n\'a pas abouti'); }

        });
        //alert(name+' '+value);  \app\core\Utils::ConvNumberLetter($transactT[0]->mnt,'','')
    }


</script>

<!-- jQuery -->
<script src="<?= WEBROOT;?>assets/plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?= WEBROOT;?>assets/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="<?= WEBROOT;?>assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>

<!--slimscroll JavaScript -->
<script src="<?= WEBROOT;?>assets/js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="<?= WEBROOT;?>assets/js/waves.js"></script>
<!-- Custom Theme JavaScript -->
<script src="<?= WEBROOT;?>assets/js/custom.min.js"></script>
<!--Style Switcher -->
<script src="<?= WEBROOT;?>assets/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
<script src="<?= ASSETS ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>



<script>

    function choisirLangue() {
        var lang = $("#lang").val();
        if (lang == 'us'){
            $("#login").attr("placeholder", "Login");
            $("#password").attr("placeholder", "Password");
            $("#to-recover").html('Forgot your password ?');
            $("#bc").html("SIGN UP");
            $("#mpof").html("Forgot your password");
            $("#accueil").html("Home");
            $("#reset").html("Reset");
        }else{
            $("#login").attr("placeholder", "<?php echo $this->lang['labLogin'];?>");
            $("#password").attr("placeholder", "<?php echo $this->lang['labpwd'];?>");
            $("#to-recover").html("<?php echo $this->lang['recover_password'];?>");
            $("#bc").html("<?php echo strtoupper($this->lang['toconnect']); ?>");
            $("#mpof").html("<?php echo $this->lang['recover_password'];?>");
            $("#accueil").html("Accueil");
            $("#reset").html("<?php echo $this->lang['reset'];?>");
        }
        //alert(lang);

    }

    (function () {
        $("#butonreset").prop('disabled', true);
    })();



</script>

<script src="<?= ASSETS ?>plugins/select2/select2.full.min.js"></script>
<script>
    $(".select2").select2();
</script>





</body>
</html>
