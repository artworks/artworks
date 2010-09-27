<?php

/**
 * ArtworksPrices filter form base class.
 *
 * @package    artworks
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseArtworksPricesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'fkidcurrencyfromartworks' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Currency'), 'add_empty' => true)),
      'fkidartworksfromprices'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Artworks'), 'add_empty' => true)),
      'price'                    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'fkidcurrencyfromartworks' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Currency'), 'column' => 'idcurrency')),
      'fkidartworksfromprices'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Artworks'), 'column' => 'idartworks')),
      'price'                    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('artworks_prices_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ArtworksPrices';
  }

  public function getFields()
  {
    return array(
      'idartworks_prices'        => 'Number',
      'fkidcurrencyfromartworks' => 'ForeignKey',
      'fkidartworksfromprices'   => 'ForeignKey',
      'price'                    => 'Number',
    );
  }
}
