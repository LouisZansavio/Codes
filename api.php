<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $name = $data['username'];
    $profession = $data['profession'];
    $age = $data['age']; 
    $gender = $data['gender']; 
    
    $sql = "INSERT INTO users (username, profession, age, gender) VALUES ('$name', '$profession', '$age', '$gender')";
    
    if ($conn->query($sql) === TRUE) {
        http_response_code(201);
        echo json_encode(['message' => 'Registro criado com sucesso']);
        die();
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Erro ao criar registro: ' . $conn->error]);
        die();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    if (isset($_GET["id"])){
        $id = $_GET["id"];
        $sql = "SELECT * FROM users WHERE id=$id";
    }else {
        $sql = "SELECT * FROM users";
    }    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        http_response_code(200);
        echo json_encode($data);
    } else {
        http_response_code(404);
        echo json_encode(['message' => 'Nenhum registro encontrado']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $_GET['id'];
    $username = $data['username'];
    $profession = $data['profession'];
    $age = $data['age']; 
    $gender = $data['gender']; 
    
    $sql = "UPDATE users SET username='$username', profession='$profession', age='$age', gender='$gender' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['message' => 'Registro editado com sucesso']);
        http_response_code(200);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Erro ao editar registro: ' . $conn->error]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
   
    $id = $_GET['id'];
    
    $sql = "DELETE FROM users WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        http_response_code(200);
        echo json_encode(['message' => 'Registro excluído com sucesso']);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Erro ao excluir registro: ' . $conn->error]);
    }
} else {
    http_response_code(405); 
    echo json_encode(['error' => 'Método não permitido']);
}
die();
$conn->close();
?>