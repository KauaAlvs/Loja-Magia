<?php
//arquivo products.php
session_start();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos Da Loja</title>
    <link rel="stylesheet" href="../CSS/styleprodutos.css">
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

    <main class="product-list">
        <div class="product" data-produto="1">
            <img src="../IMG/pocao.jpg" alt="Item 1">
            <h2>Poção da Sabedoria</h2>
            <p>Uma poção que concede sabedoria e conhecimento.</p>
            <p class="price">$50.00</p>
            <button class="add-to-cart" onclick="addToCart('Poção da Sabedoria', 50.00, 1)">Adicionar ao Carrinho</button>
        </div>

        <div class="product" data-produto="2">
            <img src="../IMG/amuleto.jpg" alt="Item 2">
            <h2>Amuleto de Proteção</h2>
            <p>Um amuleto que oferece proteção contra forças negativas.</p>
            <p class="price">$30.00</p>
            <button class="add-to-cart" onclick="addToCart('Amuleto de Proteção', 30.00, 2)">Adicionar ao Carrinho</button>
        </div>

        <div class="product" data-produto="3">
            <img src="../IMG/varinha.jpg" alt="Item 3">
            <h2>Varinha Encantada</h2>
            <p>Uma varinha poderosa capaz de lançar feitiços incríveis.</p>
            <p class="price">$40.00</p>
            <button class="add-to-cart" onclick="addToCart('Varinha Encantada', 40.00, 3)">Adicionar ao Carrinho</button>
        </div>

        <div class="product" data-produto="4">
            <img src="../IMG/caldeirao.jpg" alt="Item 4">
            <h2>Caldeirão Mágico</h2>
            <p>Prepare poções e elixires com este caldeirão de qualidade premium.</p>
            <p class="price">$60.00</p>
            <button class="add-to-cart" onclick="addToCart('Caldeirão Mágico', 60.00, 4)">Adicionar ao Carrinho</button>
        </div>

        <div class="product" data-produto="5">
            <img src="../IMG/livro.jpg" alt="Item 5">
            <h2>Livro de Feitiços Antigos</h2>
            <p>Conhecimento poderoso de feitiçaria em um livro encantado.</p>
            <p class="price">$70.00</p>
            <button class="add-to-cart" onclick="addToCart('Livro de Feitiços Antigos', 70.00, 5)">Adicionar ao Carrinho</button>
        </div>
    </main>

    <footer>
        &copy; 2023 MagiaMística
    </footer>

    <script>
        function addToCart(productName, productPrice, productId) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var response = JSON.parse(this.responseText);
                    if (response.status === 'success') {
                      console.log("Item adicionado ao carrinho");
                    } else {
                        alert('Erro ao adicionar produto ao carrinho.');
                    }
                }
            };

            xhttp.open("POST", "add_to_card.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("produto_id=" + productId + "&produto_nome=" + productName + "&produto_preco=" + productPrice);
        }
    </script>
</body>

</html>