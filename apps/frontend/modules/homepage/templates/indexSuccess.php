<form id="SignInForm" name="SignInForm" action="<?php echo url_for('homepage/signin') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> >
	<input type="hidden" name="form_type" value="<?php echo get_class($form); ?>" />	

<?php echo $form->renderGlobalErrors(); ?>

<?php echo $form['username']->renderLabel(); ?>
<?php echo $form['username']->renderError(); ?>
<?php echo $form['username']->render(); ?><br/><br/>

<?php echo $form['password']->renderLabel(); ?>
<?php echo $form['password']->renderError(); ?>
<?php echo $form['password']->render(); ?><br/><br/>
<!-- Protection contre les remplissage automatique -->
<?php echo $form['_csrf_token']->render(); ?>
<input type="submit"  value="<?php echo __('VALIDATE_LOGIN', null, 'stepping');?>"><br/>
<a href="http://signup.artworks.com/fr/step0">signup !</a> or <a href="http://www.artworks.com/fr/passworddrecover">recover your password !</a>
</form>