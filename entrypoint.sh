#!/bin/bash

# Esperar 10 segundos
sleep 30

# Iniciar o Apache em primeiro plano
apache2-foreground &

# Mudar para o diretório do Laravel
cd /var/www/html

# Executar as migrações do Laravel
php artisan migrate

php artisan db:seed

npm run dev &

# Mantenha o contêiner em execução
tail -f /dev/null