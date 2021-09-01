import bbc_scrape
import bbc_sport_scrape
import cnn_entertainment_scrape
import cnn_health_scrape
import cnn_sport_scrape
import cnn_travelnews_scrape
import guardian_sport_scrape
import nytimes_scrape
import fox_scrape

from sys import argv

"""
nytimes_economy_scrape infinite scrolls - last: 04.20 (02.07)
coindesk_scrape load more button - last: 04.20
"""

ERROR_MSG_ARG = "Date is given as argument"

def main(date):
    bbc_scrape.main(date)
    bbc_sport_scrape.main(date)
    cnn_entertainment_scrape.main(date)
    cnn_health_scrape.main(date)
    cnn_sport_scrape.main(date)
    cnn_travelnews_scrape.main(date)
    guardian_sport_scrape.main(date)
    nytimes_scrape.main(date)
    fox_scrape.main(date)


if __name__ == "__main__":
    if len(argv) == 2:
        main(argv[1])
    else:
        print(ERROR_MSG_ARG)