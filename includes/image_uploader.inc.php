<?php
        
	/*
	if($form==1) {
	    $pic=$_FILES['mov_pic'];  
	    $img_path="img/mov/";
	    
	} else if ($form==2) {
	    $pic=$_FILES['peo_pic'];  
	    $img_path="img/peo/";
	    
	}
    //sen kan du göra allt som i if-satserna nedan
	*/
	
	
    function image_uploader () {
	// Filuppladdningen
	$allowedExts=array("gif","jpeg","jpg","png");
	
	
	if (isset($_POST['mov_title'])) {
	    
	    $temp = explode(".", $_FILES["mov_pic"]["name"]);
	    $extension = end($temp);
	    
	    // Bara bildfiler under 1mb ska gå att ladda upp
	    if ((($_FILES['mov_pic']['type']=="image/png")
	    || ($_FILES['mov_pic']['type']=="image/jpg")
	    || ($_FILES['mov_pic']['type']=="image/jpeg")
	    || ($_FILES['mov_pic']['type']=="image/gif"))
	    && ($_FILES['mov_pic']['size']<1048576)
	    && in_array($extension, $allowedExts)) {
		
		// Bilderna ska till rätt plats tror jag måste göra såhär:
		$source=$_FILES['mov_pic']['tmp_name']; // Den tillfälliga temp-mappen där filen först hamnar.
		$filename=$_FILES['mov_pic']['name']; // Filnamnet
		
		// Destinationen
		$imgPath="img/mov/";
		
		$destination= $imgPath . pathinfo($_FILES['mov_pic']['tmp_name'], PATHINFO_BASENAME) . "." . $extension;
		//echo "<br>" . $destination . "<br>";
	    }
		
	} elseif (isset($_POST['peo_firstname'])) {
	    
	    $temp = explode(".", $_FILES["peo_pic"]["name"]);
	    $extension = end($temp);
	    
	    // Bara bildfiler under 1mb ska gå att ladda upp
	    if ((($_FILES['peo_pic']['type']=="image/png")
	    || ($_FILES['peo_pic']['type']=="image/jpg")
	    || ($_FILES['peo_pic']['type']=="image/jpeg")
	    || ($_FILES['peo_pic']['type']=="image/gif"))
	    && ($_FILES['peo_pic']['size']<1048576)
	    && in_array($extension, $allowedExts)) {
		
		// Bilderna ska till rätt plats tror jag måste göra såhär:
		$source=$_FILES['peo_pic']['tmp_name']; // Den tillfälliga temp-mappen där filen först hamnar.
		$filename=$_FILES['peo_pic']['name']; // Filnamnet
		
		// Destinationen
		$imgPath="img/peo/";
		
		$destination= $imgPath . pathinfo($_FILES['peo_pic']['tmp_name'], PATHINFO_BASENAME) . "." . $extension;
		
	    }
	}
	
	move_uploaded_file($source, $destination);
	//$files=scandir($imgPath); // Listar filerna innuti mappen Behövs denna?
	
        return $destination;
	
        }//*********************************** END OF FUNCTION ********************************
	
    
     
?>
