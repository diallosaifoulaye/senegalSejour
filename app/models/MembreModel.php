<?php
/**
 * Created by PhpStorm.
 * User: Seyni FAYE
 * Date: 27/02/2017
 * Time: 16:03
 */

namespace app\models;

use app\core\BaseModel;

class MembreModel extends BaseModel
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
    public function insertMembre($param)
    {
        $this->table = "membre";
        $this->__addParam($param);
        return $this->__insert();
    }

    /**
     * @param $param
     * @return bool|mixed
     */

    /**
     * @param null $param
     * @return array|bool
     */
    public function getUser($param = null)
    {
        $this->table = "user u";
        $this->__addParam($param);
        return $this->__select();
    }


    public function getOneMembre_($param = null)
    {
        $this->table = "user";
        $this->champs   = ["id","prenom","nom","email","telephone","dateNaissance"];
        $this->__addParam($param);
        return $this->__detail();
    }

    public function getDept()
    {
        $this->table    = "departement";
        $this->champs   = ["*"];
        $this->condition=["etat="=>"Activer"];
        return $this->__select();
    }
    public function getCom()
    {
        $this->table    = "commune";
        $this->champs   = ["*"];
        $this->condition=["etat="=>"Activer"];
        return $this->__select();
    }
    public function getDepartementByRegion($idtyped)
    {

        $this->table = "departement";
        $this->champs = ['*'];
        $this->condition = ["fk_region="=>$idtyped["region_rowid"],"etat = "=>"Activer"];
        return $this->__select();

    }

    public function getCommuneByDepartement($idtyped)
    {

        $this->table = "commune";
        $this->champs = ['*'];
        $this->condition = ["fk_departement="=>$idtyped["dept_rowid"],"etat = "=>"Activer"];
        return $this->__select();

    }

    public function getList()
    {
        $this->table = "user u";
        $this->champs = ["u.id","u.nom","u.prenom","u.email","f.libelle","u.date_crea","u.etat"];
        $this->jointure = [
            "LEFT JOIN sj_souscription s ON s.membre_id = u.id",
            "LEFT JOIN sj_formule f ON f.id = s.formule_id"
        ];
        $this->condition = ['u.type_profil = ? AND ((s.membre_id IS NULL AND s.etat IS NULL) OR s.etat = ?)'];
        $this->value=[3,1];
        return $this->__processing();
    }

    public function getIdFormuleSubs($param)
    {
        $this->table = "user u";
        $this->champs = ["u.id as id_user","f.id as id_formule"];
        $this->jointure = [
            "LEFT JOIN souscription s ON s.membre_id = u.id",
            "LEFT JOIN formule f ON f.id = s.formule_id"
        ];
        $this->__addParam($param);
        return $this->__select();
    }

    public function getListPassage($param = null){
        $this->table = "passage p";
        $this->champs = ["p.id","pa.nom","p.date_passage","p.montant", "p.montant_economise"];
        $this->jointure = [
            "INNER JOIN partenaire pa ON pa.id = p.partenaire_id",
            "INNER JOIN souscription s ON s.id = p.souscription_id",
            "INNER JOIN user u ON u.id = s.membre_id",
        ];
        $this->condition = ["s.membre_id="=> $param->id];
        return $this->__processing();
    }

    public function getListTransaction($param = null){
        $this->table = "transaction t";
        $this->champs = ["s.id","s.No_carte","t.numtransaction","s.date_debut","s.date_fin","f.libelle as libelleFormule","s.etat"];
        $this->jointure = [
            "INNER JOIN souscription s ON s.id = t.souscription_id",
            "INNER JOIN formule f ON f.id = s.formule_id",
            "INNER JOIN user u ON u.id = s.membre_id",
            "INNER JOIN mode_paiement m ON m.id = t.fk_mode_paiement"
        ];
//        $this->sort = ["s.", "desc"];
        $this->condition = ["s.membre_id="=> $param->id];
        return $this->__processing();
    }

    public function getListSouscription($param = null){
        $this->table = "souscription s";
        $this->champs = ["s.id","s.No_carte","s.date_debut","s.date_fin","f.libelle ","f.montant","m.libelle as libellePaie"];
        $this->jointure = [
            "INNER JOIN formule f ON f.id = s.formule_id",
            "INNER JOIN user u ON u.id = s.membre_id",
            "INNER JOIN mode_paiement m ON m.id = s.mode_paiement_id"
        ];
        $this->condition = ["s.membre_id="=> $param->id];
        return $this->__processing();
    }

    public function getListCadeau(){
        $this->table = "gain_bon c";
        $this->champs = ["c.id","c.nb_point","c.cadeau","validite","en_temps"/*,"etat"*/];
        return $this->__processing();
    }

    public function getPointFidelite($param = null){
        $this->table = "user u";
        $this->champs = ["u.id","u.point_fidelite"];
        $this->condition = ["u.id="=> $param->id];
        return $this->__select();
    }

    public function editMembre($param){
        $this->table = "user u";
        $this->__addParam($param);
        return $this->__update();
    }
    public function insertTransaction($param)
    {
        $this->table = "transaction";
        $this->__addParam($param);
        return $this->__insert();
    }

    public function updateTransaction($param){
        $this->table = "transaction";
        $this->__addParam($param);
        return $this->__update();
    }

    public function insertTransactionEchec($param)
    {
        $this->table = "transaction_echec";
        $this->__addParam($param);
        return $this->__insert();
    }
    public function insertTransactionVisite($param)
    {
        $this->table = "transaction_visite";
        $this->__addParam($param);
        return $this->__insert();
    }

    public function getOneTransactionVisite($param = null)
    {
        $this->table = "transaction_visite";
        $this->__addParam($param);
        return $this->__detail();
    }

    public function updateTransactionVisite($param){
        $this->table = "transaction_visite";
        $this->__addParam($param);
        return $this->__update();
    }

    public function insertToken($param)
    {
        $this->table = "token";
        $this->__addParam($param);
        return $this->__insert();
    }

    public function getOneToken($param = null)
    {
        $this->table = "token";
        $this->__addParam($param);
        return $this->__detail();
    }

    public function updateToken($param){
        $this->table = "token";
        $this->__addParam($param);
        return $this->__update();
    }

    public function deleteToken($param)
    {
        $this->table = "token";
        $this->__addParam($param);
        return $this->__delete();
    }

    public function getOneMembre($param = null)
    {
        $this->table = "passage p";
        $this->champs = ["p.id","pa.nom","p.date_passage","p.montant","p.souscription_id", "p.montant", "p.montant_economise"];
        $this->jointure = [
            "INNER JOIN partenaire pa ON pa.id = p.partenaire_id",
            "INNER JOIN souscription s ON s.id = p.souscription_id",
            "INNER JOIN user u ON u.id = s.membre_id",
        ];
        //$this->condition = ['p.souscription_id =' => $param];
        $this->__addParam($param);
        return $this->__select();
    }

    public function getListPassageMembre($param = null){
        $this->table = "passage p";
        $this->champs = ["p.id","pa.nom","p.date_passage","p.montant", "p.montant_economise"];
        $this->jointure = [
            "INNER JOIN partenaire pa ON pa.id = p.partenaire_id",
            "INNER JOIN souscription s ON s.id = p.souscription_id",
            "INNER JOIN user u ON u.id = s.membre_id",
        ];
        $this->condition = ['s.id =' => $param[0]];
        return $this->__processing();
    }



}