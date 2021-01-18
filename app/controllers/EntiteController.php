<?php
/**
 * Created by PhpStorm.
 * User: stagiaire_dev_mob
 * Date: 8/8/20
 * Time: 2:09 AM
 */
namespace app\controllers;

use app\core\BaseController;
use app\core\Session;
use app\core\Utils;

class EntiteController extends BaseController
{

    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = $this->model("entite");
    }


    /**
     * @droit Lister Entite - 4
     */
    public function liste()
    {
        $this->views->getTemplate();
    }

    public function listeProcessing()
    {
        $param = [
            "button"=> [
                "modal" => [
                    ["entite/editModal","entite/editModal","fa fa-edit"]
                ],
                "default" => [
                    ["champ" => "etat","val" => ["0" => ["entite/activate/","fa fa-toggle-off"],"1" => ["entite/deactivate/", "fa fa-toggle-on"]]],
                    ["entite/removeEntite/", "fa fa-trash"],

                    //["utilisateur/detailUtilisateur","fa fa-search"]
                ],
                "custom" => []
            ],
            "tooltip"=> [
                "modal" => [
                    $this->lang["tooltipModif"]
                ],
                "default" => [
                    ["champ"=>"etat","val"=>["0"=>$this->lang["tooltipActive"],"1"=>$this->lang["tooltipDesactive"]]],

                    $this->lang["supprimer"]
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
        $this->processing($this->model, "getList", $param);
    }

    public function createEntiteModal__()
    {
        $this->modal();
    }
    public function ajoutEntite__(){
        $result = $this->model->insertEntite(["champs"=>$this->paramPOST]);
        if($result !== false){
            Utils::setMessageALert(["success", $this->lang["succes_ajout"]]);
        }
        else Utils::setMessageALert(["danger", $this->lang["echec_ajout"]]);
        Utils::redirect("entite", "liste");


    }
    /**
     * @droit Activer Entite - 4
     */
    public function activate()
    {
        if(intval($this->paramGET[0]) > 0)
        {
            if (intval($this->paramGET[0]) > 0) {
                $result = $this->model->updateEntite(["champs" => ["etat" => 1], "condition" => ["id = " => $this->paramGET[0]]]);
                if ($result !== false) Utils::setMessageALert(["success", $this->lang["active_entite"]]);
                else Utils::setMessageALert(["danger", $this->lang["desactive_etite"]]);
            } else Utils::setMessageALert(["danger", $this->lang["desactive_etite"]]);
            Utils::redirect("entite", "liste");
        }
    }

    /**
     * @droit Désactiver Entite - 4
     */
    public function deactivate()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->model->updateEntite(["champs" => ["etat" => 0], "condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang["succes_desactivation"]]);
            else Utils::setMessageALert(["danger", $this->lang["echec_desactivate_partenaire"]]);
        } else Utils::setMessageALert(["danger", $this->lang["echec_desactivation"]]);
        Utils::redirect("entite", "liste");

    }

    public function editModal()
    {
        $data['entite'] = $this->model->getOneEntite(["condition" => ["id = " => $this->paramGET[2]]]);
        $this->views->setData($data);
        $this->modal();

    }
    public function updateEntite()
    {
        $data['condition'] = ["id = " => $this->paramPOST['id']];
        unset($this->paramPOST['id']);
        $data['champs'] = $this->paramPOST;
        $result = $this->model->updateEntite($data);
        if ($result !== false) Utils::setMessageALert(["success", $this->lang["success_modification"]]);
        else Utils::setMessageALert(["danger",$this->lang["echec_modification"]]);
        Utils::redirect("entite", "liste");
    }
    // Supression Entite
    public function removeEntite()
    {
        if (intval($this->paramGET[0]) > 0) {
            $result = $this->model->deleteEntite(["condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false) Utils::setMessageALert(["success", $this->lang['succes_suppression']]);
            else Utils::setMessageALert(["danger", $this->lang["echec_suppression"]]);
        } else Utils::setMessageALert(["danger", $this->lang["echec_suppression"]]);
        Utils::redirect("entite", "liste");
    }



}