<?php
/**
 * Created by PhpStorm.
 * User: Seyni FAYE
 * Date: 17/08/2017
 * Time: 11:03
 */

namespace app\core;

use app\common\CommonUtils;

//include "/Users/stagiaire_dev_mob/Documents/stagiareDev/senegalSejour/MAIL/emailTemplate.php";
//include 'MAIL/emailTemplate.php';

class Utils
{

    public static function redirect($controleur = null, $action = "index", array $param = [], $espace = null)
    {
        $url = ($espace === "default") ? RACINE : ((is_null($espace)) ? WEBROOT : RACINE.$espace);
        $action = (is_null($action)) ? "index" : $action;
        if (is_string($controleur)){
            $url .= $controleur . "/" . $action;
            if (count($param) > 0) $url .= "/" . implode('/', self::setBase64_encode_array($param));
        }
        header('Location:' . $url);
    }

    public function getType($type){
        return ($type == 1) ? "numerique" : "alphanumerique" ;
    }

    /**
     *
     */
    public static function sessionStarted()
    {
        if (\php_sapi_name() !== 'cli') {
            if (\version_compare(\phpversion(), '5.4.0', '>=')) {
                if(\session_status() !== PHP_SESSION_ACTIVE) {
                    session_cache_expire(30);
                    session_start();
                }
            } else {
                if(\session_id() === ''){
                    session_cache_expire(30);
                    session_start();
                }
            }
        }else{
            session_cache_expire(30);
            session_start();
        }
    }

    /**
     * @param $model
     * @return mixed
     */
    public static function getModel($model)
    {
        $_USER = (Session::existeAttribut(SESSIONNAME)) ? Session::getAttributArray(SESSIONNAME)[0] : null;
        $model = Prefix_Model . ucfirst($model) . 'Model';
        return new $model($_USER);
    }

    /**
     * @param $controller
     * @param $action
     * @param null $module
     * @param null $sousModule
     * @return bool|mixed
     */
    public static function authorized($controller, $action, $module = null, $sousModule = null)
    {
        return (new Model())->authorized($controller, $action, $module, $sousModule);
    }

    /**
     * @param array $array
     * @return array
     */
    public static function setBase64_encode_array($array)
    {
        foreach ($array as $key => $value){
            if(!\is_array($value)) $array[$key] = base64_encode($value);
            else self::setBase64_encode_array($value);
        }
        return $array;
    }

    /**
     * @param array $array
     * @return array
     */
    public static function setPurgeArray($array)
    {
        if(\is_array($array)){
            foreach ($array as $key => $value){
                if(!\is_array($value))
                    if($value == '' || strlen(trim($value)) == 0)
                        unset($array[$key]);
                    else self::setPurgeArray($value);
            }
            return $array;
        }
    }

    /**
     * @param $valeur
     * @return bool
     */
    public static function isBase64($valeur)
    {
        $decoded_data = base64_decode($valeur, true);
        $encoded_data = base64_encode($decoded_data);
        if ($encoded_data != $valeur) return false;
        else if (!ctype_print($decoded_data)) return false;
        return true;
    }

    /**
     * @param array $array
     * @return array
     */
    public static function setBase64_decode_array($array)
    {
        if(count($array) > 0){
            foreach ($array as $key => $value){
                if(!\is_array($value)) $array[$key] = self::isBase64($value) ? base64_decode($value) : $value;
                else self::setBase64_decode_array($value);
            }
        }
        return $array;
    }

    /**
     * @param int $length
     * @return string
     */
    public static function getAlphaNumerique($length = 10)
    {
        $string = "";
        $chaine = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        \srand((double)\microtime() * 1000000);
        for ($i = 0; $i < $length; $i++) $string .= $chaine[\rand() % \strlen($chaine)];
        return $string;
    }

    /**
     * @param $pass
     * @return bool|null|string
     */
    public static function getPassCrypt($pass)
    {
        $timeTarget = 0.05; // 50 millisecondes
        $cost = 8;
        $passHasher = null;
        do {
            $cost++;
            $start = \microtime(true);
            $passHasher = \password_hash($pass, PASSWORD_BCRYPT, ["cost" => $cost]);
            $end = \microtime(true);
        } while (($end - $start) < $timeTarget);
        return $passHasher;
    }

    /**
     * @param $lenght
     * @return bool|string
     */
    public static function random($lenght = 8) {
        $return = null;
        if (function_exists('openssl_random_pseudo_bytes')) {
            $byteLen = intval(($lenght / 2) + 1);
            $return = substr(bin2hex(openssl_random_pseudo_bytes($byteLen)), 0, $lenght);
        } elseif (@is_readable('/dev/urandom')) {
            $f=fopen('/dev/urandom', 'r');
            $urandom=fread($f, $lenght);
            fclose($f);
        }

        if (is_null($return)) {
            for ($i=0; $i<$lenght; ++$i) {
                if (!isset($urandom)) {
                    if ($i%2==0) {
                        mt_srand(time()%2147 * 1000000 + (double)microtime() * 1000000);
                    }
                    $rand=48+mt_rand()%64;
                } else {
                    $rand=48+ord($urandom[$i])%64;
                }

                if ($rand>57)
                    $rand+=7;
                if ($rand>90)
                    $rand+=6;

                if ($rand==123) $rand=52;
                if ($rand==124) $rand=53;
                $return .= chr($rand);
            }
        }
        return $return;
    }

    /**
     * @param $length
     * @return array
     */
    public static function getGeneratePassword($length = 8)
    {
        // on declare une chaine de caractÃ¨res
        $chaine = "abcdefghijklmnopqrstuvwxyz@ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        //nombre de caractÃ¨res dans le mot de passe
        $pass = "";
        //on fait une boucle
        for ($u = 1; $u <= $length; $u++) {
            //on compte le nombre de caractÃ¨res prÃ©sents dans notre chaine
            $nb = \strlen($chaine);
            // on choisie un nombre au hasard entre 0 et le nombre de caractÃ¨res de la chaine
            $nb = \mt_rand(0, ($nb - 1));
            // on ajoute la lettre a la valeur de $pass
            $pass .= $chaine[$nb];
        }
        // on retourne le rÃ©sultat :
        return ["pass"=>$pass,"crypt"=>self::getPassCrypt($pass)];
    }

    /**
     * @param int $length
     * @return string
     */
    public static function genererReference($length = 8)
    {
        $characts = '0123456789';
        $ref = '';
        for ($i = 0; $i < $length; $i++) {
            $ref .= \substr($characts, \rand() % (\strlen($characts)), 1);
        }
        return $ref;
    }

    /**
     * @return bool
     */
    public static function getSessionStarted()
    {
        if (\php_sapi_name() !== 'cli') {
            if (\version_compare(\phpversion(), '5.4.0', '>=')) {
                return \session_status() === PHP_SESSION_ACTIVE ? true : false;
            } else {
                return \session_id() === '' ? false : true;
            }
        }
        return false;
    }

    /**
     * @return string
     */
    public static function getBrowser()
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'] . "\n\n";
        switch (true) {
            case (\strpos($user_agent, 'Opera') || \strpos($user_agent, 'OPR/')) :
                return 'Opera';
                break;
            case (\strpos($user_agent, 'Edge')) :
                return 'Edge';
                break;
            case (\strpos($user_agent, 'Chrome')) :
                return 'Chrome';
                break;
            case (\strpos($user_agent, 'Safari')) :
                return 'Safari';
                break;
            case (\strpos($user_agent, 'Firefox')) :
                return 'Firefox';
                break;
            case  (\strpos($user_agent, 'MSIE') || \strpos($user_agent, 'Trident/7')) :
                return 'Internet Explorer';
                break;
            default :
                return 'Other';
        }
    }

    /**
     * @return mixed
     */
    public static function getIp()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        return $ip;
    }


    /**
     * @param float $nombre
     * @param null $arg
     * @param int $decimals
     * @return string
     */
    public static function getFormatMoney($nombre = 0.0, $arg = null, $decimals = 0)
    {
        return @\number_format(floatval($nombre), $decimals, ',', ' ') . ' ' . $arg;
    }

    /**
     * @param $date
     * @param bool $heure
     * @return string
     */
    public static function getDateFR($date, $heure = true)
    {
        $tabMois = ["01"=>"Jan","02"=>"Fev","03"=>"Mar","04"=>"Avr","05"=>"Mai","06"=>"Jui","07"=>"Juil","08"=>"Aout","09"=>"Sept","10"=>"Oct","11"=>"Nov","12"=>"Dec"];
        $date    = \explode(" ",$date);
        $heur   = $date[1];
        $date    = \explode("-",$date[0]);
        $date[1] = $tabMois[$date[1]];
        $heur = ($heure) ? $heur : null;
        return (!\is_null($heur)) ? $date[2] . " / " . $date[1] . " / " . $date[0] . " " . $heur : $date[2] . " / " . $date[1] . " / " . $date[0];
    }
    public static function getMoisAnnee($date, $heure = true)
    {
        $date    = \explode(" ",$date);
        $heur   = $date[1];
        $date    = \explode("-",$date[0]);
        return   $date[1] . " / " . $date[0];
    }

    public static function heure_minute_seconde($date)
    {
        $date_fr = '';
        if ($date != '') {
            $ss = substr($date, 17, 2);
            $ii = substr($date, 14, 2);
            $hh = substr($date, 11, 2);

            ///////////////
            $date_fr =  $hh . ':' . $ii . ':' . $ss;
        }
        return $date_fr;
    }

    /**
     * @param bool $with_time default false
     * @return false|string
     */
    public static function getDateNow($with_time = false)
    {
        return ($with_time) ? \gmdate("Y-m-d H:i:s") : \gmdate("Y-m-d");
    }

    /**
     * @param array $interval
     * @param string $dateFrom
     * @return false|string
     */
    public static function getDateFuturFromDate($interval = [1, "mois"], $dateFrom = "now")
    {
        $int = null;
        $number = intval($interval[0]);
        $number = $number == 0 ? 1 : $number;

        switch (strtolower($interval[1])){
            case "seconde"  : $int = "+".$number." Second"; break;
            case "minute"  : $int = "+".$number." Minute"; break;
            case "heure" : $int = "+".$number." Hours"; break;
            case "jour"  : $int = "+".$number." Day"; break;
            case "mois"  : $int = "+".$number." Month"; break;
            case "annee" : $int = "+".$number." Year"; break;
            default      : $int = "+".$number." ".$interval[1]; break;
        }
        return gmdate("Y-m-d H:i:s", strtotime($dateFrom." $int"));
    }

    /**
     * @param $date
     * @return string
     */
    public static function getMonthYearFR($date)
    {
        $tabMois = ["01"=>"Jan","02"=>"Fev","03"=>"Mar","04"=>"Avr","05"=>"Mai","06"=>"Jui","07"=>"Juil","08"=>"Aout","09"=>"Sept","10"=>"Oct","11"=>"Nov","12"=>"Dec"];
        $date    = \explode(" ",$date);
        $date    = \explode("-",$date[0]);
        $date[1] = $tabMois[$date[1]];
        return $date[1] . " / " . $date[0];
    }

    /**
     * @param $date
     * @return string
     */
    public static function getDayMonthFR($date)
    {
        $tabMois = ["01"=>"Jan","02"=>"Fev","03"=>"Mar","04"=>"Avr","05"=>"Mai","06"=>"Jui","07"=>"Juil","08"=>"Aout","09"=>"Sept","10"=>"Oct","11"=>"Nov","12"=>"Dec"];
        $date    = \explode(" ",$date);
        $date    = \explode("-",$date[0]);
        $date[1] = $tabMois[$date[1]];
        return $date[2] . " / " . $date[1];
    }

    /**
     * @param $date
     * @return string
     */
    public static function getDateUS($date)
    {
        $tabMois = ["01"=>"Jan","02"=>"Fev","03"=>"Mar","04"=>"Avr","05"=>"Mai","06"=>"Jui","07"=>"Juil","08"=>"Aout","09"=>"Sept","10"=>"Oct","11"=>"Nov","12"=>"Dec"];
        $date    = \explode(" ",$date);
        $heure   = $date[1];
        $date    = \explode("-",$date[0]);
        $date[1] = $tabMois[$date[1]];
        return (!\is_null($heure)) ? $date[2] . " / " . $date[1] . " / " . $date[0] . " " . $heure : $date[2] . " / " . $date[1] . " / " . $date[0];
    }

    /**
     * @param $car
     * @return string
     */
    public static function getIntegerUnique($car = 6) {
        $string = "";
        $chaine = "0123456789";
        \srand((double)\microtime()*1000000);
        for($i=0; $i<$car; $i++) {
            $string .= $chaine[\rand()%\strlen($chaine)];
        }
        return $string;
    }

    /**
     * @param $car
     * @return string
     */
    public static function getStringUnique($car = 6) {
        $string = "";
        $chaine = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        \srand((double)\microtime()*1000000);
        for($i=0; $i<$car; $i++) {
            $string .= $chaine[\rand()%\strlen($chaine)];
        }
        return $string;
    }

    /**
     * @param array $paramFiles
     * @param string $url
     * @param string $nameFile
     * @return bool
     */
    public static function setUploadFiles($paramFiles = [], $url = "", $nameFile = "")
    {
        if (\count($paramFiles) > 0 && $paramFiles["error"] != "4" && $url != "") {
            if(!self::createDir($url)) return false;
            if($nameFile == "") $nameFile = gmdate("YmdHis");
            $nameFile .= ".".\pathinfo($paramFiles['name'], PATHINFO_EXTENSION);
            return (\move_uploaded_file($paramFiles['tmp_name'], ROOT.$url ."/". $nameFile)) ? $nameFile : false;
        }
        return false;
    }

    /**
     * @param array $paramFiles
     * @param string $url
     * @param string $name
     * @return bool
     */
    public static function setUploadFilesBinaire($paramFiles = [], $url = "", $name = "")
    {
        if (\count($paramFiles) > 0 && $paramFiles["error"] != "4" && $url != "") {
            if ($name == "") $name = Utils::getAlphaNumerique(5);
            if(!self::createDir($url)) return 'Error';
            $fWriteHandle = fopen($url.'/'.$name."." . \pathinfo($paramFiles['name'], PATHINFO_EXTENSION), 'w+');
            $fReadHandle = fopen($paramFiles['tmp_name'], 'rb');
            $fileContent = fread($fReadHandle, $paramFiles['size']);
            $result = fwrite($fWriteHandle, $fileContent);
            fclose($fWriteHandle);
            return ($result === false) ? $result : $name.'.'.\pathinfo($paramFiles['name'], PATHINFO_EXTENSION);
        }
        return false;
    }

    /**
     * @param $path
     * @param $newName
     * @return bool
     */
    public static function setRenameFile($path, $newName)
    {
        $dispath = explode("/",$path);
        if(count($dispath) > 0) {
            self::createDir(ROOT.implode("/",[$dispath[0]]));
            $tempDispath = $dispath;
            $newName .= ".".\pathinfo($tempDispath[count($tempDispath)-1], PATHINFO_EXTENSION);
            unset($tempDispath[count($tempDispath)-1]);
            $newName = implode("/",$tempDispath)."/".$newName;
            return rename(ROOT.$path, ROOT.$newName);
        }
        return false;
    }

    /**
     * @param string $url
     * @return bool
     */
    public static function setDeleteFiles($url = "")
    {
        return ($url != "") ? ((is_file(ROOT.$url)) ? \unlink(ROOT.$url) : true) : false;
    }

    /**
     * @param int $index
     * @param string $sort
     */
    public static function setDefaultSort($index = 0, $sort = "ASC")
    {
        Session::setAttributArray("default_sort",[$index,$sort]);
    }

    /**
     *
     */
    public static function unsetDefaultSort()
    {
        Session::destroyAttributSession("default_sort");
    }

    /**
     * @param string $url
     * @return bool
     */
    public static function createDir($url = "")
    {
        return ($url != "") ? ((!\is_dir(ROOT . $url)) ? \mkdir(ROOT . $url, 0777, true) : chmod(ROOT . $url, 0777)) : false;
    }

    /**
     * @param array $message
     */
    public static function setMessageALert(array $message)
    {
        Session::setAttributArray("MSG_ALERT",["type"=>$message[0],"alert"=>$message[1]]);
    }

    /**
     * @return array
     */
    public static function getMessageALert()
    {
        $msg = Session::getAttributArray("MSG_ALERT");
        return $msg;
    }

    /**
     * @param array $message
     */
    public static function setMessageError(array $message)
    {
        Session::setAttributArray("MSG_ERROR",["type"=>$message[0],"alert"=>$message[1]]);
    }

    /**
     * @return array
     */
    public static function getMessageError()
    {
        $msg = Session::getAttributArray("MSG_ERROR");
        return $msg;
    }

    /**
     * @param $name
     */
    public static function unsetMessage($name)
    {
        Session::destroyAttributSession("MSG_$name");
    }

    /**
     * @param array $droits
     * @return array
     */
    public static function setArrayDroit(array $droits)
    {
        $retour = [];
        foreach ($droits as $item) {
            if(array_key_exists($item->module, $retour)){
                if(array_key_exists($item->sous_module, $retour[$item->module]))   $retour[$item->module][$item->sous_module][] = (isset($item->id_aff)) ? ["id"=>$item->id,"droit"=>$item->droit,"id_aff"=>$item->id_aff,"etat_aff"=>$item->etat_aff] : ["id"=>$item->id,"droit"=>$item->droit];
                else $retour[$item->module][$item->sous_module][] = (isset($item->id_aff)) ? ["id"=>$item->id,"droit"=>$item->droit,"id_aff"=>$item->id_aff,"etat_aff"=>$item->etat_aff] : ["id"=>$item->id,"droit"=>$item->droit];
            }else $retour[$item->module] = [$item->sous_module=>[((isset($item->id_aff)) ? ["id"=>$item->id,"droit"=>$item->droit,"id_aff"=>$item->id_aff,"etat_aff"=>$item->etat_aff] : ["id"=>$item->id,"droit"=>$item->droit])]];
        }
        return $retour;
    }

    /**
     * @param $errtxt
     */
    public static function writeFileLogs($errtxt)
    {
        self::createDir('logs/' . date('Y'). "/" . date('m'). '/' . date('W'));

        $fp = fopen(ROOT . 'logs/' . date('Y') . '/' . date('m') . '/' . date('W') . '/' . date("d_m_Y") . '.txt', 'a+'); // ouvrir le fichier ou le créer
        fseek($fp, SEEK_END); // poser le point de lecture à la fin du fichier
        $nouvel_ligne = $errtxt . "\r\n"; // ajouter un retour à la ligne au fichier
        fputs($fp, $nouvel_ligne); // ecrire ce texte
        fclose($fp); //fermer le fichier
    }

    /**
     * @param $params
     * @return mixed
     */
    public static function validateMail($params)
    {
        return filter_var(filter_var($params, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
    }

    /**
     * @param array $params
     * @return bool
     */
    public static function validateForm(array $params)
    {
        $retour = true;
        foreach ($params as $key => $value){
            if(\is_array($value)) self::validateForm($value);
            else {
                switch (strtolower($key)) {
                    case "email" : if(filter_var(filter_var($value, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL) === false) return false; break;
                    case "prenom" : if((filter_var($value, FILTER_VALIDATE_INT) && self::startsWith($value,"+") && (strlen($value) === 7)) === false) return false; break;
                }
            }
        }
        return $retour;
    }

    /**
     * @param $haystack
     * @param $needle
     * @return bool
     */
    public static function startsWith($haystack, $needle)
    {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }

    /**
     * @param $haystack
     * @param $needle
     * @return bool
     */
    public static function endsWith($haystack, $needle)
    {
        $length = strlen($needle);
        return $length === 0 || (substr($haystack, -$length) === $needle);
    }

    public static function bourrageChaine($caractere,$chaine_a_bourrer,$tailleVoulue,$sensBourrage)
    {
        $boucle = $tailleVoulue - strlen($chaine_a_bourrer);
        while($boucle){
            if($sensBourrage=='gauche')
                $chaine_a_bourrer = $caractere.$chaine_a_bourrer;
            else $chaine_a_bourrer = $chaine_a_bourrer.$caractere;
            $boucle--;
        }
        return $chaine_a_bourrer;
    }

    static function getAddressThroughFileGetContents ($RG_Lat,$RG_Lon) {

        // Create a stream
        $opts = array('http'=>array('header'=>"User-Agent: MyCleverAddressScript 1.0.0\r\n"));
        $context = stream_context_create($opts);

        // Open the file using the HTTP headers set above
        $query = "https://nominatim.openstreetmap.org/reverse?format=json&lat=".$RG_Lat."&lon=".$RG_Lon;

        //Warning: file_get_contents(https://...@acme.com): failed to open stream: Connection timed out in /var/www/sda/4/0/myserver/myscript.php on line 47
        $result = json_decode(@file_get_contents($query, false, $context));
        return $result;
    }


    public static function inputCheckbox($val)
    {

        return "<div style='text-align: center;'><input name='select_all[]' value='".$val."' type='checkbox'></div>";
    }


    public static function getPosition($val)
    {
       // var_dump($val) ;exit;
        //echo $val['_longitude_']." ".$val['_latitude_'] ;
        $r = self::getAddressThroughFileGetContents($val['_latitude_'],$val['_longitude_']) ;
       //var_dump($r) ;
       $adresse = $r->address ;
        //$chaine = utf8_decode(substr($r->display_name, 1, 3));
        $chaine = html_entity_decode($adresse->city.' , '.$adresse->state.' , '.$adresse->country);
        //echo $chaine ;
        //var_dump(utf8_decode($r->display_name));
        return "<div style='text-align: left;'>".$chaine."</div>";
    }



    public static function alignCenter($val)
    {
        return "<div style='text-align: center;'>".$val."</div>";
    }

    public static function alignCenterSuccess($val)
    {
        return "<div  class='text-success' style='text-align: center;'>".$val."</div>";
    }

    public static function alignCenterDanger($val)
    {
        return "<div  class='text-danger' style='text-align: center;'>".$val."</div>";
    }

    public static function alignRightMontant($val)
    {
        return "<div style='text-align: right;'>".Utils::getFormatMoney($val)."</div>";
    }

     public static function alignCenterMontantInfo($val)
     {
            return "<div class='text-info' style='text-align: center;'>".Utils::getFormatMoney($val)."</div>";
     }

     public function afficherLien($data){
         //$nomFichier = "TCCPSL012020.txt"  ;
         $nomFichier = $data['_lien_'] ;
         $lienFichier = '../Fichiers/'.$data['_lien_'] ;

         return "<a href='".$lienFichier."'  target='_blank'>".$nomFichier."<a>";
     }

    public function afficherLienExcel($data){
        //$nomFichier = "TCCPSL012020.txt"  ;
        $nomFichier = $data['_lien_'] ;
        $lienFichier = '../Fichiers/xml/'.$data['_lien_'] ;

        return "<a href='".$lienFichier."'  target='_blank'>".$nomFichier."<a>";
    }

     public function formaterPeriode($periode){
         if (strlen($periode) >= 4){
             $annee =  substr($periode, -4);
             $mois = intval(substr($periode, 0,strlen($periode) - strlen($annee))) ;
             $tabMois = ["1"=>"Jan","2"=>"Fév","3"=>"Mar","4"=>"Avr","5"=>"Mai","6"=>"Jui","7"=>"Juil","8"=>"Aout","9"=>"Sept","10"=>"Oct","11"=>"Nov","12"=>"Dec"];
             return   "<div style='text-align: center;'>".$moisEnLettre = $tabMois[$mois]." ".$annee."</div>";
         }

         return "";
     }

    public static function moisAnnee($periode){
        if (strlen($periode) >= 4){
            $annee =  substr($periode, -4);
            $mois = intval(substr($periode, 0,strlen($periode) - strlen($annee))) ;
            return   array('mois'=>$mois, 'annee'=>$annee);
        }

        return null;
    }



    use CommonUtils;

    public static function envoiparametre($destinataire, $email, $login, $password)
    {
        $sujet = "Les identifiants de votre espace";

        $message = '<html>
                    <head>
                        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
                        <link rel="stylesheet" href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/bootstrap/css/bootstrap.min.css">
                        <link href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/header/header1.css" rel="stylesheet">
                        <link id="color_scheme" href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/theme.css" rel="stylesheet">
                        <link href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/responsive.css" rel="stylesheet">
                        <link href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/style.css" rel="stylesheet" type="text/css">
                        <link href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/inscription.css" rel="stylesheet" type="text/css">
                        <link href="https://fonts.googleapis.com/css?family=Poppins:600,700,800&display=swap" rel="stylesheet">
	                    <link href="https://fonts.googleapis.com/css?family=Libre+Franklin:400,500,600,700,800&display=swap" rel="stylesheet">
                    </head>
                    <body class="common-home res layout-1">
                        <div id="wrapper" class="wrapper-fluid banners-effect-10" style="background-image: url(\'https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/tissu3.png\');">

                            <!-- Main Container  -->
                            <div id="content" style="margin-bottom: 0;">
                                <div class="so-page-builder">
                                    <section class="section-style1" style="padding: 90px 0px 200px 0px;">
                                        <div id="container-custom" class="container page-builder-ltr" style="width: 55%;">
                                            <div class="row row-style row_a1">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_a1c" style="background: #fff;opacity: 0.95;text-align: center;padding: 20px 40px;font-family:coveslight; font-size: 18px;">
                                                    <h3>
                                                        <span>
                                                            <span class="hi" style="font-size: 3em; text-shadow: rgba(0, 0, 0, 0.4) 0px 4px 5px; color : rgb(149, 123, 95) !important; font-family: \'lulo_cleanoutline_bold\';">
                                                                BIENVENUE!
                                                            </span>
                                                        </span>
                                                    </h3> <br>
                                                      <p> Bonjour  '.$destinataire.', </p><br>
                                                    <p> Nous avons bien créé votre espace sur notre plateforme.</p>
                                                    <p> Ci-dessous vos identifiants de connexion pour acceder à votre espace, merci de cliquer sur le lien suivant:</p><br>
                                                    <p>Login: <span style="color: #0b0b0b;">'.$login.'</span></p>
								                    <p>Mot de passe : <span style="color: #0b0b0b;">'.$password.'</span></p>
                                                    <p> Merci de cliquer sur le lien suivant pour vous connecter:</p><br>
                                                    <p><a href="https://virtualtoursenegalsejour.com/senegalsejour/home/loginpage" target="_blank" style="color: #c7a47e;text-decoration: underline;">Accéder à mon espace</a></p><br>
                                                    <p style="color: #000"> </p><br>
                                                    <p style="color: #000"> Merci pour l\'intérêt que vous portez à notre site !</p>
                                                    <p style="color: #000">Si vous n\'avez pas fait de demande d\'inscription sur notre site, vous pouvez ignorer ce mail . </p>
                                                    <p style="color: #000">suivez nous sur nos pages réseaux</p>
                                                    <a href="https://www.facebook.com/Senegal-Sejour-108086863902137/" title="Facebook"><img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/icon/fcbk.png" alt=""></a>
                                                    <a href="#" title="Pinterest"><img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/icon/pinterest.png" alt=""></a>
                                                    <a href="https://www.instagram.com/senegal_sejour/?hl=fr" title="Instagram"><img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/icon/instagram.png" alt=""></a>	
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                            <!-- //Main Container -->
                        </div>
                    </body>
                    </html>';
        /** Envoi du mail **/
        $entete = "Content-type: text/html; charset=utf8\r\n";
        $entete .= " MIME-Version: 1.0\r\n";
        $entete .= "To: $destinataire<".$email."> \r\n";
        $entete .= "From:SenegalSejour<no-reply@senegalsejour.sn>\r\n";
        @mail($email, $sujet, $message, $entete);
    }

    public static function envoiMail($destinataire, $email, $login, $password)
    {
        $sujet = "Creation d'un compte d'acces utilisateur"; //Sujet du mail

        $message = '<html>
                    <head>
                        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
                        <link rel="stylesheet" href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/bootstrap/css/bootstrap.min.css">
                        <link href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/header/header1.css" rel="stylesheet">
                        <link id="color_scheme" href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/theme.css" rel="stylesheet">
                        <link href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/responsive.css" rel="stylesheet">
                        <link href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/style.css" rel="stylesheet" type="text/css">
                        <link href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/inscription.css" rel="stylesheet" type="text/css">
                        <link href="https://fonts.googleapis.com/css?family=Poppins:600,700,800&display=swap" rel="stylesheet">
	                    <link href="https://fonts.googleapis.com/css?family=Libre+Franklin:400,500,600,700,800&display=swap" rel="stylesheet">
                    </head>
                    <body class="common-home res layout-1">
                        <div id="wrapper" class="wrapper-fluid banners-effect-10" style="background-image: url(\'https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/tissu3.png\');">

                            <!-- Main Container  -->
                            <div id="content" style="margin-bottom: 0;">
                                <div class="so-page-builder">
                                    <section class="section-style1" style="padding: 90px 0px 200px 0px;">
                                        <div id="container-custom" class="container page-builder-ltr" style="width: 55%;">
                                            <div class="row row-style row_a1">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_a1c" style="background: #fff;opacity: 0.95;text-align: center;padding: 20px 40px;font-family:coveslight; font-size: 18px;">
                                                    <h3>
                                                        <span>
                                                            <span class="hi" style="font-size: 3em; text-shadow: rgba(0, 0, 0, 0.4) 0px 4px 5px; color : rgb(149, 123, 95) !important; font-family: \'lulo_cleanoutline_bold\';">
                                                                BIENVENUE!
                                                            </span>
                                                        </span>
                                                    </h3> <br>
                                                      <p> Bonjour  '.$destinataire.', </p><br>
                                                    <p> Nous avons bien créé votre espace sur notre plateforme.</p>
                                                    <p> Ci-dessous vos identifiants de connexion pour acceder à votre espace:</p><br>
                                                    <p>Login: <span style="color: #0b0b0b;">'.$login.'</span></p>
								                    <p>Mot de passe : <span style="color: #0b0b0b;">'.$password.'</span></p>
                                                    <p> Merci de cliquer sur le lien suivant pour vous connecter:</p><br>
                                                    <p><a href="https://virtualtoursenegalsejour.com/senegalsejour/home/loginpage" target="_blank" style="color: #c7a47e;text-decoration: underline;">Accéder à mon espace</a></p><br>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                            <!-- //Main Container -->
                        </div>
                    </body>
                    </html>';

        /** Envoi du mail **/
        $entete = "Content-type: text/html; charset=utf8\r\n";
        $entete .= " MIME-Version: 1.0\r\n";
        $entete .= "To: $destinataire<".$email."> \r\n";
        $entete .= "From:SenegalSejour<no-reply@senegalsejour.sn>\r\n";
        @mail($email, $sujet, $message, $entete);

    }

    public static function envoiMail_v1($destinataire, $email, $login, $password)
    {
        $sujet = "Les identifiants de votre espace"; //Sujet du mail

        $message = '<html>
                    <head>
                        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
                        <link rel="stylesheet" href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/bootstrap/css/bootstrap.min.css">
                        <link href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/header/header1.css" rel="stylesheet">
                        <link id="color_scheme" href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/theme.css" rel="stylesheet">
                        <link href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/responsive.css" rel="stylesheet">
                        <link href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/style.css" rel="stylesheet" type="text/css">
                        <link href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/inscription.css" rel="stylesheet" type="text/css">
                        <link href="https://fonts.googleapis.com/css?family=Poppins:600,700,800&display=swap" rel="stylesheet">
	                    <link href="https://fonts.googleapis.com/css?family=Libre+Franklin:400,500,600,700,800&display=swap" rel="stylesheet">
                    </head>
                    <body class="common-home res layout-1">
                        <div id="wrapper" class="wrapper-fluid banners-effect-10" style="background-image: url(\'https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/tissu3.png\');">

                            <!-- Main Container  -->
                            <div id="content" style="margin-bottom: 0;">
                                <div class="so-page-builder">
                                    <section class="section-style1" style="padding: 90px 0px 200px 0px;">
                                        <div id="container-custom" class="container page-builder-ltr" style="width: 55%;">
                                            <div class="row row-style row_a1">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_a1c" style="background: #fff;opacity: 0.95;text-align: center;padding: 20px 40px;font-family:coveslight; font-size: 18px;">
                                                    <h3>
                                                        <span>
                                                            <span class="hi" style="font-size: 3em; text-shadow: rgba(0, 0, 0, 0.4) 0px 4px 5px; color : rgb(149, 123, 95) !important; font-family: \'lulo_cleanoutline_bold\';">
                                                                BIENVENUE!
                                                            </span>
                                                        </span>
                                                    </h3> <br>
                                                      <p> Bonjour  '.$destinataire.', </p><br>
                                                    <p> Nous avons bien créé votre espace sur notre plateforme.</p>
                                                    <p> Ci-dessous vos identifiants de connexion pour acceder à votre espace:</p><br>
                                                    <p>Login: <span style="color: #0b0b0b;">'.$login.'</span></p>
								                    <p>Mot de passe : <span style="color: #0b0b0b;">'.$password.'</span></p>
                                                    <p> Merci de cliquer sur le lien suivant pour vous connecter:</p><br>
                                                    <p><a href="https://virtualtoursenegalsejour.com/senegalsejour/home/loginpage" target="_blank" style="color: #c7a47e;text-decoration: underline;">Accéder à mon espace</a></p><br>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                            <!-- //Main Container -->
                        </div>
                    </body>
                    </html>';

        /** Envoi du mail **/
        $entete = "Content-type: text/html; charset=utf8\r\n";
        $entete .= " MIME-Version: 1.0\r\n";
        $entete .= "To: $destinataire<".$email."> \r\n";
        $entete .= "From:SenegalSejour<no-reply@senegalsejour.sn>\r\n";
        @mail($email, $sujet, $message, $entete);

    }

    public static function envoiMailRegeneration($destinataire, $email, $login, $password)
    {
        $sujet = "Regeneration de votre mot de passe"; //Sujet du mail

        $message = '<html>
                    <head>
                        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
                        <link rel="stylesheet" href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/bootstrap/css/bootstrap.min.css">
                        <link href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/header/header1.css" rel="stylesheet">
                        <link id="color_scheme" href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/theme.css" rel="stylesheet">
                        <link href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/responsive.css" rel="stylesheet">
                        <link href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/style.css" rel="stylesheet" type="text/css">
                        <link href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/inscription.css" rel="stylesheet" type="text/css">
                        <link href="https://fonts.googleapis.com/css?family=Poppins:600,700,800&display=swap" rel="stylesheet">
	                    <link href="https://fonts.googleapis.com/css?family=Libre+Franklin:400,500,600,700,800&display=swap" rel="stylesheet">
                    </head>
                    <body class="common-home res layout-1">
                        <div id="wrapper" class="wrapper-fluid banners-effect-10" style="background-image: url(\'https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/tissu3.png\');">

                            <!-- Main Container  -->
                            <div id="content" style="margin-bottom: 0;">
                                <div class="so-page-builder">
                                    <section class="section-style1" style="padding: 90px 0px 200px 0px;">
                                        <div id="container-custom" class="container page-builder-ltr" style="width: 55%;">
                                            <div class="row row-style row_a1">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_a1c" style="background: #fff;opacity: 0.95;text-align: center;padding: 20px 40px;font-family:coveslight; font-size: 18px;">
                                                    <p> Bonjour  '.$destinataire.', </p><br>
                                                    <p> Votre mot de passe a ete bien regénéré.</p>
                                                    <p> Ci-dessous vos identifiants de connexion pour acceder à votre espace.</p><br>
                                                    <p>Login: <span style="color: #0b0b0b;">'.$login.'</span></p>
								                    <p>Mot de passe : <span style="color: #0b0b0b;">'.$password.'</span></p>
                                                    <p> Merci de cliquer sur le lien suivant pour vous connecter:</p><br>
                                                    <p><a href="https://virtualtoursenegalsejour.com/senegalsejour/home/loginpage" target="_blank" style="color: #c7a47e;text-decoration: underline;">Accéder à mon espace</a></p><br>
                                                    <p style="color: #000"> </p><br>
                                                    <p style="color: #000"> Merci pour l\'intérêt que vous portez à notre site !</p>
                                                    <p style="color: #000">Si vous n\'avez pas fait de demande d\'inscription sur notre site, vous pouvez ignorer ce mail . </p>
                                                    <p style="color: #000">suivez nous sur nos pages réseaux</p>
                                                    <a href="https://www.facebook.com/Senegal-Sejour-108086863902137/" title="Facebook"><img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/icon/fcbk.png" alt=""></a>
                                                    <a href="#" title="Pinterest"><img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/icon/pinterest.png" alt=""></a>
                                                    <a href="https://www.instagram.com/senegal_sejour/?hl=fr" title="Instagram"><img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/icon/instagram.png" alt=""></a>	
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                            <!-- //Main Container -->
                        </div>
                    </body>
                    </html>';

        /** Envoi du mail **/
        $entete = "Content-type: text/html; charset=utf8\r\n";
        $entete .= " MIME-Version: 1.0\r\n";
        $entete .= "To: $destinataire<".$email."> \r\n";
        $entete .= "From:SenegalSejour<no-reply@senegalsejour.sn>\r\n";
        @mail($email, $sujet, $message, $entete);

    }


    public static function envoiQrCode($destinataire, $email, $type ,$libelle,$corps, $titre1,$labels , $texts, $titre2,$back_color ,$qrcode, $code, $date_debut, $date_fin)
    {
        $sujet = "Souscription au ".$libelle; //Sujet du mail

        $message = '<html>
                    <head>
                        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
                        <link rel="stylesheet" href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/bootstrap/css/bootstrap.min.css">
                        <link href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/header/header1.css" rel="stylesheet">
                        <link id="color_scheme" href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/theme.css" rel="stylesheet">
                        <link href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/responsive.css" rel="stylesheet">
                        <link href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/style.css" rel="stylesheet" type="text/css">
                        <link href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/style_verification.css" rel="stylesheet" type="text/css">
                        <link href="https://fonts.googleapis.com/css?family=Poppins:600,700,800&display=swap" rel="stylesheet">
	                    <link href="https://fonts.googleapis.com/css?family=Libre+Franklin:400,500,600,700,800&display=swap" rel="stylesheet">
                    </head>
                    <body class="common-home res layout-1">
                        <div id="wrapper" class="wrapper-fluid banners-effect-10"  style="background-image: url(\'https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/tissu3.png\');">

                            <!-- Main Container  -->
                            <div id="content" style="margin-bottom: 0;">
                                <div class="so-page-builder">
                                    <section class="section-style1" style="padding: 90px 0px 200px 0px;">
                                        <div id="container-custom" class="container-fluid page-builder-ltr">
                                        <div class="row">
                                            <div class="col-lg-1 col-md-1 col-sm-1"></div>
                                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                                <div class="how-section1" style="background: #fff;opacity: 0.95;padding: 35px;">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h3 class="tia">
                                                                <span id="title-mail"  style="font-family:lulo_cleanoutline_bold;font-size: 41px;color: #C6A47E;">FÉLICITATIONS</span>
                                                            </h3>
                                                        </div>
                                                    </div>
                                                    <div class="row" style="margin-top: 40px;margin-bottom: 20px;">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="col-lg-8 col-md-8 col-xs-12  text-muted" style="font-size: 18px;color: #000;text-align: center;margin: 0 0 25px;font-family: coveslight">
                                                                <p> Bonjour  '.$destinataire.' , </p><br>
                                                                <p>Votre achat de votre formule  <bold>'.$libelle.'</bold> a été enregistré avec succès!</p>
                                                                <p>Retrouvez désormais sur votre page personnelle  toutes les informations <br> concernant votre formule en cours :</p>
                                                                <ul style="font-weight: bold !important;">
                                                                    <li>
                                                                        <p>Historique de vos utilisations et de vos passages chez nos partenaires</p>
                                                                    </li>
                                                                    <li>
                                                                        <p>Récapitulatif de vos anciennes souscriptions et votre formule en cours </p>
                                                                    </li>
                                                                    <li>
                                                                        <p>Affichage de votre '.$libelle.'  avec QR Code à présenter aux <br> partenaires pour bénéficier de vos avantages</p>
                                                                    </li>
                                                                </ul>
                                                                <div class="how-section1" style="background:#c7a47e;padding: 10px; border-radius: 15px;">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/HCO.png" class="img-responsive" alt="" style="height: 120px; border-radius: 50%;" />
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <p class="text-muted" style="font-size: 17px;color: #000;text-align: center;margin: 0 0 25px;">
                                                                            Astuce : faites une capture d\'écran sur votre smartphone de l\'affichage de votre '.$libelle.' pour pouvoir afficher votre QR code personnel même en étant hors connexion  !
                                                                            </p>
                                                                        </div>							
                                                
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-xs-12" >
                                                                <div id="pass" style="font-size: 17px;text-align: center;margin: 0 0 25px;font-family: coveslight; background-color:'.$corps.';">
                                                                    <h4 class="tia" style="font-family:lulo_cleanoutline_bold;font-size: 16px; color: '.$titre1.'; padding-top: 17px;">
                                                                        <span>'.$type.'</span>
                                                                    </h4><br>
                                                                    <img src="'.$qrcode.'" class="img-responsive" alt="" style="height: 8em; margin-bottom: 8px;margin-top: -22px;" />
                                                                    <div id="corps-text" style="font-family:coveslight; font-size: 1.5vw;">
                                                                        <div class="container-fluid">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <span style="margin-bottom: 0px !important ;color:'.$labels.';">Prénom-Nom</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <span style="margin-bottom: 0px !important ;color: '.$texts.';">'.$destinataire.'</span>
                                                                                </div>
                                                                            </div>
                        
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <span style="margin-bottom: 0px !important ;color: '.$labels.';">Numéro de carte</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <span style="margin-bottom: 0px !important ;color: '.$texts.';">'.$code.'</span>
                                                                                </div>
                                                                            </div>
                        
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <span style="margin-bottom: 0px !important ;color: '.$labels.';">Date de création</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <span style="margin-bottom: 0px !important ;color: '.$texts.';">'.self::getDateFR($date_debut).'</span>
                                                                                </div>
                                                                            </div>
                        
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <span style="margin-bottom: 0px !important ;color: '.$labels.';">Date d\'expiration</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <span style="margin-bottom: 0px !important ;color: '.$texts.';">'.self::getDateFR($date_fin).'</span>
                                                                                </div>
                                                                            </div>
                        
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <h4 class="tia" style="font-family:lulo_cleanoutline_bold;font-size: 20px;color: '.$titre2.'; background-color: '.$back_color.'; margin-bottom: 0px;">'.$libelle.'</h4>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12" style="height: 90px;">
                                                                            <img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/logo_tissu.png" class="img-responsive" alt="" style="height: 100%; width: 100%;" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_a1c about-text">
                                                            <h4 id="titre2" class="tia" style="font-family:lulo_clean_outline_bold;font-size: 4vw;color: #C6A47E;"><span>POUR BÉNÉFICIER DE VOS REMISES</span></h4><br>
                                                        </div>
                                                    </div>
                                                    <div id="remise" class="row" style="font-size: 1.5vw;color: #FFF;text-align: center;margin: 0 0 25px;font-family: coveslight; background-color:initial;"> 
                                                        <div class="col-md-4 col-sm-12 col-xs-12 maxcol " style="margin-top: 10px;">
                                                            <div class="card maxcard maxcard-custom" style="background-color: #6CA9A6;height: 590px;">
                                                                <img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/card_1.svg" alt="">
                                                                <div class="card-text-custom">
                                                                    <br>
                                                                    <h5 class="card-title">RDV chez un Partenaire</h5>
                                                                    <p>Identifiez nos partenaires facilement sur le site ou à l\'aide du logo Sénégal séjour présent sur les lieux​​</p>
                                                                    <hr>
                                                                    <p>Présentez votre carte nominative sur votre smartphone au moment de régler</p>
                                                                    <hr>
                                                                    <p>Présentez votre mail d\'inscription si vous  n\'avez pas de smartphone</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-12 col-xs-12 maxcol"  style="margin-top: 10px;">
                                                            <div class="card mb-4 maxcard maxcard-custom" style="background-color: #6CA9A6;height: 590px;">
                                                                <img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/card_2.svg" alt="">
                                                                <div class="card-text-custom">
                                                                    <br>
                                                                    <h5 class="card-title">Validation </h5>
                                                                    <p>Le partenaire dans son espace dédié sur notre site va vérifier la validité de votre carte ou PASS</p>
                                                                    <hr>
                                                                    <p>Une fois la vérification effectuée, il lui suffit de saisir avec vous le montant de la facture que vous deviez régler</p>
                                                                    <hr>
                                                                    <p>Vous aurez instantanément l’affichage de la somme que vous devrez payer après déduction automatique de l’avantage enregistré dans notre base partenaire </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4  col-sm-12 col-xs-12  maxcol"  style="margin-top: 10px;">
                                                            <div class="card mb-4 maxcard maxcard-custom"  style="background-color: #6CA9A6;height: 590px;">
                                                                <img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/card_3.svg" alt="">
                                                                <div class="card-text-custom">
                                                                    <br>
                                                                    <h5 class="card-title">Enregistrement</h5>
                                                                    <p>En validant la transaction, nous l’enregistrons automatiquement sur votre profil de membre et aussi celui du Partenaire. </p>
                                                                    <hr>
                                                                    <p>Vous avez ainsi une totale visibilité sur les économies réalisées grâce à l’achat de votre carte</p>
                                                                    <hr>
                                                                    <p>Vos points de fidélité sont automatiquement enregistrés en fonction du montant dépensé que vous pourrez retrouver dans votre profil de membre </p><br>
                                                                </div>
                                                            </div>
                                                        </div>
                
                                                    </div>
                                                    <div class="how-section1">
                                                        <div class="row text-muted" style="font-size: 18px;color: #000;text-align: center;margin: 0 0 25px; font-family: coveslight;">
                                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                                <p> N\'hésitez pas à nous contacter pour vous aider dans l\'utilisation de votre '.$libelle.'</p>
                                                            </div>
                                                            <div id="rsx-social" class="col-md-6 col-sm-12 col-xs-12 text-right">
                                                                <p>abonnez vous à nos pages</p>
                                                                <div style="padding-right: 28px;">
                                                                    <a href="https://www.facebook.com/Senegal-Sejour-108086863902137/" title="Facebook"><img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/icon/fcbk.png" alt=""></a>
                                                                    <a href="#" title="Pinterest"><img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/icon/pinterest.png" alt=""></a>
                                                                    <a href="https://www.instagram.com/senegal_sejour/?hl=fr" title="Instagram"><img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/icon/instagram.png" alt=""></a>
                                                                </div>
                                                            </div>					
                                                        </div>		
                                                    </div>
                                                    <div class="row row-style row_a1">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_a1c" style="font-size: 18px;color: #000;text-align: center;margin: 0 0 25px; font-family: coveslight; ">
                                                                <span>Avis de sécurité important : Senegalsejour ne vous demandera jamais votre mot de passe ou d\'autres informations sensibles par e-mail. Ne cliquez pas sur des liens et ne répondez pas aux e-mails suspects! </span><br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-sm-1"></div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                            <!-- //Main Container -->
                        </div>
                    </body>
                    </html>';

        /** Envoi du mail **/
        $entete = "Content-type: text/html; charset=utf8\r\n";
        $entete .= " MIME-Version: 1.0\r\n";
        $entete .= "To: $destinataire<".$email."> \r\n";
        $entete .= "From:SenegalSejour<no-reply@senegalsejour.sn>\r\n";
        @mail($email, $sujet, $message, $entete);

    }

    public static function envoiConfirmation_($destinataire, $email,$id,$token)
    {
        $sujet = "Confirmer mon inscription";

        $message = '<html>
                    <head>
                        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
                        <link rel="stylesheet" href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/bootstrap/css/bootstrap.min.css">
                        <link href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/header/header1.css" rel="stylesheet">
                        <link id="color_scheme" href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/theme.css" rel="stylesheet">
                        <link href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/responsive.css" rel="stylesheet">
                        <link href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/style.css" rel="stylesheet" type="text/css">
                        <link href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/inscription.css" rel="stylesheet" type="text/css">
                        <link href="https://fonts.googleapis.com/css?family=Poppins:600,700,800&display=swap" rel="stylesheet">
	                    <link href="https://fonts.googleapis.com/css?family=Libre+Franklin:400,500,600,700,800&display=swap" rel="stylesheet">
                    </head>
                    <body class="common-home res layout-1">
                        <div id="wrapper" class="wrapper-fluid banners-effect-10" style="background-image: url(\'https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/tissu3.png\');">

                            <!-- Main Container  -->
                            <div id="content" style="margin-bottom: 0;">
                                <div class="so-page-builder">
                                    <section class="section-style1" style="padding: 90px 0px 200px 0px;">
                                        <div id="container-custom" class="container page-builder-ltr" style="width: 55%;">
                                            <div class="row row-style row_a1">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_a1c" style="background: #fff;opacity: 0.95;text-align: center;padding: 20px 40px;font-family:coveslight; font-size: 18px;">
                                                    <h3>
                                                        <span>
                                                            <span class="hi" style="font-size: 3em; text-shadow: rgba(0, 0, 0, 0.4) 0px 4px 5px; color : rgb(149, 123, 95) !important; font-family: \'lulo_cleanoutline_bold\';">
                                                                BIENVENUE!
                                                            </span>
                                                        </span>
                                                    </h3> <br>
                                                      <p> Bonjour  '.$destinataire.', </p><br>
                                                    <p> Nous avons bien enregistré votre demande d\'inscription sur notre site.</p>
                                                    <p>Pour confirmer la création de votre profil, merci de cliquer sur le lien suivant:</p><br>
                                                    <p><a href="https://virtualtoursenegalsejour.com/senegalsejour/home/confirm/'.base64_encode($id).'/'.$token.'" style="color: #c7a47e;text-decoration: underline;">Confirmer mon inscription</a></p><br>
                                                    <p> Vous allez accéder à votre page personnelle pour confirmer votre adresse mail de contact et  modifier vos informations et mot de passe.</p>
                                                    
                                                    <div class="how-section1" style="background:#c7a47e;padding: 10px; border-radius: 15px;">
                                                            <div class="row">
                                                                <div class="col-md-4 col-sm-12">
                                                                    <img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/HCO.png" class="img-responsive" alt="" style="height: 200px; border-radius: 50%;" />
                                                                </div>
                                                                <div class="col-md-8 col-sm-12">
                                                                    <h4 class="tia text-photo" style="color: #000;text-transform: uppercase;">Envie de faire le plein d\'avantages ?</h4><br>
                                                                    <p class="text-muted" style="font-size: 17px;color: #000;text-align: center;margin: 0 0 25px;">
                                                                        Nous vous invitons à visiter notre rubrique CLUB pour découvrir nos formules de PASS et CARTE de Membre  et bénéficier  <b>jusqu\'à - 50 % de remise en illimité </b> sur vos dépenses chez nos partenaires du CLUB Sénégal séjour
                                                                    </p>
                                                                </div>							
                                                            </div>					
                                                        </div>
                                                            <p style="color: #000"> </p><br>
                                                            <p style="color: #000"> Merci pour l\'intérêt que vous portez à notre site !</p>
                                                            <p style="color: #000">Si vous n\'avez pas fait de demande d\'inscription sur notre site, vous pouvez ignorer ce mail . </p>
                                                            <p style="color: #000">suivez nous sur nos pages réseaux</p>
                                                            <a href="https://www.facebook.com/Senegal-Sejour-108086863902137/" title="Facebook"><img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/icon/fcbk.png" alt=""></a>
                                                            <a href="#" title="Pinterest"><img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/icon/pinterest.png" alt=""></a>
                                                            <a href="https://www.instagram.com/senegal_sejour/?hl=fr" title="Instagram"><img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/icon/instagram.png" alt=""></a>	
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                            <!-- //Main Container -->
                        </div>
                    </body>
                    </html>';
        /** Envoi du mail **/
        $entete = "Content-type: text/html; charset=utf8\r\n";
        $entete .= " MIME-Version: 1.0\r\n";
        $entete .= "To: $destinataire<".$email."> \r\n";
        $entete .= "From:SenegalSejour<no-reply@senegalsejour.sn>\r\n";
        @mail($email, $sujet, $message, $entete);
    }

    public static function envoiConfirmation_v2($destinataire, $email,$id,$token)
    {
        $sujet = "Confirmer mon inscription";

        $message = '<html>
                    <head>
                        <link href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/style.css" rel="stylesheet" type="text/css">
                        <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400&display=swap" rel="stylesheet">
                    </head>
                    <body>
                    <div style="background-image: url(\'https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/tissu_ci_biir_.jpg\');">
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <table width="80%" align="center" bgcolor="#FFF">
                          <tbody>
                            <tr>
                              <th height="132" align="center" valign="top" scope="col"><table width="100%" cellspacing="10">
                                <tbody>
                                  <tr>
                                    <th align="center" valign="middle" scope="col"><h3 class="titreinscription">BIENVENUE!</h3></th>
                                  </tr>
                                  <tr>
                                    <td align="center" valign="middle" class="textblackpetit2">Bonjour '.$destinataire.', </td>
                                  </tr>
                                  <tr>
                                    <td height="78" align="center" valign="middle"><p class="textblackpetit2">Nous avons bien enregistré votre demande d\'inscription sur notre site .<br>
                                    Pour confirmer la création de votre profil, merci de cliquer sur le lien suivant :</p></td>
                                              </tr>
                                              <tr>
                                                <td align="center" valign="middle" class="textmarronpetit2"><a href="https://virtualtoursenegalsejour.com/senegalsejour/home/confirm/'.base64_encode($id).'/'.$token.'" target="_blank">Confirmer mon inscription</a></td>
                                              </tr>
                                              <tr>
                                                <td height="29" align="center" valign="middle" class="textblackpetit2">Vous allez accéder à votre page personnelle pour confirmer votre adresse mail de contact et modifier vos informations et mot de passe
                                        </td>
                                              </tr>
                                              <tr>
                                                <td height="214" align="center" valign="middle" bgcolor="#c6a47e"><table width="100%" cellspacing="0">
                                                  <tbody>
                                                    <tr>
                                                      <th scope="col" width="20%"><img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/costume_rouge.jpg" width="350" alt=""/></th>
                                                      <th width="80%" align="center" valign="top" scope="col"><p><br>
                                                          <span class="titreinscription2">Envie de faire le plein d\'avantages ?</span></p>
                                                        <p class="textblackpetit2">Nous vous invitons à visiter notre rubrique CLUB pour découvrir nos formules de PASS et CARTE de Membre et bénéficier jusqu\'à - 50 % de remise en illimité sur vos dépenses chez nos partenaires du CLUB Sénégal séjour</p></th>
                                                    </tr>
                                                  </tbody>
                                                </table></td>
                                              </tr>
                                              <tr>
                                                <td align="center" valign="middle"><div data-packed="true" data-vertical-text="false" id="comp-kffo3mik2">
                                                  <p class="textblackpetit2">Merci pour l\'intérêt que vous portez à notre site !</p>
                                                  <p class="textblackpetit2">Si vous n\'avez pas fait de demande d\'inscription sur notre site, vous pouvez ignorer ce mail .</p>
                                                </div>
                                                  <div data-packed="true" data-vertical-text="false" id="comp-kffo3mio">
                                                    <p class="textblackpetit2">suivez nous sur nos pages réseaux</p>
                                                  </div></td>
                                              </tr>
                                              <tr>
                                                <td height="70" align="center" valign="middle"><table width="30%" align="center">
                                                  <tbody>
                                                    <tr>
                                                      <th align="center" valign="middle" scope="col"><a href="https://www.facebook.com/Senegal-Sejour-108086863902137/"><img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/ce6ec7c11b174c0581e20f42bb865ce3.jpg" width="39" height="39" alt=""/></a></th>
                                                      <th align="center" valign="middle" scope="col"><a href="#"><img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/2891096df79f43829b310ad815d42011.jpg" width="39" height="39" alt=""/></a></th>
                                                      <th align="center" valign="middle" scope="col"><a href="https://www.instagram.com/senegal_sejour/?hl=fr"><img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/fdcfaba150fc427da298a00cb09d91c1_(1).jpg" width="39" height="39" alt=""/></a></th>
                                                    </tr>
                                                  </tbody>
                                                </table></td>
                                              </tr>
                                            </tbody>
                                          </table></th>
                                        </tr>
                                      </tbody>
                                    </table>
                        <p>&nbsp;</p>
                    </div>
                    </body>
                    </html>';
        /** Envoi du mail **/
        $entete = "Content-type: text/html; charset=utf8\r\n";
        $entete .= " MIME-Version: 1.0\r\n";
        $entete .= "To: $destinataire<".$email."> \r\n";
        $entete .= "From:SenegalSejour<no-reply@senegalsejour.sn>\r\n";
        @mail($email, $sujet, $message, $entete);
    }
    public static function envoiConfirmation_inscription($destinataire, $email)
    {
        $sujet = "Nouvelle inscription";

        $message = '<html>
                    <head>
                        <link href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/style.css" rel="stylesheet" type="text/css">
                        <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400&display=swap" rel="stylesheet">
                    </head>
                    <body>
                    <div style="background-image: url(\'https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/tissu_ci_biir_.jpg\');">
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <table width="80%" align="center" bgcolor="#FFF">
                          <tbody>
                            <tr>
                              <th height="132" align="center" valign="top" scope="col"><table width="100%" cellspacing="10">
                                <tbody>
                                  <tr>
                                    <th align="center" valign="middle" scope="col"><h4 class="titreinscription">NOUVEAU MEMBRE INSCRIT!</h4></th>
                                  </tr>
                                  <tr>
                                    <td align="center" valign="middle" class="textblackpetit2">Bonjour, </td>
                                  </tr>
                                  <tr>
                                    <td height="78" align="center" valign="middle"><p class="textblackpetit2">Nous vous annonçons l\'inscription de M/Mme '. $destinataire .' comme nouveau membre sur notre site . </p></td> </tr>
                                      <tr>
                                                <td height="214" align="center" valign="middle" bgcolor="#c6a47e"><table width="100%" cellspacing="0">
                                                  <tbody>
                                                    <tr>
                                                      <th scope="col" width="20%"><img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/costume_rouge.jpg" width="350" alt=""/></th>                                               
                                                  </tbody>
                                                </table></td>
                                              </tr>                                           
                           
                                            </tbody>
                                          </table></th>
                                        </tr>
                                      </tbody>
                                    </table>
                        <p>&nbsp;</p>
                    </div>
                    </body>
                    </html>';
        // Envoi du mail
        $entete = "Content-type: text/html; charset=utf8\r\n";
        $entete .= " MIME-Version: 1.0\r\n";
        $entete .= "To: $destinataire<".$email."> \r\n";
        $entete .= "From:SenegalSejour<no-reply@senegalsejour.sn>\r\n";
        @mail($email, $sujet, $message, $entete);
    }



    public static function envoiMailReinitialisation($destinataire, $email, $code)
    {
        $sujet = "Réinitialisation de mot de passe"; //Sujet du mail

        $message = '<html>
                    <head>
                        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
                        <link rel="stylesheet" href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/bootstrap/css/bootstrap.min.css">
                        <link href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/header/header1.css" rel="stylesheet">
                        <link id="color_scheme" href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/theme.css" rel="stylesheet">
                        <link href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/responsive.css" rel="stylesheet">
                        <link href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/style.css" rel="stylesheet" type="text/css">
                        <link href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/css/inscription.css" rel="stylesheet" type="text/css">
                        <link href="https://fonts.googleapis.com/css?family=Poppins:600,700,800&display=swap" rel="stylesheet">
	                    <link href="https://fonts.googleapis.com/css?family=Libre+Franklin:400,500,600,700,800&display=swap" rel="stylesheet">
                    </head>
                    <body class="common-home res layout-1">
                        <div id="wrapper" class="wrapper-fluid banners-effect-10" style="background-image: url(\'https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/tissu3.png\');">

                            <!-- Main Container  -->
                            <div id="content" style="margin-bottom: 0;">
                                <div class="so-page-builder">
                                    <section class="section-style1" style="padding: 90px 0px 200px 0px;">
                                        <div id="container-custom" class="container page-builder-ltr" style="width: 55%;">
                                            <div class="row row-style row_a1">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_a1c" style="background: #fff;opacity: 0.95;text-align: center;padding: 20px 40px;font-family:coveslight; font-size: 18px;">
                                                    <p> Bonjour  '.$destinataire.', </p><br>
                                                    <p> Ci-dessous le mot de passe pour acceder à votre espace</p><br>
								                    <p>Mot de passe : <span style="color: #0b0b0b;">'.$code.'</span></p>
                                                    <p> Merci de cliquer sur le lien suivant pour vous connecter et changer votre mode de passe:</p><br>
                                                    <p><a href="https://virtualtoursenegalsejour.com/senegalsejour/home/loginpage"  style="color: #c7a47e;text-decoration: underline;" target="_blank">Accéder à mon espace</a></p><br>
                                                    <p style="color: #000"> </p><br>
                                                    <p style="color: #000"> Merci pour l\'intérêt que vous portez à notre site !</p>
                                                    <p style="color: #000">Si vous n\'avez pas fait de demande d\'inscription sur notre site, vous pouvez ignorer ce mail . </p>
                                                    <p style="color: #000">suivez nous sur nos pages réseaux</p>
                                                    <a href="https://www.facebook.com/Senegal-Sejour-108086863902137/" title="Facebook"><img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/icon/fcbk.png" alt=""></a>
                                                    <a href="#" title="Pinterest"><img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/icon/pinterest.png" alt=""></a>
                                                    <a href="https://www.instagram.com/senegal_sejour/?hl=fr" title="Instagram"><img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/icon/instagram.png" alt=""></a>	
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                            <!-- //Main Container -->
                        </div>
                    </body>
                    </html>';

        /** Envoi du mail **/
        $entete = "Content-type: text/html; charset=utf8\r\n";
        $entete .= " MIME-Version: 1.0\r\n";
        $entete .= "To: $destinataire<".$email."> \r\n";
        $entete .= "From:SenegalSejour<no-reply@senegalsejour.sn>\r\n";
        @mail($email, $sujet, $message, $entete);

    }

    public static function generateQrCode(){

        $code = substr(md5(microtime()), 0, 10);

        $dossier_photo = ROOT."app/qrCodes/";

        $fileName = 'qr_file_'.md5(strtoupper($code)).'.png';

        $pngAbsoluteFilePath = $dossier_photo.$fileName;

        $codeContents ="https://nmedias.media". WEBROOT."scan/loginscan/".base64_encode(strtoupper($code));

        \QRcode::png($codeContents, $pngAbsoluteFilePath);
        return $pngAbsoluteFilePath;
    }


    public static function envoiQrCodeV2($destinataire, $email, $type ,$libelle,$corps, $titre1,$labels , $texts, $titre2,$back_color ,$qrcode, $code, $date_debut, $date_fin)
    {
        $sujet = "Souscription au ".$libelle; //Sujet du mail

        $message = '<html>
                        <head>
                            <link href="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/style.css" rel="stylesheet" type="text/css">
                            <style type="text/css">
                            body {
                                background-color: #f2f2f2;
                            }
                            </style>
                            <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400&display=swap" rel="stylesheet">
                        </head>
                        
                        <body>
                            <table width="800" align="center" bgcolor="#FFF">
                              <tbody>
                                <tr>
                                  <th scope="col"><table width="100%">
                                    <tbody>
                                      <tr>
                                        <th width="50%" height="437" bgcolor="#63523f" scope="col"><table width="100%" cellspacing="10">
                                          <tbody>
                                            <tr>
                                              <th align="left" valign="top" class="titre" scope="col"><div data-packed="true" data-vertical-text="false" id="comp-kg9ar0iw">
                                                <p>FÉLICITATIONS</p>
                                              </div>
                                                <div data-packed="true" data-vertical-text="false" id="comp-kg9ar0is">
                                                  <p class="textblankpetit">Bonjour  '.$destinataire.' ,</p>
                                                  <p class="textblankpetit">​</p>
                                                  <p class="textblankpetit">Votre achat de votre '.$libelle.' a été enregistré avec succès!</p>
                                                </div>
                                                <div data-packed="false" data-vertical-text="false" data-min-height="93" id="comp-kffocw9g">
                                                  <p class="textblankpetit">Retrouvez désormais sur <a href="https://virtualtoursenegalsejour.com/senegalsejour/home/loginpage" target="_blank" class="textblankpetit" rel="noopener" data-type="external" data-content="https://virtualtoursenegalsejour.com/senegalsejour/home/loginpage">votre page personnelle</a>  toutes les informations concernant votre formule en cours :</p>
                                                  <ul>
                                                    <li>
                                                      <p class="textblankpetit">Historique de vos utilisations et de vos passages chez nos partenaires</p>
                                                    </li>
                                                    <li>
                                                      <p class="textblankpetit">Récapitulatif de vos anciennes souscriptions et votre formule en cours </p>
                                                    </li>
                                                    <li>
                                                      <p class="textblankpetit">Affichage de votre '.$libelle.'  avec le QR Code à présenter aux partenaires pour bénéficier de vos avantages</p>
                                                    </li>
                                                  </ul>
                                                </div></th>
                                            </tr>
                                          </tbody>
                                        </table>
                                        </th>
                                        <th width="50%" scope="col"><table width="60%" align="center" cellspacing="0">
                                          <tbody>
                                            <tr>
                                              <th height="293" align="center" valign="top" scope="col" bgcolor="'.$corps.'"><table width="80%">
                                                <tbody>
                                                  <tr>
                                                    <th align="center" valign="middle" class="titreinterm" scope="col" style="color: '.$titre1.'">'.$type.'</th>
                                                  </tr>
                                                  <tr>
                                                    <td align="center" valign="middle"><img src="'.$qrcode.'" width="120" alt=""/></td>
                                                  </tr>
                                                  <tr>
                                                    <td height="137" align="center" valign="top">
                                                        <span class="textorangepetit" style="color: '.$labels.';">Prenom - Nom</span><br>
                                                        <span class="textblankpetit" style="color: '.$texts.'">'.$destinataire.'</span><br>
                                                        <span class="textorangepetit" style="color: '.$labels.';">Numéro de carte</span><br>
                                                        <span class="textblankpetit" style="color: '.$texts.'">'.$code.'</span><br>
                                                        <span class="textorangepetit" style="color: '.$labels.';">Date de Création</span><br>
                                                        <span class="textblankpetit" style="color: '.$texts.'">'.self::getDateFR($date_debut).'</span><br>
                                                        <span class="textorangepetit" style="color: '.$labels.';">Date d\'Expiration</span><br>
                                                        <span class="textblankpetit" style="color: '.$texts.'">'.self::getDateFR($date_fin).'</span></td>
                                                  </tr>
                                                </tbody>
                                              </table></th>
                                            </tr>
                                            <tr>
                                              <td height="29" align="center" valign="middle" bgcolor="'.$back_color.'" class="titreinterm2" style="color: '.$titre2.'">'.$libelle.'</td>
                                            </tr>
                                            <tr>
                                                  <td height="74" align="center" valign="middle" background="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/bg_carte_tissu_ci_biir.jpg"><img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/logo_senegal sejour_avec_fond metal.png" width="60" alt=""/></td>
                                            </tr>
                                          </tbody>
                                        </table></th>
                                      </tr>
                                      <tr>
                                        <td colspan="2" bgcolor="#b39159"><table width="100%">
                                          <tbody>
                                            <tr>
                                              <th width="12%" scope="col"><img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/img_individu.png" width="80"  alt=""/></th>
                                              <th width="88%" scope="col"><p class="titre2">Astuce : faites une capture d\'écran sur votre smartphone de l\'affichage de votre '.$libelle.'<br>
                                                Vous pourrez  afficher votre QR code personnel même en étant hors connexion  !</p></th>
                                            </tr>
                                          </tbody>
                                        </table></td>
                                      </tr>
                                      <tr>
                                        <td colspan="2"><table width="100%" cellspacing="10">
                                          <tbody>
                                            <tr>
                                              <th align="center" valign="middle" class="titre3" scope="col">PROFITEZ IMMEDIATEMENT DE VOS REMISES</th>
                                            </tr>
                                          </tbody>
                                        </table></td>
                                      </tr>
                                      <tr>
                                        <td colspan="2"><table width="100%" height="267">
                                          <tbody>
                                            <tr>
                                              <th width="50%" scope="col" bgcolor="#000"><img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/Little-Buddha-Dining-Room.jpg"  alt="" width="384" height="267"/></th>
                                              <th width="50%" scope="col" bgcolor="#304040"><table width="100%">
                                                <tbody>
                                                  <tr>
                                                    <th width="10%" rowspan="2" scope="col"><h2 class="textvertical">RDV chez un Partenaire</h2></th>
                                                    <th width="90%" scope="col"><img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/img_valid.png" height="90" alt=""/></th>
                                                  </tr>
                                                  <tr>
                                                    <th class="textblankpetit" scope="col"><div data-packed="true" data-vertical-text="false" id="comp-kg9ccmx3">
                                                      <p>Présentez votre mail d\'inscription si vous  n\'avez pas de smartphone</p>
                                                    </div>
                                                      <div data-packed="true" data-vertical-text="false" id="comp-kg9cdful">
                                                        <p>Présentez votre mail d\'inscription si vous  n\'avez pas de smartphone</p>
                                                      </div>
                                                      <div data-packed="true" data-vertical-text="false" id="comp-kg9cdi3q">
                                                        <p>Identifiez nos partenaires facilement sur le site ou à l\'aide du logo Sénégal séjour présent sur les lieux</p>
                                                      </div></th>
                                                  </tr>
                                                </tbody>
                                              </table></th>
                                              </tr>
                                          </tbody>
                                        </table></td>
                                      </tr>
                                      <tr>
                                        <td colspan="2">&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td colspan="2"><table width="100%" height="267">
                                          <tbody>
                                            <tr>
                                              <th width="50%" scope="col" bgcolor="#8a8479"><table width="100%">
                                                <tbody>
                                                  <tr>
                                                    <th width="90%" align="center" valign="middle" scope="col"><img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/img_rdv.png" width="64" height="71" alt=""/></th>
                                                    <th width="10%" rowspan="2" align="center" valign="middle" scope="col"><h2 class="textvertical">Validation</h2></th>
                                                  </tr>
                                                  <tr>
                                                    <th scope="col"><div data-packed="true" data-vertical-text="false" id="comp-kg9cne6w">
                                                      <p><span class="textblankpetit">Le partenaire  va vérifier la validité de votre carte ou PASS</span></p>
                                                    </div>
                                                      <div data-packed="true" data-vertical-text="false" id="comp-kg9cne6z">
                                                        <p><span class="textblankpetit">Une fois la vérification effectuée, il lui suffit de saisir avec vous le montant de la facture que vous deviez régler</span></p>
                                                    </div>
                                                      <div data-packed="true" data-vertical-text="false" id="comp-kg9cne701">
                                                        <p><span class="textblankpetit">Vous aurez instantanément l&rsquo;affichage de la somme que vous devrez payer après déduction automatique de l&rsquo;avantage enregistré dans notre base partenaire</span> </p>
                                                      </div></th>
                                                    </tr>
                                                </tbody>
                                              </table></th>
                                              <th width="50%" scope="col" bgcolor="#000"><img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/android-q-qr-code-1.jpg" width="385" height="267"  alt=""/></th>
                                            </tr>
                                          </tbody>
                                        </table></td>
                                      </tr>
                                      <tr>
                                        <td colspan="2">&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td colspan="2"><table width="100%" height="267">
                                          <tbody>
                                            <tr>
                                              <th width="50%" scope="col" bgcolor="#000"><img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/fidelite.png" width="384" height="267"  alt=""/></th>
                                              <th width="50%" scope="col" bgcolor="#875226"><table width="100%">
                                                <tbody>
                                                  <tr>
                                                    <th width="10%" rowspan="2" scope="col"><h2 class="textvertical">Enregistrement</h2></th>
                                                    <th width="90%" scope="col"><img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/img_enregistrement.png" width="81" height="63" alt=""/></th>
                                                  </tr>
                                                  <tr>
                                                    <th class="textblankpetit" scope="col"><div data-packed="true" data-vertical-text="false" id="comp-kg9cp4xa">
                                                      <p>En validant la transaction, nous l&rsquo;enregistrons automatiquement sur votre profil de membre et aussi celui du Partenaire. </p>
                                                    </div>
                                                      <div data-packed="true" data-vertical-text="false" id="comp-kg9cp4xc1">
                                                        <p>Vous avez ainsi une totale visibilité sur les économies réaliséesavec  votre carte</p>
                                                    </div>
                                                      <div data-packed="true" data-vertical-text="false" id="comp-kg9cp4xf">
                                                        <p>Vos points de fidélité sont automatiquement enregistrés en fonction du montant dépensé disponible dans votre profil de membre</p>
                                                      </div></th>
                                                  </tr>
                                                </tbody>
                                              </table></th>
                                            </tr>
                                          </tbody>
                                        </table></td>
                                      </tr>
                                      <tr>
                                        <td colspan="2" align="center" valign="middle"><p class="textblackmoyen">N\'hésitez pas à nous contacter pour vous aider dans l\'utilisation de votre '.$libelle.'</p>
                                          <p class="textblackmoyen">abonnnez vous à nos pages</p>
                                          <table width="30%" align="center">
                                            <tbody>
                                              <tr>
                                                <th align="center" valign="middle" scope="col">
                                                    <a href="https://www.facebook.com/Senegal-Sejour-108086863902137/"><img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/ce6ec7c11b174c0581e20f42bb865ce3.jpg" width="39" height="39" alt=""/></a>
                                                </th>
                                                <th align="center" valign="middle" scope="col">
                                                    <a href="#"><img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/2891096df79f43829b310ad815d42011.jpg" width="39" height="39" alt=""/></a>
                                                <th align="center" valign="middle" scope="col">
                                                <a href="https://www.instagram.com/senegal_sejour/?hl=fr"><img src="https://virtualtoursenegalsejour.com/senegalsejour/MAIL/image/fdcfaba150fc427da298a00cb09d91c1_(1).jpg" width="39" height="39" alt=""/></a>
                                                </th>
                                              </tr>
                                            </tbody>
                                          </table>
                                          <p class="textblackpetit">Avis de sécurité important : Senegalsejour ne vous demandera jamais votre mot de passe ou d\'autres informations sensibles par e-mail. Ne cliquez pas sur des liens et ne répondez pas aux e-mails suspects !</p></td>
                                      </tr>
                                    </tbody>
                                    </table>
                                  </th>
                                </tr>
                              </tbody>
                            </table>
                        </body>
                        </html>';

        /** Envoi du mail **/
        $entete = "Content-type: text/html; charset=utf8\r\n";
        $entete .= " MIME-Version: 1.0\r\n";
        $entete .= "To: $destinataire<".$email."> \r\n";
        $entete .= "From:SenegalSejour<no-reply@senegalsejour.sn>\r\n";
        @mail($email, $sujet, $message, $entete);

    }

}