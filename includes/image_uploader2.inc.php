<?php
	
    function image_uploader2 () {
	
        //if($form == 1) {
	    $pic=$_FILES['mov_pic'];  
	    $img_path="img/mov/";
            
	//} else if ($form == 2) {
	    //$pic=$_FILES['peo_pic'];  
	    //$img_path="img/peo/";
	    
	//}
        
        // Filuppladdningen
	$allowedExts=array("gif","jpeg","jpg","png");
	
	$temp = explode(".", $pic["name"]);
	$extension = end($temp);
	    
	    // Bara bildfiler under 1mb ska gå att ladda upp
	    if ((($pic['type']=="image/png")
	    || ($pic['type']=="image/jpg")
	    || ($pic['type']=="image/jpeg")
	    || ($pic['type']=="image/gif"))
	    && ($pic['size']<1048576)
	    && in_array($extension, $allowedExts)) {
		
		// Bilderna ska till rätt plats tror jag måste göra såhär:
		$source=$pic['tmp_name']; // Den tillfälliga temp-mappen där filen först hamnar.
		$filename=$pic['name']; // Filnamnet
		
		// Destinationen
		
		$destination= $imgPath . pathinfo($pic['tmp_name'], PATHINFO_BASENAME) . "." . $extension;
		//echo "<br>" . $destination . "<br>";
	    }
	
	move_uploaded_file($source, $destination);
	
        return $destination;
	
        }//*********************************** END OF FUNCTION ********************************
	
    
     
?>
