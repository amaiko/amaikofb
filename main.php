<?php
/**
 * Application main page
 */
include('config.php');

$structInit = array(
	'app_id' => APP_ID,
	'app_name' => APP_NAME,
	'sec_key' => APP_SECKEY,
);
$FacebookAPP = new PHPforFB($structInit);

if($FacebookAPP->lastErrorCode>0){
	//Creation failed => Display error message and exit
	echo "PHPforFB Error: ".$FacebookAPP->lastErrorCode." -> ".$FacebookAPP->lastError;
	exit;
}
else{
	//If you want to offer a non-Facebook mode:
	if($FacebookAPP->callFromFacebook===FALSE){
		//None-Facebook
		echo "Please complete the code in nonfb.php to offer a non-Facebook version of your application.<br>";
		echo "<br>Alternatively, display an error at this point in index.php, explaining that this application is only available in Facebook.";
		$source = 'main';
		include('nonfb.php');
		exit;
	}
	else{
//The following section is needed for rendering a FBML form, for instance.
//We activate XFBML by calling $FacebookAPP->EnableXFBML().
//This should take place immediately after the opening body tag.
?>

<html xmlns="http://www.w3.org/1999/xhtml" >	
	<head>
	<title><?php echo ucfirst($FacebookAPP->appName); ?></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.3.0/build/cssreset/reset-min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="http://code.jquery.com/jquery-latest.js" type="text/javascript"></script>
	<script src="js/custom.js" type="text/javascript"></script>
	<script type="text/javascript">
$(document).ready(function(){
$('#tabs div').hide();
$('#tabs div:first').show();
$('#tabs ul li:first').addClass('active');
 
$('#tabs ul li a').click(function(){
$('#tabs ul li').removeClass('active');
$(this).parent().addClass('active');
var currentTab = $(this).attr('href');
$('#tabs div').hide();
$(currentTab).show();
return false;
});
});
	</script>
	</head>
	<body>
	<div id="main">
	<?php $FacebookAPP->EnableXFBML();?>
	<p style="display:none;">
	<?php
	//Main Vars
	$userData = $FacebookAPP->GetUserInfo();
	
	//Quotes On Design [json api]
	$json = file_get_contents("http://quotesondesign.com/api/3.0/api-3.0.json");
	$json = json_decode($json, TRUE);
	$quote = $json["quote"];
	$author = $json ["author"];

				//echo "<br /> -----------------------<br />";
//var_dump($userData);
			//$ama = $FacebookAPP->userID;
			//	$erg = $FacebookAPP->GetLikes('','','');
				//var_dump($ama);
				//var_dump($erg);
 				
		}
	}
	echo "</p>";
		
	?>
	<header>
	<p class="left">	
	  <img src="http://futuresystems-me.com/images/logo.png" alt="" />
	</p>
	<p class="user">	
		<a href="<?php echo $FacebookAPP->userData['link']; ?>" class="pimage">
		  <img src="<?php echo $FacebookAPP->userData["pictures"]['small']; ?>" alt="" />
		</a>
		<span>Welcome, <?php echo $FacebookAPP->userData['name']; ?></span>
		<br />
		<span><?php echo $FacebookAPP->userData["location"]['name']; ?></span>
	</p>
 	</header> 	
	<div id="tabs">
	<p class="shadow"></p>

   <ul>
     <li><a href="#tab-1">HOME</a></li>
     <li><a href="#tab-2">About US</a></li>
     <li><a href="#tab-3">Mail List</a></li>
     <li><a href="#tab-4">Design Quotes</a></li>
   </ul>
   <div id="tab-1">
     <br />
	 <section class="note">
	<img class="right" alt="RATE ME" src="http://futuresystems-me.com/rateme/public/images/rate-me-small.png">
	<h2>This is customized designs for you to share</h2>
	<p>
	Please, share these design with your friends to get their votes to help you decide what's better!
	Please, share these design with your friends to get their votes to help you decide what's better!
	Please, share these design with your friends to get their votes to help you decide what's better!
	</p>
	</section>
    <p class="shadow2"></p>
     <br />
     <p><img src="https://d2q0qd5iz04n9u.cloudfront.net/_ssl/proxy.php/http/eepurl.com/j-Sn1.qr.4" width="120" height="120" class="thumbs"/> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur enim. Nullam id ligula in nisl tincidunt feugiat. Curabitur eu magna porttitor ligula bibendum rhoncus. Etiam dignissim. Duis lobortis porta risus. Quisque velit metus, dignissim in, rhoncus at, congue quis, mi. Praesent vel lorem. Suspendisse ut dolor at justo tristique dapibus. Morbi erat mi, rutrum a, aliquam nec, mattis semper, leo. Maecenas blandit risus vitae quam. Vivamus ut odio. Pellentesque mollis arcu nec metus. Nullam bibendum scelerisque turpis. Aliquam erat volutpat. <br/>
     <a href="http://feeds2.feedburner.com/AshleyFord-Papermashupcom">Subscribe to my feed here</a> </p>
   </div>
   <div id="tab-2">
     <h3>About US</h3>
     <p><img src="http://papermashup.com/demos/jquery-gallery/images/t2.png" width="120" height="120" class="thumbs"/> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur enim. Nullam id ligula in nisl tincidunt feugiat. Curabitur eu magna porttitor ligula bibendum rhoncus. Etiam dignissim. Duis lobortis porta risus. Quisque velit metus, dignissim in, rhoncus at, congue quis, mi. Praesent vel lorem. Suspendisse ut dolor at justo tristique dapibus. Morbi erat mi, rutrum a, aliquam nec <br/>
       <a href="http://feeds2.feedburner.com/AshleyFord-Papermashupcom">Subscribe to my feed here</a></p>
   </div>
   <div id="tab-3">
     <h3>Subscribe to our mailing list</h3>
	 <br />
     <p id="mc_embed_signup">
		<!-- Begin MailChimp Signup Form -->
 		<form action="http://dev.us4.list-manage1.com/subscribe/post?u=2e4b50af01f9e710cf4a78c4f&amp;id=25006816fc" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
			<label for="mce-EMAIL">Subscribe:</label>
			<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required>
			 <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"> 
		</form>
 		<!--End mc_embed_signup-->
	 </p>
	 <br />
	 <p>* Subscribe now to get our latest offer and news and our monthly techno newsletter.</p>
   </div>
   <div id="tab-4">
     <h3>Random Quotes On Design</h3>
	 <?php echo "<p id='quotes'> {$quote}</p><span class='author'>{$author}</span>"; ?>
   </div>
  </div>

	</div>
	</body>
</html>