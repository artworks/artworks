<?php
class sfRequestHostRoute extends sfRequestRoute
{
  
 
  public function generate($params, $context = array(), $absolute = false)
  {
    $url = parent::generate($params, $context, $absolute);
 
    if (
      isset($this->requirements['sf_host'])
      &&
      $this->requirements['sf_host'] != $context['host']
    )
    {
      // apply the required host
      $protocol = $context['is_secure'] ? 'https' : 'http';
      $url = $protocol.'://'.$this->requirements['sf_host'].sfConfig::get('app_project_domain').$url;
    }
 
    return $url;
  }
}