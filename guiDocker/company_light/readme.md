Deploy Honeypot
====================

###Steps to run
1. Put the zip file into a Linux server
2. Unzip the honeypot zip
```bash
sudo apt-get install unzip
sudo unzip <honeypot_folder_name>
``` 
3. Run bash requirements.sh
```bash
sudo bash requirements.sh
```
4. Run **generate_pcap.sh** in screen mode and detach from screen mode
```bash
screen
mkdir <pcap_folder_name> 
bash generate_pcap.sh
Ctrl+A+D
```

