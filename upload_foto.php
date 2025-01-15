<?php 
function upload_file($File){    
    $uploadOk = 1;
    $hasil = array();
    $message = '';

    //File properties:
    $FileName = $File['name'];
    $TmpLocation = $File['tmp_name'];
    $FileSize = $File['size'];

    //Figure out what kind of file this is:
    $FileExt = explode('.', $FileName);
    $FileExt = strtolower(end($FileExt));

    //Allowed files:
    $AllowedImages = array('jpg', 'png', 'gif', 'jpeg');  
    $AllowedVideos = array('mp4', 'avi', 'mov', 'mkv');
    $Allowed = array_merge($AllowedImages, $AllowedVideos);

    // Check file size based on type
    if (in_array($FileExt, $AllowedImages) && $FileSize > 5000000) {
        $message .= "Sorry, your image file is too large, max 5MB. ";
        $uploadOk = 0;
    } elseif (in_array($FileExt, $AllowedVideos) && $FileSize > 50000000) {
        $message .= "Sorry, your video file is too large, max 50MB. ";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if(!in_array($FileExt, $Allowed)){
        $message .= "Sorry, only JPG, JPEG, PNG, GIF, MP4, AVI, MOV & MKV files are allowed. ";
        $uploadOk = 0; 
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $message .= "Sorry, your file was not uploaded. ";
        $hasil['status'] = false; 
    } else {
        //Create new filename:
        $NewName = date("YmdHis"). '.' . $FileExt;
        $UploadDestination = (in_array($FileExt, $AllowedImages) ? "img/" : "video/") . $NewName; 

        if (move_uploaded_file($TmpLocation, $UploadDestination)) {
            $message .= "File uploaded successfully: " . $NewName;
            $hasil['status'] = true; 
        } else {
            $message .= "Sorry, there was an error uploading your file. ";
            $hasil['status'] = false; 
        }
    }
    
    $hasil['message'] = $message; 
    return $hasil;
}
?>
