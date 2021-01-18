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

class TransactionController extends BaseController
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = $this->model("transaction");
    }

    //--------------------------TRANSACTION------------------------
    /**
     * @droit Liste transaction - 20
     */
    public function liste(){


        if (isset($this->paramPOST["datedebut"]) & isset($this->paramPOST["datefin"])) {
            $param['datedebut'] = $this->paramPOST['datedebut'];
            $param['datefin'] = $this->paramPOST['datefin'];
        }else{

            $param['datedebut'] = date('Y-m-d');
            $param['datefin'] = date('Y-m-d');
        }

        $tabmois = [1,2,3,4,5,6,7,8,9,10,11,12 ];
        $param['mnt'] = [];
        $param['nbrT'] = [];
        $MeczyServ = array();
        $M1 = '';
        $dt='';
        $Nbredt='';
        $NbredtGF='';
        $NbredtGM='';
        $Nbredt18 = 0;
        $initmnt=0;
        $initnbrT=0;
        $initnbrGF=0;
        $initnbrGM=0;
        $b =0;
        $year= date('Y');

        $param['Nbredt18T']=$this->model->TransactNbreParTranch([0, 18]); /// 0 - 18years
        if ($param['Nbredt18T'][0]->nbre==NULL) {
            $Nbredt18 = 0;
        }else{
            $Nbredt18 = $param['Nbredt18T'][0]->nbre;

        }
        $param['Nbredt35T']=$this->model->TransactNbreParTranch([19, 35]); /// 19 - 30years
        if ($param['Nbredt35T'][0]->nbre==NULL) {
            $Nbredt35 = 0;
        }else{
            $Nbredt35 = $param['Nbredt35T'][0]->nbre;

        }
        $param['Nbredt59T']=$this->model->TransactNbreParTranch([36, 59]); /// 31 - 45years
        if ($param['Nbredt59T'][0]->nbre==NULL) {
            $Nbredt59 = 0;
        }else{
            $Nbredt59 = $param['Nbredt59T'][0]->nbre;

        }

        $param['Nbredt60T']=$this->model->TransactNbreParTranch([60, 1000]); /// more than 60 years
        if ($param['Nbredt60T'][0]->nbre==NULL) {
            $Nbredt60 = 0;
        }else{
            $Nbredt60 = $param['Nbredt60T'][0]->nbre;

        }

        ///////////graphe selon //////////////////

        $param['services']=$this->model->getServicesReporting();

        if(sizeof($param['services']) > 0){

            foreach ($param['services'] as $oneServ){
                array_push($MeczyServ,$oneServ->leService,$oneServ->libelle_service);
            }
        }else{}


        for($i = 0 ; $i < count($param['services']) ; $i++){
            $id = $param['services'][$i]->data;
            $param['services'][$i]->data = [];
            for($j = 1 ; $j < 13 ; $j++) {
                array_push($param['services'][$i]->data, intval($this->model->TransactNbreParService($j, intval($id))[0]->nbre));
            }
        }

        foreach ($tabmois as $lemois)
        {
            $param['mnt']=$this->model->TransactParMois($lemois);
            $param['nbrT']=$this->model->TransactNbreParMois($lemois);
            $param['nbrTFM']=$this->model->TransactNbreParMoisGenre($lemois);

            if ($param['mnt'][0]->mnt==NULL) {
                $initmnt = 0; //Montant transaction
                $initnbrT = 0; //Nombre transaction
                $initnbrGM = 0; //Nombre transaction par genre Man
                $initnbrGF = 0; //Nombre transaction par genre femel
            }else{
                $initmnt=$param['mnt'][0]->mnt;
                $initnbrT=$param['nbrT'][0]->nbre;
                $initnbrGF=$param['nbrTFM'][0]->nbre; //Femel
                $initnbrGM=$param['nbrTFM'][1]->nbre; //Man
            }
                if ($lemois == 1) {
                    $dt = $initmnt;
                    $Nbredt = $initnbrT; //Nombre de transactions
                    $NbredtGM = $initnbrGM; //Nombre de transactions genre : Man
                    $NbredtGF = $initnbrGF; //Nombre de transactions genre : Femel
                } else {
                    $dt = $dt . ',' . $initmnt;
                    $Nbredt = $Nbredt . ',' . $initnbrT; //Le nombre de transactions
                    $NbredtGF = $NbredtGF . ',' . $initnbrGF; //Le nombre de transactions genre Femel
                    $NbredtGM = $NbredtGM . ',' . $initnbrGM; //Le nombre de transactions genre Man

                 }

        }

        $param['year']= $year;
        $param['mnt1']=$dt;
        $param['nbrT']=$Nbredt;
        $param['nbrTGF']=$NbredtGF; //Femel
        $param['nbrTGM']=$NbredtGM; //Man
        $param['nbr18T']=$Nbredt18; //Tranche de 0 à 18 ans
        $param['nbr35T']=$Nbredt35; //Tranche de 19 à 35 ans
        $param['nbr59T']=$Nbredt59; //Tranche de 36 à 59 ans
        $param['nbr60T']=$Nbredt60; //Tranche de plus de 60 ans
        //$param['services']=$M1;//$param['services'][0]->leService; //Les transactions
        ///////////////
        $this->views->setData($param);
        $this->views->initTemplate(["header" => "header", "footer" => "footer", "sidebar" => "sidebar"]);
        $this->views->getTemplate('transaction/liste');
    }

    public function transactionProcessing__()
    {
        Utils::setDefaultSort(1, "DESC");
        $param = [
            "button"=> [
                "modal" => [],
                "default" => [],
                "custom" => []
            ],
            "tooltip"=> [
                "modal" => [],
                "default" => [
                   // ["champ"=>"etat","val"=>["Désactiver"=>"Activer","Activer"=>"Desactiver"]],
                   // "Détail"
                ]
            ],
            "classCss"=> [
                "modal" => [],
                "default" => ["confirm"]
            ],
            "attribut"=> [
                "modal" => [],
                "default" => []
            ],
            "args"=>$this->paramGET,
            "dataVal"=>[
                ["champ"=>"statut","val"=>[0=>["<span style='.temp::before{text-align: right;}' class='temp text-info'>".$this->lang["statTransFail"]."</span>"],1=>["<span  class='temp text-success' >".$this->lang["statTransSuccess"]."</span><style>.temp::before{text-align: right;}</style>"]]]
            ],
            "fonction"=>[
                'date_transac'=>'getDateFR',
                'montant'=>'getFormatMoney|alignRight'
            ]
        ];
       /* if($this->appConfig->profile_level == 2)
            array_push($param["button"]["default"],["utilisateur/affectation/","fa fa-male"]);*/
        $this->processing($this->model, "getTransProcess", $param);
    }

    /**
     * @droit Exporter transaction - 20
     */
    public function export()

    {
        $data['transact'] = $this->model->getTransaction(["condition" => ["DATE(date_transac) >= " => $this->paramGET[0], "DATE(date_transac) <=" => $this->paramGET[1]]]);
        $data['transactT'] = $this->model->getMontantTTransaction(["condition" => ["DATE(date_transac) >= " => $this->paramGET[0], "DATE(date_transac) <=" => $this->paramGET[1]]]);
       // var_dump($data['transactT']);exit;
        $data['debut']=$this->paramGET[0];
        $data['fin']=$this->paramGET[1];
        $this->views->setData($data);
        if ($data['transact']) {
            $this->views->exportToPdf('transaction/printTransaction');
        } else{
            Utils::setMessageALert(["danger",$this->lang["repech"]]);
            Utils::redirect("transaction", "liste");
        }


    }


        function getAddressThroughFileGetContents ($RG_Lat,$RG_Lon) {

            // Create a stream
        $opts = array('http'=>array('header'=>"User-Agent: MyCleverAddressScript 1.0.0\r\n"));
        $context = stream_context_create($opts);

            // Open the file using the HTTP headers set above
        $query = "https://nominatim.openstreetmap.org/reverse?format=json&lat=".$RG_Lat."&lon=".$RG_Lon;

            //Warning: file_get_contents(https://...@acme.com): failed to open stream: Connection timed out in /var/www/sda/4/0/myserver/myscript.php on line 47
        $result = json_decode(@file_get_contents($query, false, $context));
        return $result;
        }

    public  function getPosition($latitude,$longitude)
    {
        // var_dump($val) ;exit;
        //echo $val['_longitude_']." ".$val['_latitude_'] ;
        $r = $this->getAddressThroughFileGetContents($latitude,$longitude) ;
        //var_dump($r) ;
        $adresse = $r->address ;
        //$chaine = utf8_decode(substr($r->display_name, 1, 3));
        $chaine = htmlentities($adresse->city.' , '.$adresse->state.' , '.$adresse->country);
        //echo $chaine ;
        //var_dump(utf8_decode($r->display_name));
        return "<div style='text-align: left;'>".$chaine."</div>";
    }



    /**
     * @droit Localiser collecteur - 17
     */
    public function localisation(){

        $transactions = $this->model->getLastTransaction() ;
        if($transactions!=null){
            foreach($transactions as $transaction){
                $position = $this->getPosition($transaction->latitudes, $transaction->longitude) ;
                $transaction->position = $position ;
            }

        }
       // echo '<pre>' ;
        //var_dump($transactions);exit;

        $data['transactions'] = $transactions ;
        $this->views->setData($data);

       // Utils::setDefaultSort(2, "DESC");
       // $r = $this->getAddressThroughFileGetContents(14.722463, -17.484407) ;
        //var_dump(utf8_decode($r->display_name )); exit;
        $this->views->initTemplate(["header" => "header", "footer" => "footer", "sidebar" => "sidebar"]);
        $this->views->getTemplate('transaction/localisation');

    }

    public function locatisationProcessing__(){


        $param = [
            "button"=> [
                "modal" => [],
                "default" => [
                    [],
                    ["transaction/localiser/_latitude_/_longitude_/","fa fa-search"]
                ],
                "custom" => []
            ],
            "tooltip"=> [
                "modal" => [],
                "default" => [
                    ["Localiser"],

                ]
            ],
            "classCss"=> [
                "modal" => [],
                "default" => []
            ],
            "attribut"=> [
                "modal" => [],
                "default" => []
            ],
            "args"=>$this->paramGET,
            "dataVal"=>[
                ["champ"=>"statut","val"=>[0=>["<span style='.temp::before{text-align: right;}' class='temp text-info'>Échouée</span>"],1=>["<span  class='temp text-success' >Réussie</span><style>.temp::before{text-align: right;}</style>"]]]
            ],
            "fonction"=>[
                'date_transac'=>'getDateFR',
                'montant'=>'getFormatMoney|alignRight',
                'code'=>'getPosition/alldata'
            ]
        ];
        /* if($this->appConfig->profile_level == 2)
             array_push($param["button"]["default"],["utilisateur/affectation/","fa fa-male"]);*/
        $this->processing($this->model, "getLocProcess", $param);

    }

    /**
     * @droit détail localisat collecteur - 17
     */
    public function localiser()
    {
        //var_dump($this->paramGET);exit;
        $data['latitude']=$this->paramGET[0];
        $data['longitude']=$this->paramGET[1];

        //echo $data['latitude']." ".$data['longitude']; exit;
        $this->views->setData($data);
        $this->views->initTemplate(["header" => "header1", "footer" => "footer", "sidebar" => "sidebar"]);
        $this->views->getTemplate('transaction/local');
       // $this->views->getPage('transaction/localiser');
    }


}