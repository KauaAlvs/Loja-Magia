<?php
//arquivo nivel.php
session_start();

// Conecte-se ao banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "magiamistica";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Verifique se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Obtenha o ID do usuário da sessão
$usuario_id = $_SESSION['usuario_id'];

// Consulta para obter o nível mágico do usuário
$sql_nivel = "SELECT nivel_magico FROM usuarios WHERE usuario_id = '$usuario_id'";
$result_nivel = $conn->query($sql_nivel);

if ($result_nivel->num_rows > 0) {
    $row_nivel = $result_nivel->fetch_assoc();
    $nivel_magico = $row_nivel['nivel_magico'];
} else {
    $nivel_magico = 1; // Define um valor padrão se o nível não estiver definido
}

// Consulta para obter o nome e a descrição do nível
$sql_nivel_info = "SELECT nome FROM niveismagicos WHERE nivel_id = '$nivel_magico'";
$result_nivel_info = $conn->query($sql_nivel_info);

if ($result_nivel_info->num_rows > 0) {
    $row_nivel_info = $result_nivel_info->fetch_assoc();
    $nome_nivel = $row_nivel_info['nome'];
} else {
    $nome_nivel = "Nível Desconhecido";
}

// Define as descrições para cada nível
$descricoes_niveis = [
    1 => "O iniciante mal começa a compreender as sutilezas da magia. Seus feitiços são hesitantes, muitas vezes desaparecendo antes de alcançar seu objetivo. A energia mágica é como uma vela tremeluzente, pronta para ser apagada pela menor brisa.",
    2 => "O praticante intermediário começa a domar a energia mágica com mais eficiência. Seus feitiços agora atingem seus alvos com mais consistência, mas ainda carecem de verdadeira potência. A energia flui como um pequeno riacho, ainda um tanto instável, mas com propósito claro.",
    3 => "O mágico avançado é capaz de manipular a magia com confiança e precisão. Seus feitiços são fortes e controlados, capazes de alterar a realidade à sua vontade. A energia flui como um rio furioso, poderosa e ininterrupta.",
    4 => "O mágico santo transcende os limites mundanos, canalizando a magia de maneira sagrada. Seus feitiços são imbuidos de uma pureza divina, capazes de curar, purificar e banir a escuridão. A energia é como uma cascata de luz celestial, abençoada e sagrada.",
    5 => "O mágico real é um mestre do seu domínio, capaz de conjurar magia que se integra perfeitamente com o mundo ao seu redor. Seus feitiços transcendem a compreensão comum, afetando a realidade de maneiras profundas e duradouras. A energia é como um oceano calmo e profundo, cheio de mistérios e potencial ilimitado.",
    6 => "O mágico imperador é uma força da natureza, capaz de reescrever as leis da realidade com um simples gesto. Seus feitiços são como cometas, deixando um rastro de maravilhas e deslumbramento. A energia é como o cosmos em si, vasto e imensurável.",
    7 => "O mágico divino transcende a mortalidade, sua magia é uma manifestação direta da vontade dos deuses. Seus feitiços têm o poder de criar e destruir mundos, moldando a própria essência da existência. A energia é como a chama primordial do universo, eterna e infinita. "
];

// Obtém a descrição do nível atual
$descricao_nivel = isset($descricoes_niveis[$nivel_magico]) ? $descricoes_niveis[$nivel_magico] : "Descrição não disponível";


$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nivel Mágico</title>
    <link rel="stylesheet" href="../CSS/stylenivel.css">
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

    <div class="nivel-info">
        <h2><?php echo $nome_nivel; ?></h2>
        <p><?php echo $descricao_nivel; ?></p>
    </div>

    <footer>
        &copy; 2023 MagiaMística
    </footer>
</body>

</html>