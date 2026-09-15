<?php
include "conexao.php";

$titulo = $_GET["titulo"] ?? ""; 
$status = $_GET["status"] ?? "Todos"; 

$sql = "SELECT * FROM chamados
        WHERE titulo LIKE '%$titulo%'";

        if ($status != "Todos") {
            $sql .= " AND status = '$status'"; 
        
        }

        $resultado = $conn->query($sql); 

        if ($resultado->num_rows > 0) {
            while ($chamado = $resultado->fetch_assoc()) {
                echo "Código: " .$chamado["id"] . "<br>"; 
                echo "Título: " .$chamado["titulo"] . "<br>"; 
                echo "Solicitantes: " .$chamado["nome"] . "<br>";
                echo "Setor: " .$chamado["setor"] . "<br>"; 
                echo "Prioridade: " .$chamado["prioridade"] . "<br";
                echo "Status: " .$chamado["status"] . "<br>"; 
                echo "Data: " .$chamado["data_hora"] . "<br>";
                echo "<hr>";
            }

        } else {
            echo "Nenhum chamado encontrado";
        }

        $conn->close(); 

?> 