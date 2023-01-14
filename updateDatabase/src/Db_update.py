#from python_mysql_dbconfig import read_db_config
#from mysql.connector import MySQLConnection, Error
import pandas as pd
import numpy as np
import datetime as dt
from datetime import date
import yfinance as yf
#import sh
import os
import csv
import math

dateparse = lambda x: pd.datetime.strptime(x, '%Y-%m-%d')

def insert_table(self,symb,date,Close,Vol, Open, High, Low,mycursor,conn):

    check = True
#    print("Vol = ",Vol)

    if math.isnan(Close):
        check = False
    if math.isnan(Vol):
        check = False
    if math.isnan(Open):
        check = False
    if math.isnan(High):
        check = False
    if math.isnan(Low):
        check = False

#    print("check = ",check)
    if check:
        sql = "INSERT INTO PriceHistory (name, Date, Close, Volume, Open, High, Low) VALUES (%s, %s, %s, %s, %s, %s, %s)"
        val = [
                symb, date, Close, Vol, Open, High, Low
        ]

        mycursor.execute(sql, val)
        conn.commit()

def update_table_nasdaq(self, symb, mycursor,conn):


        comm = "SELECT Date FROM `{name}` ORDER BY Date DESC LIMIT 1".format( name=symb)
        mycursor.execute(comm)
        rows = mycursor.fetchall()
        if not rows:
            print(" view is empty")
            up_date = "1900-01-01"
        else:
            print(rows[0][0])
            up_date = "{y}-{m}-{d}".format(y=rows[0][0].year,
                                       m="0" + str(rows[0][0].month) if (rows[0][0].month < 10) else rows[0][0].month,
                                       d="0" + str(rows[0][0].day) if (rows[0][0].day < 10) else rows[0][0].day)

        today = date.today()
        check = False

        if not rows:
            os.chdir('src/nasdaq_mysql/us')
            print("hi 1")
            os.system('rm -rf ../data')
            os.system('scrapy crawl stocks -a stocks_list={List} -a start_date={Date}'.format(List=symb,Date=up_date))
            os.chdir('../../../')
            check = True
        else:
            if today != rows[0][0]:
                print("hi 2\n",os.system('pwd'))
                os.chdir('src/nasdaq_mysql/us')
                print("hi3")
                os.system('rm -rf ../data')
                os.system('scrapy crawl stocks -a stocks_list={List} -a start_date={Date}'.format(List=symb,Date=up_date))
                os.chdir('../../../')
                check = True

        if check:
            datafile = 'src/nasdaq_mysql/data/us_stocks/{name}.csv'.format(name=symb.lower())

            try:

                data = pd.read_csv(datafile, index_col = 'Date')

                data.index = pd.to_datetime(data.index)
                data_len = len(data.index)-1

                data[' Close/Last']=data[' Close/Last'].replace({'\$': ''}, regex=True)
                data[' Open']=data[' Open'].replace({'\$': ''}, regex=True)
                data[' High']=data[' High'].replace({'\$': ''}, regex=True)
                data[' Low']=data[' Low'].replace({'\$': ''}, regex=True)

                for k in range(data_len,-1,-1):
                    if not rows:
                        Open = data[' Open'].astype('double')[k].item()
                        High = data[' High'].astype('double')[k].item()
                        Low = data[' Low'].astype('double')[k].item()
                        Close = data[' Close/Last'].astype('double')[k].item()
                        Volume = data[' Volume'].astype('int')[k].item()
                        insert_table(self,symb,data.index[k].strftime('%Y-%m-%d %H:%M:%S'), Close, Volume, Open, High, Low,mycursor,conn)

                    elif data.index[k] > rows[0][0]:
                        Open = data[' Open'].astype('double')[k].item()
                        High = data[' High'].astype('double')[k].item()
                        Low = data[' Low'].astype('double')[k].item()
                        Close = data[' Close/Last'].astype('double')[k].item()
                        Volume = data[' Volume'].astype('int')[k].item()
                        insert_table(self,symb,data.index[k].strftime('%Y-%m-%d %H:%M:%S'), Close, Volume, Open, High, Low,mycursor,conn)

            except:
                print("no data in downloaded data file")


            os.system('rm -f {}'.format(datafile))

        else:
            print('{} databes is update'.format(symb))
 

def update_table_macrotrends(self, symb, mycursor,conn):


        comm = "SELECT Date FROM `{name}` ORDER BY Date DESC LIMIT 1".format( name=symb)
        mycursor.execute(comm)
        rows = mycursor.fetchall()
        if not rows:
            print(" view is empty")
            up_date = "1900-01-01"
        else:
            print(rows[0][0])
            up_date = "{y}-{m}-{d}".format(y=rows[0][0].year,
                                       m="0" + str(rows[0][0].month) if (rows[0][0].month < 10) else rows[0][0].month,
                                       d="0" + str(rows[0][0].day) if (rows[0][0].day < 10) else rows[0][0].day)

        today = date.today()
        check = False

        if not rows:
            os.system('wget http://download.macrotrends.net/assets/php/stock_data_export.php?t={sym} -O {sym}.csv'.format(sym=symb.upper()))
            check = True
        else:
            if today != rows[0][0]:
                os.system('wget http://download.macrotrends.net/assets/php/stock_data_export.php?t={sym} -O {sym}.csv'.format(sym=symb.upper()))
                check = True

        if check:
            datafile = '{name}.csv'.format(name=symb.upper())
            data = pd.read_csv(datafile, index_col = 'date', date_parser=dateparse,skiprows=14)


            if data.empty:
                print('data is empty ')

            data.index = pd.to_datetime(data.index)
            data_len = len(data.index)-1

            for k in range(data_len,-1,-1):
                if not rows:
                    Open = data['open'].astype('double')[k].item()
                    High = data['high'].astype('double')[k].item()
                    Low = data['low'].astype('double')[k].item()
                    Close = data['close'].astype('double')[k].item()
                    Volume = data['volume'].astype('int')[k].item()

                    insert_table(self,symb,data.index[k].strftime('%Y-%m-%d %H:%M:%S'), Close, Volume, Open, High, Low,mycursor,conn)

                elif data.index[k] > rows[0][0]:
                    Open = data['open'].astype('double')[k].item()
                    High = data['high'].astype('double')[k].item()
                    Low = data['low'].astype('double')[k].item()
                    Close = data['close'].astype('double')[k].item()
                    Volume = data['volume'].astype('int')[k].item()

                    insert_table(self,symb,data.index[k].strftime('%Y-%m-%d %H:%M:%S'), Close, Volume, Open, High, Low,mycursor,conn)

        os.system('rm -f {}'.format(datafile))
        

def update_table_yahoo(self, symb, mycursor,conn):


        comm = "SELECT Date FROM `{name}` ORDER BY Date DESC LIMIT 1".format( name=symb)
        mycursor.execute(comm)
        rows = mycursor.fetchall()
        if not rows:
            print(" view is empty")
            start_date = "1900-01-01"
        else:
#            print(rows[0][0])
            startTime = rows[0][0] + dt.timedelta(days=1)
            start_date = "{y}-{m}-{d}".format(y=startTime.year,
                                       m="0" + str(startTime.month) if (startTime.month < 10) else startTime.month,
                                       d="0" + str(startTime.day) if (startTime.day < 10) else startTime.day)

        today = date.today()
#        print('today = ',today,' start_date = ',start_date )

        check = False
        check_r = False

        if rows:
            if today != rows[0][0]:
                data = yf.download(symb.upper(), start=start_date, end=today, progress=False,)
                if not data.empty:
                    check = True
        else:
            data = yf.download(symb.upper(), start=start_date, end=today, progress=False,)
            if not data.empty:
                check = True
                check_r = True

        if check:

            if data.empty:
                print('data is empty ')

            data.index = pd.to_datetime(data.index)
            data_len = len(data.index)

            if rows:
                if data.index[data_len-1] != rows[0][0]:
                    check_r = True

            if check_r:
                for k in range(data_len):
                    Open = data['Open'].astype('double')[k].item()
                    High = data['High'].astype('double')[k].item()
                    Low = data['Low'].astype('double')[k].item()
                    Close = data['Close'].astype('double')[k].item()
#                    Volume = data['Volume'].astype('Int64')[k].item()
                    Volume = data['Volume'].fillna(0).astype('int')[k].item()
#                    print(data.index[k].strftime('%Y-%m-%d %H:%M:%S'), Close, Volume, Open, High, Low)
                    insert_table(self,symb,data.index[k].strftime('%Y-%m-%d %H:%M:%S'), Close, Volume, Open, High, Low,mycursor,conn)
       

def check_view(self, symb, mycursor):

    mycursor.execute("SHOW TABLES")
    check = True
    for x in mycursor:
        if symb == x[0]:
            check = False
            print(x[0],"\t view exist")

    if check:
        print("creating view for ",symb)
        view = "CREATE VIEW `{sy}` AS SELECT * FROM PriceHistory WHERE `name`='{sy}'".format(sy = symb)

        mycursor.execute(view)

def read_db_list(self):

    fname = 'Database/db_list.csv'
    with open(fname, newline='') as csvfile:
        reader = csv.DictReader(csvfile)
        for row in reader:
                self.db_list[row['Symbol'].strip()] = row['Name'].strip()

def db_update(self):

    try:

        connection = self.connection_pool.get_connection()
        if connection.is_connected():
            mycursor = connection.cursor(buffered=True)

        read_db_list(self)


        for k in self.db_list.keys():
            check_view(self, k, mycursor)  
            if self.method=='nasdaq':
                update_table_nasdaq(self, k, mycursor,connection)
            elif self.method=='macrotrends':
                update_table_macrotrends(self, k, mycursor,connection)
            elif self.method=='yahoo':
                update_table_yahoo(self, k, mycursor,connection)
        
    finally:
        mycursor.close()
        connection.close()


