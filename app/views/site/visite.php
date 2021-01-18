<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo 'Sénégal séjour';?></title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
    <script src="<?= ASSETS; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <link rel="stylesheet" href="<?= WEBROOT;?>theme/css/bootstrap/css/bootstrap.min.css">
</head>
<body>

<style>
    .timer{
        position: absolute;
        top: 10px;
        right: 50%;
        font-weight: bold;
        color: black;
        font-size: 20px;
        background-color: #E09E3A;
        padding: 1px 10px;
        border-radius: 15px;
    }
    .swal-text {
        color: #D59128;
    }
</style>
<div class="text-center timer">
    <span id="time"> </span>
</div>
<iframe id="iframe" src="https://virtualtoursenegalsejour.com/3d-model/ousmane-sow-teaser/fullscreen/" frameborder="0"  allowfullscreen allow="xr-spatial-tracking" style="width: 100%; height: 100%;"></iframe>

<!-- jQuery -->
<script src="<?= ASSETS;?>plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?= ASSETS;?>bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?= ASSETS;?>js/notify.min.js"></script>
<script>
    $(document).ready(function () {
        $('#iframe').css("height", ($(window).height())+"px");
        function startTimer(duration, display) {

            var timer = duration, minutes, seconds;
            let inter = setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.text(minutes + ":" + seconds);
                --timer;
                if (timer === 60)
                    $.notify("!! Attention !! Il vous reste une minute de visite !");
                if (timer < 0) {
                    Swal.fire({
                        title: 'Fin de la visite!',
                        text: 'Vous allez etre redirige vers la page d\'accueil !! Merci pour la visite',
                        icon: 'info',
                        confirmButtonText: 'OK',
                        onClose: (e) =>{
                            window.location = 'https://virtualtoursenegalsejour.com/senegalsejour/visite/tampon';
                        }
                    })
                    clearInterval(inter);
                }
            }, 1000);
        }

        jQuery(function ($) {
            var fiveMinutes = parseInt('<?= $restant; ?>'), display = $('#time');
            startTimer(fiveMinutes, display);
        });


    });




</script>
</body>
</html>

