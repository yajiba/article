<?php
require_once 'config.php';
require_once 'model/model.php';
require_once 'views/view.php';
require_once 'controller/controller.php';
$model = new Model();
$view = new View();
$controller = new Controller($model, $view);

 if(isset($_POST['title'])){
    $response = $controller->add_article($_POST);
   
    if($response) {
        echo json_encode(array('status' => 'success','message' =>"Article successfully added."));
    }else {
        echo json_encode(array('status' => 'failed','message' =>"Error while inserting article."));
    }
   
    
} 
if(isset($_POST['update_title'])){
    $response = $controller->update_article($_POST);
    if($response) {
        echo json_encode(array('status' => 'success','message' =>"Article successfully updated."));
    }else {
        echo json_encode(array('status' => 'failed','message' =>"Error while updating article."));
    }  
}
if(isset($_POST['id'])){
    $response = $controller->delete_article($_POST);
    if($response) {
        echo json_encode(array('status' => 'success','message' =>"Article successfully deleted."));
    }else {
        echo json_encode(array('status' => 'failed','message' =>"Error while deleting article."));
    }  
}
if(isset($_POST['date'])){
    $response = $controller->send_mail($_POST);
    if($response == 1) {
        echo json_encode(array('status' => 'success','message' =>"Article successfully sent."));
    }else {
        echo json_encode(array('status' => 'failed','message' =>"Error while sending article."));
    }  
}
?>