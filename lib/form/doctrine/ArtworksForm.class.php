<?php

/**
 * Artworks form.
 *
 * @package    artworks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ArtworksForm extends BaseArtworksForm
{
	public function configure()
	{
		unset($this['created_at'], $this['updated_at'], $this['idartworks']);
		$this->embedRelation('ArtworksPrices');

		if($this->object->idartworks && !count($this->object->getArtworksPrices()) ) {
			$artworksPricesForm  = new ArtworksPricesForm();
			$artworksPricesForm->setDefault('fkidartworksfromprices', $this->object->idartworks);
			$this->embedForm('new',$artworksPricesForm );
		}

		   $this->widgetSchema['photo'] = new sfWidgetFormInputFileEditable(array(
      'label'     => 'Company logo',
      'file_src'  => sfConfig::get( 'sf_web_dir' ).DIRECTORY_SEPARATOR.ImagesTools::getGalleryPath( $this->getObject()->getIdartworks() ).$this->getObject()->getPhoto(),
      'is_image'  => true,
      'edit_mode' => !$this->isNew(),
      'template'  => '<div>%file%<br />%input%<br />%delete% %delete_label%</div>',
    ));
 
    $this->validatorSchema['photo_delete'] = new sfValidatorPass();
		
	}


}
