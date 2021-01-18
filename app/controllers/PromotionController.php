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

class PromotionController extends BaseController
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
        $this->views->getTemplate("formule/listePromotion");
    }

    public function listePromotionProcessing()
    {
        $param = [
            "button"=> [
                "modal" => [
                ],
                "default" => [
                    ["champ" => "etat","val" => ["0" => ["promotion/activate/","fa fa-toggle-off"],"1" => ["promotion/deactivate/", "fa fa-toggle-on"]]],
                    ["promotion/deletePromotion/","fa fa-trash"]
                ],
                "custom" => []
            ],
            "tooltip"=> [
                "modal" => [
                    $this->lang["tooltipModif"]
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
                'debut'=>'getDateFR',
                'fin'=>'getDateFR']
        ];
        $this->processing($this->model, "getListePormotionProcess", $param);
    }


    public function promotionModal__()
    {
        $this->modal("formule/promotionModal");
    }


    public function ajoutPromotion()
    {
//        var_dump($this->paramPOST);die();

        $result = $this->model->insertPromotion(["champs"=>$this->paramPOST]);

        if($result !== false) {
            Utils::setMessageALert(["success",$this->lang["actionsuccess"]]);
        }
        else {
            Utils::setMessageALert(["danger",$this->lang["actionechec"]]);
        }

        Utils::redirect("promotion", "liste");
    }

    public function modifPromotion()
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

    public function deletePromotion()
    {
        //parent::validateToken("exemples", "exemples");

        if(isset($this->paramGET[0])) {
            $param['condition'] = ["id = "=>$this->paramGET[0]];
            $result = $this->model->deletePromotion($param);
            if($result !== false) {
                Utils::setMessageALert(["success",$this->lang["actionsuccess"]]);
            }
            else Utils::setMessageALert(["danger",$this->lang["actionechec"]]);
        }
        Utils::redirect("promotion", "liste");
    }

    public function activate()
    {
        if(intval($this->paramGET[0]) > 0)
        {
            if (intval($this->paramGET[0]) > 0) {
                $result = $this->model->updatePromotion(["champs" => ["etat" => 1], "condition" => ["id = " => $this->paramGET[0]]]);
                if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_activate_promotion"]]);
                else Utils::setMessageALert(["danger", $this->lang["echec_activate_promotion"]]);
            } else Utils::setMessageALert(["danger", $this->lang["echec_activate_promotion"]]);
            Utils::redirect("promotion", "liste");
        }
    }

    public function deactivate()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->model->updatePromotion(["champs" => ["etat" => 0], "condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_deactivate_promotion"]]);
            else Utils::setMessageALert(["danger", $this->lang["echec_deactivate_promotion"]]);
        } else Utils::setMessageALert(["danger", $this->lang["echec_deactivate_promotion"]]);
        Utils::redirect("promotion", "liste");

    }
}