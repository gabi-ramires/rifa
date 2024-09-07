#!/bin/bash

echo "--------------------------------Inicio--------------------------------"
data_hora=$(date +"%Y-%m-%d %H:%M:%S")
echo "Data e hora atual: $data_hora"

# Endpoint que você deseja verificar
endpoint="http://api.gabrielaramires.com.br:3000/api"

# Função para verificar se o servidor está acessível
check_server() {
    # Tente fazer uma solicitação HTTP ao endpoint com um timeout de 5 segundos
    response=$(curl -s -o /dev/null -w "%{http_code}" --connect-timeout 5 "$endpoint")

    # Verifique se a resposta está na faixa de 2xx (sucesso)
    if [ "$response" -ge 200 ] && [ "$response" -lt 300 ]; then
        return 0
    else
        return 1
    fi
}

# Verifique se o servidor está acessível
if ! check_server; then
    echo -e "\e[31mServidor caiu\e[0m"
    
    # Inicie o serviço
    cd /var/www/html || exit
    nohup php artisan serve --host=0.0.0.0 --port=3000 > service_log_$(date +"%Y%m%d_%H%M%S").txt 2>&1 &

    # Aguarde um momento para permitir a inicialização do serviço
    sleep 5

    # Verifique se o serviço está em execução (substitua '3000' pela porta correta)
    if pgrep -f "php artisan serve --host=0.0.0.0 --port=3000" >/dev/null; then
        echo -e "\e[32mO serviço foi iniciado com sucesso.\e[0m"
    else
        echo -e "\e[31mErro ao iniciar o serviço\e[0m"
    fi
else
    echo -e "\e[32mO servidor está acessível e o serviço já está em execução.\e[0m"
fi

echo "Fim"
