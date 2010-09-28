<?php
/**
 * autoconnect actions.
 *
 * @package    app
 * @subpackage autoconnect
 * @author     Ferey Cyril
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z  $
 */
class autoconnectActions extends sfActions
{

 /**
  * Executes index action
  * Permet de g�n�rer une connexion automatique sur ce site, mettre � jour les donn�es age/sex, cr�er le compte si n�cessaire
  * et renvoyer vers la bonne adresse interne ensuite.
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
	$this->logMessage('autoconnect', 'notice');
	try
	{	
		// Routing : // cryptuid/:hascode/:crypttimelimit/
			//
			
			// R�cup�ration des param�tres obligatoires du routing
			$CryptUID = $this->getRequestParameter('cryptuid',null);
			$HashCode= $this->getRequestParameter('hashcode',null);
			$CryptTimeLimit = $this->getRequestParameter('crypttimelimit',null);
			$ForwardURLCodee = $this->getRequestParameter('forwardurl',null);
			
			if($CryptUID==null || $HashCode==null || $CryptTimeLimit==null)
			{
				
				echo("Page indisponible"); // TODO : renvoi sur page d'erreur
				$this->logMessage("autoconnect: Tentative de connexion �chou�e avec des param�tres null CryptUID:$CryptUID HashCode:$HashCode CryptTimeLimit:$CryptTimeLimit", 'err');
				return SfView::NONE; 
			}
			else
			{
				// On authentifie la personne ici depuis les param�tres de l'url et on renvoi sur les offres
				//$ObjMembers= new Members();   // Gestion des membres
				
				$ObjAccessPayment = new AccessSites(); // Gestion de l'authentification sur le front
				$Authentification = $ObjAccessPayment->SetMemberAuthentification($CryptUID,$HashCode,$CryptTimeLimit,$ForwardURLCodee);
				if($Authentification!=null)
				{ // 3 Formats possibles de ForwardURL www.attractiveworld.net secure.attractiveworld.net /offres/show
					// 2 cas possibles
					// 1/url sans pr�ciser le domaine, c'est local on redirige directement
					// 2/url sur un autre serveur, voir les 2 sous cas ci apr�s, on cr�e une SecureConnexion
					// 2.1/ C'est le m�me que celui sur lequel on se trouve, on fait une redirection simple
					// 2.2/ C'est un domaine diff�rent, on fait une redirection via autoconnect
					$_ForwardURL =$Authentification->ForwardURL;
					$URLInfos =	parse_url($_ForwardURL);
					if(isset($URLInfos["host"]))
					{ 
						// Le domaine est mentionn�
						// cas 2.1 ou 2.2
						if((sfConfig::get('app_subdomaine').".".sfConfig::get('app_domaine'))==$URLInfos["host"])
						{
							// cas 2.1 : url sur le domaine en cours
							$ForwardURL =$Authentification->ForwardURL;				
						}
						else
						{
							// cas 2.2 : url sur un autre domaine, on g�n�re une autoconnexion
							$URLOtherDomaine= $ObjAccessPayment->GetSecureConnexionURL($Authentification->uid,AccessSites::TimeOutShort,$URLInfos["path"]);
							$ForwardURL = $URLInfos["scheme"]."://".$URLInfos["host"].":".$URLInfos["port"]."/fr/autoconnect/index/".$URLOtherDomaine->URL;
						}
					}
					else
					{   // Redirection simple
						$ForwardURL =$Authentification->ForwardURL;				
					}
					
					sfContext::getInstance()->getLogger()->notice("ForwardURL".$ForwardURL);
					$this->redirect($ForwardURL);   //ATTENTION, un redirect �quivaux � un exit() et donc g�n�re une exception Donc pas de try & catch ici					
					sfContext::getInstance()->getLogger()->notice("Forward URL erreur si cette ligne s'affiche");
				}
				else
				{
					echo("Page indisponible");
					$this->logMessage("autoconnect: Tentative de connexion �chou�e avec des param�tres non coh�rent CryptUID:$CryptUID HashCode:$HashCode CryptTimeLimit:$CryptTimeLimit", 'err');
					return SfView::NONE; 
				}
			}
		}
		catch (sfStopException $e)
		{
			// Ne rien faire, c'est la redirection qui g�n�re une erreur
			$this->logMessage("autoconnect: Tentative de connexion �chou�e avec des param�tres non coh�rent CryptUID:$CryptUID HashCode:$HashCode CryptTimeLimit:$CryptTimeLimit", 'info');
		}		
		catch(sfException $e) 
		{
			$this->logMessage("autoconnect: Tentative de connexion �chou�e avec des param�tres non coh�rent CryptUID:$CryptUID HashCode:$HashCode CryptTimeLimit:$CryptTimeLimit Message:".$e->getMessage(), 'err');
			return(null);	
		}
	}
}
