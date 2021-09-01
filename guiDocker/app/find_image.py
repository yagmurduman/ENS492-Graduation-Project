from selenium import webdriver
import time, requests
import uuid

def search_google(search_query, website_type, save=False):
    website_folder = ""
    if website_type == "news":
        website_folder = "news_website/news"
    elif website_type == "blog":
        website_folder = "blog_website/blog"

    options = webdriver.ChromeOptions()
    options.add_argument('--headless')
    options.add_argument('--no-sandbox')
    options.add_argument("--disable-dev-shm-usage")
    browser = webdriver.Chrome(options=options)
    #executable_path=r'usr/local/bin/chromedriver',
    search_url = f"https://www.google.com/search?site=&tbm=isch&source=hp&biw=1873&bih=990&q={search_query}"

    # open browser and begin search
    browser.get(search_url)
    elements = browser.find_elements_by_class_name('rg_i')

    imageFile = ""
    index = 0
    while (imageFile == "" and index<40):
        try:
            # get images source url
            elements[index].click()
            time.sleep(1)
            element = browser.find_elements_by_class_name('v4dQwb')

            big_img = element[0].find_element_by_class_name('n3VNCb')

            image_url = big_img.get_attribute("src")

            # write image to file or return url
            response = requests.get(image_url)
            # print(response.status_code)
            if response.status_code == 200:
                if save == False:
                    imageFile = image_url
                else:
                    imageFile = website_folder + f"/images/search{uuid.uuid1()}.jpg"
                    with open(imageFile,"wb") as file:
                        file.write(response.content)

        except:
            index += 1
            pass
    
    return imageFile


