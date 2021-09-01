##### VUE #####
FROM node:lts-alpine

# install simple http server for serving static content
RUN npm install -g http-server

# make the 'frontend' folder the current working directory
WORKDIR /gui

# copy both 'package.json' and 'package-lock.json' (if available)
COPY package*.json ./

# install project dependencies
RUN npm install
RUN npm install vue-color
RUN npm install axios --save
RUN npm install bootstrap-vue

# copy project files and folders to the current working directory (i.e. 'app' folder)
COPY . .

# build app for production with minification
RUN npm run build

EXPOSE 8080
CMD [ "http-server", "dist" ]