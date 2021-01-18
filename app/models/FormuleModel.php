<?php
/**
 * Created by PhpStorm.
 * User: Seyni FAYE
 * Date: 27/02/2017
 * Time: 16:03
 */

namespace app\models;

use app\core\BaseModel;

class FormuleModel extends BaseModel
{

    /**
     * FormuleModel constructor.
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
    public function insertFormule($param)
    {
        $this->table = "formule";
        $this->__addParam($param);
        return $this->__insert();
    }

    public function insertDevise($param)
    {
        $this->table = "devise";
        $this->__addParam($param);
        return $this->__insert();
    }

    public function insertPromotion($param)
    {
        $this->table = "promotion";
        $this->__addParam($param);
        return $this->__insert();
    }

    /**
     * @param $param
     * @return bool|mixed
     */
    public function insertAvantage($param)
    {
        $this->table = "avantage";
        $this->__addParam($param);
        return $this->__insert();
    }

    /**
     * @param $param
     * @return bool|mixed
     */
    public function insertFormuleAvantage($param)
    {
        $this->table = "formule_has_avantage";
        $this->__addParam($param);
        return $this->__insert();
    }

    /**
     * @param $param
     * @return bool|mixed
     */
    public function insertModePaiement($param)
    {
        $this->table = "mode_paiement";
        $this->__addParam($param);
        return $this->__insert();
    }

    /**
     * @param $param
     * @return bool|mixed
     */
    public function insertCadeauPoint($param)
    {
        $this->table = "gain_bon";
        $this->__addParam($param);
        return $this->__insert();
    }

    /**
     * Processing module
     */
    public function getListeProcess()
    {
        $this->table = "formule";
        $this->champs = ["id","libelle","montant","description","duree","type_duree","nombre_point","etat"];
        return $this->__processing();
    }

    public function getListePormotionProcess()
    {
        $this->table = "promotion";
        $this->champs = ["id","libelle","debut","fin","taux","etat"];
        return $this->__processing();
    }

    public function getListeDeviseProcess()
    {
        $this->table = "devise";
        $this->champs = ["id","libelle","valeur","etat"];
        return $this->__processing();
    }

    /**
     * Processing module
     */
    public function getListeAvantageProcess()
    {
        $this->table = "avantage";
        $this->champs = ["id","libelle","etat"];
        return $this->__processing();
    }

    /**
     * Processing module
     */
    public function getListeModePaiementProcess()
    {
        $this->table = "mode_paiement";
        $this->champs = ["id","libelle","etat"];
        return $this->__processing();
    }

    /**
     * Processing module
     */
    public function getListeCadeauPointProcess()
    {
        $this->table = "gain_bon";
        $this->champs = ["id","nb_point","cadeau","validite","en_temps","etat"];
        return $this->__processing();
    }

    /**
     * @param null $param
     * @return array|bool
     */
    public function getFormule($param = null)
    {
        $this->table = "formule";
        $this->__addParam($param);
        return $this->__select();
    }
    /**
     * @param null $param
     * @return array|bool
     */
    public function getFormuleActif($param = null)
    {
        $this->table = "formule";
        $this->condition = ["etat="=>1];
        $this->__addParam($param);
        return $this->__select();
    }

    /**
     * @param null $param
     * @return array|bool
     */
    public function getPromotion($param = null)
    {
        $this->table = "promotion";
        $this->__addParam($param);
        return $this->__select();
    }
    /**
     * @param null $param
     * @return array|bool
     */
    public function getPromotionActif($param = null)
    {
        $this->table = "promotion";
        $this->condition = ["etat="=>1];
        $this->__addParam($param);
        return $this->__select();
    }

    /**
     * @param null $param
     * @return array|bool
     */
    public function getDevise($param = null)
    {
        $this->table = "devise";
        $this->__addParam($param);
        return $this->__select();
    }
    /**
     * @param null $param
     * @return array|bool
     */
    public function getDeviseActif($param = null)
    {
        $this->table = "devise";
        $this->condition = ["etat="=>1];
        $this->__addParam($param);
        return $this->__select();
    }

    /**
     * @param null $param
     * @return array|bool
     */
    public function getAvantage($param = null)
    {
        $this->table = "avantage";
        $this->__addParam($param);
        return $this->__select();
    }

    /**
     * @param null $param
     * @return array|bool
     */
    public function getAvantageActif($param = null)
    {
        $this->table = "avantage";
        $this->condition = ["etat="=>1];
        $this->__addParam($param);
        return $this->__select();
    }

    /**
     * @param null $param
     * @return array|bool
     */
    public function getFormuleAvantage($param = null)
    {
        $this->table = "formule_has_avantage";
        $this->__addParam($param);
        return $this->__select();
    }
    /**
     * @param null $param
     * @return array|bool
     */
    public function getFormuleAvantageLibelle($param = null)
    {
        $this->table = "formule_has_avantage f";
        $this->champs = ["a.libelle"];
        $this->jointure = ["INNER JOIN avantage a on f.avantage_id = a.id"];
        $this->__addParam($param);
        return $this->__select();
    }

    /**
     * @param null $param
     * @return array|bool
     */
    public function getModePaiement($param = null)
    {
        $this->table = "mode_paiement";
        $this->__addParam($param);
        return $this->__select();
    }

    /**
     * @param null $param
     * @return array|bool
     */
    public function getCadeauPoint($param = null)
    {
        $this->table = "gain_bon";
        $this->__addParam($param);
        return $this->__select();
    }


    /**
     * @param $param
     * @return bool|mixed
     */
    public function updatePromotion($param)
    {
        $this->table = "promotion";
        $this->__addParam($param);
        return $this->__update();
    }

    /**
     * @param $param
     * @return bool|mixed
     */
    public function updateDevise($param)
    {
        $this->table = "devise";
        $this->__addParam($param);
        return $this->__update();
    }

    /**
     * @param $param
     * @return bool|mixed
     */
    public function updateAvantage($param)
    {
        $this->table = "avantage";
        $this->__addParam($param);
        return $this->__update();
    }

    /**
     * @param $param
     * @return bool|mixed
     */
    public function updateFormuleAvantage($param)
    {
        $this->table = "formule_has_avantage";
        $this->__addParam($param);
        return $this->__update();
    }

    /**
     * @param $param
     * @return bool|mixed
     */
    public function updateModePaiement($param)
    {
        $this->table = "mode_paiement";
        $this->__addParam($param);
        return $this->__update();
    }

    /**
     * @param $param
     * @return bool|mixed
     */
    public function updateCadeauPoint($param)
    {
        $this->table = "gain_bon";
        $this->__addParam($param);
        return $this->__update();
    }

    /**
     * @param $param
     * @return bool|mixed
     */
    public function deleteFormule($param)
    {
        $this->table = "formule";
        $this->__addParam($param);
        return $this->__delete();
    }

    /**
     * @param $param
     * @return bool|mixed
     */
    public function deletePromotion($param)
    {
        $this->table = "promotion";
        $this->__addParam($param);
        return $this->__delete();
    }

 /**
 * @param $param
 * @return bool|mixed
 */
    public function deleteDevise($param)
    {
        $this->table = "devise";
        $this->__addParam($param);
        return $this->__delete();
    }

    /**
     * @param $param
     * @return bool|mixed
     */
    public function deleteAvantage($param)
    {
        $this->table = "avantage";
        $this->__addParam($param);
        return $this->__delete();
    }

    /**
     * @param $param
     * @return bool|mixed
     */
    public function deleteFormuleAvantage($param)
    {
        $this->table = "formule_has_avantage";
        $this->__addParam($param);
        return $this->__delete();
    }

    /**
     * @param $param
     * @return bool|mixed
     */
    public function deleteModePaiement($param)
    {
        $this->table = "mode_paiement";
        $this->__addParam($param);
        return $this->__delete();
    }

    /**
     * @param $param
     * @return bool|mixed
     */
    public function deleteCadeauPoint($param)
    {
        $this->table = "gain_bon";
        $this->__addParam($param);
        return $this->__delete();
    }

    public function getOneFormule($param = null)
    {
        $this->table = "formule";
        $this->__addParam($param);
        return $this->__detail();
    }

    public function getOneAvantage($param = null)
    {
        $this->table = "avantage";
        $this->__addParam($param);
        return $this->__detail();
    }

    public function getOneFormuleAvantage($param = null)
    {
        $this->table = "formule_has_avantage";
        $this->__addParam($param);
        return $this->__detail();
    }

    public function getOneModePaiement($param = null)
    {
        $this->table = "mode_paiement";
        $this->__addParam($param);
        return $this->__detail();
    }

    public function getOneCadeauPoint($param = null)
    {
        $this->table = "gain_bon";
        $this->__addParam($param);
        return $this->__detail();
    }

    public function getSouscriptionCount($param = null)
    {
        $this->table = "souscription s";
        $this->champs = ["COUNT(s.id) as nbr"];
        $this->jointure = ["INNER JOIN user u on s.membre_id = u.id"];
        $this->__addParam($param);
        return $this->__select();
    }

    public function getCodePromo($param = null)
    {
        $this->table = "promotion p";
        $this->__addParam($param);
        return $this->__select();
    }

}