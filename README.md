## Instalação
> Download e configuração do projeto.

- Clone o projeto para seu ambiente de desenvolvimento
- Acesse a pasta do repositório clonado
- Execute o comando: npm install
- Altere o arquivo env.example para .env
- Coloque no arquivo .env suas variáveis de ambiente

## Inicialização
> Execute os comando abaixo em sequência, dentro do repositório clonado.

- composer update
- php artisan migrate
- php artisan key:generate
- php artisan serve

## Finalização
> Link de acesso fornecido pelo laravel
- acesse o link gerado pelo laravel: http://127.0.0.1:8000/

## Observações
> O PHP deve estar corretamente instalado e o apache rodando para o perfeito funcionamento do projeto.

- PHP na versão 7.3 ou superior

## License
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
