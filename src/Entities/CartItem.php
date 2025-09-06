<?php

namespace src\Entities;

class CartItem
{
    private Product $product;
    private int $quantity;

    public function __construct(Product $product, int $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    /**
     * Retorna o produto associado ao item do carrinho.
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * Retorna a quantidade do item no carrinho.
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * Define a quantidade do item no carrinho.
     * @param int $quantity
     * @return void
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * Calcula o subtotal do item no carrinho.
     * @return float
     */
    public function getSubtotal(): float
    {
        return $this->product->getPrice() * $this->quantity;
    }
}