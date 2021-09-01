# 'requests' is what we use to send web-requests (to fetch the html files from websites)
import requests
# beautiful-soup will help us in navigating through the html extract just the text we care about
from bs4 import BeautifulSoup
from bs4.element import Comment

from sys import argv
import csv
import time
import re
import pandas as pd

ERROR_MSG_ARG = "Date is given as argument"
CATEGORIES = {"health":'https://www.nytimes.com/section/health',
    "sport": 'https://www.nytimes.com/section/sports',
    "entertainment": 'https://www.nytimes.com/section/arts',
    "tech": 'https://www.nytimes.com/section/technology',
    "science": 'https://www.nytimes.com/section/science',
    "fashion": 'https://www.nytimes.com/section/fashion',
    "world": 'https://www.nytimes.com/section/'}

def find_urls(url_subject):
    response = requests.get(url_subject)
    # print("response: ", response)
    if (response.status_code // 100 == 2 ):  
        html = response.text
        soup = BeautifulSoup(html, 'html.parser')
        links = []

        section = soup.find("section", attrs={"id": "collection-highlights-container"})
        articles = section.find_all("article")
        for article in articles:
            link = article.find('a').get('href')
            if (link not in links):
                links.append(link)
        return(links)


def get_text(urls, writer, cat):
    count = 1
    for url in urls:
        if(url.find('https') == -1):
            url = "https://www.nytimes.com" + url
        response = requests.get(url)
    
        if (response.status_code // 100 == 2):
            print(url)
            html = response.text
            soup = BeautifulSoup(html, 'html.parser')

            try:
                headline = soup.find("h1", attrs={"data-test-id": "headline"}).text
                texts = ""
                section = soup.find("section", attrs={"name": "articleBody"})
                pars = section.find_all("p")
                for par in pars:
                    text = par.text.replace(u'\xa0', '')
                    text = text.replace(u'\n', '')
                    texts += "&lt;p&gt;" + text + "&lt;p&gt;"
                print("document ", count, ": ",headline)
                count +=1
                writer.writerow({'category': cat, 'url': url, 'headline': headline, 'content': texts})
            except Exception as ex:
                print(ex)
                pass

def main(date):
    for cat in CATEGORIES:
        print("-----" + cat + "------")
        fileName = cat + "_nytimes_" + str(date) + ".csv"
        cat_csv = open(fileName, "w+", newline='', encoding="utf-8")
    
        colNames = ["url", "headline", "content", "category"]
        cat_writer = csv.DictWriter(cat_csv, fieldnames=colNames, delimiter=',')
        cat_writer.writeheader()
        
        if cat == "world":
            urls_world = find_urls('https://www.nytimes.com/section/world')
            urls_pol = find_urls('https://www.nytimes.com/section/politics')
            urls_us = find_urls('https://www.nytimes.com/section/us')
            urls = urls_world + urls_pol + urls_us
        else:
            urls = find_urls(CATEGORIES[cat])
        
        get_text(urls, cat_writer, cat)

        cat_csv.close()

if __name__ == "__main__":
    if len(argv) == 2:
        main(argv[1])
    else:
        print(ERROR_MSG_ARG)

