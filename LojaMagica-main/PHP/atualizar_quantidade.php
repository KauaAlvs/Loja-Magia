<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['produto_key']) && isset($_POST['action'])) {
        $produto_key = $_POST['produto_key'];
        $action = $_POST['action'];

        // Verifique se a sessão carrinho existe e se há produtos no carrinho
        if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
            $carrinho = $_SESSION['carrinho'];

            if (array_key_exists($produto_key, $carrinho)) {
                if ($action === 'aumentar') {
                    $carrinho[$produto_key]['quantidade']++;
                } elseif ($action === 'diminuir') {
                    if ($carrinho[$produto_key]['quantidade'] > 1) {
                        $carrinho[$produto_key]['quantidade']--;
                    }
                }
            }

            $_SESSION['carrinho'] = $carrinho;
        }
    }
}

header("Location: cart.php");
?>
