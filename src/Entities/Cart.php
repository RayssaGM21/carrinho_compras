<?php

namespace src\Entities;

class Cart
{

    private array $items = [];

    /**
     * Adiciona um item ao carrinho.
     * 
     * @param CartItem $item
     * @return void
     */
    public function addItem(CartItem $item): void
    {
        // Verifica se o item já existe no carrinho para atualizar a quantidade
        $found = false;
        foreach ($this->items as $existingItem) {
            if ($existingItem->getProduct()->getId() === $item->getProduct()->getId()) {
                $existingItem->setQuantity($existingItem->getQuantity() + $item->getQuantity());
                $found = true;
                break;
            }
        }

        if (!$found) {
            $this->items[] = $item;
        }
    }

    /**
     * Remove um item do carrinho pelo ID do produto.
     * 
     * @param int $productId
     * 
     * @return bool Retorna `true` se o item foi removido com sucesso ou `false` caso contrário
     */
    public function removeItem(int $productId): bool
    {
        foreach ($this->items as $index => $item) {
            if ($item->getProduct()->getId() === $productId) {
                // Remove o item do array
                unset($this->items[$index]);
                // Reorganiza os índices do array
                $this->items = array_values($this->items);
                return true;
            }
        }
        return false;
    }

    /**
     * Retorna a lista de itens armazenados.
     *
     * @return Item[] Lista de itens.
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * Calcula o subtotal do carrinho.
     * 
     * @return float
     */
    public function getSubtotal(): float
    {
        $subtotal = 0.0;
        
        foreach ($this->items as $item) {
            $subtotal += $item->getSubtotal();
        }
        return $subtotal;
    }

    /**
     * Retorna um item do carrinho pelo ID do produto.
     * 
     * @param int $productId
     * 
     */
    public function getItemById(int $productId): ?CartItem
    {
        foreach ($this->items as $item) {
            if ($item->getProduct()->getId() === $productId) {
                return $item;
            }
        }
        return null;
    }
}