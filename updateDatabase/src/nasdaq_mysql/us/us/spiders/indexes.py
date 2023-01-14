# -*- coding: utf-8 -*-
import scrapy
import loguru
from datetime import date
from us.items import HistoryFile


class IndexesSpider(scrapy.Spider):
    name = 'indexes'
    allowed_domains = ['www.nasdaq.com']
    start_urls = ['http://www.nasdaq.com/']
    custom_settings = {
        "ITEM_PIPELINES": {
            "us.pipelines.IndexPipeline": 300
        }
    }

    def parse(self, response):

        indexes = ["ndx", "spx", "nya", "ixic", "rut"]

        for i in indexes:

            # new data holder
            history = HistoryFile()
            url_tpl = (
                "https://www.nasdaq.com/api/v1/historical/"
                "{index}/"
                "index/"
                "{start}/"
                "{end}"
            )
            today = date.today()
            start = "{y}-{m}-{d}".format(y=today.year - 5,
                                         m="0" + str(today.month) if (today.month < 10) else today.month,
                                         d="0" + str(today.day) if (today.day < 10) else today.day)
            end = "{y}-{m}-{d}".format(y=today.year,
                                       m="0" + str(today.month) if (today.month < 10) else today.month,
                                       d="0" + str(today.day) if (today.day < 10) else today.day)
            url = url_tpl.format(index=i.upper(), start=start, end=end)
            loguru.logger.info(url)
            history["file_urls"] = [url]
            yield history
