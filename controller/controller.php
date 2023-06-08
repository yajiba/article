<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 
require 'vendor/autoload.php';
class Controller {
    private $model;
    private $view;

    public function __construct($model, $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function pageRequest() {
        $page = 'home';
        $data = null;
        if(isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        $data = $this->model->list();
        $this->view->render($page,$data);
    }
   

    public function add_article($post){
        $target_dir = "views/uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $filename =  basename($_FILES["fileToUpload"]["name"]);
        $uploaded = false;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $response = "";
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
           $uploaded = true;
           $response = $this->model->add_article($post,$filename);
        } else {
            $response = "Failed";
        }
        return $response;
    }
    public function update_article($post){
        $response = "";
        $filename = "";
        $filesize = $_FILES['update_fileToUpload']['size'];
        if($filesize != 0) {
            $target_dir = "views/uploads/";
            $target_file = $target_dir . basename($_FILES["update_fileToUpload"]["name"]);
            $filename =  basename($_FILES["update_fileToUpload"]["name"]);
            $uploaded = false;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            if (move_uploaded_file($_FILES["update_fileToUpload"]["tmp_name"], $target_file)) {
                $uploaded = true;
                $response = $this->model->update_article($post,$filename);
             }else {
                $response = "Failed";
             }
        }else {
            $response = $this->model->update_article($post,$filename);
        }
        return $response;
    }
    public function delete_article($post){
     
        return $this->model->delete($post);
       
    }


    public function send_mail($data) {
        $mail = new PHPMailer(true);
        $response = 0;
        $articles = json_decode($this->model->get_by_date($data['date']));
        try {
            $mail->SMTPDebug = 0;                                 
            $mail->isSMTP();                                           
            $mail->Host       = 'smtp.gmail.com';                   
            $mail->SMTPAuth   = true;                            
            $mail->Username   = 'emailaddress';                
            $mail->Password   = 'secret';                       
            $mail->SMTPSecure = 'tls';                             
            $mail->Port       = 587; 
         
            $mail->setFrom('rogenewebdev@gmail.com', 'Article Test');          
            $mail->addAddress($data['recipient']);
              
            $mail->isHTML(true);                                 
            $mail->Subject = 'Article for '.date('F j, Y', strtotime($data['date']));
            $mail->Body    = "";
            
            foreach($articles as $row) {
                $mail->Body .="<h3>".$row->title."</h3>";
                $mail->Body .="<p>".date('F j, Y', strtotime($data['date']))."</p><br/>";
                $mail->Body .="<img width='150px' height='150px' src='http://localhost/article/views/uploads/".$row->image."' style='border-radius:10px'/><br/>";
                $mail->Body .="<p>".$row->content."</p>";
                $mail->Body .="<hr/>";
            }
            $mail->send();
            $response = 1 ;
        } catch (Exception $e) {
            $response = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        return $response;
         
    }

}

?>