<div class="error" id="error"  >
<h1>Votre session a expir&#233;</h1>
<p>
Par mesure de s&#233;curit&#233; votre session a expir&#233;e. Si vous &#233;tiez en cours d'inscription veuillez entrer votre adresse email pour recevoir un lien vous permettant de continuer votre inscription :

</p>
<br/>
<form id="error3000" name="error3000" action="<?php echo url_for("@errors_send_recovery_form") ?> " method="post" >
<div class="colonneUn">
	<fieldset >
	<?php echo $form['email']->renderLabel(); ?>
	<?php echo $form['email']->render(); ?>
	<?php echo $form['email']->renderError(); ?>
	</fieldset>
</div>
<div class="colonneDeux">
	<input class="submit" type="image" value="" src="http://inscription.attractiveworld.net/images/aw_inscription_bouton_poursuivre.gif">
</div>
<div class="clear"></div>
<br/>
<p><?php if (isset($MessageResult)){ echo($MessageResult);} ?></p>
<br/>
<p><?php echo link_to('Revenir &#224; l\'accueil', '@homepage', array('title' => 'Revenir &#224; l\'accueil')); ?></p>
 
</div>
