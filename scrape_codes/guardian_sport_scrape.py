# 'requests' is what we use to send web-requests (to fetch the html files from websites)
import requests
# beautiful-soup will help us in navigating through the html extract just the text we care about
from bs4 import BeautifulSoup
from bs4.element import Comment


import csv
import time
import re
import pandas as pd
from sys import argv

ERROR_MSG_ARG = "Date is given as argument"

def find_urls(url_subject):
    response = requests.get(url_subject)
    # print("response: ", response)
    if (response.status_code // 100 == 2 ):  
        html = response.text
        soup = BeautifulSoup(html, 'html.parser')
        links = []
 
        sections= soup.find_all("section")
        section_names = ["sport", "news-and-features", "in-depth", "football"]
        for section in sections:
            if (section.get('id') in section_names):
                articles = section.find_all('a', attrs={"data-link-name": "article"})
                for article in articles:
                    link = article.get('href')
                    if link not in links:
                        links.append(link)
        return(links)


def get_text(urls, cat_writer, cat):
    count = 1
    for url in urls:
        response = requests.get(url)
    
        if (response.status_code // 100 == 2):
            print(url)
            html = response.text
            soup = BeautifulSoup(html, 'html.parser')

            try:
                headline = soup.find("h1").text
                texts = ""
                div = soup.find("div", attrs={"class": "article-body-commercial-selector"})
                pars = div.find_all("p")
                for par in pars:
                    text = par.text.replace(u'\xa0', '')
                    text = text.replace(u'\n', '')
                    texts += "&lt;p&gt;" + text + "&lt;p&gt;"
                print("document ", count, ": ",headline)
                count +=1
                cat_writer.writerow({'category': cat, 'url': url, 'headline': headline, 'content': [texts]})
            except Exception as ex:
                print(ex)
                pass

def main(date):
    fileName = "sport_guardian_"+ str(date) +".csv"
    cat_csv = open(fileName, "w+", newline='', encoding="utf-8")
    colNames = ['category', "url", "headline", "content"]
    cat_writer = csv.DictWriter(cat_csv, fieldnames=colNames, delimiter=',')
    cat_writer.writeheader()
    urls = find_urls('https://www.theguardian.com/uk/sport')
    # print(urls)

    get_text(urls, cat_writer, "sport")

    cat_csv.close()

if __name__ == "__main__":
    if len(argv) == 2:
        main(argv[1])
    else:
        print(ERROR_MSG_ARG)

