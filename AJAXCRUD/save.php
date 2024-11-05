<?php
$servername = 'localhost';
$dbname = 'mydata';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM std";

    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = $_GET['search'];
        $sql = "SELECT * FROM std WHERE id = :search";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':search', $search, PDO::PARAM_INT);
        $stmt->execute();
    } else {
        $stmt = $conn->query($sql);
    }

    echo "<table border='1'><tr><th>ID</th><th>Name</th><th>Address</th><th>Actions</th></tr>";
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['address']}</td>
                <td>
                    <button class='edit' data-id='{$row['id']}'>Edit</button>
                    <button class='delete' data-id='{$row['id']}'>Delete</button>
                </td>
              </tr>";
    }
    echo "</table>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
