import time
import os

os.chdir('us')
os.system('scrapy crawl stocks')
os.system('scrapy crawl indexes')

