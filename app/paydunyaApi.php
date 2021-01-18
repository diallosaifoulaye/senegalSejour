<?php
    require(ROOT.'app/paydunya-php-master/paydunya.php');
    Paydunya_Setup::setMasterKey("7Tg1cyEo-Bj48-xuIg-WH0f-BJO8sUmqDW9o");
    Paydunya_Setup::setPublicKey("live_public_uU5dNXeYR0u4cK01fpJpMMnJCZ7");
    Paydunya_Setup::setPrivateKey("live_private_gVFPNz8Lt2ojBi9AYaikLWaZ9F8");
    Paydunya_Setup::setToken("rL90W4Qk6tBGTZg2Xqpc");
    Paydunya_Setup::setMode("live");


    //Configuration des informations de votre service/entreprise
     // Seul le nom est requis
    /*Paydunya_Checkout_Store::setPhoneNumber("336530583");
    Paydunya_Checkout_Store::setPostalAddress("Dakar Plateau - Etablissement kheweul");
    Paydunya_Checkout_Store::setWebsiteUrl("http://www.chez-sandra.sn");
    Paydunya_Checkout_Store::setLogoUrl("http://www.chez-sandra.sn/logo.png");*/


//    Paydunya_Checkout_Store::setCallbackUrl("https://ba21bbf25451.ngrok.io");
    Paydunya_Checkout_Store::setCallbackUrl("https://nmedias.media/senegalsejour/Apipaiement/statusPaiement");

    /*Paydunya_Checkout_Store::setCancelUrl("https://nmedias.media/senegalsejour/membre/DunyaCancel");

    Paydunya_Checkout_Store::setReturnUrl("https://nmedias.media/senegalsejour/membre/generateQr");*/