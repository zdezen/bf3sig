<?php 

  include "global.php"; 

    header('Content-Type: image/png');
    
	/*
	* Font Files Directory
	*
	*/
	
	if(!defined('fontDir')){define('fontDir', "fonts/");}
	
	/*
	* Background Image Directory
	*
	*/
	
	if(!defined('imgDir')){define('imgDir', "images/");}
	
	/*
	* Rank Image Dir
	*
	*/
	
	if(!defined('rankDir')){define('rankDir', "public/");}

	@$name = $soldier["name"];
	@$kills = $soldier["kills"];
	@$deaths = $soldier["deaths"];
	@$fkd = $kills / $deaths;
	@$kdratio = substr($fkd, 0, 4); 
	@$score = $soldier["score"];
	@$rank = $soldier["rank"];

    /*
	* Player ID Number
	*
	*/

	@$pid = is_numeric($_GET["pid"]);
	
	/*
	* Select Background 
	*
	*/
	
	@$bg = $_GET["bg"];
	
	/* 
    * Select Army
	* 1-> US
	* 2-> RU
    *
	*/
	
	@$army = is_numeric($_GET["army"]);
	
	/* 
    * Select Kit
	* 1-> Assault
	* 2-> Engineer
	* 3-> Recon
	* 4-> Sniper
    *
	*/
	
	@$kit = is_numeric($_GET["kit"]); 
	
	/* if($pid != "" & $bg != "" & $bg != "" & $army != "") { */
	
	/* 
    * Background Control
    *
	*/
	
	if($bg < 2) {
	
	switch ($bg) {

        case '1':

         $bg = imgDir.'signature.png';

         break;

        case '2':

         $bg = imgDir.'signature.png';

         break;
	 
		case '': /* Empty Value */
		 
		 $bg = imgDir.'signature.png';
		 
		 break;

  }
  
  } else { echo $bg = imgDir.'signature.png'; }
  
  /*
  * Army Control
  *
  */
   
   if($army < 2) { 
   
   switch($army) {
   
        case '1':
		
         $army = 'us';

         break;
		
		case '2':
		
		 $army = 'ru';
		
		 break;
		 
		case '': /* Empty Value */
        
		 $army = 'us';
		 
		 break;

  }
  
  } else { $army = 'us'; }
   
   if ($kit < 4) {
   
   switch($kit) {
   
		case '1':
		$kit = 'assault';
		break;
		case '2':	
		$kit = 'engineer';	
		break;	
		case '3':		
		$kit = 'recon';		
		break;
		case '4':
		$kit = 'support';
		break;
		case '': /* Empty Value */ 
		$kit = 'assault';
		break;
		
	} 
   } else { $kit = 'assault'; }
	
	$kitResimi = BattlelogUtils::getKitImage('engineer', $army, 'medium');

	$arkap = imgDir.'/signature.png';
		 
	$res = @imagecreatefrompng("$arkap");

	$font = fontDir."Sansation_Regular.ttf";
	
	$font1 = fontDir."arial.ttf";

	$white = imagecolorallocate($res, 22, 22, 22);
	
	$wShadow = imagecolorallocate($res, 255, 255, 255);
	$gri = imagecolorallocate($res, 22, 22, 22);

	$rank_r ="public/".$rank.'.png';

	$rnk = imagecreatefrompng($rank_r);

	imagecopyresampled($res, $rnk, 0, -2, 0, 0, 35, 35, 64, 64);
	$cank_r = $kitResimi;

	$cnk = imagecreatefrompng($cank_r);

	imagecopyresampled($res, $cnk, 10, 0, 0, 0, 100, 100, 100, 100);

	if ($kdratio > 1.00) {

	 $kdcolor = imagecolorallocate($res, 0, 255, 20);

	} else {

	 $kdcolor = imagecolorallocate($res, 255, 0, 0);

	}

	imagettftext($res, 16, 0, 61, 24, $wShadow, $font, $name);
	
	imagettftext($res, 8, 0, 91, 46, $wShadow, $font, "Öldurme:");

	imagettftext($res, 8, 0, 162, 46, $wShadow, $font, $kills);

	imagettftext($res, 8, 0, 91, 60, $wShadow, $font, "Ölüm:");

	imagettftext($res, 8, 0, 145, 60, $wShadow, $font, $deaths );

	imagettftext($res, 8, 0, 91, 74, $wShadow, $font, "K/D:");
	
	imagettftext($res, 8, 0, 118, 73, $kdcolor, $font, $kdratio);
	
	imagepng($res);

?>
