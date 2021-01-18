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

class PaiementController extends BaseController
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


    public function listeProcessingPaiement()
    {
        $param = [
            "button"=> [
                "modal" => [
                    ["paiement/paiementModal","paiement/paiementModal","fa fa-edit"]
                ],
                "default" => [
                    ["champ" => "etat","val" => ["0" => ["paiement/activate/","fa fa-toggle-off"],"1" => ["paiement/deactivate/", "fa fa-toggle-on"]]],
                    ["paiement/deletePaiement/","fa fa-trash"]
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
            "fonction"=>[]
        ];
        $this->processing($this->model, "getListeModePaiementProcess", $param);
    }


    public function paiementModal__()
    {
        if($this->paramGET[2]){
            $data['paiement'] = $this->model->getModePaiement(["condition"=>["id = "=>$this->paramGET[2]]])[0];
//            var_dump($data);die();
        }
        $this->views->setData($data);
        $this->modal();
    }

    public function ajoutPaiement()
    {
        $result = $this->model->insertModePaiement(["champs"=>$this->paramPOST]);

        if($result !== false) {
            Utils::setMessageALert(["success",$this->lang["actionsuccess"]]);
        }

        else Utils::setMessageALert(["danger",$this->lang["actionechec"]]);

        Utils::redirect("paiement", "liste");
    }

    public function modifPaiement()
    {
        $param['condition'] = ["id = "=>$this->paramPOST['id']];
        $param['champs'] = $this->paramPOST;
        unset($this->paramPOST['id']);
        $result = $this->model->updateModePaiement($param);
        if($result !== false) {
            Utils::setMessageALert(["success",$this->lang["actionsuccess"]]);
        }
        else Utils::setMessageALert(["danger",$this->lang["actionechec"]]);

        Utils::redirect("paiement", "liste");
    }

    public function deletePaiement()
    {
        //parent::validateToken("exemples", "exemples");

        if(isset($this->paramGET[0])) {
            $param['condition'] = ["id = "=>$this->paramGET[0]];
            $result = $this->model->deleteModePaiement($param);
            if($result !== false) {
                Utils::setMessageALert(["success",$this->lang["actionsuccess"]]);
            }
            else Utils::setMessageALert(["danger",$this->lang["actionechec"]]);
        }
        Utils::redirect("paiement", "liste");
    }

    public function activate()
    {
        if(intval($this->paramGET[0]) > 0)
        {
            if (intval($this->paramGET[0]) > 0) {
                $result = $this->model->updateModePaiement(["champs" => ["etat" => 1], "condition" => ["id = " => $this->paramGET[0]]]);
                if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_activate_paiement"]]);
                else Utils::setMessageALert(["danger", $this->lang["echec_activate_paiement"]]);
            } else Utils::setMessageALert(["danger", $this->lang["echec_activate_paiement"]]);
            Utils::redirect("paiement", "liste");
        }
    }

    public function deactivate()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->model->updateModePaiement(["champs" => ["etat" => 0], "condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_deactivate_paiement"]]);
            else Utils::setMessageALert(["danger", $this->lang["echec_deactivate_paiement"]]);
        } else Utils::setMessageALert(["danger", $this->lang["echec_deactivate_paiement"]]);
        Utils::redirect("paiement", "liste");

    }
}