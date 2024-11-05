<?php
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "mydata";
 try {
     $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 $id = $_POST['id']; 
 $sql = "SELECT * FROM std WHERE id = :id";
 $stmt = $conn->prepare($sql);
 $stmt->bindParam(':id',$id);
 $stmt->execute();
 $user = $stmt->fetch(PDO::FETCH_ASSOC);

 echo json_encode($user);
 } catch(PDOException $e) {
     echo "Error: " . $e->getMessage();
}
$conn = null;


