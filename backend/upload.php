<?php
$valid_extensions = array('jpeg', 'jpg','png'); 

    if ( 0 < $_FILES['image']['error'] ) {
        echo 'Error: ' . $_FILES['image']['error'] . '<br>';
    }
    else {
       
        $code=mt_rand(10,100000);/* rename the file name*/
        $size= $_FILES['image']['size'];
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        if($size > 2097152) /*2 mb 1024*1024 bytes*/
        {
            echo json_encode(array("statusCode"=>400,'msg'=>"Image allowd less than 2 mb"));
        }
        else if(!in_array($ext, $valid_extensions)) {
            echo json_encode(array("statusCode"=>400,'msg'=>$ext.' not allowed'));
        }
        else{
           
            $result = move_uploaded_file($_FILES['image']['tmp_name'], '../backend/Upload/' . $code.'.'.$ext);
            echo json_encode(array("statusCode"=>200 ,'code'=>$code));
        }
        
    }
?>
    