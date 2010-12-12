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
 * But : Permettre dans le modèle MVC le passage d'informations d'un module à une autre. converse l'historique de la navigation
 * entre modules avec gestion du cache
 * Dépendance : Memcache,
 *
 * Cas d'application
 *  Lors d'une recherche impliquant des éléments complexe, plûtot que de stocker les éléments de la recherche, on stocke le résultat
 * (liste d'id). Que l'on va passer sur un même module en paging (liste d'id).
 *
 * Que faire si la donnée n'est plus disponible
 *  retourner une erreur à l'appelant et/ou laisser l'application renvoyer sur une url d'erreur
 *
 * Historique
 *  le fait de revenir en arrière, va crée lors du post suivant une autre branche.
 *
 * NavID
 *  C'est la variable qui permet de savoir sur quel élément on se trouve actuellement.
 *
 *
 *
 * Next NavID : Toujours nouveau
 * Back NavID : il faudrait prendre celui de la branche d'où l'on vient
 *			    besoin de stocker les branches de la navigation
 *
 * Nous aurions donc
 *				ID1-ID2-ID3
 *		et un tableau d'array sur les branches ou un tableau d'array d'array.
 *		branches doit donc être conservé par session ?!!! Ou je compose ma NavID avec ma clé primaire de navigation
 *
 *
 * Lorsque l'on accès au module suivante, ce n'est que pour la branche dans laquelle nous nous trouvons.
 * Les autres branches de navigation ayant le même comportement. Donc chaque back, va recréer une nouvelle branche.
 * Mais pas tout l'ancienne qui peut être encore contenu dans un onglet de la navigation.
 *
 *
 * Exemple
 * 4bf3a335d2332-23-456-345-2345
 * 4bf3a335d2332-23-324
 * 4bf3a335d2332 : étant initial, possible de conserver des données sur cet emplacement mémoire
 * 4bf3a335d2332-23 : 2eme page du module,
 * 4bf3a335d2332-23-324 : 2eme branche possible
 *
 * Chaque données stockée sera sous la forme : 4bf3a335d2332-23-324
 * le temps par défaut de conservation sera de 60 minutes.
 *
 * Il est inutile de stocker le parcours de branche vu que l'id le fait de part sa nature.
 *
 * Conditions à prendre en compte
 * -On doit générer un id unique pour chaque module dans chaque chemin de navigation (navigation multi-onglets).
 * -id identique tant que l'on se trouve sur le même module, il faut donc passer l'id du module dans l'url.
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
	private $NavLifeTime=3600;			// temps de vie normal des objets en mémoire, c'est en secondes

	// Session de Nav
	private $NavCurrentID;				// identifiant pour le stockage de l'objet courant.
	private $NavNextID;					// Suivant
	private $NavBackID;					// précédent, les zones mémoires existant déjà
	private $NavPrimaryID;				// ID le plus ancien
	// ATTENTION  : La cumulation de navigation à l'intérieur de plusieurs module est impossible s'ils sont de même niveau
	// exemple : recherche <> vote
	// Par contre : le module recherche->Profil peut fonctionner avec des sous éléments de profils stockant des infos ds le module profil.
	// On parle alors de session de navigation avec un module = 1 page et 1 Nav = un module et plusieurs pages contenant des sous modules.



	// TODO : Remplace par une configuration YAML
	const PORT = 11211;
	const HOST = "localhost";
		
	/**
	 * $NavID : Identifiant de la branche de navigation
	 *			s'il est vide c'est que l'on se trouve dans une nouvelle branche.
	 */

	/**
	 *  Génération de l'id primaire du premier tableau
	 *  celui-ci contient toute la branche
	 */
	private function PrimaryID()
	{
		return(uniqid());
	}

	/**
	 * Besoin d'un niveau moindre d'unicité
	 */
	private function SecondaryID()
	{
		// Composition du timestamp de ce jour à 0h00
		// int mktime ( int hour, int minute, int second, int month, int day, int year [, int is_dst])

		$DayTimeStamp = mktime(0,0,0,date("m"),date("d"),date("Y"));
		$NowTimeStamp = mktime((date("H")+6) % 18,date("i"),date("s"),date("m"),date("d"),date("Y"));		// On va boucler sur 18 heures pour des raisons d'économie de caractères
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
	 * Renvoi l'id de la Nav précédente, utilisable ds une url
	 * @return mixed This is the return value description
	 *
	 */
	public function GetBackID()
	{
		// Current : 4bf3a335d2332-23-456-345-2345 Back : 4bf3a335d2332-23-456-345
		$CutAt = strripos($this->NavCurrentID, '-', -1); // recherche depuis la fin, avant dernier caractère.
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
		$CutAt = strpos($this->NavCurrentID, '-'); // recherche depuis la fin, avant dernier caractère.
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
	 * Renvoi du nom de la variable que l'on cherche à atteindre en fonction de la session de Nav (Back,Current,Next)
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
		return($ID."_".$Name);					// _ séparateur pour les variables en mémoire, pas indispensable juste pour une lecture humaine
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
		// Gérer ici l'objet de stockage
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
			throw new Exception("L'objet de cache ne peut être instancié",4000);
		}

		// Session : pas nécessaire ici, l'id devant être unique
		// Le cache n'est pas nécessaire pour l'utilisation de l'objet, aucune erreur n'est relevée
		try
		{
			// Navid : si null c'est que l'on se trouve dans une nouvelle branche (le début).
			// si l'on fait après la page suivante un back en utilisant l'url back contenant ce navid, on pourra retrouve les
			// éléments stockés dans cette life time.
			if(Isset($NavID))
			{
				$this->NavCurrentID=$NavID;
			}
			else
			{
				$this->NavCurrentID=self::PrimaryID();
			}
			// NavBackID : Identifiant des données stockées précédement
			$this->NavBackID = self::GetBackID();
			// NavNextID : Identifiant des données pour la prochaine Nav (page suivante).
			$this->NavNextID = $this->NavCurrentID."-".self::SecondaryID();
			// PrimaryID : Stockage principal des données
			$this->NavPrimaryID = self::GetPrimaryID();
		}
		catch (Exception $e)
		{
			throw new Exception("Erreur lors de l'initialisation des variables de l'application",4003);
		}
	}



	/* Permet de définir un renvoi vers une url en cas d'erreur pour ne pas avoir à le gérer coté appelant.*/
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
			throw new Exception("L'objet de cache ne peut être instancié",4001);
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
			$LifeTime = $LifeTime==null?$this->NavLifeTime:$LifeTime;     // Si null, valeur par défaut de conservation en cache
			// Création de la variable interne
			$VarName = $this->GetVarName($Name,$Position);						// Format GetVarName($Name,NavID) par défaut current
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

	// Un constructeur privé ; empêche la création directe d'objet
	private function __construct()
	{
		echo 'Je suis construit';
	}

	public function __clone()
	{
		trigger_error('Le clônage n\'est pas autorisé.', E_USER_ERROR);
	}
}

?>