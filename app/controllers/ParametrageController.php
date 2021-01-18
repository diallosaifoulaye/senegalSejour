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

class ParametrageController extends BaseController
{
    private $devise;

    public function __construct()
    {
        parent::__construct();
        $this->devise = $this->model("formule");
    }


    public function listeDevise()
    {
        $this->views->getTemplate('parametrage/listeDevise');
    }

    public function listeProcessing()
    {
        $param = [
            "button" => [
                "modal" => [
                    ["parametrage/newDevise", "parametrage/createDevise", "fa fa-edit"]
                ],
                "default" => [
                    ["champ" => "etat", "val" => ["0" => ["parametrage/activate", "fa fa-toggle-off"], "1" => ["parametrage/deactivate", "fa fa-toggle-on"]]],
                    ["parametrage/deleteParametrage/","fa fa-trash"]
                    //["utilisateur/detailUtilisateur","fa fa-search"]
                ],
                "custom" => []
            ],
            "tooltip" => [
                "modal" => [
                    "Modifier"
                ],
                "default" => [
                    ["champ" => "etat", "val" => ["0" => "Activer", "1" => "Desactiver"]],
                    "Supprimer"
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
                ["champ" => "etat", "val" => ["0" => ["<span style='.temp::before{text-align: right;}' class='temp text-danger'>". $this->lang['btn_desactiver'] ."</span>"], "1" => ["<span  class='temp text-success' >". $this->lang['btn_activer'] ."</span><style>.temp::before{text-align: right;}</style>"]]]
            ],
            "fonction" => []
        ];
        $this->processing($this->devise, "getListeDeviseProcess", $param);
    }

    public function newDevise()
    {
        //var_dump(1);die;
        if ($this->paramGET[2]) {
            $data['devise'] = $this->devise->getDevise(["condition"=>["id = "=>$this->paramGET[2]]])[0];

        }
        $this->views->setData($data);
        $this->modal();
    }


    public function create()
    {


        $result = $this->devise->insertDevise(["champs" => $this->paramPOST]);
        if ($result !== false) {
            Utils::setMessageALert(["success", $this->lang["actionsuccess"]]);
        } else Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
        Utils::redirect("parametrage", "listeDevise");
    }


    public function edit()
    {
        $param['condition'] = ["id = " => $this->paramPOST['id']];

        unset($this->paramPOST['id']);
        $param['champs'] = $this->paramPOST;
        $result = $this->devise->updateDevise($param);
        if ($result !== false) {
            Utils::setMessageALert(["success", $this->lang["actionsuccess"]]);
        } else Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
        Utils::redirect("parametrage", "listeDevise");
    }

    public function activate()
    {
        if (intval($this->paramGET[0]) > 0) {

            $this->devise->beginTransaction();
            $result = $this->devise->set(["table" => "devise", "champs" => ["etat" => "1"], "condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false){
                $result1 = $this->devise->set(["table" => "devise", "champs" => ["etat" => "0"], "condition" => ["id != " => $this->paramGET[0]]]);
                if ($result1 !== false){
                    $this->devise->commit();
                    Utils::setMessageALert(["success", $this->lang["actionsuccess"]]);
                }else{
                    $this->devise->rollBack();
                    Utils::setMessageALert(["danger", $this->lang["actionechec"]]);

                }
            }
            else {
                $this->devise->rollBack();
                Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
            }
        }
        else Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
        Utils::redirect("parametrage", "listeDevise");
    }


    public function deactivate()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->devise->set(["table" => "devise", "champs" => ["etat" => "0"], "condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["actionsuccess"]]);
            else Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
        } else Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
        Utils::redirect("parametrage", "listeDevise");
    }

    public function deleteParametrage()
    {

        if(isset($this->paramGET[0])) {
            $param['condition'] = ["id = "=>$this->paramGET[0]];
            $result = $this->devise->deleteDevise($param);
            if($result !== false) {
                Utils::setMessageALert(["success",$this->lang["actionsuccess"]]);
            }
            else Utils::setMessageALert(["danger",$this->lang["actionechec"]]);
        }
        Utils::redirect("parametrage", "listeDevise");
    }



}