<?php

if(session_id() == '') {
	session_start();
}

function convertImage($originalImage, $outputImage, $quality)
{
    // jpg, png, gif or bmp?
    $exploded = explode('.',$originalImage);
    $ext = $exploded[count($exploded) - 1]; 

    if (preg_match('/jpg|jpeg/i',$ext))
        $imageTmp=imagecreatefromjpeg($originalImage);
    else if (preg_match('/png/i',$ext))
        $imageTmp=imagecreatefrompng($originalImage);
    else if (preg_match('/gif/i',$ext))
        $imageTmp=imagecreatefromgif($originalImage);
    else if (preg_match('/bmp/i',$ext))
        $imageTmp=imagecreatefrombmp($originalImage);
    else
        return 0;

    // quality is a value from 0 (worst) to 100 (best)
    imagejpeg($imageTmp, $outputImage, $quality);
    imagedestroy($imageTmp);

    return 1;
}

if ( !empty( $_FILES ) ) {

    $tempPath = $_FILES[ 'file' ][ 'tmp_name' ];
	
	$path_info = pathinfo($_FILES[ 'file' ][ 'name' ]);

	$ext = $path_info['extension'];
	
	if($_REQUEST['uid'] != 0){
		$filename = $_REQUEST['uid'] . '.' . $ext;
	}else{
		$filename = $_FILES[ 'file' ][ 'name' ];
	}

	$answer	 = array();

	echo $uploadPath = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'public/uploads/avatar' . DIRECTORY_SEPARATOR . $filename;
	
   $x = move_uploaded_file( $tempPath, $uploadPath );

	
	/*$x = convertImage($originalImage, $outputImage, 80);
	$exploded = explode('.',$originalImage);
	$ext = $exploded[count($exploded) - 1]; 
	if (!preg_match('/jpg|jpeg/i',$ext)){unlink($uploadPath);}*/
	
   // $answer = array( 'answer' => 'File transfer completed','uploadPath'=>$uploadPath );
   
	$answer ['answer'] = 'File transfer completed';
    $json = json_encode( $answer );

    echo $json;

} else {
    echo 'No files';
}

?>