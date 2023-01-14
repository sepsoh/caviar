# -*- coding: utf-8 -*-

# Define here the models for your spider middleware
#
# See documentation in:
# https://docs.scrapy.org/en/latest/topics/spider-middleware.html

from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from scrapy import signals
import scrapy
import time
import random
import loguru


class UsSpiderMiddleware(object):
    # Not all methods need to be defined. If a method is not defined,
    # scrapy acts as if the spider middleware does not modify the
    # passed objects.

    @classmethod
    def from_crawler(cls, crawler):
        # This method is used by Scrapy to create your spiders.
        s = cls()
        crawler.signals.connect(s.spider_opened, signal=signals.spider_opened)
        return s

    def process_spider_input(self, response, spider):
        # Called for each response that goes through the spider
        # middleware and into the spider.

        # Should return None or raise an exception.
        return None

    def process_spider_output(self, response, result, spider):
        # Called with the results returned from the Spider, after
        # it has processed the response.

        # Must return an iterable of Request, dict or Item objects.
        for i in result:
            yield i

    def process_spider_exception(self, response, exception, spider):
        # Called when a spider or process_spider_input() method
        # (from other spider middleware) raises an exception.

        # Should return either None or an iterable of Request, dict
        # or Item objects.
        pass

    def process_start_requests(self, start_requests, spider):
        # Called with the start requests of the spider, and works
        # similarly to the process_spider_output() method, except
        # that it doesn’t have a response associated.

        # Must return only requests (not items).
        for r in start_requests:
            yield r

    def spider_opened(self, spider):
        spider.logger.info('Spider opened: %s' % spider.name)


class UsDownloaderMiddleware(object):
    # Not all methods need to be defined. If a method is not defined,
    # scrapy acts as if the downloader middleware does not modify the
    # passed objects.

    @classmethod
    def from_crawler(cls, crawler):
        # This method is used by Scrapy to create your spiders.
        s = cls()
        crawler.signals.connect(s.spider_opened, signal=signals.spider_opened)
        return s

    def process_request(self, request, spider):
        # Called for each request that goes through the downloader
        # middleware.

        # Must either:
        # - return None: continue processing this request
        # - or return a Response object
        # - or return a Request object
        # - or raise IgnoreRequest: process_exception() methods of
        #   installed downloader middleware will be called
        return None

    def process_response(self, request, response, spider):
        # Called with the response returned from the downloader.

        # Must either;
        # - return a Response object
        # - return a Request object
        # - or raise IgnoreRequest
        return response

    def process_exception(self, request, exception, spider):
        # Called when a download handler or a process_request()
        # (from other downloader middleware) raises an exception.

        # Must either:
        # - return None: continue processing this exception
        # - return a Response object: stops process_exception() chain
        # - return a Request object: stops process_exception() chain
        pass

    def spider_opened(self, spider):
        spider.logger.info('Spider opened: %s' % spider.name)


class RotateProxyMiddleware(object):

    def process_request(self, request, spider):

        # webdriver setting
        options = webdriver.ChromeOptions()
        options.add_argument('--headless')

        # webdriver request
        driver = webdriver.Chrome(chrome_options=options)
        driver.get("http://free-proxy-list.net")
        time.sleep(1)

        # real time random select free proxy from website
        row = int(random.randint(1, 20))

        ip_xpath = "//tbody/tr[{row}]/td[1]".format(row=row)
        ip = driver.find_element_by_xpath(ip_xpath).text

        port_xpath = "//tbody/tr[{row}]/td[2]".format(row=row)
        port = driver.find_element_by_xpath(port_xpath).text

        proxy = "{ip}:{port}".format(ip=ip, port=port)
        loguru.logger.info("Hold Proxy {proxy}".format(proxy=proxy))
        driver.quit()

        # hold proxy
        request.meta["proxy"] = proxy


class RotateAgentMiddleware(object):

    def process_request(self, request, spider):

        # webdriver setting
        options = webdriver.ChromeOptions()
        options.add_argument('--headless')

        # webdriver request
        driver = webdriver.Chrome(chrome_options=options)
        driver.get("https://deviceatlas.com/blog/list-of-user-agent-strings")
        time.sleep(1)

        # real time random select user agent from website
        agent_list = driver.find_elements_by_xpath("//td")
        agent = (random.choice(agent_list)).text
        loguru.logger.info("Hold Agent {agent}".format(agent=agent))
        driver.quit()

        # hold user agent
        request.headers["User-Agent"] = agent


class SeleniumMiddleware(object):

    def process_request(self, request, spider):

        # webdriver setting
        options = webdriver.ChromeOptions()
        options.add_argument('--proxy-server=%s' % request.meta["proxy"])
        options.add_argument('--user-agent=%s' % request.headers["User-Agent"])

        # webdriver request
        driver = webdriver.Chrome(chrome_options=options)
        driver.get(request.url)
        time.sleep(10)

        return scrapy.http.HtmlResponse(url=request.url,
                                        status=200,
                                        body=driver.page_source
                                                   .encode("utf-8"),
                                        encoding="utf-8")


class NasdaqMiddleware(object):

    def process_request(self, request, spider):

        url = request.url

        # webdriver setting
        options = webdriver.ChromeOptions()
        # options.add_argument('--headless')
        # options.add_argument('--proxy-server=%s' % request.meta["proxy"])
        # options.add_argument('--user-agent=%s' % request.headers["User-Agent"])

        # webdriver request
        driver = webdriver.Chrome(chrome_options=options)
        driver.set_window_size(1440, 800)
        driver.delete_all_cookies()
        driver.get(url)

        # clean popup
        popup_xpath = (
            ".//button["
            "contains(@class, \"agree-button\")"
            " and "
            "contains(@class, \"eu-cookie-compliance-default-button\")"
            "]"
        )
        popup_element = WebDriverWait(driver, 60).until(
            EC.element_to_be_clickable((By.XPATH, popup_xpath))
        )
        loguru.logger.warning(popup_element)
        popup_element.click()
        time.sleep(5)

        # select time
        time_xpath = (
            ".//div["
            "@class=\"table-tabs__list\""
            "]/button[5]"
        )
        time_element = WebDriverWait(driver, 60).until(
            EC.element_to_be_clickable((By.XPATH, time_xpath))
        )
        time_element.click()
        time.sleep(5)

        # page count
        download_xpath = (
            ".//a["
            "@class=\"historical-data__download\""
            "]"
        )
        download = driver.find_element_by_xpath(download_xpath).get_attribute("href")
        loguru.logger.info("Get url: {download}".format(download=download))

        driver.quit()

        return scrapy.http.HtmlResponse(url=url,
                                        status=200,
                                        body=download.encode('utf-8'),
                                        encoding='utf-8')
