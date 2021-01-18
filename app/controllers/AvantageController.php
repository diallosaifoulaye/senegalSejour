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

class AvantageController extends BaseController
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


    public function listeProcessingAvantage()
    {
        $param = [
            "button"=> [
                "modal" => [
                    ["avantage/avantageModal","avantage/avantageModal","fa fa-edit"]
                ],
                "default" => [
                    ["champ" => "etat","val" => ["0" => ["avantage/activate/","fa fa-toggle-off"],"1" => ["avantage/deactivate/", "fa fa-toggle-on"]]],
                    ["avantage/deleteAvantage/","fa fa-trash"]
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
        $this->processing($this->model, "getListeAvantageProcess", $param);
    }


    public function avantageModal__()
    {
        if($this->paramGET[2]){
            $data['avantage'] = $this->model->getAvantage(["condition"=>["id = "=>$this->paramGET[2]]])[0];
//            var_dump($data);die();
        }
        $this->views->setData($data);
        $this->modal();
    }

    public function ajoutAvantage()
    {
        $result = $this->model->insertAvantage(["champs"=>$this->paramPOST]);

        if($result !== false) {
            Utils::setMessageALert(["success",$this->lang["actionsuccess"]]);
        }

        else Utils::setMessageALert(["danger",$this->lang["actionechec"]]);

        Utils::redirect("avantage", "liste");
    }

    public function modifAvantage()
    {
        $param['condition'] = ["id = "=>$this->paramPOST['id']];
        $param['champs'] = $this->paramPOST;
        unset($this->paramPOST['id']);
        $result = $this->model->updateAvantage($param);
        if($result !== false) {
            Utils::setMessageALert(["success",$this->lang["actionsuccess"]]);
        }
        else Utils::setMessageALert(["danger",$this->lang["actionechec"]]);

        Utils::redirect("avantage", "liste");
    }

    public function deleteAvantage()
    {
        //parent::validateToken("exemples", "exemples");

        if(isset($this->paramGET[0])) {
            $param['condition'] = ["id = "=>$this->paramGET[0]];
            $result = $this->model->deleteAvantage($param);
            if($result !== false) {
                Utils::setMessageALert(["success",$this->lang["actionsuccess"]]);
            }
            else Utils::setMessageALert(["danger",$this->lang["actionechec"]]);
        }
        Utils::redirect("avantage", "liste");
    }

    public function activate()
    {
        if(intval($this->paramGET[0]) > 0)
        {
            if (intval($this->paramGET[0]) > 0) {
                $result = $this->model->updateAvantage(["champs" => ["etat" => 1], "condition" => ["id = " => $this->paramGET[0]]]);
                if ($result !== false) Utils::setMessageALert(["success", $this->lang["succues_activate_avantage"]]);
                else Utils::setMessageALert(["danger", $this->lang["echec_activate_formule"]]);
            } else Utils::setMessageALert(["danger", $this->lang["echec_activate_formule"]]);
            Utils::redirect("avantage", "liste");
        }
    }

    public function deactivate()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->model->updateAvantage(["champs" => ["etat" => 0], "condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["succues_deactivate_avantage"]]);
            else Utils::setMessageALert(["danger", $this->lang["echec_desactivate_partenaire"]]);
        } else Utils::setMessageALert(["danger", $this->lang["echec_desactivate_partenaire"]]);
        Utils::redirect("avantage", "liste");

    }
}