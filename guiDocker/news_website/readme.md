Deploy Honeypot
====================

###Steps to run
1. Put the zip file into a Linux server
2. Unzip the honeypot zip
```bash
sudo apt-get install unzip
sudo unzip <honeypot_folder_name>
``` 
3. Change MYSQL_ROOT_PASSWORD in docker-compose.yml file
4. Run bash requirements.sh
```bash
sudo bash requirements.sh
```
5. Run **load_content.sh** to deploy database and enter  MYSQL_ROOT_PASSWORD when prompted
```bash
sudo bash load_content.sh 
MYSQL_ROOT_PASSWORD
```
6. Run **generate_pcap.sh** in screen mode and detach from screen mode
```bash
screen
mkdir <pcap_folder_name> 
bash generate_pcap.sh
Ctrl+A+D
```

