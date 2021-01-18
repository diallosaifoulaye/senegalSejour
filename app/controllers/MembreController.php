<?php

/**
 * Created by PhpStorm.
 * User: Seyni FAYE
 * Date: 15/02/2017
 * Time: 21:11
 */


namespace app\controllers;

require(ROOT.'app/phpqrcode/qrlib.php');
require(ROOT.'app/paydunyaApi.php');

use app\core\BaseController;
use app\core\Session;
use app\core\Utils;
use app\CreateOrder;
use app\currencyConverter;
use app\models\UserModel;
use http\Client\Request;
use Paydunya_Checkout_Store;
use PayPal\Api\Amount;
use PayPal\Api\Currency;
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

class MembreController extends BaseController
{
    private $model;
    private $user_model;
    private $formule;
    private $paiement;
    private $souscription;
    private $gainBon;
    private $montant;
    private $deviseVal;
    private $deviseCode;

    public function __construct()
    {
        parent::__construct();
        $this->model = $this->model("membre");
        $this->user_model = $this->model("user");
        $this->formule = $this->model("formule");
        $this->paiement = $this->model("paiement");
        $this->souscription = $this->model("souscription");
        $this->gainBon = $this->model("gainBon");
        $this->membre_tmp = $this->model("membre_tmp");
    }

    /**
     * @droit Lister Agence - 4
     */
    public function liste()
    {
        $this->views->getTemplate('membre/liste');
    }

    public function differentesformules()
    {
        if ($this->_USER->fk_partenaire) {
            $formules = $this->formule->getFormuleActif(["condition" => ["etat =" => 1]]);
        } else {
            $formules = $this->formule->getFormuleActif(["condition" => ["exclusive !=" => 1, "etat =" => 1]]);
        }

        $_ = $this->formule->getSouscriptionCount(["condition" => ["u.id =" => $this->_USER->id, "s.etat=" => 1]]);
//        var_dump($_[0]->nbr);die();
        $AllReadySusbcribe = $_[0]->nbr;
        $formulesAvantages = array();
        foreach ($formules as $value) {
            $avantages = $this->formule->getFormuleAvantageLibelle(["condition" => ["formule_id =" => $value->id]]);
            $_ = array("formules" => $value, "avantages" => $avantages);
            array_push($formulesAvantages, $_);
        }
        $data["formulesAvantages"] = $formulesAvantages;
        $data["AllReadySusbcribe"] = $AllReadySusbcribe;

        $this->views->setData($data);
        $this->views->initTemplate(["header" => "header_ep", "footer" => "footer_ep", "sidebar" => "sidebar_site"]);
        $this->views->getTemplate('site/pass');
    }

    public function home()
    {
//        var_dump($this->_USER);die();
        $this->views->initTemplate(["header" => "header_ep", "footer" => "footer_ep", "sidebar" => "sidebar_site"]);
        $this->views->getTemplate('site/accueil');
    }

    public function listeProcessing()
    {
        $param = [
            "button" => [
                "modal" => [
                    ["membre/editMembreModal", "membre/editMembreModal", "fa fa-edit"],
                    ["membre/editMembreMail", "membre/editMembreMail", "fa fa-at"],
                    ["membre/editFormule", "membre/editFormuleModal", "fa fa-file"]
                ],
                "default" => [
                    ["champ" => "etat", "val" => ["Désactiver" => ["membre/activate", "fa fa-toggle-off"], "Activer" => ["membre/deactivate", "fa fa-toggle-on"]]],
                    ["membre/historyMembre", "fa fa-history"]
                ],
                "custom" => []
            ],
            "tooltip" => [
                "modal" => [
                    $this->lang["modifyMembre"],
                    $this->lang["modifyMail"],
                    $this->lang["update_Formule"]
                ],
                "default" => [
                    ["champ" => "etat", "val" => ["Désactiver" => $this->lang["tooltipActive"], "Activer" => $this->lang["tooltipDesactive"]]],
                    $this->lang["historique_membre"]
                ]
            ],
            "classCss" => [
                "modal" => [],
                "default" => ["confirm"]
            ],
            "attribut" => [
                "modal" => [],
                "default" => []
            ],
            "args" => null,
            "dataVal" => [
                ["champ" => "etat", "val" => ["Désactiver" => ["<span style='.temp::before{text-align: right;}' class='temp text-info'>" . $this->lang['btn_desactiver'] . "</span>"], "Activer" => ["<span  class='temp text-success' >" . $this->lang['btn_activer'] . "</span><style>.temp::before{text-align: right;}</style>"]]]
            ],
            "fonction" => [
                "date_crea" => "getDateFR_",
                "libelle" => "testFormule"
            ]
        ];
        $this->processing($this->model, "getList", $param);
    }

    /**
     * @droit Activer Membre - 4
     */
    public function activate()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->model->set(["table" => "user", "champs" => ["etat" => "Activer"], "condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false) {
                Utils::setMessageALert(["success", $this->lang["membre_active"]]);
                Utils::redirect("membre", "liste");
            } else {
                Utils::setMessageALert(["danger", $this->lang["echec_activation_membre"]]);
                Utils::redirect("membre", "liste");
            }
        } else {
            Utils::setMessageALert(["danger", $this->lang["echec_activation_membre"]]);
            Utils::redirect("membre", "liste");
        }
    }

    /**
     * @droit Désactiver Membre - 4
     */
    public function deactivate()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->model->set(["table" => "user", "champs" => ["etat" => "Désactiver"], "condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false) {
                Utils::setMessageALert(["success", $this->lang["membre_desactive"]]);
                Utils::redirect("membre", "liste");

            } else {
                Utils::setMessageALert(["danger", $this->lang["echec_desactivation_membre"]]);
                Utils::redirect("membre", "liste");

            }
        } else {
            Utils::setMessageALert(["danger", $this->lang["echec_desactivation_membre"]]);
            Utils::redirect("membre", "liste");
        }

    }

    public function code()
    {
        $this->views->initTemplate(["header" => "header_ep", "footer" => "footer_ep", "sidebar" => "sidebar_site"]);
        $this->views->getTemplate('membre/code');
    }


    public function souscriptionModal__()
    {
        $data['formule'] = $this->formule->getOneFormule(["condition" => ["id = " => $this->paramGET[2]]]);
        $data['paiement'] = $this->paiement->getPaiement(["condition" => ["etat = " => 1]]);
        $this->views->setData($data);
        $this->modal();
    }

    public function listePassageMembre()
    {
        $this->views->initTemplate(["header" => "header_ep", "footer" => "footer_ep", "sidebar" => "sidebar_site"]);
        $this->views->getTemplate('site/histo_membre');
        //$this->views->getTemplate('membre/listePassageMembre');
    }

    public function listePassageProcessing__()
    {
        $param = [
            "args" => $this->_USER,
            "fonction" => [
                'montant' => 'getFormatMoney',
                'date_passage' => 'getDateFR',
                'montant_economise' => 'getFormatMoney'
            ]

        ];
        $this->processing($this->model, "getListPassage", $param);
    }

    public function listeTransactionMembre()
    {
        Utils::setDefaultSort(6, "DESC");
        $this->views->initTemplate(["header" => "header_ep", "footer" => "footer_ep", "sidebar" => "sidebar_site"]);
        $this->views->getTemplate('site/histo_transaction_membre');
        //$this->views->getTemplate('membre/listeTransactionMembre');
    }

    public function listeTransactionProcessing()
    {
        $param = [
            "button" => [
                "modal" => [
//                    ["membre/formuleInfoModal","membre/formuleInfoModal","fa fa-search"]
                ],
                "default" => [
                    ["membre/formuleDetail", "fa fa-eye"]
                ],
                "custom" => []
            ],
            "tooltip" => [
                "modal" => [
                    $this->lang["tooltipDetail"]
                ],
                "default" => [
                    $this->lang["tooltipVoir"]
                ]
            ],
            "args" => $this->_USER,
            "dataVal" => [
                ["champ" => "etat", "val" => ["0" => ["<i class='text-danger'>" . $this->lang['expire'] . " </i>"], "1" => ["<i class='text-success'>" . $this->lang['cours'] . "</i>"]]]
            ],
            "fonction" => [
                'date_debut' => 'getDateFR',
                'date_fin' => 'getDateFR'
            ]

        ];
        $this->processing($this->model, "getListTransaction", $param);
    }

    public function listeSouscriptionMembre()
    {
        $this->views->initTemplate(["header" => "header_ep", "footer" => "footer_ep", "sidebar" => "sidebar_site"]);
        $this->views->getTemplate('site/histo_souscription_membre');
        //$this->views->getTemplate('membre/listeSouscriptionMembre');
    }

    public function getListSouscription()
    {
        $param = [
            "args" => $this->_USER,
            "dataVal" => [
                ["champ" => "etat", "val" => ["0" => ["<i class='text-danger'>" . $this->lang['desactiver'] . " </i>"], "1" => ["<i class='text-success'>" . $this->lang['activer'] . "</i>"]]]
            ],
            "fonction" => [
                'montant' => 'getFormatMoney',
                'date_debut' => 'getDateFR',
                'date_fin' => 'getDateFR'
            ]
        ];
        $this->processing($this->model, "getListSouscription", $param);
    }

    public function listeCadeaux()
    {
        $this->views->initTemplate(["header" => "header_ep", "footer" => "footer_ep", "sidebar" => "sidebar_site"]);

        $data['point_fidelite'] = $this->model->getPointFidelite($this->_USER)[0];
        $this->views->setData($data);
        $this->views->getTemplate('site/liste_cadeaux');
        //$this->views->getTemplate('membre/listeCadeaux');
    }

    public function rejoindreClub()
    {
        $this->views->initTemplate(["header" => "header_ep", "footer" => "footer_ep", "sidebar" => "sidebar_site"]);
        $this->views->getTemplate('site/static');
    }

    public function listeCadeauProcessing()
    {
        $param = [
            "button" => [
                "modal" => [
                    ["membre/getCadeauModal", "membre/getCadeauModal", "glyphicon glyphicon-chevron-right"]
                ]
            ],
            "tooltip" => [
                "modal" => [
                    $this->lang["tooltipModif"]
                ]
            ],
            "args" => null,
            "dataVal" => [
                ["champ" => "etat", "val" => ["0" => ["<i class='text-danger'>" . $this->lang['desactiver'] . " </i>"], "1" => ["<i class='text-success'>" . $this->lang['activer'] . "</i>"]]]

            ],
            "fonction" => []
        ];
        $this->processing($this->model, "getListCadeau", $param);
    }

    public function getCadeauModal__()
    {
        $data['cadeaux'] = $this->gainBon->getOneGainBon(["condition" => ["id = " => $this->paramGET[2]]]);
        $this->views->setData($data);

        $this->modal();
    }

    public function editFormule()
    {
        if ($this->paramGET[2]) {
            $val = $this->getIdSubscription($this->paramGET[2]);
            $data['id_user'] = $val[0]->id_user;
            $data['id_formule'] = $val[0]->id_formule;
        }
        $data['formules'] = $this->formule->getFormuleActif(["condition" => ["etat =" => 1]]);
        $this->views->setData($data);
        $this->modal();
    }


    function getIdSubscription($id)
    {
        $param = ["condition" => ["u.id =" => $id]];
        return $this->model->getIdFormuleSubs($param);
    }

    public function formuleInfoModal__()
    {
        $this->modal();
    }

    public function formuleDetail__()
    {
        $data['souscription'] = $this->souscription->getOneSouscription(["condition" => ["id = " => $this->paramGET[0]]]);
        $formule_id = $data['souscription']->formule_id;
        $membre_id = $data['souscription']->membre_id;
        $qrcode = $data['souscription']->qrcode;
        $data['formule'] = $this->formule->getFormule_Type(["condition" => ["f.id = " => $formule_id]])[0];
        $user = $this->model->getUser(["condition" => ["id = " => $membre_id]])[0];
        $data['user'] = $user->prenom . ' ' . $user->nom;
//        var_dump($data);
        $matches = array();
        $_pattern = "/app\/[a-zA-Z0-9\/_]*.png/i";
        preg_match($_pattern, $qrcode, $matches);
        $data['souscription']->qrcode = WEBROOT . $matches[0];
//        var_dump($data);die();
        $this->views->setData($data);
        $this->views->initTemplate(["header" => "header_ep", "footer" => "footer_ep", "sidebar" => "sidebar_site"]);
        $this->views->getTemplate("membre/formuleInfo");
    }

    public function souscrireFormule()
    {
//        var_dump($this->paramPOST);die();
        $mode = $this->paramPOST['mode'];
        $formule_id = $this->paramPOST['id'];
        $promotion_id = $this->paramPOST['promotion_id'];
        $code = $this->paramPOST['confirmation'];
        if ($code == "non") {
            if ($mode == "paydunia") {
                Utils::redirect("membre", "souscrirePayD", [0 => $formule_id, 1 => 2]);
            } else {
                Utils::redirect("membre", "souscrirePayP", [0 => $formule_id, 1 => 3]);
            }
        } else {
            if ($mode == "paydunia") {
                Utils::redirect("membre", "souscrirePayD", [0 => $formule_id, 1 => 2, 2 => $promotion_id]);
            } else {
                Utils::redirect("membre", "souscrirePayP", [0 => $formule_id, 1 => 3, 2 => $promotion_id]);
            }
        }

    }

    public function gestFormule()
    {
        $formule = $this->formule->getFormule(["condition" => ["id = " => $this->paramPOST['id_formule']]])[0];
        $user = $this->model->getUser(["condition" => ["id = " => $this->paramPOST['id_user']]])[0];

        $_ = array("user" => $user, "formule" => $formule);

        $this->setSubscription($_);

        die();
    }

    /*
     * PayDunya
     */

    public function souscrirePayD()
    {

        Paydunya_Checkout_Store::setName("Le Club SenegalSejour");

        Paydunya_Checkout_Store::setCancelUrl(HOST . "membre/DunyaCancel");

        Paydunya_Checkout_Store::setReturnUrl(HOST . "membre/generateQr");

        $result = $this->formule->getOneFormule(["condition" => ["id = " => $this->paramGET[0]]]);

        Session::setAttribut("formule_id", $result->id);
        Session::setAttribut("mode_paiement", $this->paramGET[1]);

        $this->montant = 0;

        if (isset($this->paramGET[2])) {
            $res_ = $this->formule->getCodePromo(['condition' => ["id =" => $this->paramGET[2]]])[0];
            $this->montant = (intval($result->montant) * (intval($res_->taux))) / 100;
            $this->montant = intval($result->montant) - intval($this->montant);
        } else {
            $this->montant = $result->montant;
        }

        try {
            $invoice = new \Paydunya_Checkout_Invoice();
            $invoice->addItem($result->libelle, 1, $this->montant, $result->montant, $result->description);
            $invoice->setTotalAmount($this->montant);

            $numtransaction = strtoupper(Utils::getAlphaNumerique(20));

            Session::setAttribut("numtransaction", $numtransaction);

            $datetransac = date("Y-m-d H:i:s");

            $param = ["datetransac" => $datetransac, "numtransaction" => $numtransaction, "montant" => $result->montant, "fk_mode_paiement" => $this->paramGET[1]];


            $this->model->insertTransaction(["champs" => $param]);

            if ($invoice->create()) {
                header("Location: " . $invoice->getInvoiceUrl());
            } else {
                echo $invoice->response_text;
                Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
                Utils::redirect("membre", "differentesFormules");
            }
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
            Utils::redirect("membre", "differentesFormules");
        }
    }


    public function generateQr()
    {

        $token = $_GET['token'];

        $id = Session::getAttribut("formule_id");

        $mode_paiement_id = Session::getAttribut("mode_paiement");

        $formule = $this->formule->getFormule_Type(["condition" => ["f.id = " => $id]])[0];

        $numtransaction = Session::getAttribut("numtransaction");

        try {
            $invoice = new \Paydunya_Checkout_Invoice();
            if ($invoice->confirm($token)) {

                if ($invoice->getStatus() == "completed") {

                    $code = substr(md5(microtime()), 0, 10);

                    $date_debut = date('Y-m-d H:i:s');

                    $date_debut_crea = date_create($date_debut);

                    if ($formule->type_duree == "MOIS") {
                        $_ = "months";
                    } elseif ($formule->type_duree == "ANNEES") {
                        $_ = "years";
                    }
                    $date_debut_ = clone $date_debut_crea;

                    $date_fin = date_add($date_debut_crea, date_interval_create_from_date_string($formule->duree . ' ' . $_));

                    $statut = 1;

                    $param = ["No_carte" => strtoupper($code), "date_debut" => $date_debut_->format('Y-m-d H:i:s'), "date_fin" => $date_fin->format('Y-m-d H:i:s'), "qrcode" => "", "membre_id" => $this->_USER->id, "formule_id" => $id, "mode_paiement_id" => $mode_paiement_id];

                    $result = $this->souscription->insertSouscription(["champs" => $param]);

                    $destinataire = $this->_USER->prenom . ' ' . $this->_USER->nom;

                    $dossier_photo = ROOT . "app/qrCodes/";

                    $fileName = 'qr_file_' . md5(strtoupper($code)) . '.png';

                    $pngAbsoluteFilePath = $dossier_photo . $fileName;

                    $codeContents = HOST . "scan/loginscan/" . base64_encode(strtoupper($code));


                    \QRcode::png($codeContents, $pngAbsoluteFilePath);


                    $this->souscription->updateSouscription(["champs" => ["qrcode" => $pngAbsoluteFilePath], "condition" => ["id =" => $result]]);

                    $matches = array();

                    $_pattern = "/app\/[a-zA-Z0-9\/_]*.png/i";

                    preg_match($_pattern, $pngAbsoluteFilePath, $matches);
//                    Utils::envoiQrCode($destinataire,$this->_USER->email,$formule->type,$formule->libelle,$formule->corps,$formule->titre1,$formule->labels,$formule->texts, $formule->titre2, $formule->back_color,"https://virtualtoursenegalsejour.com".WEBROOT.$matches[0],strtoupper($code),$date_debut_->format('Y-m-d'), $date_fin->format('Y-m-d'));
                    Utils::envoiQrCodeV2($destinataire, $this->_USER->email, $formule->type, $formule->libelle, $formule->corps, $formule->titre1, $formule->labels, $formule->texts, $formule->titre2, $formule->back_color, "https://virtualtoursenegalsejour.com" . WEBROOT . $matches[0], strtoupper($code), $date_debut_->format('Y-m-d'), $date_fin->format('Y-m-d'));

                    $souscription_id = $result;
                    $commentaire = "Nom: " . $invoice->getCustomerInfo('name') . " Email: " . $invoice->getCustomerInfo('email') . " Telephone: " . $invoice->getCustomerInfo('phone') . " Formule: " . $formule->libelle . " Prix: " . $formule->montant . "Reponse: " . $invoice->getStatus();
                    $commission = 0;
                    $url_pdf = $invoice->getReceiptUrl();

                    $condition = ["numtransaction =" => $numtransaction];

                    $param = ["souscription_id" => $souscription_id, "commentaire" => $commentaire, "statut" => $statut, "commission" => $commission, "url_pdf" => $url_pdf];

                    $this->model->updateTransaction(["condition" => $condition, "champs" => $param]);

                    Utils::setMessageALert(["success", $this->lang["actionsuccess"]]);
                    Utils::redirect("membre", "code");

                } else {

                    $statut = 2;

                    $commentaire = "Nom: " . $invoice->getCustomerInfo('name') . " Email: " . $invoice->getCustomerInfo('email') . " Telephone: " . $invoice->getCustomerInfo('phone') . " Formule: " . $formule->libelle . " Prix: " . $formule->montant . "Reponse: " . $invoice->getStatus();

                    $commission = 0;

                    $condition = ["numtransaction =" => $numtransaction];

                    $param = ["user_id" => $this->_USER->id, "commentaire" => $commentaire, "statut" => $statut, "commission" => $commission];

                    $this->model->updateTransaction(["condition" => $condition, "champs" => $param]);

                    Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
                    Utils::redirect("membre", "differentesFormules");

                }


            } else {
                echo $invoice->getStatus();
                echo $invoice->response_text;
                echo $invoice->response_code;

                $statut = 3;

                $commentaire = "Nom: " . $invoice->getCustomerInfo('name') . " Email: " . $invoice->getCustomerInfo('email') . " Telephone: " . $invoice->getCustomerInfo('phone') . " Formule: " . $formule->libelle . " Prix: " . $formule->montant . "Reponse: " . $invoice->getStatus();

                $commission = 0;

                $condition = ["numtransaction =" => $numtransaction];

                $param = ["user_id" => $this->_USER->id, "commentaire" => $commentaire, "statut" => $statut, "commission" => $commission];

                $this->model->updateTransaction(["condition" => $condition, "champs" => $param]);
                Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
                Utils::redirect("membre", "differentesFormules");
            }
        } catch (\Exception $exception) {
            Session::destroyAttributSession("souscription_id");
            Session::destroyAttributSession("mode_paiement");
            Session::destroyAttributSession("formule_id");
            Session::destroyAttributSession("numtransaction");

            $statut = 4;

            $commentaire = "Nom: " . $invoice->getCustomerInfo('name') . " Email: " . $invoice->getCustomerInfo('email') . " Telephone: " . $invoice->getCustomerInfo('phone') . " Formule: " . $formule->libelle . " Prix: " . $formule->montant . "Reponse: " . $invoice->getStatus();

            $commission = 0;

            $condition = ["numtransaction =" => $numtransaction];

            $param = ["user_id" => $this->_USER->id, "commentaire" => $commentaire, "statut" => $statut, "commission" => $commission];

            $this->model->updateTransaction(["condition" => $condition, "champs" => $param]);
            Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
            Utils::redirect("membre", "differentesFormules");
        }

        Session::destroyAttributSession("souscription_id");
        Session::destroyAttributSession("mode_paiement");
        Session::destroyAttributSession("formule_id");
        Session::destroyAttributSession("numtransaction");


    }


    /*
     * PayPal
     */

    public function souscrirePayP()
    {

        $result = $this->formule->getOneFormule(["condition" => ["id = " => $this->paramGET[0]]]);
        $res = $this->formule->getDeviseActif()[0];
        $this->deviseVal = $res->valeur;
        $this->deviseCode = $res->code;


        Session::setAttribut("formule_id", $result->id);
        Session::setAttribut("mode_paiement", $this->paramGET[1]);

        $this->montant = 0;

        if (isset($this->paramGET[2])) {
            $res_ = $this->formule->getCodePromo(['condition' => ["id =" => $this->paramGET[2]]])[0];
            $this->montant = (intval($result->montant) * (intval($res_->taux))) / 100;
            $this->montant = intval($result->montant) - intval($this->montant);
            $this->montant = intval($this->montant) / intval($this->deviseVal);
        } else {
            $this->montant = $result->montant / $this->deviseVal;
        }
        // After Step 1
        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                PAYPAL_CLIENT_ID,     // ClientID
                PAYPAL_CLIENT_SECRET     // ClientSecret
            )
        );

        $apiContext->setConfig(
            array(
                'mode' => 'live'
            )
        );


        $list = new ItemList();
        $amountC = $this->montant;

        $item = (new Item())
            ->setName($result->libelle)
            ->setPrice(round($amountC))
            ->setCurrency($this->deviseCode)
            ->setQuantity("1");

        $list->addItem($item);


        $details = (new Details())->setSubtotal(round($amountC));

        $amount = (new Amount())->setTotal(round($amountC))->setCurrency($this->deviseCode)->setDetails($details);

        $transaction = (new Transaction())
            ->setItemList($list)
            ->setDescription("Achat " . $result->libelle . " sur senegal sejour")
            ->setAmount($amount);

        $payment = new Payment();

        $payment->setTransactions([$transaction]);

        $payment->setIntent('sale');

        $redirectUrls = (new RedirectUrls())
            ->setReturnUrl(HOST . "membre/generateQrPal")
            ->setCancelUrl(HOST . "membre/PalCancel");


        $payment->setRedirectUrls($redirectUrls);

        $payment->setPayer((new Payer())->setPaymentMethod('paypal'));


        try {
            $numtransaction = strtoupper(Utils::getAlphaNumerique(20));

            Session::setAttribut("numtransaction", $numtransaction);

            $datetransac = date("Y-m-d H:i:s");

            $param = ["datetransac" => $datetransac, "numtransaction" => $numtransaction, "montant" => $result->montant, "fk_mode_paiement" => $this->paramGET[1]];

            $this->model->insertTransaction(["champs" => $param]);

            $payment->create($apiContext);
            header('Location : ' . $payment->getApprovalLink());
        } catch (PayPalConnectionException $exception) {
            Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
            Utils::redirect("membre", "differentesFormules");
        }


    }

    public function generateQrPal()
    {

        $id = Session::getAttribut("formule_id");

        $mode_paiement_id = Session::getAttribut("mode_paiement");

        $formule = $this->formule->getFormule_Type(["condition" => ["f.id = " => $id]])[0];

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

        $payment = Payment::get($this->paramGET['paymentId'], $apiContext);

        $execution = (new PaymentExecution())
            ->setPayerId($this->paramGET['PayerID'])
            ->setTransactions($payment->getTransactions());


        try {
            $payment->execute($execution, $apiContext);

            $payer = $payment->getPayer()->getPayerInfo();

            if ($payment->getState() == "approved") {
                $statut = 1;
                $code = substr(md5(microtime()), 0, 10);

                $date_debut = date('Y-m-d H:i:s');

                $date_debut_crea = date_create($date_debut);

                if ($formule->type_duree == "MOIS") {
                    $_ = "months";
                } elseif ($formule->type_duree == "ANNEES") {
                    $_ = "years";
                }
                $date_debut_ = clone $date_debut_crea;

                $date_fin = date_add($date_debut_crea, date_interval_create_from_date_string($formule->duree . ' ' . $_));

                $param = ["No_carte" => strtoupper($code), "date_debut" => $date_debut_->format('Y-m-d H:i:s'), "date_fin" => $date_fin->format('Y-m-d H:i:s'), "qrcode" => "", "membre_id" => $this->_USER->id, "formule_id" => $id, "mode_paiement_id" => $mode_paiement_id];

                $result = $this->souscription->insertSouscription(["champs" => $param]);

                $destinataire = $this->_USER->prenom . ' ' . $this->_USER->nom;

                $dossier_photo = ROOT . "app/qrCodes/";

                $fileName = 'qr_file_' . md5(strtoupper($code)) . '.png';

                $pngAbsoluteFilePath = $dossier_photo . $fileName;

                $codeContents = HOST . "scan/loginscan/" . base64_encode(strtoupper($code));


                \QRcode::png($codeContents, $pngAbsoluteFilePath);

                $this->souscription->updateSouscription(["champs" => ["qrcode" => $pngAbsoluteFilePath], "condition" => ["id =" => $result]]);

                $matches = array();

                $_pattern = "/app\/[a-zA-Z0-9\/_]*.png/i";

                preg_match($_pattern, $pngAbsoluteFilePath, $matches);
//                Utils::envoiQrCode($destinataire,$this->_USER->email,$formule->type,$formule->libelle,$formule->corps,$formule->titre1,$formule->labels,$formule->texts, $formule->titre2, $formule->back_color,"https://virtualtoursenegalsejour.com".WEBROOT.$matches[0],strtoupper($code),$date_debut_->format('Y-m-d'), $date_fin->format('Y-m-d'));
                Utils::envoiQrCodeV2($destinataire, $this->_USER->email, $formule->type, $formule->libelle, $formule->corps, $formule->titre1, $formule->labels, $formule->texts, $formule->titre2, $formule->back_color, "https://virtualtoursenegalsejour.com" . WEBROOT . $matches[0], strtoupper($code), $date_debut_->format('Y-m-d'), $date_fin->format('Y-m-d'));

                $souscription_id = $result;
                $commentaire = "Prenom: " . $payer->getFirstName() . "Nom: " . $payer->getLastName() . " Email: " . $payer->getEmail() . " Telephone: neant  Formule: " . $formule->libelle . " Prix: " . $formule->montant . "Reponse: " . $payment->getState();
                $commission = 0;

                $condition = ["numtransaction =" => $numtransaction];

                $param = ["souscription_id" => $souscription_id, "commentaire" => $commentaire, "statut" => $statut, "commission" => $commission];

                $this->model->updateTransaction(["condition" => $condition, "champs" => $param]);

                Utils::setMessageALert(["success", $this->lang["actionsuccess"]]);
                Utils::redirect("membre", "code");

            } else {

                $statut = 2;

                $commentaire = "Prenom: " . $payer->getFirstName() . "Nom: " . $payer->getLastName() . " Email: " . $payer->getEmail() . " Telephone: neant  Formule: " . $formule->libelle . " Prix: " . $formule->montant . "Reponse: " . $payment->getState();

                $commission = 0;

                $condition = ["numtransaction =" => $numtransaction];

                $param = ["user_id" => $this->_USER->id, "commentaire" => $commentaire, "statut" => $statut, "commission" => $commission];

                $this->model->updateTransaction(["condition" => $condition, "champs" => $param]);

                Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
                Utils::redirect("membre", "differentesFormules");
            }
        } catch (PayPalConnectionException $exception) {
            Session::destroyAttributSession("mode_paiement");
            Session::destroyAttributSession("formule_id");
            Session::destroyAttributSession("numtransaction");
            $statut = 3;

            $commentaire = "Prenom: " . $payer->getFirstName() . "Nom: " . $payer->getLastName() . " Email: " . $payer->getEmail() . " Telephone: neant  Formule: " . $formule->libelle . " Prix: " . $formule->montant . "Reponse: " . $payment->getState();

            $commission = 0;

            $condition = ["numtransaction =" => $numtransaction];

            $param = ["user_id" => $this->_USER->id, "commentaire" => $commentaire, "statut" => $statut, "commission" => $commission];

            $this->model->updateTransaction(["condition" => $condition, "champs" => $param]);
            Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
            Utils::redirect("membre", "differentesFormules");
        }

        Session::destroyAttributSession("mode_paiement");
        Session::destroyAttributSession("formule_id");
        Session::destroyAttributSession("numtransaction");


    }

    public function PalCancel()
    {
        Utils::setMessageALert(["succes", $this->lang["action_cancelled"]]);
        Utils::redirect("membre", "differentesFormules");
    }

    public function DunyaCancel()
    {
        Utils::setMessageALert(["succes", $this->lang["action_cancelled"]]);
        Utils::redirect("membre", "differentesFormules");
    }

    public function historyMembre()
    {

        $data['membres'] = $this->model->getOneMembre(["condition" => ["s.membre_id = " => $this->paramGET[0]]])[0];
        $this->views->setData($data);
        $this->views->getTemplate('membre/historyMembre');

    }

    public function listePassageByMembreProcessing()
    {
        $param = [
            "args" => $this->paramGET,
            "fonction" => [
                'date_passage' => 'getDateFR',
                'montant_economise' => 'getFormatMoney',
                'montant' => 'getFormatMoney',
            ]
        ];
        $this->processing($this->model, 'getListPassageMembre', $param);
    }

    function setDuration($duree, $type_duree)
    {
        $date_debut = date('Y-m-d H:i:s');

        $date_debut_crea = date_create($date_debut);

        if ($type_duree == "MOIS") {
            $_ = "months";
        } elseif ($type_duree == "ANNEES") {
            $_ = "years";
        }
        $date_debut_ = clone $date_debut_crea;

        $date_fin = date_add($date_debut_crea, date_interval_create_from_date_string($duree . ' ' . $_));

        $_ = array("debut" => $date_debut_->format('Y-m-d H:i:s'), "fin" => $date_fin->format('Y-m-d H:i:s'));

        return $_;
    }

    function setSubscription(&$data)
    {

        $formule = $data["formule"];

        $user = $data["user"];

        $this->souscription->beginTransaction();

        $_ = $this->souscription->updateSouscription(["champs" => ["etat" => 0], "condition" => ["membre_id =" => $user->id]]);

        if ($_) {
            $_duration = $this->setDuration($formule->duree, $formule->type_duree);

            $code = substr(md5(microtime()), 0, 10);
//
            $param = ["No_carte" => strtoupper($code), "date_debut" => $_duration['debut'], "date_fin" => $_duration['fin'], "qrcode" => "", "membre_id" => $user->id, "formule_id" => $formule->id, "mode_paiement_id" => 4];
//
            $result = $this->souscription->insertSouscription(["champs" => $param]);
//
            $destinataire = $user->prenom . ' ' . $user->nom;
//
            $dossier_photo = ROOT . "app/qrCodes/";
//
            $fileName = 'qr_file_' . md5(strtoupper($code)) . '.png';
//
            $pngAbsoluteFilePath = $dossier_photo . $fileName;
//
            $codeContents = HOST . "scan/loginscan/" . base64_encode(strtoupper($code));
//
//
            \QRcode::png($codeContents, $pngAbsoluteFilePath);
//
            $this->souscription->updateSouscription(["champs" => ["qrcode" => $pngAbsoluteFilePath], "condition" => ["id =" => $result]]);

            $numtransaction = strtoupper(Utils::getAlphaNumerique(20));

            $datetransac = date("Y-m-d H:i:s");

            $param = ["souscription_id" => $result, "datetransac" => $datetransac, "numtransaction" => $numtransaction, "montant" => $formule->montant, "commentaire" => "Souscription depuis la BO", "fk_mode_paiement" => 4, "statut" => 1];

            $res_tra = $this->model->insertTransaction(["champs" => $param]);

            if ($res_tra != null || $res_tra) {

                $matches = array();
//
                $_pattern = "/app\/[a-zA-Z0-9\/_]*.png/i";
//
                preg_match($_pattern, $pngAbsoluteFilePath, $matches);
////                Utils::envoiQrCode($destinataire,$this->_USER->email,$formule->type,$formule->libelle,$formule->corps,$formule->titre1,$formule->labels,$formule->texts, $formule->titre2, $formule->back_color,"https://virtualtoursenegalsejour.com".WEBROOT.$matches[0],strtoupper($code),$date_debut_->format('Y-m-d'), $date_fin->format('Y-m-d'));
                $_deb = explode(" ", $_duration['debut']);
                $_fin = explode(" ", $_duration['fin']);
                Utils::envoiQrCodeV2($destinataire, $user->email, $formule->type, $formule->libelle, $formule->corps, $formule->titre1, $formule->labels, $formule->texts, $formule->titre2, $formule->back_color, "https://virtualtoursenegalsejour.com" . WEBROOT . $matches[0], strtoupper($code), $_deb[0], $_fin[0]);
//
                $this->souscription->commit();
                Utils::setMessageALert(["success", $this->lang["actionsuccess"]]);
                Utils::redirect("membre", "liste");
            } else {
                $this->souscription->rollBack();
                Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
                Utils::redirect("membre", "liste");
            }

        } else {
            $this->souscription->rollBack();
            Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
            Utils::redirect("membre", "liste");
        }

    }

    public function ajoutMembreModal()
    {
        $this->modal();
    }

    public function ajoutMembre()
    {
        try {
            if (Utils::validateMail($this->paramPOST["email"])) {
                $this->user_model->beginTransaction();
                $data['nom'] = $this->paramPOST['nom'];
                $data['prenom'] = $this->paramPOST['prenom'];
                $data['email'] = $this->paramPOST['email'];
                $data['telephone'] = $this->paramPOST['telephone'];
                $data['dateNaissance'] = $this->paramPOST['dateNaissance'];
                $data['login'] = $this->paramPOST['email'];
                $data['uiid'] = bin2hex(random_bytes(5));
                $data['type_profil'] = 3;
                $data['date_crea'] = date('Y-m-d');
                $pass = Utils::getGeneratePassword(12);
                $pwd = $pass['pass'];
                $data['password'] = $pass["crypt"];
                $data['connect'] = 1;
                $result = $this->user_model->insertUser(["champs" => $data]);
                if ($result !== false) {
                    try {
                        Utils::envoiMail_v1($this->paramPOST["prenom"] . ' ' . $this->paramPOST["nom"], $this->paramPOST["email"], $this->paramPOST['email'], $pwd);
                        Utils::envoiConfirmation_inscription($this->paramPOST['prenom'] . ' ' . $this->paramPOST['nom'], EMAIL_CONTACT);

                        $this->user_model->commit();
                        Utils::setMessageALert(["success", $this->lang["actionsuccess"]]);
                        Utils::redirect("membre", "liste");
                    } catch (\Exception $exception) {
                        $this->user_model->rollBack();
                        Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
                        Utils::redirect("membre", "liste");
                    }

                }
                else {
                    Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
                    Utils::redirect("membre", "liste");
                    $this->user_model->rollBack();
                }

            }
            else {
                Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
                Utils::redirect("membre", "liste");
                $this->user_model->rollBack();
            }
        } catch (\Exception $e) {
            Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
            Utils::redirect("membre", "liste");
        }
    }

    public function editMembreModal()
    {
        $data['membre'] = $this->model->getOneMembre_(["condition" => ["id = " => $this->paramGET[2]]]);
        $this->views->setData($data);
        $this->modal();

    }

    public function editMembreMail()
    {
        $data['membre'] = $this->model->getOneMembre_(["condition" => ["id = " => $this->paramGET[2]]]);

        $this->views->setData($data);
        $this->modal();

    }

    public function editMail()
    {
        var_dump($this->paramPOST);
        try {
            if (Utils::validateMail($this->paramPOST["email"])) {
                $this->user_model->beginTransaction();
                $data['email'] = $this->paramPOST['email'];
                $data['login'] = $this->paramPOST['email'];
                $pass = Utils::getGeneratePassword(12);
                $pwd = $pass['pass'];
                $data['password'] = $pass["crypt"];
                $data['connect'] = 1;
                $result = $this->user_model->updateUser(["champs" => $data, "condition" => ["id =" => $this->paramPOST['id']]]);
                if ($result !== false) {
                    Utils::envoiMail_v1($this->paramPOST["prenom"] . ' ' . $this->paramPOST["nom"], $this->paramPOST["email"], $this->paramPOST['email'], $pwd);
                    $this->user_model->commit();
                    Utils::setMessageALert(["success", $this->lang["actionsuccess"]]);
                    Utils::redirect("membre", "liste");
                } else {
                    $this->user_model->rollBack();
                    Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
                    Utils::redirect("membre", "liste");
                }

            } else {
                Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
                Utils::redirect("membre", "liste");
            }
        } catch (\Exception $e) {
            Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
            Utils::redirect("membre", "liste");
        }
    }

    public function editMembre()
    {
        try {

//            var_dump(explode("+221",$this->paramPOST['telephone']));
//            die();
            $this->user_model->beginTransaction();
            $data['nom'] = $this->paramPOST['nom'];
            $data['prenom'] = $this->paramPOST['prenom'];
            $data['telephone'] = $this->paramPOST['telephone'];
            $data['dateNaissance'] = $this->paramPOST['dateNaissance'];
            $result = $this->user_model->updateUser(["champs" => $data, "condition" => ["id =" => $this->paramPOST['id']]]);
            if ($result !== false) {
                try {
                    $this->user_model->commit();
                    Utils::setMessageALert(["success", $this->lang["actionsuccess"]]);
                    Utils::redirect("membre", "liste");
                } catch (\Exception $exception) {
                    $this->user_model->rollBack();
                    Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
                    Utils::redirect("membre", "liste");
                }
            } else {
                Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
                Utils::redirect("membre", "liste");
                $this->user_model->rollBack();
            }
        } catch (\Exception $e) {
            Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
            Utils::redirect("membre", "liste");
        }
    }

    public function import_CSV()
    {
        $this->modal();
    }

    public function liste_import_csv()
    {
        $this->views->getTemplate('membre/liste_import_csv');
    }

    function read($csv)
    {
        $file = fopen($csv, 'r');
        while (!feof($file)) {
            $line[] = fgetcsv($file, 1024);
        }
        fclose($file);
        return $line;
    }

    public function import_fichier_CSV()
    {

        if (isset($_FILES["csv"]["tmp_name"]) && $_FILES["csv"]["size"] > 0) {
            $fileName = $_FILES["csv"]["tmp_name"];
            $membres = $this->read($fileName);

            while ($membres !== FALSE) {
                for ($i = 0; $i < count($membres)-1; $i++) {

                    $data['prenom'] = $membres[$i][1];
                    $data['nom'] = $membres[$i][2];
                    $data['email'] = $membres[$i][3];
                    $data['telephone'] = $membres[$i][5];
                    $data['date_naissance'] = $membres[$i][4];
                    $result = $this->membre_tmp->insertUser_tmp(["champs" => $data]);

                    $param['condition'] =  ["u.email="=> $data['email']];
                    $param['champs'] = ["id"];
                    $resultat = count($this->user_model->getUser($param));
                    if($resultat>0){
                        $champs['verif_etat_mail'] = 1;
                        $update_etat = $this->membre_tmp->set(["table"=>"membre_tmp","champs" => $champs, "condition"=>["email ="=>$data['email']]]);

                    }

                }
                break;
            }
        }
        Utils::redirect("membre", "liste_tmpMembre");
    }

    function liste_tmpMembre()
    {
        $this->views->getTemplate('membre/liste_tmpMembre');
    }
    public function listeProcessing_tmp()
    {
        $param = [
            "button" => [
                "modal" => [
                    ["membre/editMembreTmpModal", "membre/editMembreTmpModal", "fa fa-edit"]

                ],
                "default" => [
                    ["membre/ajouterMembreTmp", "fa fa-plus"]
                ],
                "custom" => []
            ],
            "tooltip" => [
                "modal" => [
                    $this->lang["modifyMembre"]

                ],
                "default" => [
                    $this->lang["btnAjouter"]
                ]
            ],
            "classCss" => [
                "modal" => []
            ],
            "attribut" => [
                "modal" => [],
                "default" => []
            ],
            "args" => null,
            "dataVal" => [
                /*                ["champ" => "etat", "val" => ["Désactiver" => ["<span style='.temp::before{text-align: right;}' class='temp text-info'>" . $this->lang['btn_desactiver'] . "</span>"], "Activer" => ["<span  class='temp text-success' >" . $this->lang['btn_activer'] . "</span><style>.temp::before{text-align: right;}</style>"]]]*/
            ],
            "fonction" => [
                "date_crea" => "getDateFR_",
                "libelle" => "testFormule"
            ]
        ];
        $this->processing($this->membre_tmp, "getList", $param);
    }

    public function editMembreTmpModal()
    {
        $data['membre'] = $this->membre_tmp->getOneMembre(["condition" => ["id = " => $this->paramGET[2]]]);
        $this->views->setData($data);
        $this->modal();

    }

    public function editMembreTmp()
    {
        try {

            $this->membre_tmp->beginTransaction();
            $data['nom'] = $this->paramPOST['nom'];
            $data['prenom'] = $this->paramPOST['prenom'];
            $data['telephone'] = $this->paramPOST['telephone'];
            $data['email'] = $this->paramPOST['email'];
            $data['date_naissance'] = $this->paramPOST['date_naissance'];
            $result = $this->membre_tmp->editMembre(["champs" => $data, "condition" => ["id =" => $this->paramPOST['id']]]);
            if ($result !== false) {
                try {
                    $this->membre_tmp->commit();
                    Utils::setMessageALert(["success", $this->lang["actionsuccess"]]);
                    Utils::redirect("membre", "liste_tmpMembre");
                } catch (\Exception $exception) {
                    $this->membre_tmp->rollBack();
                    Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
                    Utils::redirect("membre", "liste_tmpMembre");
                }
            } else {
                Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
                Utils::redirect("membre", "liste_tmpMembre");
                $this->membre_tmp->rollBack();
            }
        } catch (\Exception $e) {
            Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
            Utils::redirect("membre", "liste_tmpMembre");
        }
    }



    public function ajouterMembreTmp()
    {
        try {
            $data['membre'] = $this->membre_tmp->getOneMembre(["condition" => ["id = " => $this->paramGET[0]]]);
            $email = $data["membre"]->email;
            $param['condition'] =  ["u.email="=> $email];
            $param['champs'] = ["id"];
            $resultat = count($this->user_model->getUser($param));

            if ($resultat == 0){

                if (Utils::validateMail($data["membre"]->email)) {
                    $this->user_model->beginTransaction();
                    $data1['nom'] = $data["membre"]->nom;
                    $data1['prenom'] = $data["membre"]->prenom;
                    $data1['email'] = $data["membre"]->email;
                    $data1['telephone'] = $data["membre"]->telephone;
                    $data1['dateNaissance'] = $data["membre"]->date_naissance;
                    $data1['login'] = $data["membre"]->email;
                    $data1['uiid'] = bin2hex(random_bytes(5));
                    $data1['type_profil'] = 3;
                    $data1['date_crea'] = date('Y-m-d');
                    $pass = Utils::getGeneratePassword(12);
                    $pwd = $pass['pass'];
                    $data1['password'] = $pass["crypt"];
                    $data1['connect'] = 1;
                    $result = $this->user_model->insertUser(["champs" => $data1]);
                    if ($result !== false) {

                        try {
                            $result1 = $this->membre_tmp->deleteMembreTmp(["condition" => ["id = " => $this->paramGET[0]]]);

                            Utils::envoiMail_v1($data1['prenom'] . ' ' . $data1['nom'], $data1['email'], $data1['email'], $pwd);
                            Utils::envoiConfirmation_inscription($data1['prenom'] . ' ' . $data1['nom'], EMAIL_CONTACT);

                            $this->user_model->commit();
                            Utils::setMessageALert(["success", $this->lang["actionsuccess"]]);
                            Utils::redirect("membre", "liste_tmpMembre");
                        } catch (\Exception $exception) {
                            $this->user_model->rollBack();
                            Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
                            Utils::redirect("membre", "liste_tmpMembre");
                        }

                    } else {
                        Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
                        Utils::redirect("membre", "liste_tmpMembre");
                        $this->user_model->rollBack();
                    }

                } else {
                    Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
                    Utils::redirect("membre", "liste_tmpMembre");
                    $this->user_model->rollBack();
                }

            }else{
                Utils::setMessageALert(["danger", $this->lang["email_existe"]]);
                Utils::redirect("membre", "liste_tmpMembre");
            }
        } catch (\Exception $e) {
            Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
            Utils::redirect("membre", "liste_tmpMembre");
        }

    }

    public function ajoutMembreTmpAll(){

        $membres = $this->membre_tmp->getListMembreTmp();
        echo '<pre>';
        while ($membres !== FALSE) {
            $this->user_model->beginTransaction();
            for ($i = 0; $i < count($membres)-1; $i++) {
                $data['prenom'] = $membres[$i]->prenom;
                $data['nom'] = $membres[$i]->nom;
                $data['email'] = $membres[$i]->email;
                $data['telephone'] = $membres[$i]->telephone;
                $data['dateNaissance'] = $membres[$i]->date_naissance;
                $data['login'] = $membres[$i]->email;
                $data['uiid'] = bin2hex(random_bytes(5));
                $data['type_profil'] = 3;
                $data['date_crea'] = date('Y-m-d');
                $pass = Utils::getGeneratePassword(12);
                $pwd = $pass['pass'];
                $data['password'] = $pass["crypt"];
                $data['connect'] = 1;
                $result = $this->user_model->insertUser(["champs" => $data]);
                var_dump($data);
               /* if ($result !== false) {

                    try {
                        $result1 = $this->membre_tmp->deleteMembreTmp(["condition" => ["email = " => $data['email']]]);

                       // Utils::envoiMail_v1($data['prenom'] . ' ' . $data['nom'], $data['email'], $data['email'], $pwd);
                       // Utils::envoiConfirmation_inscription($data['prenom'] . ' ' . $data['nom'], EMAIL_CONTACT);

                        $this->user_model->commit();
                        Utils::setMessageALert(["success", $this->lang["actionsuccess"]]);
                        Utils::redirect("membre", "liste");
                    } catch (\Exception $exception) {
                        $this->user_model->rollBack();
                        Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
                        Utils::redirect("membre", "liste_tmpMembre");
                    }

                } else {
                    Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
                    Utils::redirect("membre", "liste_tmpMembre");
                    $this->user_model->rollBack();
                }*/
            }
            break;
        }

    }

}