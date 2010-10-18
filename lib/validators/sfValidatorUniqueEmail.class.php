<?php
class sfValidatorUniqueEmail extends sfValidatorDoctrineUnique
{
	
	protected function configure($options = array(), $messages = array())
	{
		/* unique error messages */
		$this->addMessage('unique', 'I18N_NOT_UNIQUE_EMAIL');
		
		/* let's use the parent configure() to keep file validator configure() */    
		parent::configure($options, $messages);
	}

	
	protected function doClean($values)
	{
	
		
		if($isUnique = Doctrine::getTable('Subscribers')->isUniqueEmail($values)){			
		//	$error = new sfValidatorError($this, 'unique', array('column' => implode(', ', $this->getOption('column'))));
		$error = new sfValidatorError($this, 'unique');
		throw new  sfValidatorErrorSchema($this, array('unique'=>$error));
		
		}
		
		parent::doClean($values);
		return $values;
	}


}

