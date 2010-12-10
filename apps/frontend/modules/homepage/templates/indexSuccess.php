<?php echo __('You are logged in')?><br/><br/>
<?php echo link_to1(__('My profile'),'http://profile.artworks.com/dev.php/fr/')?><br/>
<?php echo link_to1(__('logout'), "@homepage_logout")?>

<h1>Artworks</h1>


<h2>Photos</h2>
<?php foreach ($photos as $photo):?>
<?php echo $photo->getDescription()?><br/>
<?php endforeach; ?>

<h2>Pictures</h2>
<?php foreach ($pictures as $picture):?>
<?php echo $picture->getDescription()?><br/>
<?php endforeach; ?>