<?php
class ImagesTools {

	/* LIB */
	public static function str_rpl($filename){
		$filename = strtr($filename, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
		$filename = strtolower($filename );
		$filename =  preg_replace('/([^.a-z0-9]+)/i', '_', $filename);
		return $filename;

	}

	private static function int_int_divide($x, $y) {
		return ($x - ($x % $y)) / $y;
	}

	private static  function UniversalMKDIR($dir)
	{
		try
		{
			// Belazar Mohamed mardi 9 novembre 2010 - meilleure gestion des permissions
			$fileSystem = new sfFilesystem();
			return $fileSystem->mkdirs(sfConfig::get('sf_web_dir').$dir);
		}
		catch (Exception $e)
		{
			throw new Exception(get_class($this)." : Erreur pour créer le répertoire $dir suivant Message:".$e->getMessage());
			return null;
		}
	}

	/*
	 renvoi un chemin du type DIR/a/MD5(b)//MD5(ID)
	 exemple
	 id =  4 234 398
	 Répertoire DIR/4/234+333/398
	 */
	public static function getGalleryPath($id)
	{
		try
		{
			$MAXID = 66300 ; // ID le plus élevé lors de la mise en ligne, ajouter 100 pour avoir une marge de manoeuvre.
			if($id>$MAXID)
			{
				// Création d'un chemin a/b/c/MD5(uid)/IMAGES
				$a = self::int_int_divide($id,1000000);
				$b = self::int_int_divide($id-($a*1000000),1000);
				$c = $id-($a*1000000)-($b*1000);
				$Repertoire = sfConfig::get( 'sf_upload_dir' ).$a."/".($b+333)."/".$c."/"; // + 333 permet de brouiller l'ID
			}
			else
			{
				$Repertoire = sfConfig::get( 'sf_upload_dir' ).md5 ( $id )."/";
			}
			if (! is_dir ( sfConfig::get('sf_web_dir').$Repertoire ))
			{
				self::UniversalMKDIR($Repertoire);
			}
			return $Repertoire;
		}
		catch (Exception $e)
		{
			throw new Exception(get_class($this).' : Erreur pour récupérer le chemin de la gallerie photo du membre $idMessage :'.$e->getMessage());
			return null;
		}
	}


	/**
	 * Copie la photo $photo_url dans le même dossier où se trouve $photo_url et modifie sa taille proportionnellement
	 * aux nouvelles dimensions : $width et $height
	 *
	 *
	 * @param String $photo_url
	 * @param int $width_target
	 * @param int $height_target
	 * @example si $photo_url = "/uploads/gallery/23456/thumnails/ma_photo_xyz.jpg, cette fonction va
	 * l'enregistrer sous ""/uploads/gallery/23456/thumnails/ma_photo_xyz.jpg"
	 *
	 */
	public static function savePhotoInParticularSize($photo_url,$width_target,$height_target){

	}
	/**
	 * copie une photo vers le répertoire d'un memberUser et génère les thumbnails associées
	 *
	 * @param memberUser $memberUser
	 * @param String $photo_path
	 * @param array $sizes
	 * @return array
	 */
	public static function copyPhotoIntoOurServerIndifferentSizes($memberUser , $photo_path , $sizes){
		try{
			$info_img_tab=ImagesTools::copyFileToDefaultMemberUserDirectory($memberUser,$photo_path);
		}catch (Exception $exc){
			return ;
		}

		foreach ( $sizes as $size){
			$widthTarget	=	$size[0];
			$heightTarget	=	$size[1];
			$file_name_tab=ImagesTools::getSplittedFileNameAsArray($info_img_tab[2]);

			$thumbnail = new sfThumbnail ( $widthTarget, $heightTarget );
			$thumbnail->loadFile ( $info_img_tab[2]);
			//
			$thumbnail->save ( $file_name_tab[0]. '/thumbnails/' .$file_name_tab[1] ."_".$widthTarget."x".$heightTarget. $file_name_tab[2] );
		}
			

	}

	public static function getFileInfos($photo_path){
		$photo_path_tab	=	explode("/",$photo_path);

		$file_name 		=	$photo_path_tab[sizeof($photo_path_tab)-1];
		$base_dir 		=	str_replace($file_name, "", $photo_path);

		$file_name_tab	=	explode(".",$file_name);

		if(sizeof($file_name_tab) == 1 ){
			$ext			=	"";
		}else{
			$ext			=	$file_name_tab[sizeof($file_name_tab)-1];
		}

		$file_name_base	=	$file_name_tab[0];

		return array("base_dir" => $base_dir , "file_name" => $file_name , "file_name_base" => $file_name_base , "ext" => $ext  );

	}
	/**
	 * copie un fichier vers le répertoire par défaut d'un memberUser($memberUser)
	 *
	 * @param  memberUser $memberUser
	 * @param String $file_path
	 * @return array un tableau associatif
	 * @throws Exception s'il y a erreur de copie de fichier
	 */
	public static function copyFileToDefaultMemberUserDirectory($memberUser , $file_path){
		$fileInfos=ImagesTools::getFileInfos($file_path);
		$uploadDir = sfConfig::get ( 'app_inscription_sf_upload_dir' );
		$userDir = md5 ( $memberUser->getId () );
		$relativeDir = $uploadDir . $userDir;
		if (sfConfig::get ( 'app_inscription_use_web_dir' )) {
			$rootDir = sfConfig::get ( 'sf_web_dir' );
		}
		$abseluteDir=$rootDir.$relativeDir;;
		if (! is_dir ( $abseluteDir )) {
			mkdir ( $abseluteDir, 0777, true );
		}
		$destFilePath=$abseluteDir."/".$fileInfos['file_name'];
		if(!copy($file_path,$destFilePath)){
			throw new Exception("File copy faild : [".$file_path."] to [".$destFilePath."]");
		}
		else{
			if(!chmod($destFilePath, 0777))
			throw new Exception("File CHMOD Faild:[".$destFilePath."]");
		}
		return array($fileInfos['file_name'], $relativeDir."/",$destFilePath);
	}
	/**
	 * divise le nom du fichier en base et extension et retourne un tableau contenant [dirname][basename][extension]
	 *
	 * @param String $filename
	 * @return array
	 */
	public static function getSplittedFileNameAsArray($filename){
		$filename_tab=explode("/",$filename);
		$basefilename 		=	$filename_tab[sizeof($filename_tab)-1]; //hello.txt
		$filename_tab=explode(".",$basefilename);
		$extension = $filename_tab[sizeof($filename_tab)-1]; //.txt
		return array(dirname($filename)."/",substr(basename($basefilename,str_replace(".","",$extension)),0,strlen(basename($basefilename,str_replace(".","",$extension)))-1), $extension);
	}


	/**
	 * Permet de vérifier si une image peut tenir en mémoire
	 * Permet aussi le set=true d'augmenter la limite mémoire du serveur pour contenir les données
	 * Retour
	 *  true : si l'image peut être contenue en mémoire, true aussi si on augmente la mémoire utilisable
	 *  false : si l'image ne peut être lue en mémoire
	 */
	public static function getIfMemoryForImage($filename, $SetMemory)
	{
		$imageInfo = getimagesize($filename);
		$MB = 1048576;  // number of bytes in 1M
		$K64 = 65536;    // number of bytes in 64K
		$TWEAKFACTOR = 2;  // Facteur
		$memoryNeeded = round( ( $imageInfo[0] * $imageInfo[1]
		* $imageInfo['bits']
		* $imageInfo['channels'] / 8
		+ $K64
		) * $TWEAKFACTOR
		);
		//ini_get('memory_limit') only works if compiled with "--enable-memory-limit" also
		//Default memory limit is 8MB so well stick with that.
		//To find out what yours is, view your php.ini file.
		$memoryHave = memory_get_usage();
		$memoryLimitMB = (integer) ini_get('memory_limit');
		$memoryLimit = ini_get('memory_limit') * $MB;

		if ($memoryHave + $memoryNeeded > $memoryLimit)
		{
			//$newLimit = $memoryLimitMB + ceil( ( $memoryHave + $memoryNeeded - $memoryLimit) / $MB);
			$newLimit = $memoryLimitMB + ceil( (  $memoryNeeded ) / $MB);
			if($SetMemory)
			{
				ini_set( 'memory_limit', $newLimit . 'M' );
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			// Pas de réallocation mémoire
			return true;
		}
	}



	/**
	 * Transforms picture by adding a reflection, save new picture and return picture path
	 *
	 * @package    ImageTools
	 * @author	Belazar Mohamed
	 * @param int $id
	 * @param string $img_name Image name
	 * @param string $bgc      Background color
	 * @param int $height
	 * @param int $fade_start
	 * @param int $fade_end
	 * @param int $quality  Quality of the image created
	 * @return string : path of image with reflection
	 *
	 */
	public static function getImageReflection($id,$img_name,$bgc='ffffff',$height=NULL,$fade_start=NULL,$fade_end=NULL,$quality=90){

		$gallery_path  = self::getGalleryPath($id);
		$cache_path    = sfConfig::get('sf_web_dir').$gallery_path;
		$source_image  = $cache_path.$img_name;
		$source_image_no_reflection    = $gallery_path.$img_name;
		$source_image_cached_no_path   = $gallery_path.'/_reflection_'.$img_name;
		$source_image_cached_with_path = $cache_path.'/_reflection_'.$img_name;

		if (!file_exists($source_image))
		{
			return $source_image_no_reflection;
		}
		else {

			if (file_exists($source_image_cached_with_path))
			{
				return $source_image_cached_no_path;
			}else {
				//	bgc (the background colour used, defaults to black if not given)
				if (isset($bgc) == false)
				{
					$red = 0;
					$green = 0;
					$blue = 0;
				}
				else
				{
					//	Extract the hex colour
					$hex_bgc = $bgc;

					//	Does it start with a hash? If so then strip it
					$hex_bgc = str_replace('#', '', $hex_bgc);

					switch (strlen($hex_bgc))
					{
						case 6:
							$red = hexdec(substr($hex_bgc, 0, 2));
							$green = hexdec(substr($hex_bgc, 2, 2));
							$blue = hexdec(substr($hex_bgc, 4, 2));
							break;

						case 3:
							$red = substr($hex_bgc, 0, 1);
							$green = substr($hex_bgc, 1, 1);
							$blue = substr($hex_bgc, 2, 1);
							$red = hexdec($red . $red);
							$green = hexdec($green . $green);
							$blue = hexdec($blue . $blue);
							break;

						default:
							//	Wrong values passed, default to black
							$red = 0;
							$green = 0;
							$blue = 0;
					}
				}

				//	height (how tall should the reflection be?)
				if (isset($height))
				{
					$output_height = $height;

					//	Have they given us a percentage?
					if (substr($output_height, -1) == '%')
					{
						//	Yes, remove the % sign
						$output_height = (int) substr($output_height, 0, -1);

						//	Gotta love auto type casting ;)
						if ($output_height < 10)
						{
							$output_height = "0.0$output_height";
						}
						else
						{
							$output_height = "0.$output_height";
						}
					}
					else
					{
						$output_height = (int) $output_height;
					}
				}
				else
				{
					//	No height was given, so default to 50% of the source images height
					$output_height = 0.50;
				}

				if (isset($fade_start))
				{
					if (strpos($fade_start, '%') !== false)
					{
						$alpha_start = str_replace('%', '', $fade_start);
						$alpha_start = (int) (127 * $alpha_start / 100);
					}
					else
					{
						$alpha_start = (int) $fade_start;

						if ($alpha_start < 1 || $alpha_start > 127)
						{
							$alpha_start = 80;
						}
					}
				}
				else
				{
					$alpha_start = 80;
				}

				if (isset($fade_end))
				{
					if (strpos($fade_end, '%') !== false)
					{
						$alpha_end = str_replace('%', '', $fade_end);
						$alpha_end = (int) (127 * $alpha_end / 100);
					}
					else
					{
						$alpha_end = (int)$fade_end;

						if ($alpha_end < 1 || $alpha_end > 0)
						{
							$alpha_end = 0;
						}
					}
				}
				else
				{
					$alpha_end = 0;
				}


				/*
				 ----------------------------------------------------------------
				 Ok, let's do it ...
				 ----------------------------------------------------------------
				 */

				//	How big is the image?
				$image_details = getimagesize($source_image);

				if ($image_details === false)
				{
					echo 'Not a valid image supplied, or this script does not have permissions to access it.';
					exit();
				}
				else
				{
					$width = $image_details[0];
					$height = $image_details[1];
					$type = $image_details[2];
					$mime = $image_details['mime'];
				}

				//	Calculate the height of the output image
				if ($output_height < 1)
				{
					//	The output height is a percentage
					$new_height = $height * $output_height;
				}
				else
				{
					//	The output height is a fixed pixel value
					$new_height = $output_height;
				}

				//	Detect the source image format - only GIF, JPEG and PNG are supported. If you need more, extend this yourself.
				switch ($type)
				{
					case 1:
						//	GIF
						$source = imagecreatefromgif($source_image);
						break;

					case 2:
						//	JPG
						$source = imagecreatefromjpeg($source_image);
						break;

					case 3:
						//	PNG
						$source = imagecreatefrompng($source_image);
						break;

					default:
						echo 'Unsupported image file format.';
						exit();
				}


				/*
				 ----------------------------------------------------------------
				 Build the reflection image
				 ----------------------------------------------------------------
				 */

				//	We'll store the final reflection in $output. $buffer is for internal use.
				$output = imagecreatetruecolor($width, $new_height);
				$buffer = imagecreatetruecolor($width, $new_height);

				//	Copy the bottom-most part of the source image into the output
				imagecopy($output, $source, 0, 0, 0, $height - $new_height, $width, $new_height);

				//	Rotate and flip it (strip flip method)
				for ($y = 0; $y < $new_height; $y++)
				{
					imagecopy($buffer, $output, 0, $y, 0, $new_height - $y - 1, $width, 1);
				}

				$output = $buffer;

				/*
				 ----------------------------------------------------------------
				 Apply the fade effect
				 ----------------------------------------------------------------
				 */

				//	This is quite simple really. There are 127 available levels of alpha, so we just
				//	step-through the reflected image, drawing a box over the top, with a set alpha level.
				//	The end result? A cool fade into the background colour given.

				//	There are a maximum of 127 alpha fade steps we can use, so work out the alpha step rate

				$alpha_length = abs($alpha_start - $alpha_end);

				for ($y = 0; $y <= $new_height; $y++)
				{
					//  Get % of reflection height
					$pct = $y / $new_height;

					//  Get % of alpha
					if ($alpha_start > $alpha_end)
					{
						$alpha = (int) ($alpha_start - ($pct * $alpha_length));
					}
					else
					{
						$alpha = (int) ($alpha_start + ($pct * $alpha_length));
					}

					imagefilledrectangle($output, 0, $y, $width, $y, imagecolorallocatealpha($output, $red, $green, $blue, $alpha));

				}


				/*
				 ----------------------------------------------------------------
				 HACK - Build the reflection image by combining the source
				 image AND the reflection in one new image!
				 ----------------------------------------------------------------
				 */
				$finaloutput = imagecreatetruecolor($width, $height+$new_height);
				imagecopy($finaloutput, $source, 0, 0, 0, 0, $width, $height);
				imagecopy($finaloutput, $output, 0, $height, 0, 0, $width, $new_height);
				$output = $finaloutput;

				/*
				 ----------------------------------------------------------------
				 Output our final PNG
				 ----------------------------------------------------------------
				 */

				if ($quality < 1 || $quality > 100)
				{
					$quality = 90;
				}

				imagejpeg($output, $source_image_cached_with_path, $quality);

				return $source_image_cached_no_path;
			}
		}
	}

}
