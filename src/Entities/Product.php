<?php

namespace src\Entities;

class Product
{
    private int $id;
    private string $name;
    private float $price;
    private int $stock;

    public function __construct(int $id, string $name, float $price, int $stock)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->stock = $stock;
    }

    /**
     * Retorna o ID do produto.
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Retorna o nome do produto.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Retorna o preço do produto.
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * Retorna o estoque do produto.
     * @return int
     */
    public function getStock(): int
    {
        return $this->stock;
    }

    /**
     * Define o estoque do produto.
     * @param int $newStock
     * @return void
     */
    public function setStock(int $newStock): void
    {
        $this->stock = $newStock;
    }
}