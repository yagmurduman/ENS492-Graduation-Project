from flask import Flask, jsonify, request, abort, Response, send_file, send_from_directory
from flask_cors import CORS
from generate_news_data import generate_news_data
from generate_blog_data import generate_blog_data
from template_variables import setCompanyTemplate, setNewsTemplate, setBlogTemplate
import os
import subprocess

app = Flask(__name__)
app.config['DEBUG'] = True
app.config['DOWNLOAD_FOLDER'] = 'download'
# enable CORS
CORS(app)


def makeZip(website_type, picture_save=False, theme="dark"):
    if website_type == "news":
        subprocess.call(['zip', '-r', 'app/download/archive.zip', 'news_website'])
        if picture_save == "True":           
            os.system("rm news_website/news/images/*")
        os.system("rm news_website/news_content.csv")
    elif website_type == "blog":
        subprocess.call(['zip', '-r', 'app/download/archive.zip', 'blog_website'])
        if picture_save == "True":
            os.system("rm blog_website/blog/images/*")
        os.system("rm blog_website/blog_content.csv")
    elif website_type == "company":
        if theme == "dark":
            subprocess.call(['zip', '-r', 'app/download/archive.zip', 'company_dark'])
            os.system("rm company_dark/source/images/*")
        else:
            subprocess.call(['zip', '-r', 'app/download/archive.zip', 'company_light'])
            os.system("rm company_light/source/images/*")

    

@app.errorhandler(404)
def page_not_found(error):
   return "<h2>cannot find your page :(</h2>"

@app.route('/', methods=["GET"])
def home():
    return "<h2>Content Server Backend</h2>"

@app.route('/get-contents-news', methods=["POST"])
def getContentsNews():
    if not request.json:
        return Response("{'Response':'Not JSON format'}", status=400, mimetype='application/json')
    contentRequest ={
        'website_type': request.json['website_type'].lower(), #news, blog
        'table_name': request.json['table_name'].lower(), #scraped_content, gpt2_content, paraphrased_content, it_company
        'category': request.json['category'].lower(), #economy, world, entertainment
        'picture_save': request.json['picture_save'], #True, False
        'number_sequences': request.json['number_sequences'], # number: 1, 2, 3,
        'website_name': request.json['website_name'],
        'title_col': request.json['title_col'],
        'navbar': request.json['navbar'],
        'second_navbar_col': request.json['second_navbar_col'],
        'title_font_size': request.json['title_font_size'],
        'navlink_font_size': request.json['navlink_font_size'],
        'cat1': request.json['cat1'],
        'cat2': request.json['cat2'],
        'cat3': request.json['cat3'],
        'cat4': request.json['cat4'],
        'cat5': request.json['cat5']
    }

    if contentRequest['website_type'] == "news":
        fileName = generate_news_data(table_name=contentRequest['table_name'],
            category_name=contentRequest['category'],
            picture_save=contentRequest['picture_save'],
            num_sequences=contentRequest['number_sequences'])
        
        setNewsTemplate(contentRequest)

    try:
        makeZip(website_type=contentRequest['website_type'], picture_save=contentRequest['picture_save'])
        downloadFile = "archive.zip"
        response = Response("{'Response':'OK'}", status=200, mimetype='application/json')
        response.headers.add('Access-Control-Allow-Origin', '*')

        return response
    except Exception as e:
        respone = Response("{'Response':" + str(e) + "}", status=400, mimetype='application/json')
        response.headers.add('Access-Control-Allow-Origin', '*')
        return respone

# {website_type, table_name, category, picture_save, numberSeqeunces}
@app.route('/get-contents-blog', methods=["POST"])
def getContentsBlog():
    if not request.json:
        return Response("{'Response':'Not JSON format'}", status=400, mimetype='application/json')
    contentRequest ={
        'website_type': request.json['website_type'].lower(), #news, blog
        'table_name': request.json['table_name'].lower(), #scraped_content, gpt2_content, paraphrased_content, it_company
        'category': request.json['category'].lower(), #economy, world, entertainment
        'picture_save': request.json['picture_save'], #True, False
        'number_sequences': request.json['number_sequences'], # number: 1, 2, 3,
        'website_name': request.json['website_name'],
        'title_col': request.json['title_col'],
        'navbar': request.json['navbar'],
    }


    if contentRequest['website_type'] == "blog":
        fileName = generate_blog_data(table_name=contentRequest['table_name'],
            category_name=contentRequest['category'],
            picture_save=contentRequest['picture_save'],
            num_sequences=contentRequest['number_sequences'])

        setBlogTemplate(contentRequest)

    try:
        makeZip(website_type=contentRequest['website_type'], picture_save=contentRequest['picture_save'])
        downloadFile = "archive.zip"
        response = Response("{'Response':'OK'}", status=200, mimetype='application/json')
        response.headers.add('Access-Control-Allow-Origin', '*')

        return response
    except Exception as e:
        return Response("{'Response':" + str(e) + "}", status=400, mimetype='application/json')

@app.route('/get-contents-company', methods=["POST"])
def getContentsCompany():
    if not request.json:
        return Response("{'Response':'Not JSON format'}", status=400, mimetype='application/json')
    contentRequest ={
        'website_type': request.json['website_type'].lower(),
        'website_name': request.json['website_name'], 
        'country': request.json['country'],
        'theme': request.json['theme'].lower()
    }

    try:
        setCompanyTemplate(contentRequest["website_name"], contentRequest["country"], contentRequest["theme"])
        makeZip(website_type=contentRequest['website_type'], theme=contentRequest["theme"]),

        response = Response("{'Response':'OK'}", status=200, mimetype='application/json')
        response.headers.add('Access-Control-Allow-Origin', '*')

        return response
    except Exception as e:
        return Response("{'Response':" + str(e) + "}", status=400, mimetype='application/json')


@app.route('/download/', methods=['GET'])
def download():
    try:
        downloadFile = "archive.zip"
        return send_from_directory(app.config['DOWNLOAD_FOLDER'], downloadFile, as_attachment=True)

    except Exception as e:
        return Response("{'Response':" + str(e) + "}", status=400, mimetype='application/json')

@app.route('/clear/', methods=['GET'])
def clear():
    try:
        downloadFile = "archive.zip"
        os.system("rm app/" + app.config['DOWNLOAD_FOLDER'] + "/" + downloadFile)

        response = Response("{'Response':'OK'}", status=200, mimetype='application/json')
        response.headers.add('Access-Control-Allow-Origin', '*')

        return response
    except Exception as e:
        return Response("{'Response':" + str(e) + "}", status=400, mimetype='application/json')
    


if __name__ == '__main__':
    app.run(host='0.0.0.0')
