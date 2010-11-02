
<form id="<?php echo get_class($form); ?>" name="<?php echo get_class($form); ?>" action="<?php echo url_for('@myprofile_update') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> >
	<input type="hidden" name="form_type" value="<?php echo get_class($form); ?>" />	
	

<?php echo __('I18N_ADDRESS')?><br/>

<?php echo __('I18N_COUNTRY')?><br/>
<?php echo $form['country']->renderLabel(); ?>
<?php echo $form['country']->renderError(); ?>
<?php echo $form['country']->render(); ?><br/><br/>

<?php echo __('I18N_TOWN')?><br/>
<?php echo $form['town']->renderLabel(); ?>
<?php echo $form['town']->renderError(); ?>
<?php echo $form['town']->render(); ?>
 <br/><br/>
<?php echo __('I18N_COMPLETE ADDRESS')?><br/>
<?php echo $form['address']->renderLabel(); ?>
<?php echo $form['address']->renderError(); ?>
<?php echo $form['address']->render(); ?>

 <br/><br/>
<?php echo __('I18N_ADDRESS SUGGESTION')?><br/>
<?php echo $form['geo']->renderLabel(); ?>
<?php echo $form['geo']->renderError(); ?>
<?php echo $form['geo']->render(); ?><br/><br/>

	
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

