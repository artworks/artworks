<div class="one-half">
    <div class="rect_area">  
      <h1>Creer un compte</h1>
    <h2>Do You Love Art ? Join US !</h2>
    <p>Comment ca se fonctionne ? Vous creez un compte. Vous devenez membre et vous pouvez : consulter le prix de nos oeuvres, gerer ta propre selection, ton carnet d adresses, acheter des oeuvres simplement, rapidement et sur notre site totalement securise.</p>
	<p>Tu peux automatiquement participer a notre Magazine d'Art.</p>    
<div class="note-box">
Tu as deja un compte ? <a href="http://www.artworks.com/fr/signin">Connecte-Toi</a>
</div>		
    </div>

</div>
<div class="one-half last">
	    <div id="form-area">
	 <div id="form-fields">
		<h1>Etape 1</h1>
<form id="signup_form" name="signup_form" action="<?php echo url_for(($form->getObject()->isNew() ? '@stepping_create' : '@stepping_update')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> >
	<input type="hidden" name="form_type" value="<?php echo get_class($form); ?>" />	
	<?php if (!$form->getObject()->isNew()): ?>
	<input type="hidden" name="sf_method" value="put" />
	<?php endif; ?>
 
<div class="row">
	<span class="label">	
<?php echo $form['email']->renderLabel(null, array()); ?>
	</span>
</div>
<div class="row">
	<span class="data">		
<?php echo $form['email']->render(); ?>
	</span>
	<span class="verif">
<?php echo $form['email']->renderError(); ?>
	</span>
</div>

<div class="row">
	<span class="data">	
<button type="submit"><?php echo __('VALIDATE_SUBSCRIPTION', null, 'stepping');?></button>
	</span>
	<span class="verif">
<!-- Protection contre les remplissage automatique -->
<?php echo $form['_csrf_token']->render(); ?>
	</span>
</div>
</form><!-- End Form -->	
    <div class="clearfix"></div>
<div class="info-box">
This E-Mail will be your future login. U will have to check your mailbox to complete your register.
If You don"t get our E-Mail in a few minute, check your spam box and add us on your adressbook.
</div>	
					</div>	
		</div> 
	
</div>
