<?php include_component("components","menu")?>
<?php include_component("components","basket")?>

<h1>Artwork</h1>

description
<?php  echo $artwork->getDescription(); ?>

<br/>
price
<?php  echo $artwork->getPrice(); ?>
<br/><br/>
 
<?php echo link_to1(__('add to selection'), "@artwork_add_to_selection?idartworks=".$artwork->getIdartworks()."&bastket_status=1",array('id' => 'addToSelection'))?>
<br/>
<?php echo link_to1(__('retour'), "@homepage")?>