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

class CadeauController extends BaseController
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


    public function listeProcessingCadeau()
    {
        $param = [
            "button"=> [
                "modal" => [
                    ["cadeau/cadeauModal","cadeau/cadeauModal","fa fa-edit"]
                ],
                "default" => [
                    ["champ" => "etat","val" => ["0" => ["cadeau/activate/","fa fa-toggle-off"],"1" => ["cadeau/deactivate/", "fa fa-toggle-on"]]],
                    ["cadeau/deleteCadeau/","fa fa-trash"]
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
        $this->processing($this->model, "getListeCadeauPointProcess", $param);
    }


    public function cadeauModal__()
    {
        if($this->paramGET[2]){
            $data['cadeaux'] = $this->model->getOneCadeauPoint(["condition"=>["id = "=>$this->paramGET[2]]]);
//            var_dump($data);die();
        }
        $this->views->setData($data);
        $this->modal();
    }

    public function ajoutCadeau()
    {
        $result = $this->model->insertCadeauPoint(["champs"=>$this->paramPOST]);

        if($result !== false) {
            Utils::setMessageALert(["success",$this->lang["actionsuccess"]]);
        }

        else Utils::setMessageALert(["danger",$this->lang["actionechec"]]);

        Utils::redirect("cadeau", "liste");
    }

    public function modifCadeau()
    {
        $param['condition'] = ["id = "=>$this->paramPOST['id']];
        $param['champs'] = $this->paramPOST;
        unset($this->paramPOST['id']);
        $result = $this->model->updateCadeauPoint($param);
        if($result !== false) {
            Utils::setMessageALert(["success",$this->lang["actionsuccess"]]);
        }
        else Utils::setMessageALert(["danger",$this->lang["actionechec"]]);

        Utils::redirect("cadeau", "liste");
    }

    public function deleteCadeau()
    {
        //parent::validateToken("exemples", "exemples");

        if(isset($this->paramGET[0])) {
            $param['condition'] = ["id = "=>$this->paramGET[0]];
            $result = $this->model->deleteCadeauPoint($param);
            if($result !== false) {
                Utils::setMessageALert(["success",$this->lang["actionsuccess"]]);
            }
            else Utils::setMessageALert(["danger",$this->lang["actionechec"]]);
        }
        Utils::redirect("cadeau", "liste");
    }

    public function activate()
    {
        if(intval($this->paramGET[0]) > 0)
        {
            if (intval($this->paramGET[0]) > 0) {
                $result = $this->model->updateCadeauPoint(["champs" => ["etat" => 1], "condition" => ["id = " => $this->paramGET[0]]]);
                if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_activate_cadeau"]]);
                else Utils::setMessageALert(["danger", $this->lang["echec_activate_cadeau"]]);
            } else Utils::setMessageALert(["danger", $this->lang["echec_activate_cadeau"]]);
            Utils::redirect("cadeau", "liste");
        }
    }

    public function deactivate()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->model->updateCadeauPoint(["champs" => ["etat" => 0], "condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_deactivate_cadeau"]]);
            else Utils::setMessageALert(["danger", $this->lang["echec_deactivate_cadeau"]]);
        } else Utils::setMessageALert(["danger", $this->lang["echec_deactivate_cadeau"]]);
        Utils::redirect("cadeau", "liste");

    }
}