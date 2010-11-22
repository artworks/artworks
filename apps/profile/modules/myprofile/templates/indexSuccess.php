<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="flash_notice"><?php echo $sf_user->getFlash('notice') ?></div>
<?php endif ?>

<div class="tabbed-content">
	<ul class="tabs">
		<li><a href="#tab1">Mon Compte</a></li>
		<li><a href="#tab2">Infos du Compte</a></li>
		<li><a href="#tab3">Carnet d'Adresses</a></li>
		<li><a href="#tab4">Selection</a></li>
		<li><a href="#tab5">Commandes</a></li>
		<li><a href="#tab6">Panier</a></li>
	</ul>
	
	<div class="tab_container">
	
		<div style="display: none;" id="tab1" class="tab_content">
<p>
Bonjour, <?php echo __('You are logged in')?> .
Vous pouvez
</p>
<?php echo link_to1(__('My profile'),'http://profile.artworks.com/dev.php/fr/')?>
<?php echo link_to1(__('Change my password'),'@myprofile_change_password')?>
<?php echo link_to1(__('Change my addresses'),'@myprofile_change_addresses')?>
<?php echo link_to1(__('logout'), "@myprofile_logout")?>
		</div>

		<div style="display: none;" id="tab2" class="tab_content">
	    		    <div id="form-fields">
<form id="<?php echo get_class($form); ?>" name="<?php echo get_class($form); ?>" action="<?php echo url_for('@myprofile_update') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> >
	<input type="hidden" name="form_type" value="<?php echo get_class($form); ?>" />	
	<?php if (!$form->getObject()->isNew()): ?>
	<input type="hidden" name="sf_method" value="put" />
	<?php endif; ?>

<div class="row">
<?php echo $form['company']->renderLabel(); ?>
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
<?php echo $form['email']->renderLabel(); ?>
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
<?php echo $form['surname']->renderLabel(); ?>
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
<?php echo $form['fkidgender']->renderLabel(); ?>
</div>
<div class="row">
	<span class="data">	
<?php echo $form['fkidgender']->render(); ?>
	</span>
	<span class="verif">
<?php echo $form['fkidgender']->renderError(); ?>
	</span>
</div>

<div class="row">
<?php echo $form['name']->renderLabel(); ?>
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
<?php echo $form['fkiddialing_codefromcustomers']->renderLabel(); ?>
	</span>
</div>
<div class="row">
	<span class="data">
<?php echo $form['fkiddialing_codefromcustomers']->render(); ?>
	</span>
	<span class="verif">
<?php echo $form['fkiddialing_codefromcustomers']->renderError(); ?>
	</span>
</div>

<div class="row">
<?php echo $form['phone']->renderLabel(); ?>
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
<input type="submit"  value="<?php echo __('VALIDATE_SUBSCRIPTION', null, 'stepping');?>">
</div>
<!-- Protection contre les remplissage automatique -->
<div class="row">
<?php echo $form['_csrf_token']->render(); ?>
</div>
</form>
					</div><!-- End FormField -->
		</div> 

		
		<div style="display: none;" id="tab3" class="tab_content">
		          <h3>CARNET D ADRESSES</h3> 
<p><img src="/img/804.jpg" alt="" class="thin right" />Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla facilisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc rhoncus tortor quis eros bibendum a tempus est dapibus. Vivamus consectetur quam eu tellus porttitor ultrices. Nunc metus massa, ullamcorper sit amet malesuada a, porttitor in tellus. Vestibulum ullamcorper quam nec lorem aliquam id feugiat risus tincidunt. </p> 


        </div> 

		
		<div style="display: none;" id="tab4" class="tab_content">
		          <h3>SELECTION OEUVRES</h3> 
<p><img src="/img/804.jpg" alt="" class="thin right" />Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla facilisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc rhoncus tortor quis eros bibendum a tempus est dapibus. Vivamus consectetur quam eu tellus porttitor ultrices. Nunc metus massa, ullamcorper sit amet malesuada a, porttitor in tellus. Vestibulum ullamcorper quam nec lorem aliquam id feugiat risus tincidunt. </p> 
        </div> 

		
		<div style="display: none;" id="tab5" class="tab_content">
		          <h3>COMMANDES</h3> 
<p>>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla facilisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc rhoncus tortor quis eros bibendum a tempus est dapibus. Vivamus consectetur quam eu tellus porttitor ultrices. Nunc metus massa, ullamcorper sit amet malesuada a, porttitor in tellus. Vestibulum ullamcorper quam nec lorem aliquam id feugiat risus tincidunt. </p>
	
	<div class="table">

<table id="commande">

	<thead>
<td>Date</td>
<td>Reference</td>
<td>Statut</td>
<td>Arworks</td>
<td>Montant</td>
<td></td>
	</thead>
<tr>
<td>15 nov 2010</td>
<td>Commande A</td>
<td>Expediee</td>
<td>4</td>
<td>780 Euros</td>
</tr>
<tr>

</table> 
																																																																																																																																																																																																																					
        </div> 
		
		<div style="display: none;" id="tab6" class="tab_content">
		          <h3>PANIER</h3> 
<p><img src="/img/804.jpg" alt="" class="thin right" />Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla facilisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc rhoncus tortor quis eros bibendum a tempus est dapibus. Vivamus consectetur quam eu tellus porttitor ultrices. Nunc metus massa, ullamcorper sit amet malesuada a, porttitor in tellus. Vestibulum ullamcorper quam nec lorem aliquam id feugiat risus tincidunt. </p> 
        </div> 
		
		<div style="display: none;" id="tab7" class="tab_content">
		          <h3>FUTURE CONTENT</h3> 
<p><img src="/img/804.jpg" alt="" class="thin right" />Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla facilisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc rhoncus tortor quis eros bibendum a tempus est dapibus. Vivamus consectetur quam eu tellus porttitor ultrices. Nunc metus massa, ullamcorper sit amet malesuada a, porttitor in tellus. Vestibulum ullamcorper quam nec lorem aliquam id feugiat risus tincidunt. </p> 
        </div> 
        
	</div>
</div>

</div>


