<?php
/**
 *ALGO
 * Id : id du module actuel
 *
 *
 *
 *
 */


/**
 * This is class NavCache
 * Auteur : Ferey Cyril
 * But : Permettre dans le mod�le MVC le passage d'informations d'un module � une autre. converse l'historique de la navigation
 * entre modules avec gestion du cache
 * D�pendance : Memcache,
 *
 * Cas d'application
 *  Lors d'une recherche impliquant des �l�ments complexe, pl�tot que de stocker les �l�ments de la recherche, on stocke le r�sultat
 * (liste d'id). Que l'on va passer sur un m�me module en paging (liste d'id).
 *
 * Que faire si la donn�e n'est plus disponible
 *  retourner une erreur � l'appelant et/ou laisser l'application renvoyer sur une url d'erreur
 *
 * Historique
 *  le fait de revenir en arri�re, va cr�e lors du post suivant une autre branche.
 *
 * NavID
 *  C'est la variable qui permet de savoir sur quel �l�ment on se trouve actuellement.
 *
 *
 *
 * Next NavID : Toujours nouveau
 * Back NavID : il faudrait prendre celui de la branche d'o� l'on vient
 *			    besoin de stocker les branches de la navigation
 *
 * Nous aurions donc
 *				ID1-ID2-ID3
 *		et un tableau d'array sur les branches ou un tableau d'array d'array.
 *		branches doit donc �tre conserv� par session ?!!! Ou je compose ma NavID avec ma cl� primaire de navigation
 *
 *
 * Lorsque l'on acc�s au module suivante, ce n'est que pour la branche dans laquelle nous nous trouvons.
 * Les autres branches de navigation ayant le m�me comportement. Donc chaque back, va recr�er une nouvelle branche.
 * Mais pas tout l'ancienne qui peut �tre encore contenu dans un onglet de la navigation.
 *
 *
 * Exemple
 * 4bf3a335d2332-23-456-345-2345
 * 4bf3a335d2332-23-324
 * 4bf3a335d2332 : �tant initial, possible de conserver des donn�es sur cet emplacement m�moire
 * 4bf3a335d2332-23 : 2eme page du module,
 * 4bf3a335d2332-23-324 : 2eme branche possible
 *
 * Chaque donn�es stock�e sera sous la forme : 4bf3a335d2332-23-324
 * le temps par d�faut de conservation sera de 60 minutes.
 *
 * Il est inutile de stocker le parcours de branche vu que l'id le fait de part sa nature.
 *
 * Conditions � prendre en compte
 * -On doit g�n�rer un id unique pour chaque module dans chaque chemin de navigation (navigation multi-onglets).
 * -id identique tant que l'on se trouve sur le m�me module, il faut donc passer l'id du module dans l'url.
 *
 */
class NavCache
{
	// Constantes
	const BACK = -1;
	const CURRENT = 0;
	const NEXT = 1;
	const PRIMARY = 2;					// 1er ID, soit primaryID de la nav

	// Cache
	static private $Cache;						// objet de stockage sous forme de stream
	private $NavLifeTime=3600;			// temps de vie normal des objets en m�moire, c'est en secondes

	// Session de Nav
	private $NavCurrentID;				// identifiant pour le stockage de l'objet courant.
	private $NavNextID;					// Suivant
	private $NavBackID;					// pr�c�dent, les zones m�moires existant d�j�
	private $NavPrimaryID;				// ID le plus ancien
	// ATTENTION  : La cumulation de navigation � l'int�rieur de plusieurs module est impossible s'ils sont de m�me niveau
	// exemple : recherche <> vote
	// Par contre : le module recherche->Profil peut fonctionner avec des sous �l�ments de profils stockant des infos ds le module profil.
	// On parle alors de session de navigation avec un module = 1 page et 1 Nav = un module et plusieurs pages contenant des sous modules.



	// TODO : Remplace par une configuration YAML
	const PORT = 11211;
	const HOST = "localhost";
		
	/**
	 * $NavID : Identifiant de la branche de navigation
	 *			s'il est vide c'est que l'on se trouve dans une nouvelle branche.
	 */

	/**
	 *  G�n�ration de l'id primaire du premier tableau
	 *  celui-ci contient toute la branche
	 */
	private function PrimaryID()
	{
		return(uniqid());
	}

	/**
	 * Besoin d'un niveau moindre d'unicit�
	 */
	private function SecondaryID()
	{
		// Composition du timestamp de ce jour � 0h00
		// int mktime ( int hour, int minute, int second, int month, int day, int year [, int is_dst])

		$DayTimeStamp = mktime(0,0,0,date("m"),date("d"),date("Y"));
		$NowTimeStamp = mktime((date("H")+6) % 18,date("i"),date("s"),date("m"),date("d"),date("Y"));		// On va boucler sur 18 heures pour des raisons d'�conomie de caract�res
		$Diff = $NowTimeStamp-$DayTimeStamp;
		return(sprintf( '%04s%01x',
		substr("0000".dechex($Diff),-4),
		mt_rand(0,0xf)
		));
	}

	#Region "LifeTime"
	public function SetLifeTime($LifeTime)
	{
		$this->NavLifeTime=$LifeTime;
	}

	public function GetLifeTime()
	{
		return($this->NavLifeTime);
	}
	#End Region




	/**
	 * BackID
	 * Renvoi l'id de la Nav pr�c�dente, utilisable ds une url
	 * @return mixed This is the return value description
	 *
	 */
	public function GetBackID()
	{
		// Current : 4bf3a335d2332-23-456-345-2345 Back : 4bf3a335d2332-23-456-345
		$CutAt = strripos($this->NavCurrentID, '-', -1); // recherche depuis la fin, avant dernier caract�re.
		if($CutAt)
		{
			$BackId = substr($this->NavCurrentID,0,$CutAt);
		}
		else
		{
			$BackId = null;				//self::$NavCurrentID;
		}
		return($BackId);
	}

	public function GetBackIDUrl()
	{

	}

	/**
	 * NextID
	 *  Renvoi l'id de la session suivante
	 * @return mixed This is the return value description
	 *
	 */
	public function GetNextID()
	{
		return($this->NavNextID);
	}

	public function GetCurrentID()
	{
		return($this->NavCurrentID);
	}

	public function GetPrimaryID()
	{
		// Current : 4bf3a335d2332-23-456-345-2345 Primary : 4bf3a335d2332
		$CutAt = strpos($this->NavCurrentID, '-'); // recherche depuis la fin, avant dernier caract�re.
		if($CutAt)
		{
			$PrimaryId = substr($this->NavCurrentID,0,$CutAt);
		}
		else
		{
			$PrimaryId = $this->NavCurrentID;				//self::$NavCurrentID;
		}
		return($PrimaryId);
	}

	/**
	 * GetVarName
	 * Renvoi du nom de la variable que l'on cherche � atteindre en fonction de la session de Nav (Back,Current,Next)
	 * @return mixed This is the return value description
	 *
	 */
	private function GetVarName($Name,$Position=self::CURRENT)
	{
		//$NavID = $NavID==null?$this->NavCurrentID:$NavID;
		switch($Position){
			case self::BACK:
				$ID = $this->NavBackID;
				break;
			case self::NEXT:
				$ID = $this->NavNextID;
				break;
			case self::PRIMARY:
				$ID = $this->NavPrimaryID;
				break;
			default:
				$ID = $this->NavCurrentID;
				break;
		}
		return($ID."_".$Name);					// _ s�parateur pour les variables en m�moire, pas indispensable juste pour une lecture humaine
	}

	/**
	 * NavCache
	 *  Constructeur
	 * @param mixed $NavID This is a description
	 * @return mixed This is the return value description
	 *
	 */
	public  function NavCache($NavID=null)
	{
		// G�rer ici l'objet de stockage
		// TODO : en premier memcache uniquement
		// Prendre sa conf automatique depuis les fichiers YAML de SF

		// Instanciation objet Cache
		try
		{
			// Remplacement par un singleton
			//$this->Cache = new Memcache();
			//$this->Cache->connect(self::HOST, self::PORT) or die ('Connexion impossible!');
			//self::$Cache = clsMem::getMem();
		}
		catch (Exception $e)
		{
			throw new Exception("L'objet de cache ne peut �tre instanci�",4000);
		}

		// Session : pas n�cessaire ici, l'id devant �tre unique
		// Le cache n'est pas n�cessaire pour l'utilisation de l'objet, aucune erreur n'est relev�e
		try
		{
			// Navid : si null c'est que l'on se trouve dans une nouvelle branche (le d�but).
			// si l'on fait apr�s la page suivante un back en utilisant l'url back contenant ce navid, on pourra retrouve les
			// �l�ments stock�s dans cette life time.
			if(Isset($NavID))
			{
				$this->NavCurrentID=$NavID;
			}
			else
			{
				$this->NavCurrentID=self::PrimaryID();
			}
			// NavBackID : Identifiant des donn�es stock�es pr�c�dement
			$this->NavBackID = self::GetBackID();
			// NavNextID : Identifiant des donn�es pour la prochaine Nav (page suivante).
			$this->NavNextID = $this->NavCurrentID."-".self::SecondaryID();
			// PrimaryID : Stockage principal des donn�es
			$this->NavPrimaryID = self::GetPrimaryID();
		}
		catch (Exception $e)
		{
			throw new Exception("Erreur lors de l'initialisation des variables de l'application",4003);
		}
	}



	/* Permet de d�finir un renvoi vers une url en cas d'erreur pour ne pas avoir � le g�rer cot� appelant.*/
	public function SetErrorUrl()
	{

	}

	/**
	 * This is method GetStore
	 * Obtenir les informations de la variable pour le module courant
	 *
	 * @param mixed $Name This is a description
	 * @param mixed $Id Identifiant du module courant
	 * @return mixed This is the return value description
	 *
	 */
	public function GetStore($Name,$Position=self::CURRENT)
	{
		try
		{
			$Value=Cacher::getMem()->get($this->GetVarName($Name,$Position));
			return($Value);
		}
		catch(exception $e)
		{
			throw new Exception("L'objet de cache ne peut �tre instanci�",4001);
		}
	}

	/**
	 * This is method SetStore
	 *
	 * @param mixed $Name This is a description
	 * @param mixed $Id This is a description
	 * @return mixed This is the return value description
	 *
	 */
	public function SetStore($Name,$Value,$Position=self::CURRENT,$LifeTime=null){
		try
		{
			$LifeTime = $LifeTime==null?$this->NavLifeTime:$LifeTime;     // Si null, valeur par d�faut de conservation en cache
			// Cr�ation de la variable interne
			$VarName = $this->GetVarName($Name,$Position);						// Format GetVarName($Name,NavID) par d�faut current
			Cacher::getMem()->set($VarName, $Value, false, $LifeTime);
			//return($Value);
		}
		catch(exception $e)
		{
			throw new Exception("Impossible de mettre en cache la variable :".$VarName." avec la valeur".$Value,4002);
		}
	}



}
class Cacher extends Memcache {
	// Connections
	const PORT = 11211;
	const HOST = "localhost";

	private static $m_objMem;

	public static function getMem() {
		if (!isset(self::$m_objMem)) {
			//echo("Creation cache");
			self::$m_objMem = new Memcache();
			self::$m_objMem->connect(self::HOST, self::PORT) or die ('Connexion impossible!');
		}
		//self::$m_objMem || self::$m_objMem = new Memcache($servers);
		return self::$m_objMem;
	}

	// Un constructeur priv� ; emp�che la cr�ation directe d'objet
	private function __construct()
	{
		echo 'Je suis construit';
	}

	public function __clone()
	{
		trigger_error('Le cl�nage n\'est pas autoris�.', E_USER_ERROR);
	}
}

?>