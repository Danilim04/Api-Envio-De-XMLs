# Guia de Implementação da API

## Passo 1: Clone o Repositório
Baixe o repositório para a sua máquina utilizando o comando:
```bash
git clone <URL do Repositório>
```

## Passo 2: Inicialize os Containers
No diretório do projeto, execute o seguinte comando para construir e iniciar os containers em segundo plano:
```bash
docker-compose up -d --build
```

## Passo 3: Acesse o Container da Aplicação
Após os containers estarem em execução, acesse o container da aplicação com o comando:
```bash
docker-compose exec app bash
```

Dentro do container da aplicação, execute o comando para baixar as dependências do Composer:
```bash
composer install
```

Em seguida, inicie o projeto com:
```bash
php artisan key:generate
```

E pronto! Seu projeto estará rodando com sucesso.

### Observações
Certifique-se de ter o Docker e o Composer instalados em sua máquina antes de seguir os passos acima.

Sinta-se à vontade para explorar e personalizar seu projeto de acordo com suas necessidades. Se precisar de mais informações ou suporte, consulte a documentação oficial.

Aproveite a implementação da sua API! 🚀

