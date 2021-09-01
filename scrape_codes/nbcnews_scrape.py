# 'requests' is what we use to send web-requests (to fetch the html files from websites)
import requests
# beautiful-soup will help us in navigating through the html extract just the text we care about
from bs4 import BeautifulSoup
from bs4.element import Comment
from selenium import webdriver
from selenium.webdriver.common.action_chains import ActionChains

from sys import argv
import csv
import time
import re
import pandas as pd


ERROR_MSG_ARG = "Date is given as argument"

CATEGORIES = {'world': 'https://www.nbcnews.com/world',
            'health': 'https://www.nbcnews.com/health/coronavirus',
            'politics': 'https://www.nbcnews.com/politics'  
        }

def find_urls(url_subject):
     ##### Web scrapper for infinite scrolling page #####
    options = webdriver.ChromeOptions()
    options.add_argument('--ignore-certificate-errors')
    options.add_argument('--incognito')
    options.add_argument('--headless')
    options.add_argument('log-level=3')
    driver = webdriver.Chrome(executable_path=r'C:\webdriver\chromedriver.exe', options=options)
    driver.get(url_subject)
    time.sleep(2)  # Allow 2 seconds for the web page to open

    count = 0
    links = []
    while count < 120:
        try:
            loadMoreButton = driver.find_element_by_xpath("//button[@class='animated-ghost-button animated-ghost-button--normal feeds__load-more-button']")
            loadMoreButton.click()
            time.sleep(2)

            count += 1
        except Exception as e:
            print (e)
            break

    soup = BeautifulSoup(driver.page_source, 'html.parser')           
    div = soup.find("div", attrs={"class": "feeds__items-wrapper ph5 ph0-m"})

    for article in div.find_all("div", attrs={"class": "wide-tease-item__wrapper df flex-column flex-row-m flex-nowrap-m"}):
        link = article.find('a', attrs={"data-test": "wide-tease-image"}).get('href')
        if (link not in links and link != None):
            links.append(link)
   
    return(links)

def get_text(urls, writer, cat):
    count = 1
    for url in urls:
        if(url.find('https') == -1):
            url = "https://www.nbcnews.com/" + url
        response = requests.get(url)

        if (response.status_code // 100 == 2):
            print(url)
            html = response.text
            soup = BeautifulSoup(html, 'html.parser')

            try:
                headline = soup.find("h1").text
                texts = ""
                section = soup.find("div", attrs={"class": "article-body__content"})
                pars = section.find_all("p")
                for par in pars:
                    text = par.text.replace(u'\xa0', '')
                    text = text.replace(u'\n', '')
                    texts += "&lt;p&gt;" + text + "&lt;p&gt;" 

                print("document ", count, ": ",headline)
                count +=1
                writer.writerow({'category': cat, 'url': url, 'headline': headline, 'content': [texts]})
            except:
                pass


def main(date):

    for cat in CATEGORIES:
        fileName =  cat + "_nbcnews_" + str(date) + ".csv"
        cat_csv = open(fileName, "w+", newline='', encoding="utf-8")
        colNames = ['category', "url", "headline", "content"]
        cat_writer = csv.DictWriter(cat_csv, fieldnames=colNames, delimiter=',')
        cat_writer.writeheader()

        urls = find_urls(CATEGORIES[cat])

        get_text(urls, cat_writer, cat)

        cat_csv.close()

if __name__ == "__main__":
    if len(argv) == 2:
        main(argv[1])
    else:
        print(ERROR_MSG_ARG)