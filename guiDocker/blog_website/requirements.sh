#!/bin/bash

echo "Building docker"
# ------ DOCKER ------
# Get docker repo requirements
sudo apt-get update && sudo apt-get install apt-transport-https ca-certificates curl gnupg-agent software-properties-common -y

# Install docker repo key
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -

# Add the docker repo (Assuming x86_64)
sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable"

# Install docker!
sudo apt-get update && sudo apt-get install docker-ce docker-ce-cli containerd.io -y
# --------------------

# Install python, compose and tcpdump
sudo apt-get install python3 docker-compose tcpdump python3-pip curl tshark -y

####compose docker

sudo docker-compose build