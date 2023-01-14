import shutil
import schedule
import time
import subprocess

DATA_DIR = "../data/"


class Scraper():

    def __init__(self):
        pass

    def clean_all(self):
        shutil.rmtree(DATA_DIR, ignore_errors=True)

    def scrape_all(self):
         subprocess.call(["./job.sh"])


def job(app):
    app.scrape_all()


def main():
    app = Scraper()
    job(app)
    schedule.every().day.at("08:00").do(job, app)
    while True:
        schedule.run_pending()
        time.sleep(10)


if __name__ == '__main__':
    main()
