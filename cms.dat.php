 <?php
  /**
 * V�rifier la validit� d'une adresse IP, une adresse locale est incorrecte
 * @param string adresse IP
 * @return boolean validit� d'une adresse IP
 */
function is_ValidIP($ip) {
    if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE)) {
        return true;
    }
    else {
        return false;
    }
}
 
/**
 * Retrouver l'adresse IP du visiteur, test d'un partage de connection, d'un proxy
 * @return String l'adresse IP la + sure
 */
function getRealIPAddress() {
//Connection internet partag�e ou ISP IP
    if (!empty($_SERVER['HTTP_CLIENT_IP']) && is_ValidIP($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }
 
//Connection derri�re un routeur
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
//Extraire la premi�re adresse valide
        $iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        foreach ($iplist as $ip) {
            if (is_ValidIP($ip)) {
                return $ip;
            }
        }
    }
 
//Trouver le proxy utlis�
    if (!empty($_SERVER['HTTP_X_FORWARDED']) && is_ValidIP($_SERVER['HTTP_X_FORWARDED'])) {       
        return $_SERVER['HTTP_X_FORWARDED'];
    }
    if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && is_ValidIP($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
        return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    }
    if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && is_ValidIP($_SERVER['HTTP_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_FORWARDED_FOR'];
    }
    if (!empty($_SERVER['HTTP_FORWARDED']) && is_ValidIPp($_SERVER['HTTP_FORWARDED'])) {
        return $_SERVER['HTTP_FORWARDED'];
    }
 
//L'adresse IP par d�faut
    return $_SERVER['REMOTE_ADDR'];
}
$p = getRealIPAddress();

 $info_titre  = '';
  $info_soustitre  =  $p;
   $info_date  = date('l j F Y, H:i'); 
   $info_intro  = '';
   ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" id="theme" href="style.css" />
        <title></title>
    </head>
    <body>
                
    <div id="site_content">
      <div id="sidebar_container">
	<div class="sidebar">
            <?php include ('tz_news.tpl.php');?>
	</div>
      </div>
        <a href="mcsam.gif">Fichier</a>
    </div>
        
           
    </body>
</html>
