<?php
/**
 * Génération et vérification des liens vers le payant
 */
/**
 */
class AccessSites {
	// timeoutshort: 60  timeoutlong:  691200	
	const TimeOutShort=60;		// Permet l'échange d'auto connexion entre deux serveurs, en secondes.
	const TimeOutLong=691200;		// Permet de générer des liens de connexion dans les emails.
	// Liste des différentes url d'autoconnection  
	const SiteSecure="https://secure.artworks.com/autoconnect";
	const SiteSignup="http://signup.artworks.com/autoconnect";
	const SiteProfil="http://profil.artworks.com/autoconnect";
	const SiteFrontend="http://www.artworks.com/autoconnect";


	/**
	 * Renvoi
	 * Permet de renvoyer la personne sur les différents site du groupe lors de la connexion sur une page
	 * Site : utilisation des constantes
	 * ForwardURL : Url local au site distant
	 */
	public static function Renvoi($Site,$ForwardURL)
	{
		$UID = sfContext::getInstance()->getUser()->getId();	
		$URLPayment = self::GetSecureConnexionURL($UID,self::TimeOutShort,$ForwardURL);
		$URL = $Site.$URLPayment->URL;
		sfContext::getInstance()->getController()->redirect($URL);
	}
	/**
	 * This is method GetSecureConnexionURL
	 *  Renvoi une chaine sous la forme UID-md5(uid)-Blowfish(Temps limite) permettant de se connecter sur secure.artworks.net
	 *  il est possible de donner un temps long et court 
	 * uid : user id
	 * TimeLimitType : Temps long ou court
	 * RelativeURL : Url complète vers laquelle on veut renvoyer l'utilisateur
	 * Format URL : /UID/HASCODE/ENCODEDTIMELIMIT
	 * 
	 * Utilisation 
	 *  AdresseDuModuleAuthentification/$UrlPayment->URL
	 *  AdresseDuModuleAuthentification : Doit être mentionné comme variable dans l'application
	 *    il s'agit en fonction de l'utilisation, d'un autre serveur ou d'une autre page.
	 */
	public static function GetSecureConnexionURL($uid, $TimeLimitType, $ForwardURL)
	{
		// Vérification
		if (!is_numeric($uid))	throw new sfException("mauvais UID");
		// Cryptage	
		//#type $crypt pcrypt
		$crypt = new pcrypt(MODE_ECB, "BLOWFISH", sfConfig::get('app_key'));
		$CryptUID = $crypt->base64_url_encode($crypt->encrypt($uid));
		$HashCode = md5($uid . sfConfig::get('app_passphrase'));
		$CryptTimeLimit = self::CryptTimeLimit($TimeLimitType);
		//RETOUR DES INFOS
		$UrlPayment = new stdClass();    // Util pour ne pas lever un warning
		$UrlPayment->CryptUID = $CryptUID;
		$UrlPayment->HashCode = $HashCode;
		$UrlPayment->CryptTimeLimit=$CryptTimeLimit;
		$UrlPayment->ForwardURL=$crypt->base64_url_encode($ForwardURL);
		$UrlPayment->URL="/".$CryptUID."/".$HashCode."/".$CryptTimeLimit."/".$UrlPayment->ForwardURL;  // Pour faciliter l'écriture
		return $UrlPayment;
	}
	
	
	/**
	 * SetMemberAuthentification
	 * Valide l'authentification de l'utilisateur par une méthode spécifique au site sur lequel on se trouve
	 *
	 */
	public static function SetMemberAuthentification($CryptUID,$HashCode,$CryptTimeLimit,$ForwardURL)
	{
		try {
			$result = self::GetMemberID($CryptUID,$HashCode,$CryptTimeLimit,$ForwardURL);
			$uid=$result->uid;
			if ($uid!=null) {
				/* Authentification */
				// dans le cas de l'application de signup, on ne fait pas de vérification sur la base (car 2 bases)
				$Instance = sfContext::getInstance();
				//$Instance->getUser()->signIn();
				//$this->getContext()->getUser()->signIn();
				sfContext::getInstance()->getUser()->setAttribute('uid',$uid);		
				$result->validated = true;
			}
			return $result;
		}
		catch(sfException $e) {
			throw new Exception("SetMemberAuthentification : Erreur sur l'authentification de l'utilisateur: $uid Message:".$e->getMessage());
			return(null);	
		}
	}
	
	  
	/**
	 * GetMemberID
	 *  Renvoi l'uid de l'utilisateur si les données sont bonnes sinon null
	 * @param mixed $code_member This is a description
	 * @return mixed This is the return value description
	 *
	 */
	public static function GetMemberID($CryptUID,$HashCode,$CryptTimeLimit,$ForwardURL)
	{
		$crypt = new pcrypt(MODE_ECB, "BLOWFISH", sfConfig::get('app_key'));
		$uid = $crypt->decrypt($crypt->base64_url_decode($CryptUID));
		if (!is_numeric($uid) || strlen($HashCode) != 32)
			throw new sfException("URL mal formatée l'uid ou le hash ne sont pas bon, vérifiez les clés de cryptage");	
		$output = new stdClass();
		$output->uid = null;
		$output->ForwardURL = $crypt->base64_url_decode($ForwardURL);
		// Validation de l'utilisateur
		if ($HashCode == md5($uid . sfConfig::get('app_passphrase')))
		{		
			// Temps calculé depassé ?
			$TempOrigine=self::DeCryptTimeLimit($CryptTimeLimit);
			if ($TempOrigine> time())
			{
				$output->uid = $uid;
			} else
			{
				throw new sfException("Secure ouverture de session : Temps de passage de lien entre www et secure dépassé temp:".time()." temps limite:".self::DeCryptTimeLimit($CryptTimeLimit));	
			}
		}
		else
		{
			//$output->msg = "Invalid MD5 Hashcode";
			throw new sfException("Secure ouverture de session : MD5 non valide UID : ".$uid);	
		}
		return $output;
	}
	
	
	/**
	 * CryptTimeLimit
	 * Permet de crypter le temps limit de validité de ce lien
	 * @param mixed $key This is a description
	 * @return mixed This is the return value description
	 *
	 */
	private static function CryptTimeLimit($TimeOut)
	{
		$crypt = new pcrypt(MODE_ECB, "BLOWFISH", sfConfig::get('app_key'));
		$Time = time() + $TimeOut;
		return($crypt->base64_URL_encode($crypt->encrypt($Time))); 			
	}
	
	private static function DeCryptTimeLimit($Time)
	{
		$crypt = new pcrypt(MODE_ECB, "BLOWFISH", sfConfig::get('app_key'));
		$Time =$crypt->decrypt($crypt->base64_URL_decode($Time));
		return($Time); 			
	}
	
	
}

?>