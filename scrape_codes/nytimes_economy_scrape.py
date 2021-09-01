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
    scroll_pause_time = 1 # You can set your own pause time. My laptop is a bit slow so I use 1 sec
    screen_height = driver.execute_script("return window.screen.height;")   # get the screen height of the web
    i = 1

    while True:
        # scroll one screen height each time
        driver.execute_script("window.scrollTo(0, {screen_height}*{i});".format(screen_height=screen_height, i=i))  
        i += 1
        time.sleep(scroll_pause_time)
        # update scroll height each time after scrolled, as the scroll height can change after we scrolled the page
        scroll_height = driver.execute_script("return document.body.scrollHeight;")  
        # Break the loop when the height we need to scroll to is larger than the total scroll height
        if (screen_height) * i > scroll_height:
            break 

    soup = BeautifulSoup(driver.page_source, 'html.parser')
    links = []

    section = soup.find("section", attrs={"id": "stream-panel"})

    urls = section.find_all("a")
    for url in urls:
        link = url.get('href')
        if (link not in links and re.findall(r'^/\d{4}/\d{2}/\d{2}', link)):
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
                writer.writerow({'category': cat, 'url': url, 'headline': headline, 'content': [texts]})
            except Exception as ex:
                print(ex)
                pass

def main(date):
    fileName = "economy_nytimes_" + str(date) + ".csv"
    cat_csv = open(fileName, "w+", newline='', encoding="utf-8")

    colNames = ['category', "url", "headline", "content"]
    cat_writer = csv.DictWriter(cat_csv, fieldnames=colNames, delimiter=',')
    cat_writer.writeheader()

    url = "https://www.nytimes.com/section/business/economy"
    urls = find_urls(url)
    get_text(urls, cat_writer, 'economy')

    cat_csv.close()

if __name__ == "__main__":
    if len(argv) == 2:
        main(argv[1])
    else:
        print(ERROR_MSG_ARG)