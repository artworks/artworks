<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>

  </head>
  <body>
<!-- Begin Top Bar -->
<div id="top-bar">
  <div id="top-bar-light"></div>
  	<div class="top-bar-content">
  	
      		<div class="login">
    	
    	<ul class="links">
          <li><a href="http://signup.artworks.com/fr/">Sign Up</a></li>
          <li><a href="http://www.artworks.com/fr/signin">Sign In</a></li>
          <li><?php echo link_to1(__('My Profile'),'http://profile.artworks.com/dev.php/fr/')?></li>
          <li><a href="#">Favorites</a></li>
          <li><a href="#">Panier</a></li>
          <li><?php echo link_to1(__('Logout'), "@homepage_logout")?></li>
		</ul>      			
			</div><!-- End login --> 
		   
      		<div class="choice">
        <ul class="links">
          <li><a href="#">Country</a></li>		
          <li><a href="#">Devise</a></li>
		</ul>
			</div><!-- End choice --> 

      		<div class="search">
    	<div class="searchbox">
      			<form method="get" id="searchform" action="">
        			<input type="text" value="" name="s" id="s" class="searchbar" />
        			<button type="submit">Search</button>
      			</form>
		</div><!-- End searchbox --> 
  			</div><!-- End search --> 
  			
  	</div>
  </div>
</div>
<!-- End Top Bar -->

<!-- Begin Header -->
<div id="header">
  <!-- Begin Logo -->
  <div id="logo"><a href="#"><img src="/images/LOGO_TEMP.png" alt="Art-Love-You.com" /></a></div>
  <!-- End Logo -->
  
  <!-- Begin Menu -->
  <div id="menu">
    <div id="smoothmenu1" class="ddsmoothmenu">
      <ul>
        <li><a href="#" class="current">Home</a></li>
        <li><a href="#">Our Company</a>
          <ul>
            <li><a href="#">Philosophy</a></li>
            <li><a href="#">Team</a></li>
            <li><a href="#">Services</a>
            </li>
          </ul>
        </li>
        <li><a href="#">Services</a>
          <ul>
            <li><a href="#">Do U Love Art ?</a>
              <ul>
                <li><a href="#">Buy Art</a></li>
                <li><a href="#">Lease Art</a></li>
                <li><a href="#">Create Art</a></li>
                <li><a href="#">Learn Art</a></li>
                <li><a href="#">Art Communication</a></li>
              </ul>
            <li><a href="#">Are U An Artist ?</a>
              <ul>
                <li><a href="#">Full Backoffice</a></li>
                <li><a href="#">Marketing</a></li>
                <li><a href="#">Personal Website</a></li>
              </ul>
            <li><a href="#">Webdesign</a></li>
          </ul>
        </li>
        <li><a href="#">Artworks</a>
          <ul>
            <li><a href="#">By Artists</a></li>
            <li><a href="#">By Collections</a></li>
            <li><a href="#">By Themes</a>
              <ul>
            <li><a href="#">Landscapes</a></li>
            <li><a href="#">Portraits</a></li>
            <li><a href="#">Abstract</a></li>
            <li><a href="#">Sculptures</a></li>
            <li><a href="#">Photos</a></li>
            <li><a href="#">Others</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li><a href="#">Contact</a></li>
      </ul>
      <span></span> </div>
  </div>
  <div class="clearfix"></div>
</div><!-- End Menu -->
<!-- End Header -->

<!-- Begin Container -->
<div id="container">
    <?php echo $sf_content ?>
</div>
<!--End Container -->

<!-- Begin Footer --> 
<div id="footer">
  <div class="footer-content">
    
<div class="one-third">
        <h2 class="recentposts">Art Blog You</h2>
        <ul class="bullet">
          <li><a href="#">Duis id tellus at eros tempor imper.</a></li>
          <li><a href="#">Aenean ligula nisl, fermentum vel lobortis id, scelerisque at lorem.</a></li>
          <li><a href="#">Suspendisse nec neque ut nunc rhoncus sodales.</a></li>
          <li><a href="#">Duis id Nam pulvinar faucibus dui.</a></li>
        </ul>    
</div>
      
<div class="one-third">

		<h2 class="tags">Newsletter</h2>
		<p>Join Our Newsletter</p>
      		<div class="newsletter">
      			<form method="get" id="newsletter" action="">     			
        			<input type="text" value="Your E-Mail Adress" class="newsletterbar" />
        			<button type="submit">Join</button>
      			</form>
  			</div>
        
          <div class="clearfix"></div>  
		<p></p> 
		         
        <h2 class="tags">Tags</h2>
        <ul class="tags">
          <li><a href="#">Art</a></li>
          <li><a href="#">Artworks</a></li>
          <li><a href="#">Artistes</a></li>
          <li><a href="#">Exhibition</a></li>
          <li><a href="#">Photography</a></li>
          <li><a href="#">Web Design</a></li>
          <li><a href="#">Illustration</a></li>
        </ul>

        
</div>


    
<div class="one-third last">
		<h2 class="tags">Contact US</h2>
  <div class="information">
    <ul class="contact-info">
      <li class="home">Lorem Avenue Ipsum Street No:11/21</li>
      <li class="tel">+66 555 - 444 33 22</li>
      <li class="mail"><a href="#">Formulaire de Contact</a></li>
    </ul>
  </div>
  
</div>

  		
      </div><!--End Footer Content -->
    </div><!--End Footer -->
<!-- #Footer --> 


<!-- Begin Footer Bottom -->
<div id="footer-bottom">
	<div id="footer-bottom-light"></div>
  		<div class="footer-bottom-content">
  
        		<div class="copyright">
      <p>&copy; Copyright 2010 Art Love You. All Rights Reserved.</p>   			
				</div><!-- End copyright --> 

      		<div class="partner">

<a href="#"><img src="/images/visa-curved-32px.png" alt="VISA" /></a>
<a href="#"><img src="/images/mastercard-curved-32px.png" alt="Mastercard" /></a>
<a href="#"><img src="/images/american-express-curved-32px.png" alt="American Express" /></a>


			</div><!-- End Partner --> 
					
      		<div class="social">
<a href="#"><img src="/images/social1.png" alt="Facebook" /></a> <a href="#"><img src="/images/social6.png" alt="RSS" /></a>
			</div><!-- End social --> 
			
		</div>
	</div>
</div>
<!-- End Footer Bottom --> 

</body>
</html>