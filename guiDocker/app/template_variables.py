
"""
Company Template
data is taken from database randomly
data set up into php file 
"""
from random_address import randomAddress
import mysql.connector, shutil, random, os, uuid

def get_data_db():
    try:
        connection = mysql.connector.connect(host='34.66.139.63',
                                            database='content_db',
                                            user='root',
                                            password='secret',
                                            )

        sql_select_Query = "SELECT * FROM company_content ORDER BY RAND() LIMIT 1"
        cursor = connection.cursor()
        cursor.execute(sql_select_Query)
        # get all records
        record = cursor.fetchall()

    except mysql.connector.Error as e:
        print("Error reading data from MySQL table", e)
    finally:
        if connection.is_connected():
            connection.close()
            cursor.close()
            print("MySQL connection is closed")
            return record

def setCompanyTemplate(website_name, country, theme):
	addressInfo = randomAddress(country)
	row = get_data_db()
	if theme == "dark":
		fileName = f"company_dark/source/config/config_cont.php"
	else:
		fileName = f"company_light/source/config/config_cont.php"

	f = open(fileName,'w+')
	f.write("<?php\n\n")

	f.write("$company_name = \"" + website_name + "\";\n")
	f.write("$address = \"" + addressInfo["address"] + "\";\n")
	f.write("$phone = \"" + addressInfo["phone"] + "\";\n\n")

	f.write("$sent_1 = \"" + row[0][1] + "\";\n")
	f.write("$sent_2 = \"" + row[0][2] + "\";\n")
	f.write("$sent_3 = \"" + row[0][3] + "\";\n")
	f.write("$sent_4 = \"" + row[0][4] + "\";\n")
	f.write("$sent_5 = \"" + row[0][5] + "\";\n")
	f.write("$sent_6 = \"" + row[0][6] + "\";\n\n")

	f.write("$title_1 = \"" + row[0][7] + "\";\n")
	f.write("$title_2 = \"" + row[0][8] + "\";\n")
	f.write("$title_3 = \"" + row[0][9] + "\";\n")
	f.write("$title_4 = \"" + row[0][10] + "\";\n")
	f.write("$title_5 = \"" + row[0][11] + "\";\n")
	f.write("$title_6 = \"" + row[0][12] + "\";\n\n")


	f.write("$bullet_1 = \"" + row[0][13] + "\";\n")
	f.write("$bullet_2 = \"" + row[0][14] + "\";\n")
	f.write("$bullet_3 = \"" + row[0][15] + "\";\n")
	f.write("$bullet_4 = \"" + row[0][16] + "\";\n")
	f.write("$bullet_5 = \"" + row[0][17] + "\";\n\n")

	for i in range(1,5):
		image_destination = "company_" + theme + f"/source/images/search{uuid.uuid1()}.jpg"
		random_img = random.choice(os.listdir("app/company_images"))
		shutil.copyfile("app/company_images/"+ random_img, image_destination)
		f.write("$img"+ str(i) + "_path = \"" + image_destination[20:] + "\";\n")

	f.write("\n?>")
	f.close()

   
def setNewsTemplate(contentRequest):
	fileName = f"news_website/news/config.php"

	f = open(fileName,'w+')
	f.write("<?php\n\n")

	f.write("$news_table = \"economy_news\";\n")
	f.write("$tags_table = \"tags\";\n")
	f.write("$comments_table = \"comments\";\n")
	f.write("$contact_table = \"contact\";\n")
	f.write("$navbar_text_color = \"#EBEBE8\";\n")
	f.write("$body_backround = \"#EBEBE8\";\n")
	f.write("$font_family = \"Times New Roman\";\n\n")

	f.write("$alertnews = \"Breaking News\";\n")
	f.write("$bn_backround = \"#EBEBE8 !important\";\n")
	f.write("$bn_text_backround = \"#31352E !important\";\n")
	f.write("$bn_textcolor = \"#EBEBE8\";\n")
	f.write("$bnews_color = \"#EBEBE8\";\n\n")

	f.write("$webtitle = \""+ contentRequest["website_name"] + "\";\n")
	f.write("$titlecolor = \""+ contentRequest["title_col"] + "\";\n")
	f.write("$navbar_color = \""+ contentRequest["navbar"] + "\";\n")
	f.write("$second_navbar_color = \""+ contentRequest["second_navbar_col"] + "\";\n")
	f.write("$navlink_color = \""+ contentRequest["navbar"] + "\";\n")
	f.write("$title_font_size = \""+ contentRequest["title_font_size"] + "\";\n")
	f.write("$navlink_font_size = \""+ contentRequest["navlink_font_size"] + "\";\n\n")

	f.write("$categ1 = \""+ contentRequest["cat1"] + "\";\n")
	f.write("$categ2 = \""+ contentRequest["cat2"] + "\";\n")
	f.write("$categ3 = \""+ contentRequest["cat3"] + "\";\n")
	f.write("$categ4 = \""+ contentRequest["cat4"] + "\";\n")
	f.write("$categ5 = \""+ contentRequest["cat5"] + "\";\n")

	f.write("\n?>")
	f.close()


def setBlogTemplate(contentRequest):
	fileName = f"blog_website/blog/app/includes/config.php"

	f = open(fileName,'w+')
	f.write("<?php\n\n")

	f.write("$website_title = \""+ contentRequest["website_name"] + "\";\n")
	f.write("$text_color = \""+ contentRequest["title_col"] + "\";\n")
	f.write("$header_background = \""+ contentRequest["navbar"] + "\";\n")
	

	f.write("\n?>")
	f.close()