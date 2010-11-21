<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="flash_notice"><?php echo $sf_user->getFlash('notice') ?></div><br/><br/>
<?php endif ?>
<form id="<?php echo get_class($form); ?>" name="<?php echo get_class($form); ?>" action="<?php echo url_for('@myprofile_add_address') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> >
	<input type="hidden" name="form_type" value="<?php echo get_class($form); ?>" />	
	

<h1><?php echo __('I18N_ADDRESS_ADD')?></h1><br/>

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
 
<h1><?php echo __('I18N_BILLING_ADDRESS')?></h1>
<?php if($addressInfos=$customer->getBillingsAddress()):?>
<form id="BillingsAddress" name="BillingsAddress" action="<?php echo url_for('@myprofile_update') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> >
<input type="hidden" name="address" value="<?php echo $addressInfos['idcustomers_address_list'];?>" />
<?php echo $addressInfos['address'];?><br/>
<a href="#" class="discard-billing-address"><?php echo __('I18N_DISCARD_BILLINGS_ADDRESS');?></a><br/><br/>
<?php endif;?>


<h1><?php echo __('I18N_DELIVERY_ADDRESS')?></h1>
<?php if($addressInfos=$customer->getDeliveryAddress()):?>
<form id="DeliveryAddress" name="DeliveryAddress" action="<?php echo url_for('@myprofile_update') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> >
<input type="hidden" name="address" value="<?php echo $addressInfos['idcustomers_address_list'];?>" />
<?php echo $addressInfos['address'];?><br/>
<a href="#" class="discard-delivery-address"><?php echo __('I18N_DISCARD_DELIVERY_ADDRESS');?></a><br/>
<br/><br/>
<?php endif;?>



<h1><?php echo __('I18N_ADDRESS_LIST')?></h1>

<?php foreach($customer->getAllMyAddresses() as $idcustomers_address_list => $address ):?>
<form id="AllMyAddresses" name="<?php echo get_class($form); ?>" action="<?php echo url_for('@myprofile_update') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> >
	<input type="hidden" name="form_type" value="AllMyAddresses" />
	<input type="hidden" name="address" value="<?php echo $idcustomers_address_list?>" />
		
<br/>
<?php echo $address;?><br/>
<a href="#" class="delete-address"><?php echo __('I18N_DELETE_ADDRESS');?></a><br/>
<a href="#" class="make-billing-address"><?php echo __('I18N_MAKE_BILLINGS_ADDRESS');?></a><br/>
<a href="#" class="make-delivery-address"><?php echo __('I18N_MAKE_DELIVERY_ADDRESS');?></a><br/>

</form>
<?php endforeach;?>

<?php include_partial("menu")?>




