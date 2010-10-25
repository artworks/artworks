<?php

/**
 * ArtworksPrices form base class.
 *
 * @method ArtworksPrices getObject() Returns the current form's model object
 *
 * @package    artworks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseArtworksPricesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idartworks_prices'        => new sfWidgetFormInputHidden(),
      'fkidcurrencyfromartworks' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Currency'), 'add_empty' => true)),
      'fkidartworksfromprices'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Artworks'), 'add_empty' => true)),
      'price'                    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'idartworks_prices'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idartworks_prices')), 'empty_value' => $this->getObject()->get('idartworks_prices'), 'required' => false)),
      'fkidcurrencyfromartworks' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Currency'), 'required' => false)),
      'fkidartworksfromprices'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Artworks'), 'required' => false)),
      'price'                    => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('artworks_prices[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ArtworksPrices';
  }

}
