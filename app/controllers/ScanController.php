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

class ScanController extends BaseController
{
    private $model;
    private $souscription;
    private $user;

    public function __construct()
    {
        parent::__construct(false);
        $this->model = $this->model("passage");
        $this->user = $this->model("user");
        $this->souscription = $this->model("souscription");
    }


    public function login__()
    {
//        var_dump($this->paramPOST);die;

        $param = [
            "champs" => ["*"],
            "condition" => ["login = ? OR email = ?"],
            "value" => [$this->paramPOST["login"], $this->paramPOST["login"]]
        ];



        $result = $this->user->getUser($param);

        //TESTER SI L'UTILISATEUR EST DESACTIVE OU PAS
        if($result !== false && count($result) > 0){
            if($result[0]->etat == "Désactiver" || $result[0]->supp == 1){

                $data['message'] = $this->lang['userdesactive'];
                $this->views->setData($data);
                $this->views->getPage('partenaire/scanlogin');
            }
            else{
                if ($result[0]->type_profil == 1 || $result[0]->type_profil == 3){
                    $data['message'] = $this->lang['wrong_space'];
                    $this->views->setData($data);
                    $this->views->getPage('partenaire/scanlogin');
                }else{
                    if(password_verify($this->paramPOST["password"], $result[0]->password)) {
                        Session::set_User_Connecter($result);

                        if($result[0]->connect == 1){
                            Utils::setMessageALert(["danger",$this->lang['lab_connect_first']]);
                            Utils::redirect("scan", "loginscan");
                        }
                        else{
                            Utils::setMessageALert(["success",$this->lang['userconnect']]);
                            Utils::redirect("partenaire", "scanInfo",[$this->paramPOST['code']]);
                        }
                    }
                    else {
                        $data['message'] = $this->lang['wrongpass'];
                        $this->views->setData($data);
                        $this->views->getPage('partenaire/scanlogin');
//                        $this->views->getPage('partenaire/scanlogin');
                    }
                }

            }

        }
        else{
            $data['message'] = $this->lang['userdontexist'];
            $this->views->setData($data);
            $this->views->getPage('partenaire/scanlogin');
        }



    }

    public function logout__()
    {
        Session::destroySession();
        Utils::redirect();
    }

    public function loginscan()
    {
        $data['code'] = $this->paramGET[0];
        $result = $this->souscription->getOneSouscription(["condition"=>["No_carte = "=>$this->paramGET[0]]]);

        if ($result != false){
            if ($result->date_fin > date('Y-m-d H:i:s')){
                $this->views->setData($data);
                $this->views->getPage('partenaire/scanlogin');
            }else{
                $this->souscription->updateSouscription(["condition"=>["No_carte = "=>$this->paramGET[0]], "champs"=>["etat"=>0]]);
                $this->views->initTemplate(["header"=>"header_ep","footer"=>"footer_ep", "sidebar" => "sidebar_site"]);
                $this->views->getTemplate('partenaire/scanFailed');
            }
        }else{
            $this->views->initTemplate(["header"=>"header_ep","footer"=>"footer_ep", "sidebar" => "sidebar_site"]);
            $this->views->getTemplate('partenaire/scanFailed');
        }

    }

}