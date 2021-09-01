"""
Input: csv file that contains headline and content columns
Output: csv file {nId': "", 'nTitle': headline, 'nContent': [texts], 'nDate': date, 'img': imgUrl, 'type': randNum}

extractKeywords: extracts keywords from headline + content (limit --> 1 second	5 requests)
search_google: finds an image according to extracted keywords
img column choices: the path of saved image or url of image
"""
from sys import argv
import csv
import time
import re
import random
from datetime import datetime, timedelta

from monkeylearn_api import extractKeywords
from find_image import search_google

import mysql.connector

TABLES = ["scraped_content", "paraphrase_content", "gpt2_content"]

CATEGORIES = {"economy":1, "health":2, "entertainment":3, "fashion":3, "science":4, "sport":5,
                "tech":6, "travelnews":7, "world":7}

def strToBool(value):
    if value == "True":
        return True
    else:
        return False

def random_date():
    today = datetime.now()
    firstDay = today.replace(day=1)
    lastMonth = firstDay - timedelta(days=1)
    start = lastMonth.replace(day=today.day)
    end = today
    delta = end - start
    timeBetweenDates = (delta.days * 24 * 60 * 60) + delta.seconds
    randomTime = random.randrange(timeBetweenDates)
    return (start + timedelta(seconds=randomTime)).strftime('%m/%d/%Y %I:%M %p')

def getType(index):
    if (index < 10):
        return 0
    elif (index < 20):
        return 1
    elif (index < 30):
        return 2
    elif (index < 40):
        return 3
    elif (index < 50):
        return 4
    else:
        type_number = 4
        return random.randint(0,type_number)

def get_data_db(table_name, num_sequences, category_id):
    try:
        connection = mysql.connector.connect(host='34.66.139.63',
                                            database='content_db',
                                            user='root',
                                            password='secret',
                                            )

        sql_select_Query = "select headline,content from " + table_name + " WHERE category_id=" + str(category_id)  + " ORDER BY RAND() LIMIT " + str(num_sequences)
        cursor = connection.cursor()
        cursor.execute(sql_select_Query)
        # get all records
        records = cursor.fetchall()

    except mysql.connector.Error as e:
        print("Error reading data from MySQL table", e)
    finally:
        if connection.is_connected():
            connection.close()
            cursor.close()
            print("MySQL connection is closed")
            return records

def make_csv(rows, writer, save=False):

    for index, row in enumerate(rows):   
        headline = row[0]
        content = row[1]
        if content[0] == '[': content = content[2:-2]
        date = random_date()
        typeInt = getType(index)

        try:
            text = headline + " " + content
            keywords = extractKeywords(text)
            time.sleep(2)
            imageFile = search_google(keywords, "news", save)[18:]

            if imageFile:
                writer.writerow({'nId': 0, 'nTitle': headline, 'nContent': [content], 'nDate': date, 'img':imageFile, 'type': typeInt})
            else:
                print("image file not found")
        except Exception as ex:
            print(ex)
            pass


def generate_news_data(table_name, category_name, picture_save, num_sequences):

    fileName =  r"news_website/news_content.csv"
    cat_csv = open(fileName, "w+", newline='', encoding="utf-8")
    colNames = ["nId", "nTitle", "nContent", "nDate", "img", "type"]
    cat_writer = csv.DictWriter(cat_csv, fieldnames=colNames, delimiter=',')
    cat_writer.writeheader()

    #get headline,content from database
    category_id = CATEGORIES[category_name]
    data = get_data_db(table_name, num_sequences, category_id)

    make_csv(rows=data, writer=cat_writer, save=strToBool(picture_save))

    cat_csv.close() 

    return fileName

