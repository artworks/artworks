<div class="two-third">
	    <div id="form-area2">
<h1>Signup Step 2</h1>
	    		    <div id="form-fields">
<form id="signup_form" name="signup_form" action="<?php echo url_for(($form->getObject()->isNew() ? '@stepping_create' : '@stepping_update')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> >
	<input type="hidden" name="form_type" value="<?php echo get_class($form); ?>" />	
	<?php if (!$form->getObject()->isNew()): ?>
	<input type="hidden" name="sf_method" value="put" />
	<?php endif; ?>


<div class="row">
<?php __('I18N_GENDER')?>
</div>

<div class="row">
<?php echo $form['fkidgenderfromprospect']->renderLabel(null, array('class' => 'label')); ?>
</div>
<div class="row">
	<span class="data">	
<?php echo $form['fkidgenderfromprospect']->render(); ?>
	</span>
	<span class="verif">
<?php echo $form['fkidgenderfromprospect']->renderError(); ?>
	</span>
</div>

<div class="row">
<?php echo $form['company']->renderLabel(null, array('class' => 'label')); ?>
</div>
<div class="row">
	<span class="data">	
<?php echo $form['company']->render(); ?>
	</span>
	<span class="verif">
<?php echo $form['company']->renderError(); ?>
	</span>
</div>

<div class="row">
<?php echo $form['name']->renderLabel(null, array('class' => 'label')); ?>
</div>
<div class="row">
	<span class="data">	
<?php echo $form['name']->render(); ?>
	</span>
	<span class="verif">
<?php echo $form['name']->renderError(); ?>
	</span>
</div>

<div class="row">
<?php echo $form['surname']->renderLabel(null, array('class' => 'label')); ?>
</div>
<div class="row">
	<span class="data">	
<?php echo $form['surname']->render(); ?>
	</span>
	<span class="verif">
<?php echo $form['surname']->renderError(); ?>
	</span>
</div>

<div class="row">
<?php echo $form['fkiddialing_codefromprospects']->renderLabel(null, array('class' => 'label')); ?>
</div>
<div class="row">
	<span class="data">	
<?php echo $form['fkiddialing_codefromprospects']->render(); ?>
	</span>
	<span class="verif">
<?php echo $form['fkiddialing_codefromprospects']->renderError(); ?>
	</span>
</div>

<div class="row">
<?php echo $form['phone']->renderLabel(null, array('class' => 'label')); ?>
</div>
<div class="row">
	<span class="data">	
<?php echo $form['phone']->render(); ?>
	</span>
	<span class="verif">
<?php echo $form['phone']->renderError(); ?>
	</span>
</div>

<div class="row">
<?php __('I18N_ADRESS')?>
</div>

<div class="row">
<?php __('I18N_COUNTRY')?>
</div>

<div class="row">
<?php echo $form['country']->renderLabel(null, array('class' => 'label')); ?>
</div>
<div class="row">
	<span class="data">	
<?php echo $form['country']->render(); ?>
	</span>
	<span class="verif">
<?php echo $form['country']->renderError(); ?>
	</span>
</div>

<div class="row">
<?php __('I18N_TOWN')?>
</div>

<div class="row">
<?php echo $form['town']->renderLabel(null, array('class' => 'label')); ?>
</div>
<div class="row">
	<span class="data">	
<?php echo $form['town']->render(); ?>
	</span>
	<span class="verif">
<?php echo $form['town']->renderError(); ?>
	</span>
</div>

<div class="row">
<?php __('I18N_COMPLETE ADDRESS')?>
</div>

<div class="row">
<?php echo $form['address']->renderLabel(null, array('class' => 'label')); ?>
</div>
<div class="row">
	<span class="data">	
<?php echo $form['address']->render(); ?>
	</span>
	<span class="verif">
<?php echo $form['address']->renderError(); ?>
	</span>
</div>

<div class="row">
<?php __('I18N_ADDRESS SUGGESTION')?>
</div>

<div class="row">
<?php echo $form['geo']->renderLabel(null, array('class' => 'label')); ?>
</div>
<div class="row">
	<span class="data">	
<?php echo $form['geo']->render(); ?>
	</span>
	<span class="verif">
<?php echo $form['geo']->renderError(); ?>
	</span>
</div>

<div class="row">
<button type="submit"><?php echo __('VALIDATE_SUBSCRIPTION', null, 'stepping');?></button>
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
    <div class="rect_area_small"> 
<h1>About Signup</h1>
<div class="toggle">
	<h2 class="trigger">Adress</h2>
		<div class="togglebox">
			<p>Informations sur l adresse Postale</p>
		</div>
			<h2 class="trigger">Geolocalisation</h2>
		<div class="togglebox">
			<p>Informations sur la geolocatisation</p>
		</div>
			<h2 class="trigger">Profil</h2>
		<div class="togglebox">
			<p>Une fois votre compte creee vous pourrez modifier ces informations et votre carnet d adresses postales</p>
		</div>
	</div>
</div>

</div>