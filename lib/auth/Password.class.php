<?php
/**
 * Génération et vérification du mot de passe
 */

define('SALT_LENGTH', 9);

class Password {
	
	
	public static function generateHash($plainText, $salt = null)
	{
		if ($salt === null)
		{
			$salt = substr(md5(uniqid(rand(), true)), 0, SALT_LENGTH);
		}
		else
		{
			$salt = substr($salt, 0, SALT_LENGTH);
		}

		return $salt . sha1($salt . $plainText);
	}	
}

?>