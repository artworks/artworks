<?php

/**
 * ArtworksPrices form.
 *
 * @package    artworks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ArtworksPricesForm extends BaseArtworksPricesForm
{
  public function configure()
  {
  	$this->widgetSchema['fkidartworksfromprices'] = new sfWidgetFormInputHidden ();		
  	
  }
}
