<?php
    namespace app;
//    require ROOT.'vendor/autoload.php';

    use PayPalCheckoutSdk\Core\PayPalHttpClient;
    use PayPalCheckoutSdk\Core\SandboxEnvironment;
    use PayPalCheckoutSdk\Core\LiveEnvironment;

    ini_set('error_reporting', E_ALL); // or error_reporting(E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');

    class PayPalClient
    {
        /**
         * Returns PayPal HTTP client instance with environment that has access
         * credentials context. Use this instance to invoke PayPal APIs, provided the
         * credentials have access.
         */
        public static function client()
        {
            return new PayPalHttpClient(self::environment());
        }

        /**
         * Set up and return PayPal PHP SDK environment with PayPal access credentials.
         * This sample uses SandboxEnvironment. In production, use LiveEnvironment.
         */
        public static function environment()
        {
            $clientId = getenv("AQazxD9K6xXvelzcC6PkCzI_rp1TVH-KcWkX5aJ92UA5J0xQU9X0wxDlgPOnlUma9LMiYAzIZzud9P8f") ?: "PAYPAL-SANDBOX-CLIENT-ID";
            $clientSecret = getenv("ENJFqvrQry3HdMa-LXqz-6as4aTHDX2z6T_xfh0WoLDdXwxStgbuacaCwuL7ClrLTuRaluuoTVt1nqAz") ?: "PAYPAL-SANDBOX-CLIENT-SECRET";
            return new SandboxEnvironment($clientId, $clientSecret);
        }
        /*public static function environment()
        {
            $clientId = getenv("Acuc5_MCC46LEgnvmnb_Lv_Rxfh68aLvAwAUOR1nLa9Dy7EwnGSKlfYe4BRyk7iVTmapluRVcYNQl9e7") ?: "PAYPAL-CLIENT-ID";
            $clientSecret = getenv("EMnF1n_TWAihoin6eebxGnlqJuHY3alSlipKlMrR-iz3KGiA6sA_AWbK97C50Nkcu3gvxH_Ct1VQBYfU") ?: "PAYPAL-CLIENT-SECRET";
            return new LiveEnvironment($clientId, $clientSecret);
        }*/
    }
