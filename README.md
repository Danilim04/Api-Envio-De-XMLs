# API de Envio Automático de XMLs

## Descrição
Este projeto é uma API desenvolvida em PHP com o framework Laravel, que automatiza o envio de arquivos XML. A API monitora uma pasta específica, identifica os arquivos XML mais recentes e os envia por e-mail. Os arquivos são enviados em formato zipado para lidar com grandes volumes de dados e garantir eficiência no envio.

## Funcionalidades
- **Monitoramento de Pasta**: Verifica continuamente uma pasta específica para novos arquivos XML.
- **Seleção de Arquivos Recentes**: Identifica e seleciona apenas os XMLs mais recentes para envio.
- **Prevenção de Envios Repetitivos**: Mantém controle dos XMLs já enviados para evitar duplicidade.
- **Compactação de Arquivos**: Automatiza a compactação dos arquivos em formato ZIP antes do envio.
- **Envio de E-mails**: Utiliza a biblioteca PHPMailer para facilitar o envio de e-mails.

## Tecnologias Utilizadas
- **PHP/Laravel**: Linguagem de programação e framework utilizado para desenvolver a API.
- **Docker**: Utilizado para criar um ambiente de desenvolvimento isolado e controlado.
- **PHPMailer**: Biblioteca PHP para enviar e-mails de forma fácil e eficiente.

# Guia para usar 

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

