<?php

// The Model handles the data and business logic

class Model {
    private $data;
    private $db;

    public function __construct() {
        // Initialize the data
        $this->data = array();
        $this->db = $_SESSION['db'];
    }

    public function add_article($data,$image) {
       return $this->db->query("INSERT INTO `articles` (`id`, `image`, `title`, `date`, `content`) 
            VALUES (NULL, '".$image."', '".$data['title']."', '".date("Y-m-d")."','".$data['content']."' )");   
    }
    public function update_article($data,$image) {
        if($image == "") {
            return $this->db->query("UPDATE `articles` SET 
            `title` = '".$data['update_title']."', 
            `content` =  '".$data['update_content']."' 
            WHERE `articles`.`id` = ".$data['update_id'].";
            ");  
        }else{
            return $this->db->query("UPDATE `articles` SET
            `image` = '".$image."', 
            `title` = '".$data['update_title']."', 
            `content` =  '".$data['update_content']."' 
            WHERE `articles`.`id` = ".$data['update_id'].";
            ");   
        }
     }
    
    public function list(){
        $sql = $this->db->query("SELECT * FROM articles");
        $results = array();
        
       
        if($sql->num_rows == 0) {
            return false;
        }else {
            while($row = $sql->fetch_assoc()) {
                $results[] = $row;
            }
            return json_encode($results);
        }
    }
    public function get($id){
        $sql = $this->db->query("SELECT * FROM articles WHERE id = $id"); 
        $results = array();
        if($sql->num_rows == 0) {
            return false;
        }else {
            while($row = $sql->fetch_assoc()) {
                $results[] = $row;
            }
            return json_encode($results);
        }
     
    }
    public function get_by_date($date){
        $sql = $this->db->query("SELECT * FROM articles WHERE date = '".$date."'"); 
        $results = array();
        if($sql->num_rows == 0) {
            return false;
        }else {
            while($row = $sql->fetch_assoc()) {
                $results[] = $row;
            }
            return json_encode($results);
        }
     
    }
    public function delete($data){
        return $this->db->query("DELETE FROM articles WHERE id = ".$data['id'].""); 
    }
}

?>
