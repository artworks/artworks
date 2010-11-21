
<form id="<?php echo get_class($form); ?>" name="<?php echo get_class($form); ?>" action="<?php echo url_for('@myprofile_update') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> >
	<input type="hidden" name="form_type" value="<?php echo get_class($form); ?>" />	
	<?php if (!$form->getObject()->isNew()): ?>
	<input type="hidden" name="sf_method" value="put" />
	<?php endif; ?>

<?php echo $form['password']->renderLabel(); ?>
<?php echo $form['password']->renderError(); ?>
<?php echo $form['password']->render(); ?><br/>


<?php echo $form['password_bis']->renderLabel(); ?>
<?php echo $form['password_bis']->renderError(); ?>
<?php echo $form['password_bis']->render(); ?><br/>

<input type="submit"  value="<?php echo __('VALIDATE_SUBSCRIPTION', null, 'stepping');?>">

<!-- Protection contre les remplissage automatique -->
<?php echo $form['_csrf_token']->render(); ?>
</form>




<?php include_partial("menu")?>

