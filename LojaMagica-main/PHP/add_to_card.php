<?php
session_start();

if(isset($_POST['produto_id']) && isset($_POST['produto_nome']) && isset($_POST['produto_preco'])){
    $produto = array(
        'produto_id' => $_POST['produto_id'],
        'nome' => $_POST['produto_nome'],
        'preco' => $_POST['produto_preco']
    );

    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = array();
    }

    $produto_existente = false;

    foreach ($_SESSION['carrinho'] as &$item) {
        if ($item['produto_id'] === $produto['produto_id']) {
            $item['quantidade'] += 1;
            $produto_existente = true;
            break;
        }
    }

    if (!$produto_existente) {
        $produto['quantidade'] = 1;
        array_push($_SESSION['carrinho'], $produto);
    }

    echo json_encode(array('status' => 'success', 'message' => 'Produto adicionado ao carrinho.'));
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Parâmetros inválidos.'));
}
