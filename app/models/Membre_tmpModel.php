<?php
/**
 * Created by PhpStorm.
 * User: stagiaire_dev_mob
 * Date: 12/21/20
 * Time: 4:51 PM
 */

namespace app\models;
namespace app\models;

use app\core\BaseModel;

class Membre_tmpModel extends BaseModel
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
    public function insertUser_tmp($param)
    {
        $this->table = "membre_tmp";
        $this->__addParam($param);
        return $this->__insert();
    }
    public function insertUser_tmp_all($param)
    {
        $this->table = "membre_tmp";
        $this->__addParam($param);
        $this->condition=["verif_etat_mail="=>0];
        return $this->__insert();
    }
    public function getList()
    {
        $this->table = "membre_tmp m";
        $this->champs = ["m.id","m.nom","m.prenom","m.email","m.telephone","m.date_naissance"];
        return $this->__processing();
    }

    public function getOneMembre($param = null)
    {
        $this->table = "membre_tmp m";
        $this->champs   = ["m.id","m.prenom","m.nom","m.email","m.telephone","m.date_naissance"];
        $this->__addParam($param);
        return $this->__detail();
    }

    public function editMembre($param){
        $this->table = "membre_tmp m";
        $this->__addParam($param);
        return $this->__update();
    }

    public function getMembre($param = null)
    {
        $this->table = "user u";
        $this->__addParam($param);
        return $this->__select();
    }
    public function deleteMembreTmp($param)
    {
        $this->table = "membre_tmp";
        $this->__addParam($param);
        return $this->__delete();
    }
    public function getListMembreTmp()
    {
        $this->table = "membre_tmp m";
        $this->champs   = ["m.id","m.prenom","m.nom","m.email","m.telephone","m.date_naissance", "m.verif_etat_mail"];
        $this->condition = ['m.verif_etat_mail = ' => 0];
        return $this->__select();
    }
}
