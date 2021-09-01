# 'requests' is what we use to send web-requests (to fetch the html files from websites)
import requests
# beautiful-soup will help us in navigating through the html extract just the text we care about
from bs4 import BeautifulSoup
from bs4.element import Comment


import csv
import time
from tqdm import tqdm
import re
import pandas as pd
from sys import argv

ERROR_MSG_ARG = "Date is given as argument"
ERROR_MSG_CONN = "Cannot connect to url"

def find_urls(url_subject):
    response = requests.get(url_subject)
    # print("response: ", response)
    if (response.status_code // 100 == 2 ):  
        html = response.content
        soup = BeautifulSoup(html, 'html.parser')
        links = []

        containers = soup.find_all('div', class_='zn__containers')[:3]
        print(len(containers))
        for container in containers:
            for div_cont in container.find_all("div", class_='cd__content'):
                link = div_cont.find("a")
                links.append(link['href'])
        return(links)

def get_text(urls, cat_writer, cat):
    count = 1
    for url in urls:
        if(url.find('https') == -1):
            url = "https://edition.cnn.com" + url

        try:
            response = requests.get(url)
        
            if (response.status_code // 100 == 2):  
                print(url)
                html = response.text
                soup = BeautifulSoup(html, 'html.parser')

                try:
                    headline = soup.find("h1", attrs={"class": "pg-headline"}).text
                    texts = ""
                    pars = soup.find_all("div", attrs={"class": "zn-body__paragraph"})
                    for par in pars:
                        text = par.text.replace(u'\xa0', '')
                        text = text.replace(u'\n', '')
                        texts += "&lt;p&gt;" + text + "&lt;p&gt;"
                    print("document ", count, ": ",headline)
                    count +=1
                    cat_writer.writerow({'category': cat, 'url': url, 'headline': headline, 'content': [texts]})
                except Exception as ex1:
                    print(ex1)
                    pass
        except Exception as ex2:
            print(ERROR_MSG_CONN, ": ", ex2)
            pass

def main(date):
    fileName = "sport_cnn_"+ str(date) +".csv"
    cat_csv = open(fileName, "w+", newline='', encoding="utf-8")
    colNames = ['category', "url", "headline", "content"]
    cat_writer = csv.DictWriter(cat_csv, fieldnames=colNames, delimiter=',')
    cat_writer.writeheader()

    urls = find_urls('https://edition.cnn.com/sports')
    get_text(urls, cat_writer, 'sport')

    cat_csv.close()

if __name__ == "__main__":
    if len(argv) == 2:
        main(argv[1])
    else:
        print(ERROR_MSG_ARG)