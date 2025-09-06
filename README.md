# Carrinho de Compras

## Sobre o Projeto
Este projeto é um simulador de carrinho de compras básico, desenvolvido em PHP puro com o objetivo de aplicar boas práticas de programação e princípios de Clean Code e Design Patterns.

A arquitetura do sistema foi desenhada para ser modular e seguir o paradigma de Programação Orientada a Objetos (POO), utilizando as seguintes diretrizes:

PSR-12: Padrão de estilo de código para garantir a legibilidade e consistência.

DRY (Don't Repeat Yourself): A lógica de negócio está centralizada em um Service, evitando a repetição de código.

KISS (Keep It Simple, Stupid): Cada classe tem uma responsabilidade única e clara.


## Como Rodar o Projeto
Siga os passos abaixo para executar o projeto em seu ambiente local.

Pré-requisitos: Certifique-se de ter o XAMPP (ou qualquer ambiente de desenvolvimento PHP local) instalado e funcionando.

Clone o Repositório:


```
git clone https://github.com/RayssaGM21/carrinho_compras.git
```


Configuração no XAMPP: Mova a pasta do projeto (carrinho_compras) para o diretório de documentos do seu servidor web (normalmente htdocs no XAMPP).

Exemplo de caminho: `C:\xampp\htdocs\carrinho_compras`

**Acesso via Navegador:** Abra seu navegador e acesse a URL do ponto de entrada da aplicação.

[http://localhost/carrinho_compras/public/index.php](http://localhost/carrinho_compras/public/index.php)

O arquivo index.php estará na pasta public!

## Funcionalidades Implementadas
O projeto simula um fluxo de e-commerce e cobre as seguintes funcionalidades, conforme especificado na proposta:

* Adicionar Item ao Carrinho:

* Valida se o produto existe.

* Valida se há estoque suficiente antes de adicionar.

* Atualiza o estoque do produto.

* Remover Item do Carrinho:

* Valida se o item existe no carrinho.

* Devolve a quantidade do item ao estoque do produto.

* Listar Itens: Exibe todos os produtos adicionados, mostrando a quantidade e o subtotal de cada um.

* Calcular Total: Soma os subtotais de todos os itens no carrinho para obter o valor total.

* Aplicar Desconto: Regra simples: o cupom DESCONTO10 aplica 10% de desconto sobre o valor total.

## Exemplos de Uso (Casos de Teste)
O arquivo public/index.php contém a simulação dos principais casos de uso para demonstrar o funcionamento do sistema. Ao rodar o projeto, você verá os seguintes cenários:

* **Adicionar um produto válido:** 
O sistema adiciona 2 unidades da Camiseta ao carrinho.

* **Tentar adicionar mais do que o estoque:**
Uma tentativa de adicionar 10 unidades de Tênis (com estoque de 3) resulta em uma mensagem de erro.

* **Adicionar um segundo produto:** 
Uma Calça Jeans é adicionada ao carrinho, que agora contém dois itens.

* **Remover um produto:** 
A Calça Jeans é removida do carrinho e a quantidade é restaurada no estoque.

* **Aplicar cupom de desconto:** 
O valor total do carrinho restante (referente à Camiseta) é calculado com o desconto de 10% do cupom DESCONTO10.

* **Não aplicar cupom de desconto inválido:** 
O valor total do carrinho restante (referente à Camiseta) é calculado sem o desconto devido cupom inválido.


---
### Discente
| RA      | Nome                         |
|---------|------------------------------|
| 2001130 | Rayssa Gomides Marconato     |
