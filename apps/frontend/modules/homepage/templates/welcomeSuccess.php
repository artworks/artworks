<div class="one-half">
<h1>Sign In</h1>
	    <div id="form-area">
	    		    <div id="form-fields">
<form id="<?php echo get_class($form)?>" name="<?php echo get_class($form)?>" action="<?php echo url_for('homepage/signin') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> >
	<input type="hidden" name="form_type" value="<?php echo get_class($form); ?>" />	

<div class="row">
<?php echo $form['username']->renderLabel(); ?>
</div>
<div class="row">
	<span class="data">		
<?php echo $form['username']->render(); ?>
	</span>
	<span class="verif">
<?php echo $form['username']->renderError(); ?>
	</span>
</div>

<div class="row">
<?php echo $form['password']->renderLabel(); ?>
</div>
<div class="row">
	<span class="data">		
<?php echo $form['password']->render(); ?>
	</span>
	<span class="verif">
<?php echo $form['password']->renderError(); ?>
	</span>
</div>

<div class="row">
	<span class="data">	               
<button type="submit"><?php echo __('I18N_VALIDATE', null, 'stepping');?></button>
	</span>
	<span class="verif">
	<!-- Protection contre les remplissage automatique -->
<?php echo $form['_csrf_token']->render(); ?>
	</span>
</div>
</form><!-- End Form -->	
  <div class="clearfix"></div>
<div class="note-box">
<?php echo link_to1(__('Forgot Your Password ? Recover It !'), "@homepage_password_recovery")?>
</div>
  <div class="clearfix"></div>
<?php echo $form->renderGlobalErrors(); ?>


					</div>			
		</div> 
</div>
<div class="one-half last">

      <!-- Begin Frame -->
    <h1>You Don't Have Account ?</h1>
    <div class="rect_area">  
    <h2>Do You Love Art ? Join US !</h2>
    <p>What Are U waiting For ? 5 minutes are enough to be official in Love With Art...</p>
        <p>What Are U waiting For ? 5 minutes are enough to be official in Love With Art...</p>
<div class="row">
	<a class="button" href="http://signup.artworks.com/fr/step0">Creer Ton Compte<span></span></a>
</div>
    </div>
      <!-- End Frame -->

</div>