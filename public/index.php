<?php


// diretório raiz do projeto
define('ROOT_PATH', dirname(__DIR__));

spl_autoload_register(function ($class) {
    $file = ROOT_PATH . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

use src\Services\CartService;

$products = require ROOT_PATH . '/src/Utils/ProductData.php';
$cartService = new CartService($products);

// Estado atual do carrinho
function displayCartStatus($cartService) {
    echo "<h4>Conteúdo do Carrinho</h4>";
    $cartDetails = $cartService->getCartDetails();
    if (empty($cartDetails)) {
        echo "<p><em>O carrinho está vazio.</em></p>";
    } else {
        echo "<table style='width:100%; border-collapse: collapse; text-align: left;'>";
        echo "<thead><tr style='background-color:#f2f2f2;'>";
        echo "<th style='padding: 8px; border: 1px solid #ddd;'>ID Produto</th>";
        echo "<th style='padding: 8px; border: 1px solid #ddd;'>Nome</th>";
        echo "<th style='padding: 8px; border: 1px solid #ddd;'>Quantidade</th>";
        echo "<th style='padding: 8px; border: 1px solid #ddd;'>Subtotal</th>";
        echo "</tr></thead><tbody>";
        foreach ($cartDetails as $item) {
            echo "<tr>";
            echo "<td style='padding: 8px; border: 1px solid #ddd;'>{$item['id_produto']}</td>";
            echo "<td style='padding: 8px; border: 1px solid #ddd;'>{$item['nome']}</td>";
            echo "<td style='padding: 8px; border: 1px solid #ddd;'>{$item['quantidade']}</td>";
            echo "<td style='padding: 8px; border: 1px solid #ddd;'>R$ " . number_format($item['subtotal'], 2, ',', '.') . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Simulador de Carrinho de Compras</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; padding: 20px; max-width: 800px; margin: auto; }
        .scenario { background-color: #f9f9f9; border: 1px solid #ddd; padding: 15px; margin-bottom: 20px; border-radius: 5px; }
        .success { color: green; font-weight: bold; }
        .error { color: red; font-weight: bold; }
    </style>
</head>
<body>

    <h1>Carrinho de Compras</h1>
    <p>Demonstração dos casos de uso do projeto.</p>
    <hr>

    <div class="scenario">
        <h2>1. Adicionando 2 Camisetas (ID 1)</h2>
        <?php
        $message = $cartService->addItemToCart(1, 2);
        $total = $cartService->getCartTotal();
        echo "<p class='" . (strpos($message, 'Erro') === 0 ? 'error' : 'success') . "'>{$message}</p>";
        displayCartStatus($cartService);
        echo "<p>Total carrinho: {$total}</p>";
        ?>
    </div>

    <div class="scenario">
        <h2>2. Tentando adicionar 10 Tênis (ID 3)</h2>
        <p>Estoque disponível: 3 unidades.</p>
        <?php
        $message = $cartService->addItemToCart(3, 10);
        echo "<p class='" . (strpos($message, 'Erro') === 0 ? 'error' : 'success') . "'>{$message}</p>";
        ?>
    </div>

    <div class="scenario">
        <h2>3. Adicionando 1 Calça Jeans (ID 2)</h2>
        <?php
        $message = $cartService->addItemToCart(2, 1);
        echo "<p class='" . (strpos($message, 'Erro') === 0 ? 'error' : 'success') . "'>{$message}</p>";
        displayCartStatus($cartService);
        echo "<p>Total carrinho: {$total}</p>";
        ?>
    </div>

    <div class="scenario">
        <h2>4. Removendo a Calça Jeans (ID 2)</h2>
        <?php
        $message = $cartService->removeItemFromCart(2);
        echo "<p class='" . (strpos($message, 'Erro') === 0 ? 'error' : 'success') . "'>{$message}</p>";
        displayCartStatus($cartService);
        ?>
    </div>

    <div class="scenario">
        <h2>5. Calculando o total e aplicando desconto</h2>
        <p>Cupom: <strong>DESCONTO10</strong></p>
        <?php
        $finalTotal = $cartService->getCartTotal('DESCONTO10');
        echo "<p>Total Bruto: R$ " . number_format($cartService->getCartTotal(), 2, ',', '.') . "</p>";
        echo "<p class='success' style='font-size: 1.2em;'>Total com desconto: R$ " . number_format($finalTotal, 2, ',', '.') . "</p>";
        ?>
    </div>

</body>
</html>