<?php

if(session_id() == '') {
	session_start();
}

if ( !empty( $_FILES ) ) {

    $tempPath = $_FILES[ 'file' ][ 'tmp_name' ];
	
	$path_info = pathinfo($_FILES[ 'file' ][ 'name' ]);

	$ext = $path_info['extension'];
	
	//$filename = $_FILES[ 'file' ][ 'name' ];
	$filename = 'emp_'.date("d_m_Y").'.'.$ext;

	$answer	 = array();

	echo $uploadPath = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'public/uploads' . DIRECTORY_SEPARATOR . $filename;
	
   $x = move_uploaded_file( $tempPath, $uploadPath );

	$answer ['answer'] = 'File transfer completed!';
    $json = json_encode( $answer );

    echo $json;

} else {
    echo 'No files';
}

?>