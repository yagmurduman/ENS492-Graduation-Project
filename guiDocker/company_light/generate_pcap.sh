#!/bin/bash
#run this in screen command
#If tcpdump is already working
if ps ax | grep -v grep | grep 'tcpdump -G 3600' > /dev/null
then
    echo "$dt: TCPdump already running"
else
    echo "$dt: Starting TCPdump"
tcpdump -D
#input the interface name
read -p 'Enter interface: ' interface
read -p 'Enter filename: ' filename
sudo tcpdump -G 3600 -i $interface -w "$filename-%Y-%m-%d_%H:%M:%S.pcap"
echo "Listening to " $interface
fi
