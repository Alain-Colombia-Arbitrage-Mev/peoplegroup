<?php 

function test () {
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "oxigeno";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Conexión exitosa a la base de datos<br>";

        $query = "SELECT * FROM users_binaries";
        $stmt = $conn->query($query);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Imprimir los registros
        // foreach ($rows as $row) {
        //     echo "ID: " . $row['id'] . "<br>";
        //     echo "Username: " . $row['username'] . "<br>";
        //     echo "email: " . $row['email'] . "<br>";
        //     echo "parent: " . $row['parent'] . "<br>";
        //     echo "position: " . $row['position'] . "<br>";
            
        //     // Imprimir los demás campos...
        //     echo "<br>";
        // }
    } catch (PDOException $e) {
        echo "Error al conectar a la base de datos: " . $e->getMessage();
    }

    $conn = null;

    return  json_encode(['status'=> true, 'data' => $rows]);
}

header('Content-Type: application/json; charset=utf-8');
echo test();