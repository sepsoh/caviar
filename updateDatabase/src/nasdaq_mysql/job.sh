#!/bin/bash

cd us/
pipenv run scrapy crawl indexes
pipenv run scrapy crawl stocks
