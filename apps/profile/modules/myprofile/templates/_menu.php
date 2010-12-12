<br/><br/>
<?php echo __('You are logged in')?><br/><br/>
<?php echo link_to1(__('My profile'),'http://profile.artworks.com/dev.php/fr/')?><br/>
<?php echo link_to1(__('Change my password'),'@myprofile_change_password')?><br/>
<?php echo link_to1(__('Change my addresses'),'@myprofile_change_addresses')?><br/>
<?php echo link_to1(__('My selections'),'@myselection_list')?><br/>
<?php echo link_to1(__('Home'),'http://www.artworks.com/dev.php/fr/')?><br/>
<?php echo link_to1(__('logout'), "@myprofile_logout")?>