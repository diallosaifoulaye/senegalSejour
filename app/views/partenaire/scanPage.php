    <style>
        html{
            background: #f4f4f4;
    }
        .table thead > tr > th {
            background: #fff;
            border: 0;
        }
        .table-striped > tbody > tr:nth-of-type(2n+1) {
            background-color: #fff;
        }

        #qr-canvas {
            margin: auto;
            width: calc(100% - 20px);
            max-width: 400px;
        }

        #btn-scan-qr {
            cursor: pointer;
        }

        #btn-scan-qr img {
            height: 10em;
            padding: 15px;
            margin: 15px;
            background: white;
        }

        #qr-result {
            font-size: 1.2em;
            margin: 20px auto;
            padding: 20px;
            max-width: 700px;
            background-color: white;
        }

    </style>
<body data-racine="<?= RACINE; ?>" data-webroot="<?= WEBROOT; ?>" data-assets="<?= ASSETS; ?>"  class="common-home res layout-1">
<div id="content" style="margin-bottom: 100px;">
    <div class="so-page-builder">
        <?php include(ROOT."app/views/site/nav.php"); ?>
        <section class="section-style4" style="background: #f4f4f4;">
            <div class="container page-builder-ltr">
                <form id="validation">
                    <div class="row maxrow">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6" style="margin-bottom: 25px">
                            <div class="col-lg-12 col-md-12" style="text-align: center;">
                                <h3 style="color: #707070;font-size: 18px;text-align: center;">CODE QR</h3>
                                <a id="btn-scan-qr">
                                    <img src="<?= WEBROOT?>theme/image/codeqr.png">
                                <a/>
                                    <canvas hidden="" id="qr-canvas"></canvas>
                                    <div id="qr-result" hidden="">
                                        <a id="outputData">Voir Info</a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
<!-- //Main Container -->
<!-- Footer Container -->
<script>
    // const qrcode = window.qrcode;

    const video = document.createElement("video");
    const canvasElement = document.getElementById("qr-canvas");
    const canvas = canvasElement.getContext("2d");

    const qrResult = document.getElementById("qr-result");
    const outputData = document.getElementById("outputData");
    const btnScanQR = document.getElementById("btn-scan-qr");

    let scanning = false;

    qrcode.callback = res => {
        if (res) {
            outputData.href = res;
            scanning = false;

            video.srcObject.getTracks().forEach(track => {
                track.stop();
            });

            qrResult.hidden = false;
            canvasElement.hidden = true;
            btnScanQR.hidden = false;
        }
    };

    btnScanQR.onclick = () => {
        navigator.mediaDevices
            .getUserMedia({ video: { facingMode: "environment" } })
            .then(function(stream) {
                scanning = true;
                qrResult.hidden = true;
                btnScanQR.hidden = true;
                canvasElement.hidden = false;
                video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
                video.srcObject = stream;
                video.play();
                tick();
                scan();
            });
    };

    function tick() {
        canvasElement.height = video.videoHeight;
        canvasElement.width = video.videoWidth;
        canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);

        scanning && requestAnimationFrame(tick);
    }

    function scan() {
        try {
            qrcode.decode();
        } catch (e) {
            setTimeout(scan, 300);
        }
    }

</script>
