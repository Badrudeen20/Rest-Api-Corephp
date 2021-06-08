<?php
   header('Access-Control-Allow-Origin: *');
   header('Content-Type:Application/Json');


   include_once '../config/db.php';
   include_once '../model/model.php';
   

 $database = new Database();
 $db = $database->connect();


 $post = new Post($db);

  $result = $post->read();
  $num = $result->rowCount();

  if($num > 0){
       $data_arr = array();
       while($row = $result->fetch(PDO::FETCH_ASSOC)){
             extract($row);
             $data_item = array(
                 'id' =>$id,
                 'name'=>$name,
                 'price' =>$price,
                 'dish'=>$dish
             );
             array_push($data_arr,$data_item);
       }
       echo json_encode($data_arr);

  }else{
    echo json_encode(
        array('message' => 'No Data Found')
      );
  }

 ?>