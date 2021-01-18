<?php
/**
 * Created by PhpStorm.
 * User: stagiaire_dev_mob
 * Date: 11/2/20
 * Time: 3:13 PM
 */

namespace app\controllers;
use app\core\BaseController;


class ReportingController extends BaseController
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = $this->model("partenaire");

    }


    public function choixPartenaire() {

        $data['partenaires'] = $this->model->get(["table"=>"partenaire","champs"=>["id , nom"]]);
        $this->views->setData($data);
        $this->modal();
    }
    public function receptionChoix(){
        $data['idPartenaire'] = $this->paramPOST['partenaire'];
        $this->views->setData($data);
        $this->views->getTemplate();
    }

}