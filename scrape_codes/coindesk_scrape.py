# 'requests' is what we use to send web-requests (to fetch the html files from websites)
import requests
# beautiful-soup will help us in navigating through the html extract just the text we care about
from bs4 import BeautifulSoup
from bs4.element import Comment
from selenium import webdriver

from sys import argv
import csv
import time
import re
import pandas as pd

ERROR_MSG_ARG = "Date is given as argument"

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
    while count < 150: #120
        try:
            loadMoreButton = driver.find_element_by_xpath("//div[@class='cta-content']")
            loadMoreButton.click()
            time.sleep(2)
            count += 1
        except Exception as e:
            print (e)
            break
    print ("Complete")

    soup = BeautifulSoup(driver.page_source, 'html.parser')
    links = []

    section = soup.find("section", attrs={"class": "list-body"})

    for a in section.find_all("a"):
        link = a.get('href')
        if (link.find(r'author') == -1 and link.find(r'tag') == -1 and link not in links and link != None):
            links.append(link)

    return(links)

def get_text(urls, writer, cat):
    count = 1
    for url in urls:
        if(url.find('https') == -1):
            url = "https://www.coindesk.com" + url
        response = requests.get(url)

        if (response.status_code // 100 == 2):
            print(url)
            html = response.text
            soup = BeautifulSoup(html, 'html.parser')

            try:
                div = soup.find("div", attrs={"class": "article-hero-media-wrapper"})
                if div != None:
                    imgUrl = div.find("picture", attrs={"class":"responsive-picture"}).find("img").get("src")
                else:
                    div = soup.find("div", attrs={"class": "media-wrapper"})
                    imgUrl = div.find("picture", attrs={"class":"responsive-picture"}).find("img").get("src")
                
                headline = soup.find("h1").text 
                texts = ""
                section = soup.find("section", attrs={"class": "article-body"})
                pars = section.find_all("p", attrs={"class": "text"})
                for par in pars:
                    text = par.text.replace(u'\xa0', '')
                    text = text.replace(u'\n', '')
                    texts += "&lt;p&gt;" + text + "&lt;p&gt;" 
                print("document ", count, ": ",headline)
                count +=1
                writer.writerow({'category': cat, 'imgUrl': imgUrl, 'headline': headline, 'content': [texts]})
            except Exception as ex:
                print(ex)
                pass


def main(date):
    fileName =  "economy_coindesk_" + str(date) + ".csv"
    cat_csv = open(fileName, "w+", newline='', encoding="utf-8")
    colNames = ['category', "imgUrl", "headline", "content"]
    cat_writer = csv.DictWriter(cat_csv, fieldnames=colNames, delimiter=',')
    cat_writer.writeheader()

    url = "https://www.coindesk.com/category/business"
    urls = find_urls(url)
    
    get_text(urls, cat_writer, 'economy')

    cat_csv.close()

if __name__ == "__main__":
    if len(argv) == 2:
        main(argv[1])
    else:
        print(ERROR_MSG_ARG)