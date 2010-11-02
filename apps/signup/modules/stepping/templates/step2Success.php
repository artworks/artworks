<div class="two-third">
<h2>Signup Last Step : Choose Your Password</h2>
	    <div id="form-area2">
	    		    <div id="form-fields">
<form id="signup_form" name="signup_form" action="<?php echo url_for(($form->getObject()->isNew() ? '@stepping_create' : '@stepping_update')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> >
	<input type="hidden" name="form_type" value="<?php echo get_class($form); ?>" />	
	<?php if (!$form->getObject()->isNew()): ?>
	<input type="hidden" name="sf_method" value="put" />
	<?php endif; ?>

<div class="row">
<?php echo $form['password']->renderLabel(); ?>
</div>
<div class="row">
<?php echo $form['password']->render(); ?>
</div>

<div class="row">
<?php echo $form['password_bis']->renderLabel(); ?>
</div>
<div class="row">
<?php echo $form['password_bis']->render(); ?>
</div>

<div class="row">
<button type="submit"><?php echo __('VALIDATE_SUBSCRIPTION', null, 'stepping');?></button>
</div>

<div class="row">
<?php echo $form['password']->renderError(); ?>
<?php echo $form['password_bis']->renderError(); ?>
</div>
<div class="row">
<!-- Protection contre les remplissage automatique -->
<?php echo $form['_csrf_token']->render(); ?>
</div>
</form>
					</div>	
			</div>	

</div>
<div class="one-third last">


</div>