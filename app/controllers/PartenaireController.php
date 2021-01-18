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

class PartenaireController extends BaseController
{
    private $model;
    private $entite;
    private $user;
    private $passage;
    private $souscription;

    public function __construct()
    {
        parent::__construct();
        $this->model = $this->model("partenaire");
        $this->entite = $this->model("entite");
        $this->user = $this->model("user");
        $this->souscription = $this->model("souscription");
        $this->passage = $this->model("passage");
    }

    /**
     * @droit Lister Partenaire - 4
     */
    public function liste()
    {
        $this->views->getTemplate();
    }

    public function ajoutPartenaireModal(){
        $data['entite'] = $this->entite->AllEntite();
        $this->views->setData($data);
        $this->modal();
    }

    public function listeProcessing()
    {
        $param = [
            "button"=> [
                "modal" => [
                    ["partenaire/editPartner","partenaire/editPartnerModal","fa fa-edit"],
                    ["partenaire/setNewMailModal","partenaire/setNewMailModal","fa fa-at"],
                    ["partenaire/setResponsableModal","partenaire/setResponsableModal","fa fa-user"]
                ],
                "default" => [
                    ["champ" => "etat","val" => ["0" => ["partenaire/activate/","fa fa-toggle-off"],"1" => ["partenaire/deactivate/", "fa fa-toggle-on"]]],
//                    ["partenaire/removePartener/", "fa fa-trash"],
                    ["partenaire/detailPartenaire","fa fa-search"],
                    ["partenaire/historyPartenaire", "fa fa-history"]
                ],
                "custom" => []
            ],
            "tooltip"=> [
                "modal" => [
                    $this->lang["tooltipModif"],
                    $this->lang["setNewMail"],
                    $this->lang["setResponsable"]
                ],
                "default" => [
                    ["champ"=>"etat","val"=>["0"=>$this->lang["tooltipActive"],"1"=>$this->lang["tooltipDesactive"]]],
//                    $this->lang["supprimer"],
                    $this->lang["detail"],
                    $this->lang["historique_partenaire"]
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

    public function scanPage(){
        $this->views->initTemplate(["header"=>"header_ep","footer"=>"footer_ep", "sidebar" => "sidebar_site"]);
        $this->views->getTemplate("partenaire/scanPage");
    }



    /**
     * @droit Créer Partentaire - 4
     */
    public function ajoutPartenaire()
    {
        if (Utils::validateMail($this->paramPOST["email"])) {
            $this->paramPOST['user_crea'] = $this->_USER->id;

            $data['nom'] = $this->paramPOST['nom'];
            $data['prenom'] = $this->paramPOST['nom'];
            $data['email'] = $this->paramPOST['email'];
            $data['login'] = $this->paramPOST['email'];
            $data['telephone'] = $this->paramPOST['telephone'];
            $data['type_profil'] = 2;
            $data['espace_partenaire'] = 1;
            $data['user_crea'] = $this->_USER->id;
            $password = Utils::getGeneratePassword(12);
            $pwd = $password['pass'];
            $data['password'] =  $password['crypt'];
            $data['connect'] = 1;

            $this->model->beginTransaction();
            $result = $this->model->insertPartenaire(["champs"=>$this->paramPOST]);
            if($result){
                $data['fk_partenaire'] = $this->model->getIdPartenaire($this->paramPOST["email"]);
                $resultUser = $this->user->insertUser(["champs" => $data]);
                if ($resultUser){
                    try{
                        if (Utils::validateMail($this->paramPOST["email_responsable"])) {
                            $data_['nom'] = $this->paramPOST['nom_responsable'];
                            $data_['prenom'] = $this->paramPOST['prenom_responsable'];
                            $data_['email'] = $this->paramPOST['email_responsable'];
                            $data_['telephone'] = $this->paramPOST['telephone_responsable'];
                            $data_['login'] = $this->paramPOST['email_responsable'];
                            $data_['uiid'] = bin2hex(random_bytes(5));
                            $data_['type_profil'] = 3;
                            $data_['date_crea'] = date('Y-m-d');
                            $password_ = Utils::getGeneratePassword(12);
                            $pwd_ = $password_['pass'];
                            $data_['password'] =  $password_['crypt'];
                            $data_['connect'] = 1;
                            $data_['fk_partenaire'] = $data['fk_partenaire'];
                            $result_ = $this->user->insertUser(["champs"=>$data_]);
                            if ($result_ !== false ){
                                $this->model->commit();
                                Utils::envoiparametre($this->paramPOST['prenom_responsable'] . ' ' . $this->paramPOST['nom_responsable'], $this->paramPOST['email_responsable'],$data_['login'],$pwd_);
                                Utils::envoiparametre($this->paramPOST['nom'], $this->paramPOST['email'],  $data['login'], $pwd );
                                Utils::setMessageALert(["success", $this->lang["partenaire_ajoute"]]);
                            }
                            else {
                                Utils::setMessageALert(["danger", $this->lang["echec_add_membre"]]);
                                $this->model->rollBack();
                            }

                        } else {
                            Utils::setMessageALert(["warning", $this->lang["email_invalide"]]);
                            $this->model->rollBack();
                        }
                    }catch (\Exception $e){
                        $this->model->rollBack() ;
                        Utils::setMessageALert(["danger",$this->lang["actionechec"]." ".$e->getMessage()]);
                    }
                }else{
                    $this->model->rollBack();
                    Utils::setMessageALert(["danger", $this->lang["echec_add_partenaire"]]);
                }
            }
            else {
                Utils::setMessageALert(["danger", $this->lang["echec_add_partenaire"]]);
                $this->model->rollBack();
            }

        } else Utils::setMessageALert(["warning", $this->lang["email_invalide"]]);

        Utils::redirect("partenaire", "liste");


    }


    /**
     * @droit Modifier Partenaire - 4
     */
    public function editPartner()
    {
        $data['partenaire'] = $this->model->getOnePartenaire(["condition" => ["p.id = " => $this->paramGET[2]]]);
        $data['entite'] = $this->entite->AllEntite();

        //var_dump($data['partenaire']);die;
        $this->views->setData($data);
        $this->modal();

    }

    public function setResponsableModal()
    {
        $data['partenaire'] = $this->model->getOnePartenaire(["condition" => ["p.id = " => $this->paramGET[2]]]);
        $this->views->setData($data);
        $this->modal();

    }

    public function setNewMailModal()
    {
        $data['partenaire'] = $this->model->getOnePartenaire(["condition" => ["p.id = " => $this->paramGET[2]]]);
        $this->views->setData($data);
        $this->modal();

    }

    public function setResponsable(){

        $_["prenom"]= $this->paramPOST["prenom_responsable"];
        $_["nom"]= $this->paramPOST["nom_responsable"];
        $_["email"]= $this->paramPOST["email_responsable"];
        $_["telephone"]= $this->paramPOST["telephone_responsable"];
        $_['login'] = $this->paramPOST['email_responsable'];
        $_['uiid'] = bin2hex(random_bytes(5));
        $_['type_profil'] = 3;
        $_['date_crea'] = date('Y-m-d');
        $password_ = Utils::getGeneratePassword(12);
        $pwd_ = $password_['pass'];
        $_['password'] =  $password_['crypt'];
        $_['connect'] = 1;
        $_['fk_partenaire'] = $this->paramPOST['id'];

        $this->user->beginTransaction();


        $result_update = $this->user->updateUser(["champs" => ["fk_partenaire" => null], "condition" => ["fk_partenaire = " => $this->paramPOST['id'], "espace_partenaire = " => 0]]);

        if ($result_update){
            $result_ = $this->user->insertUser(["champs"=>$_]);
            if ($result_ !== false ){
                $data['condition'] = ["id = " => $this->paramPOST['id']];
                $data['champs'] = $this->paramPOST;
                unset($this->paramPOST['id']);
                $result = $this->model->updatePartenaire($data);
                if ($result){
                    $this->user->commit();
                    Utils::envoiparametre($this->paramPOST['prenom_responsable'] . ' ' . $this->paramPOST['nom_responsable'], $this->paramPOST['email_responsable'],$_['login'],$pwd_);
                    Utils::setMessageALert(["success", $this->lang["responsable_modifie_avec_sucess"]]);
                }else{
                    Utils::setMessageALert(["danger", $this->lang["responsable_modifie_echec"]]);
                    $this->user->rollBack();
                }
            }
            else {
                Utils::setMessageALert(["danger", $this->lang["responsable_modifie_echec"]]);
                $this->user->rollBack();
            }
        }else{
            Utils::setMessageALert(["danger", $this->lang["responsable_modifie_echec"]]);
            $this->user->rollBack();
        }


        Utils::redirect("partenaire", "liste");

    }

    public function setNewMail(){

        if (Utils::validateMail($this->paramPOST["email"])){
            $_["email"]= $this->paramPOST["email"];
            $_['login'] = $this->paramPOST['email'];
            $password_ = Utils::getGeneratePassword(12);
            $pwd_ = $password_['pass'];
            $_['password'] =  $password_['crypt'];
            $_['connect'] = 1;

            $this->user->beginTransaction();


            $result_update = $this->user->updateUser(["champs" => $_, "condition" => ["fk_partenaire = " => $this->paramPOST['id'], "type_profil = " => 2]]);

            if ($result_update){
                $result = $this->model->updatePartenaire(["champs" => ["email" => $this->paramPOST["email"]], "condition" => ["id = " => $this->paramPOST['id']]]);
                if ($result){
                    $_r = $this->model->getOnePartenaire(["condition" => ["p.id = " => $this->paramPOST['id']]]);
                    $nom = $_r->nom;
                    $this->user->commit();
                    Utils::envoiparametre($nom, $this->paramPOST['email'],  $_['login'], $pwd_ );
                    Utils::setMessageALert(["success", $this->lang["responsable_modifie_avec_sucess"]]);
                }else{
                    Utils::setMessageALert(["danger", $this->lang["responsable_modifie_echec"]]);
                    $this->user->rollBack();
                }
            }else{
                Utils::setMessageALert(["danger", $this->lang["responsable_modifie_echec"]]);
                $this->user->rollBack();
            }
        }else{
            Utils::setMessageALert(["danger", $this->lang["responsable_modifie_echec"]]);
            $this->user->rollBack();
        }




        Utils::redirect("partenaire", "liste");

    }

    public function updatePartenaire(){

        $data['condition'] = ["id = " => $this->paramPOST['id']];

        $id = $this->paramPOST['id'];
        unset($this->paramPOST['id']);
        $data['champs'] = $this->paramPOST;

        $this->model->beginTransaction();

        $result = $this->model->updatePartenaire($data);

        //var_dump($result);die;
        if ($result !== false) {
            unset($this->paramPOST["nom"]);
            unset($this->paramPOST["email"]);
            unset($this->paramPOST["telephone"]);
            unset($this->paramPOST["taux_reduction"]);
            unset($this->paramPOST["entite_id"]);

            $_["prenom"]= $this->paramPOST["prenom_responsable"];
            $_["nom"]= $this->paramPOST["nom_responsable"];
            $_["email"]= $this->paramPOST["email_responsable"];
            $_["telephone"]= $this->paramPOST["telephone_responsable"];

            $data_['condition'] = ["fk_partenaire = " => $id, "type_profil = " => 3];
            $data_['champs'] = $_;
            $resultUser = $this->user->updateUser($data_);
            if ($resultUser !== false) {
                $this->model->commit();
                Utils::setMessageALert(["success", $this->lang["succes_update_partenaire"]]);
            }else{
                Utils::setMessageALert(["danger",$this->lang["echec_update_partenaire"]]);
                $this->model->rollBack();
            }

        }
        else {
            Utils::setMessageALert(["danger",$this->lang["echec_update_partenaire"]]);
            $this->model->rollBack();
        }
        Utils::redirect("partenaire", "liste");
    }

    /**
     * @droit Activer Partenaire - 4
     */
    public function activate()
    {
        if(intval($this->paramGET[0]) > 0)
        {
           // var_dump($this->paramGET);die;
            if (intval($this->paramGET[0]) > 0) {
                $this->model->beginTransaction();
                $result = $this->model->updatePartenaire(["champs" => ["etat" => 1], "condition" => ["id = " => $this->paramGET[0]]]);
                if ($result !== false)
                {
                    $result1 = $this->user->updateUser(["champs" => ["etat" => "Activer"], "condition" => ["fk_partenaire = " => $this->paramGET[0]]]);
                    if ($result1 !== false){
                        $this->model->commit();
                        Utils::setMessageALert(["success", $this->lang["succes_activate_partenaire"]]);
                    }else{
                        Utils::setMessageALert(["danger", $this->lang["echec_activate_partenaire"]]);
                        $this->model->rollBack();
                    }
                }
                else {
                    $this->model->rollBack();
                    Utils::setMessageALert(["danger", $this->lang["echec_activate_partenaire"]]);
                }
            } else Utils::setMessageALert(["danger", $this->lang["echec_activate_partenaire"]]);
            Utils::redirect("partenaire", "liste");
        }
    }

    /**
     * @droit Désactiver Partenaire - 4
     */
    public function deactivate()
    {
        if (intval($this->paramGET[0]) > 0) {
            $this->model->beginTransaction();
            $result = $this->model->updatePartenaire(["champs" => ["etat" => 0], "condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false){
                $result1 = $this->user->updateUser(["champs" => ["etat" => "Désactiver"], "condition" => ["fk_partenaire = " => $this->paramGET[0]]]);
                if ($result1 !== false){
                    $this->model->commit();
                    Utils::setMessageALert(["success", $this->lang["succes_desactivate_partenaire"]]);
                }else{
                    Utils::setMessageALert(["danger", $this->lang["echec_desactivate_partenaire"]]);
                    $this->model->rollBack();
                }
            }
            else {
                $this->model->rollBack();
                Utils::setMessageALert(["danger", $this->lang["echec_desactivate_partenaire"]]);
            }
        } else Utils::setMessageALert(["danger", $this->lang["echec_desactivate_partenaire"]]);
        Utils::redirect("partenaire", "liste");

    }

    // Supression Partenaire
    public function removePartener()
    {
        if (intval($this->paramGET[0]) > 0) {
            $this->model->beginTransaction();
            $result = $this->model->deletePartener(["condition" => ["id = " => $this->paramGET[0]]]);
            if ($result !== false){
                $result1 = $this->user->deleteUser(["condition" => ["fk_partenaire = " => $this->paramGET[0]]]);
                if ($result1 !== false){
                    $this->model->commit();
                    Utils::setMessageALert(["success", $this->lang["succes_suppression"]]);
                }else{
                    Utils::setMessageALert(["danger", $this->lang["echec_suppression"]]);
                    $this->model->rollBack();
                }
            }
            else {
                $this->model->rollBack();
                Utils::setMessageALert(["danger", $this->lang["echec_suppression"]]);
            }
        } else Utils::setMessageALert(["danger", $this->lang["echec_suppression"]]);
        Utils::redirect("partenaire", "liste");
    }

    //Detail
    public function detailPartenaire(){
        $data['partenaire'] = $this->model->getOnePartenaire(["condition" => ["p.id = " => $this->paramGET[0]]]);
        $this->views->setData($data);
        $this->views->getTemplate('partenaire/detailPartenaire');

        //$this->modal();
    }
    /*
     * Verifie l'éxistance de partenaire
     */
    public function verifie(){
        $donnees = $this->paramPOST ;
        $param['condition'] = [$donnees["champ"]."= "=>$donnees["valeur"]];
        $param['champs'] = ["id","type_profil","prenom","nom","telephone"];

        $resultat = count($this->user->getUser($param));
        $res = $this->user->getUser($param)[0];

        $obj = "";

        if ($resultat > 0){
            $obj->code = -1;
        }else{
            $obj->code = 1;
        }

        $myJSON = json_encode($obj);
        echo $myJSON;


    }


    // ESPACE PARTENAIRE

    //LISTE PASSAGE
    public function listePassage()
    {
        $this->views->initTemplate(["header"=>"header_ep","footer"=>"footer_ep", "sidebar" => "sidebar_site"]);
        $req = $this->passage->getCaPartenaire($this->_USER);
        if ($req[0]->CA != NULL){
            $data['ChiffreAffaire'] = $req[0];
        }else {
            $req[0]->CA = 0;
            $data['ChiffreAffaire'] = $req[0];
        }
        $this->views->setData($data);
        $this->views->getTemplate('site/histo_passage_partenaire');
        //$this->views->getTemplate("partenaire/passageList");
    }

    public function listePassageProcessing()
    {
        $param = [
            "args" => $this->_USER,
            'fonction' => [
                'montant' => 'getFormatMoney',
                'date_passage'=>'getDateFR'
                ]
        ];
        $this->processing($this->passage, "getListPassage",$param);
    }

    public function scanInfo(){
        if ($this->_USER->type_profil == 2)
        {
            $data['details_partenaire'] = $this->model->getOnePartenaire(["condition"=>["p.id = "=>$this->_USER->fk_partenaire]]);
            $data['details_souscription'] = $this->souscription->getOneSouscriptionMembreFormule(["condition"=>["s.No_carte = "=>$this->paramGET[0]]]);
            $this->views->setData($data);
            $this->views->initTemplate(["header"=>"header_ep","footer"=>"footer_ep", "sidebar" => "sidebar_site"]);
            $this->views->getTemplate("partenaire/info");
        }else{
            $data['message'] = $this->lang['wrong_space'];
            $this->views->setData($data);
            $this->views->getPage('partenaire/scanlogin');
        }
    }

    public function setPassage(){

        $partenaire = $this->model->getOnePartenaire(["condition"=>["p.id = "=>$this->_USER->fk_partenaire]]);
        $taux = $partenaire->taux_reduction;
        $montant = (intval($this->paramPOST["montant_prestation"]) - (intval($this->paramPOST["montant_prestation"]) * intval($taux) / 100));
        $membre_id = $this->paramPOST["membre_id"];
        $nombre_point = $this->paramPOST["nombre_point"];
        if ($montant>=1000){
            $nombre_point = $nombre_point + ($montant / 1000) ;
        }
        unset($this->paramPOST["membre_id"]);
        unset($this->paramPOST["nombre_point"]);


        $param['champs'] = [
            "partenaire_id"=>$this->paramPOST["partenaire_id"],
            "date_passage"=>date('Y-m-d H:i:s'),
            "souscription_id"=>$this->paramPOST["souscription_id"],
            "montant"=>$montant,
            "montant_economise"=>(intval($this->paramPOST["montant_prestation"]) * intval($taux) / 100)
        ];

        try
        {
            $this->passage->beginTransaction();
            $result = $this->passage->insertPassage($param);
            if($result !== false || $result != null) {
                $_ = $this->user->getUser(["condition"=>["u.id = "=>$membre_id]])[0];
                $point_fidelite = intval($_->point_fidelite) + intval($nombre_point);
                $param['condition'] = ["id = "=>$membre_id];
                $param['champs'] = ["point_fidelite" => $point_fidelite];
                $_r = $this->user->updateUser($param);
                if ($_r != false){
                    $this->passage->commit();
                    echo 1;
                }else{
                    $this->passage->rollBack();
                    echo 0;
                }
            }
        }
        catch (\Exception $exception){
            echo 0;
            $this->passage->rollBack();
        }
    }


    public function historyPartenaire(){

        $data['partenaire'] = $this->model->getOnePartenaireHistory(["condition" => ["pa.id = " => $this->paramGET[0]]])[0];
        $this->views->setData($data);
        $this->views->getTemplate('partenaire/historyPartenaire');

    }
    public function listePassageByPartenaireProcessing()
    {
        $param = [
            "args" =>  $this->paramGET,
            "fonction" => [
                'date_passage'=>'getDateFR',
                'montant_economise'=>'getFormatMoney',
                'montant'=>'getFormatMoney',
            ]
        ];
        $this->processing($this->model, 'getListPassage', $param);
    }

}