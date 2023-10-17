<?php
session_start();

// Verifique se a sessão carrinho existe e se há produtos no carrinho
if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
    $carrinho = $_SESSION['carrinho'];
} else {
    $carrinho = array(); // Inicialize como um array vazio se não houver produtos no carrinho
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="../CSS/stylecart.css">
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

    <main class="cart">
        <h2>Carrinho de Compras</h2>
        <?php if (!empty($carrinho)) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Preço Unitário</th>
                        <th>Quantidade</th>
                        <th>Subtotal</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0; // Inicialize o total

                    foreach ($carrinho as $key => $produto) {
                        // Exibir informações do produto
                        echo '<tr>';
                        echo '<td>' . $produto['nome'] . '</td>';
                        echo '<td>$' . $produto['preco'] . '</td>';
                        echo '<td>';
                        echo '<form method="post" action="atualizar_quantidade.php">';
                        echo '<input type="hidden" name="produto_key" value="' . $key . '">';
                        echo '<button type="submit" class="seta" name="action" value="diminuir">-</button>';
                        echo '<span class="quantidade">' . (isset($produto['quantidade']) ? $produto['quantidade'] : 1) . '</span>';
                        echo '<button type="submit" class="seta" name="action" value="aumentar">+</button>';
                        echo '</form>';
                        echo '</td>';
                        $quantidade = isset($produto['quantidade']) ? $produto['quantidade'] : 1;
                        $subtotal = $produto['preco'] * $quantidade;
                        echo '<td>$' . $subtotal . '</td>';
                        echo '<td><form method="post" action="remover_do_carrinho.php"><input type="hidden" name="produto_key" value="' . $key . '"><button type="submit" class="remover">Remover</button></form></td>';
                        echo '</tr>';

                        $total += $subtotal; // Atualize o total
                    }
                    ?>

                </tbody>
            </table>
            <div class="total">
                <?php
                echo '<p>Total: $' . $total . '</p>';
                ?>
            </div>
            <form method="post" action="finalizar_compra.php">
                <button type="submit" class="checkout" name="finalizar_compra">Finalizar Compra</button>
            </form>
        <?php else : ?>
            <p>O seu carrinho está vazio.</p>
        <?php endif; ?>
    </main>

    <footer>
        &copy; 2023 MagiaMística
    </footer>
</body>

</html>
