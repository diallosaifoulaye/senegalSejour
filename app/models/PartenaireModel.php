<?php
/**
 * Created by PhpStorm.
 * User: Seyni FAYE
 * Date: 27/02/2017
 * Time: 16:03
 */

namespace app\models;

use app\core\BaseModel;

class PartenaireModel extends BaseModel
{

    /**
     * HomeModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * HomeModel destruct.
     */
    public function __destruct()
    {
        parent::__destruct();
    }

    /**
     * @param $param
     * @return bool|mixed
     */
    public function insertPartenaire($param)
    {
        $this->table = "partenaire";
        $this->__addParam($param);
        return $this->__insert();
    }

    /**
     * Suppression partener
     */
    public function deletePartener($param)
    {
        $this->table = "partenaire";
        $this->__addParam($param);
        return $this->__delete();
    }

    public function deleteUser($param)
    {
        $this->table = "user";
        $this->__addParam($param);
        return $this->__delete();
    }

    /**
     * @param $param
     * @return bool|mixed
     */
    public function updatePartenaire($param)
    {
        $this->table = "partenaire";
        $this->__addParam($param);
        return $this->__update();
    }

//    public function getList()
//    {
//        $this->table = "partenaire p";
//        $this->champs = ['p.id','p.nom','p.nom_responsable','p.prenom_responsable','p.email_responsable','p.telephone_responsable', 'SUM(ps.montant)','p.etat'];
//        $this->jointure = ["LEFT JOIN passage ps ON ps.partenaire_id = p.id"];
//       $this->group=['sj_p.id'];
//        echo '<pre>';var_dump($this->__select());die();
//        echo '<pre>';var_dump($this->__processing());die();
//        return $this->__processing();
//    }



    public function getList()
    {
        $this->table = "partenaire";
        $this->champs = ['id','nom','nom_responsable','prenom_responsable','email_responsable','telephone_responsable', 'etat'];
        return $this->__processing();
    }

    public function getListNormal()
    {
        $this->table = "partenaire";
        $this->champs = ['nom','nom_responsable','prenom_responsable','email_responsable','telephone_responsable'];
        return $this->__select();
    }

    public function getOnePartenaire($param = null)
    {
        $this->table = "partenaire p";
        $this->champs = ["p.id as partenaire_id","p.nom","p.nom_responsable","p.prenom_responsable","p.email","p.email_responsable","p.telephone","p.telephone_responsable","p.taux_reduction","e.libelle","p.adresse","p.etat"];
        $this->jointure = ["INNER JOIN entite e on e.id = p.entite_id"];
        $this->__addParam($param);
        return $this->__detail();
    }

    public function getIdPartenaire($email)
    {
        $this->table = "partenaire p";
        $this->champs = ["p.id as idPartenaire"];
        $this->condition=["p.email ="=> $email, "p.etat ="=> 1];
        return $this->__detail()->idPartenaire;
    }


    public function verifie(){
        $donnees = $this->paramPOST ;
        $param['condition'] = [$donnees["champ"]."= "=>$donnees["valeur"]];
        $param['champs'] = ["id"];
        $resultat = count($this->model->getUser($param));

        echo $resultat ;
    }

    public function getOnePartenaireHistory($param = null)
    {
        $this->table = "passage p";
        $this->champs = ["p.id","pa.id as idParte","pa.nom","p.date_passage","p.montant","p.souscription_id", "p.montant", "p.montant_economise"];
        $this->jointure = [
            "INNER JOIN partenaire pa ON pa.id = p.partenaire_id",
            "INNER JOIN souscription s ON s.id = p.souscription_id",
            "INNER JOIN user u ON u.id = s.membre_id",
        ];
        //$this->condition = ['p.souscription_id =' => $param];
        $this->__addParam($param);
        return $this->__select();
    }
    public function getListPassagePartenaire($param = null){
        $this->table = "passage p";
        $this->champs = ["p.id","pa.nom","p.date_passage","p.montant", "p.montant_economise"];
        $this->jointure = [
            "INNER JOIN partenaire pa ON pa.id = p.partenaire_id",
            "INNER JOIN souscription s ON s.id = p.souscription_id",
            "INNER JOIN user u ON u.id = s.membre_id",
        ];
        $this->condition = ['pa.id =' => $param[0]];
        return $this->__processing();
    }
    public function getListPassage($param = null)
    {
        $this->table = "passage p";
        $this->champs = ["p.id","p.date_passage","u.prenom","u.nom","s.No_carte","p.montant"];
        $this->jointure = [
            "INNER JOIN souscription s ON s.id = p.souscription_id",
            "INNER JOIN user u ON u.id = s.membre_id"
        ];
        $this->condition = ["p.partenaire_id="=> $param[0]];
        return $this->__processing();
    }


}