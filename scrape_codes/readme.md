Scrape Codes
============

Data collection can be done via scraping throughout the web. 

### Steps to run
1. Some pipelines can run periodically. Because the data changes periodically and we cannot access the old data. For periodic scraping of websites run parent_scrape and run it periodically. It takes MM.DD date as an argument. 
```bash
python parent_scrape.py 06.11
```
2. **coindesk_scrape.py**, **nbcnews_scrape.py**, **nytimes_economy_scrape.py**, **reuters_scrape.py** uses selenium to scroll down or clicking the load more button. Running them one time will be enough.
```bash
python coindesk_scrape.py 06.11
python nbcnews_scrape.py 06.11
python nytimes_economy_scrape.py 06.11
python reuters_scrape.py 06.11
``` 
