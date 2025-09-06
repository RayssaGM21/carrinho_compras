# Arquitetura do Sistema de Carrinho de Compras
Este projeto segue um padrão de arquitetura em camadas para organizar o código. O objetivo é manter a aplicação limpa, fácil de entender e de dar manutenção.

## Estrutura da Aplicação
O projeto é dividido em três partes principais:

* **Entidades (src/Entities):** São as classes que representam os dados do negócio, como `Product`, `Cart` e `CartItem`. A responsabilidade delas é apenas guardar e gerenciar seus próprios dados.

* **Serviços (src/Services):** É onde a lógica do negócio acontece. A classe `CartService` controla todas as operações do carrinho, como adicionar produtos, verificar estoque e calcular o total. Ela usa as classes da camada de Entidades para fazer seu trabalho.

* **Público (public/):** A camada de apresentação. É o ponto de entrada da aplicação, onde o código é executado e o resultado é mostrado ao usuário.

## Princípios de Design
A arquitetura foi pensada com base em princípios importantes de desenvolvimento de software:

* **DRY (Don't Repeat Yourself):** A lógica foi centralizada. Por exemplo, a validação de estoque acontece apenas no CartService, evitando que a mesma regra seja escrita em vários lugares.

* **KISS (Keep It Simple, Stupid):** O design é simples. Cada classe tem uma única responsabilidade, e as interações entre elas são diretas. Isso torna o código fácil de ler, mesmo para quem é novo no projeto.

* **Padrões de Código (PSR-12):** O código segue as regras de formatação do PSR-12. Isso garante que o estilo de codificação seja consistente, facilitando a leitura.