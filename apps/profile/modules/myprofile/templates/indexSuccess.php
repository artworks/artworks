<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="flash_notice"><?php echo $sf_user->getFlash('notice') ?></div><br/><br/>
<?php endif ?>


<form id="<?php echo get_class($form); ?>" name="<?php echo get_class($form); ?>" action="<?php echo url_for('@myprofile_update') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> >
	<input type="hidden" name="form_type" value="<?php echo get_class($form); ?>" />	
	<?php if (!$form->getObject()->isNew()): ?>
	<input type="hidden" name="sf_method" value="put" />
	<?php endif; ?>

<?php echo $form['company']->renderLabel(); ?>
<?php echo $form['company']->renderError(); ?>
<?php echo $form['company']->render(); ?><br/>


<?php echo $form['email']->renderLabel(); ?>
<?php echo $form['email']->renderError(); ?>
<?php echo $form['email']->render(); ?><br/>


<?php echo $form['surname']->renderLabel(); ?>
<?php echo $form['surname']->renderError(); ?>
<?php echo $form['surname']->render(); ?><br/>

<?php echo $form['fkidgender']->renderLabel(); ?>
<?php echo $form['fkidgender']->renderError(); ?>
<?php echo $form['fkidgender']->render(); ?><br/>

<?php echo $form['name']->renderLabel(); ?>
<?php echo $form['name']->renderError(); ?>
<?php echo $form['name']->render(); ?><br/>


<?php echo $form['fkiddialing_codefromcustomers']->renderLabel(); ?>
<?php echo $form['fkiddialing_codefromcustomers']->renderError(); ?>
<?php echo $form['fkiddialing_codefromcustomers']->render(); ?><br/>

<?php echo $form['phone']->renderLabel(); ?>
<?php echo $form['phone']->renderError(); ?>
<?php echo $form['phone']->render(); ?><br/>

<input type="submit"  value="<?php echo __('VALIDATE_SUBSCRIPTION', null, 'stepping');?>">

<!-- Protection contre les remplissage automatique -->
<?php echo $form['_csrf_token']->render(); ?>
</form>



<br/><br/>
<?php echo __('You are logged in')?><br/><br/>
<?php echo link_to1(__('My profile'),'http://profile.artworks.com/dev.php/fr/')?><br/>
<?php echo link_to1(__('Change my password'),'@myprofile_change_password')?><br/>
<?php echo link_to1(__('Change my addresses'),'@myprofile_change_addresses')?><br/>
<?php echo link_to1(__('logout'), "@myprofile_logout")?>

