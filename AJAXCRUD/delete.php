<?php
$servername='localhost';
$username='root';
$password='';
$dbname='mydata';

try{
    $conn=new PDO("mysql:host=$servarname;dbname=$dbname",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 
    $id=$_POST['id'];
    $sql="DELETE FROM std WHERE id=:id";
    $stmt=$conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}catch(PDOException $e){
    echo "Error" . $e->getMessage();
}
$conn=null;



