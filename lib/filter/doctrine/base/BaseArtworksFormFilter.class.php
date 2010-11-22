<?php

/**
 * Artworks filter form base class.
 *
 * @package    artworks
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseArtworksFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'fkidartists'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Artists'), 'add_empty' => true)),
      'fkidartwork_style' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ArtworkStyle'), 'add_empty' => true)),
      'fkidartwork_type'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ArtworkType'), 'add_empty' => true)),
      'description'       => new sfWidgetFormFilterInput(),
      'photo'             => new sfWidgetFormFilterInput(),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'fkidartists'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Artists'), 'column' => 'idartists')),
      'fkidartwork_style' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ArtworkStyle'), 'column' => 'idartwork_style')),
      'fkidartwork_type'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ArtworkType'), 'column' => 'idartwork_type')),
      'description'       => new sfValidatorPass(array('required' => false)),
      'photo'             => new sfValidatorPass(array('required' => false)),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('artworks_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Artworks';
  }

  public function getFields()
  {
    return array(
      'idartworks'        => 'Number',
      'fkidartists'       => 'ForeignKey',
      'fkidartwork_style' => 'ForeignKey',
      'fkidartwork_type'  => 'ForeignKey',
      'description'       => 'Text',
      'photo'             => 'Text',
      'updated_at'        => 'Date',
      'created_at'        => 'Date',
    );
  }
}
