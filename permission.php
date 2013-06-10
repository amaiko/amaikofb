<?php
/**
 * This file prompts the user for basic permissions.
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
	//Make sure that we are really called through Facebook.
	if($FacebookAPP->callFromFacebook===FALSE || $FacebookAPP->userLoggedIn === FALSE){
		//This visitor is wrong here and will be sent to the starting page of the application.
		header('location: index.php');
		exit;
	}
	else{
		//Query basic permissions.
		
		echo "<p style='color:#cecece;font-size:50px;text-align:center;margin:200px;'>Loading.......</p>";
		echo "<p style='display:none;'>";
		$FacebookAPP->ForcePermissions('basic');
		echo "</p>";
		
		if(($res = $FacebookAPP->ForcePermissions('basic')) === FALSE){
			//An error occurred when querying the permissions
			echo "PHPforFB Error: ".$FacebookAPP->lastErrorCode." -> ".$FacebookAPP->lastError;
			exit;
		}else{
			//Evaluate the result
			if($res==0){
				//The user declined.
				echo  '<p style="color:#FF0000;font-size:25px;text-align:center;">Please Give ' . ucfirst($FacebookAPP->appName) . ' app the permission to access your profile to make it work<br />
				<a href="permission.php?show=whypermission">Next >></a><br></p>
				';
			}else{
				//The user accepted to grant permissions to the application.
				header('location: main.php');
				//echo 'Here in permission.php we can decide what should happen when the user has granted permissions to the application.<br>
				//E.g. we can send him to a page for entering some data or selecting from a set of predefined choices.<br>
			}
		}
	}
}
?>