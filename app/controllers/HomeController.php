<?php

/**
 * Created by PhpStorm.
 * User: Seyni FAYE
 * Date: 15/02/2017
 * Time: 20:02
 */

namespace app\controllers;

use app\core\BaseController;
use app\core\Session;
use app\core\Utils;



class HomeController extends BaseController
{
    private $model;
    private $membre;
    private $formule;

    public function __construct()
    {
        //var_dump(ASSETS); exit;
        //var_dump(1);die;
        parent::__construct(false);
        $this->model = $this->model("user");
        $this->membre = $this->model("membre");
        $this->formule = $this->model("formule");
    }

    public function index__()
    {
        $this->views->initTemplate(["header"=>"header_ep","footer"=>"footer_ep", "sidebar" => "sidebar_site"]);
        $this->views->getTemplate('site/index');
//        $this->views->getPage('theme/index');
    }

    public function leClub(){
        $this->views->initTemplate(["header"=>"header_ep","footer"=>"footer_ep", "sidebar" => "sidebar_site"]);
        $this->views->getTemplate('site/accueil');
        //header('Location:  https://www.senegalsejour.com/le-club-senegalsejour/ ');


    }

    public function espace_partenaire(){
        $this->views->initTemplate(["header"=>"header_ep","footer"=>"footer_ep", "sidebar" => "sidebar_site"]);
        $this->views->getTemplate('site/accueil');
    }

    public function devenirPartenaire(){
        $this->views->initTemplate(["header"=>"header_ep","footer"=>"footer_ep", "sidebar" => "sidebar_site"]);
        $this->views->getTemplate('site/envoiInfoPartenaire');
    }


    public function loginpage__(){
        Session::destroySession();
        $this->views->getPage('site/login');
    }

    public function register__(){
        $this->views->initTemplate(["header"=>"header_ep","footer"=>"footer_ep", "sidebar" => "sidebar_site"]);
        $this->views->getTemplate('site/register');
    }

    public function differentesformules(){
        $formules = $this->formule->getFormuleActif(["condition"=>["etat ="=>1]]);
        $formulesAvantages = array();
        foreach ($formules as $value) {
            $avantages = $this->formule->getFormuleAvantageLibelle(["condition"=>["formule_id ="=>$value->id]]);
            $_ = array("formules"=> $value, "avantages" => $avantages);
            array_push($formulesAvantages, $_);
        }
        $data["formulesAvantages"] = $formulesAvantages;
        $this->views->setData($data);
        $this->views->initTemplate(["header"=>"header_ep","footer"=>"footer_ep", "sidebar" => "sidebar_site"]);
        $this->views->getTemplate('site/passHome');
    }

    /*public function home(){
        $this->views->initTemplate(["header"=>"header_ep","footer"=>"footer_ep", "sidebar" => "sidebar_site"]);
        $this->views->getTemplate('site/accueil');
    }*/

    public function login__()
    {
        $param = [
            "champs" => ["*"],
            "condition" => ["login = ? "],
            "value" => [$this->paramPOST["login"]]
        ];
        $result = $this->model->getUser($param);
        // var_dump($result);die;

        //TESTER SI L'UTILISATEUR EST DESACTIVE OU PAS
        if($result !== false && count($result) > 0){
            if($result[0]->etat == "Désactiver" || $result[0]->supp == 1){
//                Utils::setMessageALert(["danger",$this->lang['userdesactive']]);
                //Utils::redirect("home", "index", [0]);
                //Utils::redirect("home", "index");
                $data['message'] = $this->lang['userdesactive'];
                $this->views->setData($data);
                $this->views->getPage('site/login');
            }
            else{

                if($result[0]->flag_authorized != 0 ){
                    //var_dump($result[0]->password);die;
                    if(password_verify($this->paramPOST["password"], $result[0]->password)) {

                        Session::set_User_Connecter($result);
                        if (isset($this->paramPOST["lang"]) && ($this->paramPOST["lang"]!= null)){
                            Session::setAttribut("lang", $this->paramPOST["lang"]);
                        }
                        elseif($result[0]->connect == 1){
                            Utils::setMessageALert(["success",$this->lang['userconnect']]);

                            //Utils::setMessageALert(["success",$this->lang['userchangepass']]);
                            Utils::redirect("utilisateur", "renewPassword");
                        }
                        elseif(intval($result[0]->type_profil) === 1 && $result[0]->etat == 'Activer'){
                            Utils::redirect("utilisateur", "listeAll");
                            Utils::setMessageALert(["success",$this->lang['userconnect']]);
                        }
                        elseif(intval($result[0]->type_profil) === 2 && $result[0]->etat == 'Activer'){
                            Utils::setMessageALert(["success",$this->lang['userconnect']]);
                            Utils::redirect("home", "leClub");
                        }
                        elseif(intval($result[0]->type_profil) === 3 && $result[0]->etat == 'Activer' && $result[0]->confirmation_token == null) {

                            Utils::redirect("home", "leClub");
                            Utils::setMessageALert(["success",$this->lang['userconnect']]);
                        }
                        else{
                            $data['message'] = $this->lang['confirm_abonnement'];
                            $this->views->setData($data);
                            $this->views->getPage('site/login');
                        }

                    }
                    else {
//                        var_dump("ok");die();
                        $data['message'] = $this->lang['wrongpass'];
                        $this->views->setData($data);
                        $this->views->getPage('site/login');
                    }
                }
                else {
                    $data['message'] = $this->lang['user_no_authorized'];
                    $this->views->setData($data);
                    $this->views->getPage('site/login');
                }

            }

        }
        else{
            $data['message'] = $this->lang['userdontexist'];
            $this->views->setData($data);
            $this->views->getPage('site/login');
        }

    }

    public function logout__()
    {
        Session::destroySession();
        //Utils::redirect();
        header('Location: https://www.senegalsejour.com/');

    }

    public function logoutEspace__()
    {
        Session::destroySession();
        Utils::redirect('home','leClub');
    }

    public function menu__(){
        $this->views->initTemplate(["header" => "header", "footer" => "footer", "sidebar" => "sidebar"]);
        $this->views->getTemplate('home/menu');
    }


    public function regenerationPwd()
    {
        $pass = Utils::getGeneratePassword();
        $this->paramPOST['password'] = $pass["crypt"];
        $this->paramPOST['connect'] = 1;
        $param['condition'] = ["email = "=>$this->paramPOST['email']];
        $param['champs'] = [
            "password"=>$this->paramPOST["password"],
            "connect"=>$this->paramPOST["connect"],
            "user_modif"=>$this->_USER->id,
            "date_modif"=>date('Y-m-d H:i:s')
        ];

        $result = $this->model->updateUser($param);

        $param = [
            "condition" => ["email = " => $this->paramPOST['email']]
        ];
        $user = $this->model->getUser($param)[0];

        if ($result !== false) {
            $data = [
                "subject" => $this->lang["reload_pwd1"],
                "email" => $user->email,
                "content" => "template-mail/tpl-user-create",
                "data" => [
                    "nom_client" => $user->prenom . " " . $user->nom,
                    "contenue" => $this->lang["contenu_mail_regenerationPwd_1"].",<br>".$this->lang["contenu_mail_regenerationPwd_2"] ."<a href='" . HOST . RACINE . "'>".
                        $this->lang["lien"]."</a><br>".$this->lang["login"].$this->paramGET[1]."<br>".$this->lang["new_password"].$pass["pass"]

                ]
            ];
            $this->sendMail($data);
            //Utils::setMessageALert(["success", $this->lang["actionsuccess"]]);
        } //else Utils::setMessageALert(["danger", $this->lang["actionechec"]]);
        Utils::redirect("home", "index");
    }

    public function sendEmailToAdmin(){
        $email = $this->paramPOST["email"] ;

        $param = [
            "condition" => ["admin = " => 1]
        ];

        $admins = $this->model->getUser($param) ;
        if ($admins  !== false){
            foreach ($admins as $admin){
                $data = [
                    "subject" => $this->lang["reload_pwd1"],
                    "email" => $admin->email,
                    "content" => "template-mail/tpl-user-create",
                    "data" => [
                        "nom_client" => $admin->prenom . " " . $admin->nom,
                        "contenue" => $this->lang["user"].$email.", <br>". $this->lang["contenu_mail_sendEmailToAdmin_1"] ."<br>". $this->lang["contenu_mail_sendEmailToAdmin_2"]  ."<a href='" . HOST . RACINE . "'>Meczy</a> <br> "
                    ]
                ];
                $this->sendMail($data);
            }
            $message = $this->lang["actionsuccess"];
        }else
            $message = $this->lang["actionechec"];
        Utils::redirect("home", "index",[0 => $message]);


    }

    public function verifie(){
        $donnees = $this->paramPOST ;
        $param['condition'] = [$donnees["champ"]."= "=>$donnees["valeur"]];
        $param['champs'] = ["id"];
        $resultat = count($this->model->getUser($param));

        echo $resultat ;
    }


    public function ajoutMembre__(){

        try{
            if (isset($this->paramPOST['g-recaptcha-response'])) {
                $captcha = $this->paramPOST['g-recaptcha-response'];
            } else {
                $captcha = false;
            }

            if (!$captcha) {
                //Do something with error
                Utils::redirect("home", "register");
            } else {
                $secret   = '6LfYWQoaAAAAAErKvNNHxiavvR2-m9k7lElo2Cx9';
                $response = file_get_contents(
                    "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']
                );
                // use json_decode to extract json response
                $response = json_decode($response);
                if ($response->success === true) {
                    if (Utils::validateMail($this->paramPOST["email"])) {
                        $this->model->beginTransaction() ;

                        $data['nom'] = $this->paramPOST['nom'];
                        $data['prenom'] = $this->paramPOST['prenom'];
                        $data['email'] = $this->paramPOST['email'];
                        $data['telephone'] = $this->paramPOST['telephone'];
                        $data['dateNaissance'] = $this->paramPOST['dateNaissance'];
                        $data['login'] = $this->paramPOST['email'];
                        $data['uiid'] = bin2hex(random_bytes(5));
                        $data['type_profil'] = 3;
                        $data['date_crea'] = date('Y-m-d');
                        $data['password'] =  Utils::getPassCrypt($this->paramPOST['password']);
                        $data['connect'] = 0;
                        $data['confirmation_token'] = Utils::getPassCrypt(substr(md5(microtime()), 0, 16));
                        $data['confirmation_token'] = str_replace('.','',$data['confirmation_token']);
                        $data['confirmation_token'] = str_replace('/','',$data['confirmation_token']);
                        $result = $this->model->insertUser(["champs"=>$data]);
                        if ($result !== false ){
                            try{
                                Utils::envoiConfirmation_v2($this->paramPOST['prenom'] . ' ' . $this->paramPOST['nom'], $this->paramPOST['email'],  $result, $data['confirmation_token']);
                                Utils::envoiConfirmation_inscription($this->paramPOST['prenom'] . ' ' . $this->paramPOST['nom'], EMAIL_CONTACT);
                                $this->model->commit();
                                //$data['message'] = $this->lang['confirm_abonnement'];
                                $data['messageAddMembre'] = $this->lang['inscription_reussie'];
                                $this->views->setData($data);
                                //Utils::redirect("home", "loginpage");
                                Session::destroySession();
                                $this->views->getPage('site/login');



                                //Utils::setMessageALert(["success", $this->lang["inscription_succes"]]);
                            }catch (\Exception $exception){
                                //Utils::setMessageALert(["danger", $this->lang["echec_add_membre"]]);
                                $data['messageEchec'] = $this->lang['echec_add_membre'];
                                $this->views->setData($data);
                                Session::destroySession();
                                $this->views->getPage('site/login');
                                $this->model->rollBack();
                            }

                        }

                        else {
                            //Utils::setMessageALert(["danger", $this->lang["echec_add_membre"]]);
                            $data['message'] = $this->lang['echec_add_membre'];
                            Session::destroySession();
                            $this->views->getPage('site/login');
                            $this->model->rollBack();
                        }

                    } else {
                        // Utils::setMessageALert(["warning", $this->lang["email_invalide"]]);
                        $data['message'] = $this->lang['email_invalide'];
                        Session::destroySession();
                        $this->views->getPage('site/login');
                        $this->model->rollBack();
                    }
                }
                if ($response->success === false) {
                    //Do something with error
                    $data['messageEchecInscription'] = $this->lang['echec_add_membre'];
                    $this->views->setData($data);
                    Session::destroySession();
                    $this->views->initTemplate(["header"=>"header_ep","footer"=>"footer_ep", "sidebar" => "sidebar_site"]);
                    $this->views->getTemplate('site/register');
                }
            }

            if ($response->success==true && $response->score <= 0.5) {
                //Do something to denied access
                $data['autorisation_inscription'] = $this->lang['autorisation_inscription'];
                $this->views->setData($data);
                Session::destroySession();
                $this->views->initTemplate(["header"=>"header_ep","footer"=>"footer_ep", "sidebar" => "sidebar_site"]);
                $this->views->getTemplate('site/register');
            }

        }catch (\Exception $e){
            $this->model->rollBack() ;
            Session::destroySession();
            $this->views->getPage('site/login');
            //Utils::setMessageALert(["danger",$this->lang["actionechec"]." ".$e->getMessage()]);
        }
        //Utils::redirect("home", "loginpage");
    }

    public function confirm(){
        $param = [
            "champs" => ["*"],
            "condition" => ["id = ? AND confirmation_token = ? AND type_profil = ?"],
            "value" => [$this->paramGET[0], $this->paramGET[1], 3]
        ];
        $result = $this->model->getUser($param);
        if($result !== false && count($result) > 0){
            $param_['condition'] = ["id = "=>$this->paramGET[0]];
            $param_['champs'] = ["confirmation_token" => null];
            $this->model->updateUser($param_);
            Session::set_User_Connecter($result);
            Utils::redirect("home", "leClub");
        }else{
            Utils::setMessageALert(["danger", $this->lang["invalide_lien"]]);
            Utils::redirect("home", "loginpage");

            /*$data['message'] = $this->lang['invalide_lien'];
            $this->views->setData($data);
            $this->views->getPage('site/login');*/
        }
    }


    public function receptionMail(){
        $param = [
            "champs" => ["*"],
            "condition" => ["email = ?"],
            "value" => [$this->paramPOST["email"]]
        ];
        $result = $this->model->getUser($param);
        // var_dump($result);die;
        if($result){
            $data = [];
            $email = $this->paramPOST['email'];
            //$newPwd = bin2hex(random_bytes(2));
            $pass = Utils::getGeneratePassword(12);
            $pwd = $pass['pass'];
            $newPwd= $pass["crypt"];
            $recupEmail = $this->model->getEmail($email);
            //var_dump($recupEmail->mail);die;
            $insertPass = $this->model->insertNewPass($email,$newPwd);
            if($insertPass){
                $result = $this->model->set(["table" => "user", "champs" => ["connect"=>1],"condition" => ["email = "=> $email]]);

            }
            $data['messageEnvoye'] = "Un mail contenant un lien vous a été envoyé." ;
            //var_dump($data);die;
            $this->views->setData($data);
            Utils::envoiMailReinitialisation($recupEmail->nom, $recupEmail->mail, $pwd);
            //Utils::redirect("home", "loginpage");
            $this->views->getPage('site/login');
        }else{
            $data['emailNonExistant'] = "Ce email n'existe pas." ;
            $this->views->setData($data);
            $this->views->getPage('site/login');
        }


    }

    public function rejoindreClub(){
        $this->views->initTemplate(["header"=>"header_ep","footer"=>"footer_ep", "sidebar" => "sidebar_site"]);
        $this->views->getTemplate('site/static');
    }
    public function rejoindrePartenaire(){
        $this->views->initTemplate(["header"=>"header_ep","footer"=>"footer_ep", "sidebar" => "sidebar_site"]);
        $this->views->getTemplate('site/partenaire');
    }

}