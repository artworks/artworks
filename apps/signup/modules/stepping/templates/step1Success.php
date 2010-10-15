<form id="signup_form" name="signup_form" action="<?php echo url_for(($form->getObject()->isNew() ? '@stepping_create' : '@stepping_update')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> >
	<input type="hidden" name="form_type" value="<?php echo get_class($form); ?>" />	
	<?php if (!$form->getObject()->isNew()): ?>
	<input type="hidden" name="sf_method" value="put" />
	<?php endif; ?>


<?php __('I18N_GENDER')?><br/>
<?php echo $form['fkidgenderfromprospect']->renderLabel(); ?>
<?php echo $form['fkidgenderfromprospect']->renderError(); ?>
<?php echo $form['fkidgenderfromprospect']->render(); ?><br/><br/>

<?php echo $form['company']->renderLabel(); ?>
<?php echo $form['company']->renderError(); ?>
<?php echo $form['company']->render(); ?><br/>

<?php echo $form['name']->renderLabel(); ?>
<?php echo $form['name']->renderError(); ?>
<?php echo $form['name']->render(); ?><br/>

<?php echo $form['surname']->renderLabel(); ?>
<?php echo $form['surname']->renderError(); ?>
<?php echo $form['surname']->render(); ?><br/>


<?php echo $form['fkiddialing_codefromprospects']->renderLabel(); ?>
<?php echo $form['fkiddialing_codefromprospects']->renderError(); ?>
<?php echo $form['fkiddialing_codefromprospects']->render(); ?><br/>

<?php echo $form['phone']->renderLabel(); ?>
<?php echo $form['phone']->renderError(); ?>
<?php echo $form['phone']->render(); ?><br/>

<?php __('I18N_ADRESS')?><br/>

<?php __('I18N_COUNTRY')?><br/>
<?php echo $form['country']->renderLabel(); ?>
<?php echo $form['country']->renderError(); ?>
<?php echo $form['country']->render(); ?><br/><br/>

<?php __('I18N_TOWN')?><br/>
<?php echo $form['town']->renderLabel(); ?>
<?php echo $form['town']->renderError(); ?>
<?php echo $form['town']->render(); ?>

<?php __('I18N_COMPLETE ADDRESS')?><br/>
<?php echo $form['address']->renderLabel(); ?>
<?php echo $form['address']->renderError(); ?>
<?php echo $form['address']->render(); ?>

 <br/><br/>
<?php __('I18N_ADDRESS SUGGESTION')?><br/>
<?php echo $form['geo']->renderLabel(); ?>
<?php echo $form['geo']->renderError(); ?>
<?php echo $form['geo']->render(); ?><br/><br/>


<br/>

<input type="submit"  value="<?php echo __('VALIDATE_SUBSCRIPTION', null, 'stepping');?>">

<!-- Protection contre les remplissage automatique -->
<?php echo $form['_csrf_token']->render(); ?>
</form>