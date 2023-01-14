# -*- coding: utf-8 -*-
import scrapy
import loguru
from datetime import date
from us.items import HistoryFile


class StocksSpider(scrapy.Spider):
    name = 'stocks'
    def __init__(self, *args, **kwargs): 
        super(StocksSpider, self).__init__(*args, **kwargs) 
        endpoints = kwargs.get('stocks_list').split(',')
        start_date = kwargs.get('start_date').split(',')
        self.stocks = {}
        for i in range(len(endpoints)):
            self.stocks[endpoints[i]] = start_date[i]



    allowed_domains = ['www.nasdaq.com']
    start_urls = ['http://www.nasdaq.com/']
    custom_settings = {
        "ITEM_PIPELINES": {
            "us.pipelines.StockPipeline": 300
        }
    }

    def parse(self, response):

#        stocks = ["aapl", "amzn", "tsla", "nflx", "msft", "apam", "googl"]
#        stocks = getattr(self,'stocks_list','')
#        stocks = []
#        stocks = self.stocks_list

        for s ,dt  in self.stocks.items():
            history = HistoryFile()
            url_tpl = (
                "https://www.nasdaq.com/api/v1/historical/"
                "{stock}/"
                "stocks/"
                "{start}/"
                "{end}"
            )
            today = date.today()
#            start = "{y}-{m}-{d}".format(y=today.year - 10,
#                                         m="0" + str(today.month) if (today.month < 10) else today.month,
#                                         d="0" + str(today.day) if (today.day < 10) else today.day)
            end = "{y}-{m}-{d}".format(y=today.year,
                                       m="0" + str(today.month) if (today.month < 10) else today.month,
                                       d="0" + str(today.day) if (today.day < 10) else today.day)
            url = url_tpl.format(stock=s.upper(),
                                 start=dt,
                                 end=end)
            print("\n\n Helo there we are going to open the following url \n\n",url, '\n\n')
            loguru.logger.info(url)
            history["file_urls"] = [url]
            yield history
