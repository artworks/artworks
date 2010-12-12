
<fieldset style="float:left;margin:10px;">
<h1>My basket</h1>

<h2>Photos</h2>
<?php foreach ($photos as $photo):?>

<?php echo link_to($photo->getArtworks()->getDescription(),'@sfGlobalPlugin_artwork_view?idartworks='.$photo->getArtworks()->getIdartworks()) ?><br/>
<?php echo link_to1(__('delete from my selection'), "@sfGlobalPlugin_myselection_delete_from_selection?idartworks=".$photo->getArtworks()->getIdartworks()."&basket_status=1",array('class' => 'delete-from-selection'))?><br/>
price  : <?php echo $photo->getArtworks()->getPrice();?> <br/><br/>
<?php endforeach; ?>

<h2>Pictures</h2>
<?php foreach ($pictures as $picture):?>

<?php echo link_to($picture->getArtworks()->getDescription(),'@sfGlobalPlugin_artwork_view?idartworks='.$picture->getArtworks()->getIdartworks()) ?><br/>
<?php echo link_to1(__('delete from my selection'), "@sfGlobalPlugin_myselection_delete_from_selection?idartworks=".$picture->getArtworks()->getIdartworks()."&basket_status=1",array('class' => 'delete-from-selection'))?><br/>
price  : <?php echo $picture->getSomme();?> EUR<br/><br/>
<?php endforeach; ?>

estimated total price :  
<br/><br/>
<?php echo link_to('begin checkout','http://lol')?>

</fieldset>

