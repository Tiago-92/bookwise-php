# Use uma imagem base do Node.js
FROM node:latest

# Defina o diretório de trabalho
WORKDIR /app

# Copie os arquivos do seu aplicativo para o contêiner
COPY . .

# Instale as dependências do Node.js
RUN npm install

# Exponha a porta usada pelo seu aplicativo React
EXPOSE 5173

# Comando para iniciar o servidor de desenvolvimento do Vite
CMD ["npm", "run", "dev"]