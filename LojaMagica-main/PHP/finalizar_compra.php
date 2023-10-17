<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "magiamistica";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if (isset($_POST['finalizar_compra'])) {
    $usuario_id = $_SESSION['usuario_id'];
    $data_pedido = date('Y-m-d H:i:s');
    $produtos = $_SESSION['carrinho'];
    $total = 0;

    foreach ($produtos as $produto) {
        $total += $produto['preco'];
    }

    // Verificar se o usuário atingiu 2 ou mais compras
    $verificar_compras = "SELECT COUNT(*) as total_compras FROM pedidos WHERE usuario_id = '$usuario_id'";
    $result_compras = $conn->query($verificar_compras);

    if ($result_compras->num_rows == 1) {
        $row = $result_compras->fetch_assoc();
        $total_compras = $row['total_compras'];

        if ($total_compras >= 2) {
            // Verificar se o usuário não atingiu o nível máximo (nível 7)
            $verificar_nivel = "SELECT nivel_magico FROM usuarios WHERE usuario_id = '$usuario_id'";
            $result_nivel = $conn->query($verificar_nivel);

            if ($result_nivel->num_rows == 1) {
                $row_nivel = $result_nivel->fetch_assoc();
                $nivel_magico = $row_nivel['nivel_magico'];

                if ($nivel_magico < 7) {
                    // Aumentar o nível mágico
                    $atualizar_nivel = "UPDATE usuarios SET nivel_magico = nivel_magico + 1 WHERE usuario_id = '$usuario_id'";
                    $conn->query($atualizar_nivel);

                    // Resetar a contagem de compras
                    $resetar_compras = "DELETE FROM pedidos WHERE usuario_id = '$usuario_id'";
                    $conn->query($resetar_compras);
                }
            }
        }
    }

    $sql_pedido = "INSERT INTO pedidos (usuario_id, data_pedido, total) VALUES ('$usuario_id', '$data_pedido', '$total')";

    if ($conn->query($sql_pedido) === TRUE) {
        $pedido_id = $conn->insert_id;

        foreach ($produtos as $produto) {
            $produto_id = $produto['produto_id'];
            $preco = $produto['preco'];
            $quantidade = 1;

            $sql_item = "INSERT INTO itenspedido (pedido_id, produto_id, quantidade, preco_unitario) VALUES ('$pedido_id', '$produto_id', '$quantidade', '$preco')";
            $conn->query($sql_item);
        }

        unset($_SESSION['carrinho']);

        header("Location: history.php");
    } else {
        echo "Erro ao finalizar compra: " . $conn->error;
    }
} else {
    header("Location: cart.php");
}

$conn->close();
