<?php 
      
      $connect = mysqli_connect("localhost", "root", "", "sotre");
      
      if(isset($_POST['updateUser'])) {
      $id = $_POST['id'];
      }

?>