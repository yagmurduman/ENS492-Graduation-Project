Honeypot Generation Tool
========================

- The project is implemented in linux cloud server (Ubuntu 18.04) and developed in a docker container.
- GUI can be reached from http://34.66.139.63:8080/
- Health and sports categories are not available for GPT2 model because of insufficient training data.

### Steps to deploy in server
1. After setting up the docker on server run
```bash
sudo docker-compose build
```
2. Start the container
```bash
sudo docker-compose up 
```
