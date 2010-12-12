<?php include_component("components","menu")?>
<?php include_component("components","basket")?>
<br/><br/>
<fieldset>
<h1>Artworks</h1>


<h2>Photos</h2>
<?php foreach ($photos as $photo):?>
<?php echo link_to($photo->getDescription(),'@artwork_view?idartworks='.$photo->getIdartworks()) ?><br/>
<?php endforeach; ?>

<h2>Pictures</h2>
<?php foreach ($pictures as $picture):?>
<?php echo link_to($picture->getDescription(),'@artwork_view?idartworks='.$picture->getIdartworks()) ?><br/>
<?php endforeach; ?>
</fieldset>