<?php
/**
 * Created by PhpStorm.
 * User: stagiaire_dev_mob
 * Date: 8/6/20
 * Time: 1:33 PM
 */

namespace app\models;


use app\core\BaseModel;

class PassageModel extends BaseModel
{

    /**
     * FormuleModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }
    public function __destruct()
    {
        parent::__destruct();
    }

    /**
     * @param $param
     * @return bool|mixed
     */
    public function insertPassage($param)
    {
        $this->table = "passage";
        $this->__addParam($param);
        return $this->__insert();
    }

    /**
     * @param $param
     * @return bool|mixed
     */
    public function updatePassage($param)
    {
        $this->table = "passage";
        $this->__addParam($param);
        return $this->__update();
    }

    /**
     * @param $param
     * @return bool|mixed
     */
    public function deletePassage($param)
    {
        $this->table = "passage";
        $this->__addParam($param);
        return $this->__delete();
    }

    /**
     * @param null $param
     * @return array|bool
     */
    public function getGainPassage($param = null)
    {
        $this->table = "passage";
        $this->__addParam($param);
        return $this->__select();
    }

    public function getOnePassage($param = null)
    {
        $this->table = "passage";
        $this->__addParam($param);
        return $this->__detail();
    }

    public function getListPassage($param = null)
    {
        $this->table = "passage p";
        $this->champs = ["p.id","p.date_passage","u.prenom","u.nom","s.No_carte","p.montant"];
        $this->jointure = [
            "INNER JOIN souscription s ON s.id = p.souscription_id",
            "INNER JOIN user u ON u.id = s.membre_id"
        ];
        $this->condition = ["p.partenaire_id="=> $param->fk_partenaire];
        return $this->__processing();
    }

    public function getCaPartenaire($user = null){
        $this->table = "passage p";
        $this->champs = ["SUM(p.montant) as CA"];
        $this->condition = ["p.partenaire_id="=> $user->fk_partenaire];
        return $this->__select();
    }


}