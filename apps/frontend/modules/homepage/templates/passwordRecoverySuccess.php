<form id="<?php echo get_class($form)?>" name="<?php echo get_class($form)?>" action="<?php echo url_for('@homepage_send_credentials') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> >
	<input type="hidden" name="form_type" value="<?php echo get_class($form); ?>" />	

<?php echo $form->renderGlobalErrors(); ?>

<?php echo $form['email']->renderLabel(); ?>
<?php echo $form['email']->renderError(); ?>
<?php echo $form['email']->render(); ?><br/><br/>

<!-- Protection contre les remplissage automatique -->
<?php echo $form['_csrf_token']->render(); ?>
<input type="submit"  value="<?php echo __('I18N_VALIDATE', null, 'stepping');?>"><br/>
<?php echo link_to1(__('homepage'), "@homepage_index")?>
</form>