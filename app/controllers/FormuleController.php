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

class FormuleController extends BaseController
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = $this->model("formule");
    }

    public function liste()
    {
        Utils::setDefaultSort(2, "ASC");
        $this->views->getTemplate();
    }

    public function listeAvantage()
    {
        Utils::setDefaultSort(2, "ASC");
        $this->views->getTemplate();
    }

    public function listeProcessing()
    {
        $param = [
            "button"=> [
                "modal" => [
                    ["formule/formuleModal","formule/formuleModal","fa fa-edit"],
                    ["formule/formuleDetailModal","formule/formuleDetailModal","fa fa-search"]
                ],
                "default" => [
                    ["champ" => "etat","val" => ["0" => ["formule/activate/","fa fa-toggle-off"],"1" => ["formule/deactivate/", "fa fa-toggle-on"]]],
                    ["formule/deleteFormule/","fa fa-trash"],
                    ["formule/formuleAspect", "fa fa-eye"]
                ],
                "custom" => []
            ],
            "tooltip"=> [
                "modal" => [
                    $this->lang["tooltipModif"],
                    $this->lang["tooltipDetail"],
                    $this->lang["tooltipVoir"],
                ],
                "default" => [
                    ["champ"=>"etat","val"=>["0"=>$this->lang["tooltipActive"],"1"=>$this->lang["tooltipDesactive"]]],
                    $this->lang["remove"]
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
            "args"=>null,
            "dataVal"=>[
                ["champ" => "etat", "val" => ["0" => ["<i class='text-danger'>".$this->lang['desactiver']." </i>"], "1" => ["<i class='text-success'>".$this->lang['activer']."</i>"]]]
            ],
            "fonction"=>[
                'montant' => 'getFormatMoney'

            ]
        ];
        $this->processing($this->model, "getListeProcess", $param);
    }


    public function formuleModal__()
    {
        if($this->paramGET[2]){
            $data['formule'] = $this->model->getFormule_Type(["condition"=>["f.id = "=>$this->paramGET[2]]])[0];
            $data['formule_avantages'] = $this->model->getFormuleAvantage(["condition"=>["formule_id = "=>$this->paramGET[2]]]);
        }
        $data['type_formule'] = $this->model->AllTypes();
        $data['avantages'] = $this->model->getAvantageActif();
        $this->views->setData($data);
        $this->modal();
    }

    public function formuleDetailModal__()
    {
        if($this->paramGET[2]){
            $data['formule'] = $this->model->getFormule(["condition"=>["id = "=>$this->paramGET[2]]])[0];
            $data['formule_avantages'] = $this->model->getFormuleAvantage(["condition"=>["formule_id = "=>$this->paramGET[2]]]);
        }
        $data['avantages'] = $this->model->getAvantage();
        $this->views->setData($data);
        $this->modal();
    }

    public function formuleAspect__()
    {
        $data['formule'] = $this->model->getFormule_Type(["condition"=>["f.id = "=>$this->paramGET[0]]])[0];
//        var_dump($data);die();
        $this->views->setData($data);
        $this->views->initTemplate(["header"=>"header_c","footer"=>"footer", "sidebar" => "sidebar"]);
        $this->views->getTemplate("formule/formuleAspect");
    }

    public function customiseFormule__(){
        $param['condition'] = ["id = "=>$this->paramPOST['id']];
        unset($this->paramPOST["id"]);
        $param['champs'] = $this->paramPOST;
        $result = $this->model->updateFormule($param);
        if($result !== false) {
            Utils::setMessageALert(["success",$this->lang["actionsuccess"]]);
        }
        else Utils::setMessageALert(["danger",$this->lang["actionechec"]]);

        Utils::redirect("formule", "liste");
    }


    public function ajoutFormule()
    {
        $this->model->beginTransaction() ;
        //parent::validateToken("exemples", "exemples");
        $avantages = $this->paramPOST['avantages'];
        unset($this->paramPOST['avantages']);
        /*var_dump($this->paramPOST);
        var_dump($avantages);
        die();*/

        $result = $this->model->insertFormule(["champs"=>$this->paramPOST]);

        if($result !== false) {
            $i = 0;
            foreach ($avantages as $avantage){
                $param = array("formule_id" => $result, "avantage_id" => $avantage);
                $result_ = $this->model->insertFormuleAvantage(["champs"=>$param]);
                if($result_ == false) {
                    $i++;
                }
            }
            if ($i == 0){
                $this->model->commit() ;
                Utils::setMessageALert(["success",$this->lang["actionsuccess"]]);
            }else{
                $this->model->rollBack() ;
                Utils::setMessageALert(["danger",$this->lang["actionechec"]]);
            }
        }

        else {
            $this->model->rollBack() ;
            Utils::setMessageALert(["danger",$this->lang["actionechec"]]);
        }

        Utils::redirect("formule", "liste");
    }

    public function modifFormule()
    {
        //parent::validateToken("exemples", "exemples");
        $avantages = $this->paramPOST['avantages'];
        unset($this->paramPOST['avantages']);

        $param['condition'] = ["id = "=>$this->paramPOST['id']];
        $param['champs'] = $this->paramPOST;
        $id = $this->paramPOST['id'];
        unset($this->paramPOST['id']);
        $result = $this->model->updateFormule($param);
        if($result !== false) {
            $param_['condition'] = ["formule_id = "=>$id];
            $this->model->deleteFormuleAvantage($param_);
            foreach ($avantages as $avantage){
                $param = array("formule_id" => $id, "avantage_id" => $avantage);
                $this->model->insertFormuleAvantage(["champs"=>$param]);
            }
            Utils::setMessageALert(["success",$this->lang["actionsuccess"]]);
        }
        else Utils::setMessageALert(["danger",$this->lang["actionechec"]]);

        Utils::redirect("formule", "liste");
    }

    public function deleteFormule()
    {
        //parent::validateToken("exemples", "exemples");

        if(isset($this->paramGET[0])) {
            $param['condition'] = ["id = "=>$this->paramGET[0]];
            $result = $this->model->deleteFormule($param);
            if($result !== false) {
                $param_['condition'] = ["formule_id = "=>$this->paramGET[0]];
                $this->model->deleteFormuleAvantage($param_);
                Utils::setMessageALert(["success",$this->lang["actionsuccess"]]);
            }
            else Utils::setMessageALert(["danger",$this->lang["actionechec"]]);
        }
        Utils::redirect("formule", "liste");
    }

    public function activate()
    {
        if(intval($this->paramGET[0]) > 0)
        {
            if (intval($this->paramGET[0]) > 0) {
                $result = $this->model->updateFormule(["champs" => ["etat" => 1], "condition" => ["id = " => $this->paramGET[0]]]);
                if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_activate_formule"]]);
                else Utils::setMessageALert(["danger", $this->lang["echec_activate_formule"]]);
            } else Utils::setMessageALert(["danger", $this->lang["echec_activate_formule"]]);
            Utils::redirect("formule", "liste");
        }
    }

    public function deactivate()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->model->updateFormule(["champs" => ["etat" => 0], "condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_deactivate_formule"]]);
            else Utils::setMessageALert(["danger", $this->lang["echec_deactivate_formule"]]);
        } else Utils::setMessageALert(["danger", $this->lang["echec_deactivate_formule"]]);
        Utils::redirect("formule", "liste");

    }

    public function verifie(){

        $donnees = $this->paramPOST ;
        $id = $donnees['formule_id'];
        unset($donnees['formule_id']);
        $param['condition'] = [$donnees["champ"]."= "=>$donnees["valeur"], "etat =" => 1];
        $param['champs'] = ["id","libelle","fin","taux"];
        $resultat = count($this->model->getCodePromo($param));

        $obj = "";
        if ($resultat > 0){
            $res = $this->model->getCodePromo($param)[0];
            if ($res->fin > date('Y-m-d H:i:s'))
            {
                $formule = $this->model->getFormule(["condition"=>["id = "=>$id]])[0];
                $somme = intval($formule->montant) * (intval($res->taux)/ 100) ;
                $somme = intval($formule->montant) - $somme ;
                $obj->code = 1;
                $obj->id = $res->id;
                $obj->somme =  Utils::getFormatMoney($somme);
            }else{
                $param['condition'] = [$donnees["champ"]."= "=>$donnees["valeur"]];
                $param['champs'] = ["etat" => 0];
                $this->model->updatePromotion($param);
                $obj->code = -1;
            }
        }else{
            $obj->code = -1;
        }
        $myJSON = json_encode($obj);
        echo $myJSON;

    }

}