<?php

/**
 * Created by PhpStorm.
 * User: Seyni FAYE
 * Date: 15/02/2017
 * Time: 21:11
 */

namespace app\controllers;

use app\core\BaseController;
use app\core\Session;
use app\core\Utils;

class ApipaiementController extends BaseController
{

    private $model;
    public function __construct()
    {
        parent::__construct(false);
        $this->model = $this->model("membre");
    }

    public function statusPaiement (){


        try {
            //Prenez votre MasterKey, hashez la et comparez le résultat au hash reçu par IPN
            if($_POST['data']['hash'] === hash('sha512', "7Tg1cyEo-Bj48-xuIg-WH0f-BJO8sUmqDW9o")) {

                /*$souscription_id = Session::getAttribut("souscription_id");
                $datetransac =  date("Y-m-d H:i:s");
                $numtransaction = Utils::getAlphaNumerique();
                $montant = $_POST['data']['invoice']['total_amount'];
                $fk_mode_paiement = Session::getAttribut("mode_paiement");
                $commentaire = $_POST['data']['invoice']['items'][0]->description ;

                $commission = 0;


                Session::destroyAttributSession("souscription_id");
                Session::destroyAttributSession("mode_paiement");

                if ($_POST['data']['status'] == "pending") {
                    $statut = 1;
                }elseif ($_POST['data']['status'] == "cancelled"){
                    $statut = 2;
                }elseif ($_POST['data']['status'] == "completed"){
                    $statut = 3;
                }

                try {
                    $param = ["souscription_id"=>$souscription_id,"datetransac"=>$datetransac,"numtransaction"=>$numtransaction,"montant"=>$montant,"fk_mode_paiement"=>$fk_mode_paiement,"commentaire"=>$commentaire,"statut"=>$statut,"commission"=>$commission];
                    $this->model->beginTransaction();
                    $result = $this->model->insertTransaction(["champs"=>$param]);
                    if ($result != false){
                        $this->model->commit();
                    }else{
                        $this->model->rollBack();
                    }

                }catch (\Exception $exception){

                }*/


            } else {
                die("Cette requête n'a pas été émise par PayDunya");
            }
        } catch(Exception $e) {
            die();
        }

    }

}