<!-- pagina history.php-->
<?php
session_start();

// Verifique se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Conecte-se ao banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "magiamistica";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Obtenha o ID do usuário da sessão
$usuario_id = $_SESSION['usuario_id'];

// Consulta para obter o histórico de compras do usuário
$sql = "SELECT * FROM pedidos WHERE usuario_id = '$usuario_id'";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Compras</title>
    <link rel="stylesheet" href="../CSS/stylehistory.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="products.php">Produtos</a></li>
                <li><a href="cart.php">Carrinho</a></li>
                <li><a href="history.php">Histórico de Compras</a></li>
                <li><a href="nivel.php">Nivel Mágico</a></li>
                <li><a href="sair.php">Sair</a></li>
            </ul>
        </nav>
    </header>

    <main class="history">
        <h2>Histórico de Compras</h2>
        <table>
            <thead>
                <tr>
                    <th>Número do Pedido</th>
                    <th>Data do Pedido</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Verifique se há resultados da consulta
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['pedido_id'] . "</td>";
                        echo "<td>" . $row['data_pedido'] . "</td>";
                        echo "<td>" . $row['total'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Nenhum histórico de compras encontrado.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </main>

    <footer>
        &copy; 2023 MagiaMística
    </footer>
</body>

</html>