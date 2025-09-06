<?php

namespace src\Services;

use src\Entities\Cart;
use src\Entities\CartItem;
use src\Entities\Product;

class CartService
{
    private Cart $cart;
    private array $productsData;

    public function __construct(array $productsData)
    {
        $this->cart = new Cart();
        $this->productsData = $productsData;
    }

    /**
     * Adiciona um item ao carrinho, verificando o estoque antes.
     *
     * @param int $productId
     * @param int $quantity
     * @return string
     */
    public function addItemToCart(int $productId, int $quantity): string
    {
        $product = $this->findProductById($productId);

        if (!$product) {
            return "Erro: Produto com ID {$productId} não encontrado.";
        }

        if ($quantity > $product->getStock()) {
            return "Erro: Estoque insuficiente. Apenas {$product->getStock()} unidades de '{$product->getName()}' estão disponíveis.";
        }
        
        // Reduz o estoque do produto
        $product->setStock($product->getStock() - $quantity);

        // Adiciona ou atualiza o item no carrinho
        $cartItem = new CartItem($product, $quantity);
        $this->cart->addItem($cartItem);

        return "{$quantity}x '{$product->getName()}' adicionado(s) ao carrinho com sucesso.";
    }

    /**
     * Remove um item do carrinho e restaura o estoque.
     * 
     * @param int $productId
     * @return string
     */
    public function removeItemFromCart(int $productId): string
    {
        $cartItem = $this->cart->getItemById($productId);
        
        if (!$cartItem) {
            return "Erro: Produto com ID {$productId} não encontrado no carrinho.";
        }

        $product = $cartItem->getProduct();
        $removedQuantity = $cartItem->getQuantity();
        
        $product->setStock($product->getStock() + $removedQuantity);

        $this->cart->removeItem($productId);

        return "'{$product->getName()}' removido do carrinho. Estoque restaurado em {$removedQuantity} unidades.";
    }


    /**
     * Aplica um desconto ao total do carrinho com base no cupom fornecido.
     * 
     * @param int $coupon
     * @return float
     */
    public function applyDiscount(string $coupon): float
    {
        $total = $this->cart->getSubtotal();
        if ($coupon === 'DESCONTO10') {
            return $total * 0.90; // 10% de desconto
        }
        return $total;
    }

    /**
     * Retorna os detalhes atuais do carrinho.
     * @return array
     */
    public function getCartDetails(): array
    {
        $details = [];
        foreach ($this->cart->getItems() as $item) {
            $details[] = [
                'id_produto' => $item->getProduct()->getId(),
                'nome' => $item->getProduct()->getName(),
                'quantidade' => $item->getQuantity(),
                'subtotal' => $item->getSubtotal()
            ];
        }
        return $details;
    }

    /**
     * Calcula o total do carrinho, aplicando desconto se o cupom for válido.
     * 
     * @param string $coupon
     * @return float
     */
    public function getCartTotal(string $coupon = ''): float
    {
        $total = $this->cart->getSubtotal();
        if ($coupon === 'DESCONTO10') {
            $total *= 0.90;
        }
        return $total;
    }

    /**
     * Encontra um produto pelo ID no array de dados.
     * 
     * @param string $coupon
     * @return Product|null
     */
    private function findProductById(int $id): ?Product
    {
        foreach ($this->productsData as $productData) {
            if ($productData['id'] === $id) {
                return new Product(
                    $productData['id'],
                    $productData['nome'],
                    $productData['preco'],
                    $productData['estoque']
                );
            }
        }
        return null;
    }
}