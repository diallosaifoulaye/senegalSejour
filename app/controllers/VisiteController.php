<?php


namespace app\controllers;

require(ROOT.'app/paydunyaApi.php');

use app\core\BaseController;
use app\core\Session;
use app\core\Utils;
use app\core\TokenJWT;
use app\currencyConverter;
use http\Header;
use Paydunya_Checkout_Store;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;

class VisiteController extends BaseController
{

    private $model;
    /**
     * VisiteController constructor.
     */
    public function __construct()
    {
        parent::__construct(false);
        $this->model = $this->model("membre");
    }

    public function accueil(){
//        var_dump(headers_list());
        $this->views->getPage('site/payVisite');
    }

    public function maisonOusmanesow(){
        header("X-Frame-Options: unset");
        $this->views->getPage('site/visiteTest');
    }

    public function tampon(){
        header("X-Frame-Options: unset");
        $this->views->getPage('site/payVisite_tampo');

    }


    public function visiteVirtuelle(){

        $host_name = sha1($_SERVER["HTTP_USER_AGENT"]);
        $numtransaction = $this->paramPOST["transaction"];

        $param = [
            "champs" => ["*"],
            "condition" => ["numtransaction = ? "],
            "value" => [$numtransaction]
        ];

        $res = $this->model->getOneTransactionVisite($param);


        if (password_verify($host_name, $res->browser_name)){
            if ($res->first_use == 0){

                $param_['condition'] = ["numtransaction = "=>$numtransaction];
                $param_['champs'] = [
                    "first_use"=>1
                ];
                $this->model->updateTransactionVisite($param_);

                $token = TokenJWT::encode([],$res->user_id.$host_name,TIMER);

                $date_debut = date('Y-m-d H:i:s');

                $date_fin = date('Y-m-d H:i:s',strtotime('+'.TIMER.' minutes',strtotime($date_debut)));


                $param = ["numtransaction"=>$numtransaction,"token"=>$token,"date_debut"=>$date_debut,"date_fin"=>$date_fin];

                $this->model->insertToken(["champs"=>$param]);
                $restant = TokenJWT::verif($token,$res->user_id.$host_name);




                $data['restant'] = $restant;/*
                $data['email'] = $res->user_id;
                $data['token'] = $token;*/
                $this->views->setData($data);
                $this->views->initTemplate(["header"=>"header_ep","footer"=>"footer_ep", "sidebar" => "sidebar_site"]);

                header("X-Frame-Options: unset");
                $this->views->getPage('site/visite');

            }
            else{
                $param__ = [
                    "champs" => ["*"],
                    "condition" => ["numtransaction = ? "],
                    "value" => [$numtransaction]
                ];

                $res_ = $this->model->getOneToken($param__);
                if ($res_ != false){
                    $restant = TokenJWT::verif($res_->token,$res->user_id.$host_name);
                    if ($restant > 0){/*
                        $data['emailPayPalClient'] = $res->user_id;
                        $data['token'] = $res_->token;*/
                        $data['restant'] = $restant;
                        $this->views->setData($data);
                        $this->views->initTemplate(["header"=>"header_ep","footer"=>"footer_ep", "sidebar" => "sidebar_site"]);

                        header("X-Frame-Options: unset");
                        $this->views->getPage('site/visite');
                    }else{
                        //token n'est plus valide
                        $param['condition'] = ["numtransaction = "=>$numtransaction];
                        $this->model->deleteToken($param);
                        //Utils::redirect("visite", "tampon");

                        header("X-Frame-Options: unset");
                        $data['messageTokenInvalid'] = $this->lang['token_invalide'];
                        $this->views->setData($data);
                        $this->views->getPage('site/payVisite_tampo');
                    }
                }else{
                    //Token n'existe pas
                    //Utils::redirect("visite", "tampon");
                    header("X-Frame-Options: unset");
                    $data['messageTokenNExistePas'] = $this->lang['token_inexistant'];
                    $this->views->setData($data);
                    $this->views->getPage('site/payVisite_tampo');
                }
            }
        }else{
            //Token déjà utilisé ou attribué
            //Utils::redirect("visite", "tampon");
            header("X-Frame-Options: unset");
            $data['messageTokenDejaUtilise'] = $this->lang['token_deja_utilise'];
            $this->views->setData($data);
            $this->views->getPage('site/payVisite_tampo');
        }

    }

    public function verifToken(){
        $host_name = sha1($_SERVER["HTTP_USER_AGENT"]);
        $email = $this->paramPOST['email'];
        $token = $this->paramPOST['token'];

        $res = TokenJWT::verif($token,$email.$host_name);

        echo $res;
    }

    public function souscrirePayD(){

        Paydunya_Checkout_Store::setName("Visite virtuelle Maison OUSMANE SOW");

        Paydunya_Checkout_Store::setCancelUrl(VISITE_PAIEMENT);

        Paydunya_Checkout_Store::setReturnUrl(HOST."visite/generateToken");

        Session::setAttribut("email",$this->paramGET[1]);



        try
        {
            $invoice = new \Paydunya_Checkout_Invoice();
            $invoice->addItem("Viste virtuelle", 1, 6500, 6500,"Visite virtuelle Maison OUSMANE SOW");
            $invoice->setTotalAmount(6500);

            $numtransaction = strtoupper(Utils::getAlphaNumerique(7));

            Session::setAttribut("numtransaction",$numtransaction);

            $datetransac =  date("Y-m-d H:i:s");

            $host_name_sha = sha1($_SERVER["HTTP_USER_AGENT"]);

            $host_name_crypt = Utils::getPassCrypt($host_name_sha);

            $param = ["user_id"=>$this->paramGET[1],"datetransac"=>$datetransac,"numtransaction"=>$numtransaction,"montant"=>6500,"fk_mode_paiement"=>$this->paramGET[0],"statut"=>0, "browser_name"=>$host_name_crypt];

            $this->model->insertTransactionVisite(["champs"=>$param]);

            if($invoice->create()) {
                header("Location: ".$invoice->getInvoiceUrl());
            }else{
                echo $invoice->response_text;
                header("Location: ".VISITE_ERREUR_SERVEUR);
            }
        }
        catch (\Exception $exception)
        {
            echo $exception->getMessage();
            header("Location: ".VISITE_ERREUR_SERVEUR);
        }

    }

    public function souscrirePayP(){

        Session::setAttribut("email",$this->paramGET[1]);

        // After Step 1
        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                PAYPAL_CLIENT_ID,     // ClientID
                PAYPAL_CLIENT_SECRET   // ClientSecret
            )
        );

        $apiContext->setConfig(
            array(
                'mode' => 'live'
            )
        );


//        $amountC = currencyConverter::currencyConverter("XOF","EUR", PRIX_VISITE,API_CONVERSION);

        $amountC = 7;

        $list = new ItemList();

        $item = (new Item())
            ->setName("Visite virtuelle OUSMANE SOW")
            ->setPrice($amountC)
            ->setCurrency("EUR")
            ->setQuantity("1");

        $list->addItem($item);


        $details = (new Details())->setSubtotal($amountC);

        $amount = (new Amount())->setTotal($amountC)->setCurrency('EUR')->setDetails($details);


        $transaction = (new Transaction())
            ->setItemList($list)
            ->setDescription("Achat Visite virtuelle OUSMANE SOW")
            ->setAmount($amount);

        $payment = new Payment();

        $payment->setTransactions([$transaction]);

        $payment->setIntent('sale');

        $redirectUrls = (new RedirectUrls())
            ->setReturnUrl(HOST."visite/generateQrPal")
            ->setCancelUrl(VISITE_PAIEMENT);


        $payment->setRedirectUrls($redirectUrls);

        $payment->setPayer((new Payer())->setPaymentMethod('paypal'));

        try
        {
            $numtransaction = strtoupper(Utils::getAlphaNumerique(7));

            Session::setAttribut("numtransaction",$numtransaction);

            $datetransac =  date("Y-m-d H:i:s");

            $host_name_sha = sha1($_SERVER["HTTP_USER_AGENT"]);

            $host_name_crypt = Utils::getPassCrypt($host_name_sha);

            $param = ["user_id"=>$this->paramGET[1],"datetransac"=>$datetransac,"numtransaction"=>$numtransaction,"montant"=>6500,"fk_mode_paiement"=>$this->paramGET[0],"statut"=>0, "browser_name"=>$host_name_crypt];

            $this->model->insertTransactionVisite(["champs"=>$param]);

            $payment->create($apiContext);
            header('Location : ' . $payment->getApprovalLink());
        }
        catch (PayPalConnectionException $exception){
            var_dump($exception->getMessage());die();
            header("Location: ".VISITE_ERREUR_SERVEUR);
        }



    }

    public function generateToken(){
        $token = $_GET['token'];
        $numtransaction = Session::getAttribut("numtransaction");
        $email = Session::getAttribut("email");

        try
        {
            $invoice = new \Paydunya_Checkout_Invoice();
            if ($invoice->confirm($token)) {

                if ($invoice->getStatus() == "completed")
                {
                    $statut = 1;
                    $montant = $invoice->getTotalAmount();
                    $commentaire = "Nom: ".$invoice->getCustomerInfo('name')." Email: ".$invoice->getCustomerInfo('email') ." Telephone: ". $invoice->getCustomerInfo('phone')." Prix: ".$montant ."Reponse: ".$invoice->getStatus();

                    $url_pdf = $invoice->getReceiptUrl();

                    $condition = ["numtransaction =" =>$numtransaction];

                    $param = ["commentaire"=>$commentaire,"statut"=>$statut,"url_pdf"=>$url_pdf];

                    $this->model->updateTransactionVisite(["condition"=>$condition ,"champs"=>$param]);

                    Utils::envoiMailVisite($invoice->getCustomerInfo('name'),$email,$numtransaction);

                    header("Location: ".VISITE_RETURN_CALL_BACK);

                }
                else {
                    $statut = 2;
                    $montant = $invoice->getTotalAmount();
                    $commentaire = "Nom: ".$invoice->getCustomerInfo('name')." Email: ".$invoice->getCustomerInfo('email') ." Telephone: ". $invoice->getCustomerInfo('phone')."  Prix: ".$montant ."Reponse: ".$invoice->getStatus();
                    $param = ["commentaire"=>$commentaire,"statut"=>$statut];
                    $condition = ["numtransaction =" =>$numtransaction];

                    $this->model->updateTransactionVisite(["condition"=>$condition ,"champs"=>$param]);

                    header("Location: ".RETURN_ECHEC);
                }


            }else{
                echo $invoice->getStatus();
                echo $invoice->response_text;
                echo $invoice->response_code;

                $statut = 3;
                $montant = $invoice->getTotalAmount();
                $commentaire = "Nom: ".$invoice->getCustomerInfo('name')." Email: ".$invoice->getCustomerInfo('email') ." Telephone: ". $invoice->getCustomerInfo('phone')."  Prix: ".$montant ."Reponse: ".$invoice->getStatus();
                $param = ["commentaire"=>$commentaire,"statut"=>$statut];
                $condition = ["numtransaction =" =>$numtransaction];

                $this->model->updateTransactionVisite(["condition"=>$condition ,"champs"=>$param]);

                header("Location: ".RETURN_ECHEC);
            }
        }
        catch (\Exception $exception)
        {
            header("Location: ".VISITE_ERREUR_SERVEUR);
            Session::destroyAttributSession("email");
            Session::destroyAttributSession("mode_paiement");
            Session::destroyAttributSession("numtransaction");
            Session::destroyAttributSession("host_name");

            $statut = 4;
            $montant = $invoice->getTotalAmount();
            $commentaire = "Nom: ".$invoice->getCustomerInfo('name')." Email: ".$invoice->getCustomerInfo('email') ." Telephone: ". $invoice->getCustomerInfo('phone')."  Prix: ".$montant ."Reponse: ".$invoice->getStatus();
            $param = ["commentaire"=>$commentaire,"statut"=>$statut];
            $condition = ["numtransaction =" =>$numtransaction];

            $this->model->updateTransactionVisite(["condition"=>$condition ,"champs"=>$param]);
        }
        Session::destroyAttributSession("email");
        Session::destroyAttributSession("mode_paiement");
        Session::destroyAttributSession("numtransaction");
        Session::destroyAttributSession("host_name");

    }

    public function generateQrPal(){

        $email = Session::getAttribut("email");

        $numtransaction = Session::getAttribut("numtransaction");


        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                PAYPAL_CLIENT_ID,     // ClientID
                PAYPAL_CLIENT_SECRET      // ClientSecret
            )
        );

        $apiContext->setConfig(
            array(
                'mode' => 'live'
            )
        );

        $payment = Payment::get($this->paramGET['paymentId'],$apiContext);

        $execution = (new PaymentExecution())
            ->setPayerId($this->paramGET['PayerID'])
            ->setTransactions($payment->getTransactions());


        try
        {
            $payment->execute($execution,$apiContext);

            $payer = $payment->getPayer()->getPayerInfo();


            if ($payment->getState() == "approved"){

                $statut = 1;

                $commentaire = "Prenom: ".$payer->getFirstName()."Nom: ".$payer->getLastName()." Email: ". $payer->getEmail()." Telephone: neant , Reponse: ".$payment->getState();

                $condition = ["numtransaction =" =>$numtransaction];

                $param = ["commentaire"=>$commentaire,"statut"=>$statut];

                $this->model->updateTransactionVisite(["condition"=>$condition ,"champs"=>$param]);

//                Utils::envoiMailVisite($payer->getFirstName(). " ".$payer->getLastName(),$email,$numtransaction);
                Utils::envoiMailVisiteTemplate($payer->getFirstName(). " ".$payer->getLastName(),$email,$numtransaction);

                header("Location: ".VISITE_RETURN_CALL_BACK);

            }
            else {

                $statut = 2;

                $commentaire = "Prenom: ".$payer->getFirstName()."Nom: ".$payer->getLastName()." Email: ". $payer->getEmail()." Telephone: neant  Reponse: ".$payment->getState();

                $condition = ["numtransaction =" =>$numtransaction];

                $param = ["commentaire"=>$commentaire,"statut"=>$statut];

                $this->model->updateTransactionVisite(["condition"=>$condition ,"champs"=>$param]);

                header("Location: ".RETURN_ECHEC);
            }

        }
        catch (PayPalConnectionException $exception){

            Session::destroyAttributSession("email");
            Session::destroyAttributSession("mode_paiement");
            Session::destroyAttributSession("numtransaction");
            Session::destroyAttributSession("host_name");

            $statut = 3;

            $commentaire = "Prenom: ".$payer->getFirstName()."Nom: ".$payer->getLastName()." Email: ". $payer->getEmail()." Telephone: neant  Reponse: ".$payment->getState(). "Exception: ".$exception->getMessage();

            $condition = ["numtransaction =" =>$numtransaction];

            $param = ["commentaire"=>$commentaire,"statut"=>$statut];

            $this->model->updateTransactionVisite(["condition"=>$condition ,"champs"=>$param]);
            header("Location: ".VISITE_ERREUR_SERVEUR);
        }

        Session::destroyAttributSession("email");
        Session::destroyAttributSession("mode_paiement");
        Session::destroyAttributSession("numtransaction");
        Session::destroyAttributSession("host_name");

    }

}