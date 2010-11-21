<?php 
class globalPluginRouting
{
  static public function listenToRoutingLoadConfigurationEvent(sfEvent $event)
  {
    $routing = $event->getSubject();
    // add plug-in routing rules on top of the existing ones
    //$routing->prependRoute('global_route', new sfRoute('/my_plugin/:action', array('module' => 'myPluginAdministrationInterface')));
  }
}
?>