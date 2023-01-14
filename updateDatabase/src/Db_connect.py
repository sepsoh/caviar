from python_mysql_dbconfig import read_db_config
import mysql.connector
from mysql.connector import Error
from mysql.connector.connection import MySQLConnection
from mysql.connector import pooling



def connect(self):
    """ Connect to MySQL database """
    conn = None
    db_config = read_db_config()

    try:
        print('Connecting to MySQL database...')
        connection_pool = mysql.connector.pooling.MySQLConnectionPool(pool_name="khepri_pool",
                                                                  pool_size=5,
                                                                  pool_reset_session=True,
                                                                  host=db_config['host'],
                                                                  database=db_config['database'],
                                                                  user=db_config['user'],
                                                                  password=db_config['password'])




#        if connenction_pool.is_connected():
        print('Connected to MySQL database')
        print ("connection pool properties are as follow;")
        print("Connection Pool Name - ", connection_pool.pool_name)
        print("Connection Pool Size - ", connection_pool.pool_size)


#        else:
#            print('Connection failed')


    except Error as er:
        print(er)

#    finally:
#        if connection_pool is not None and connection_pool.is_connected():
#            print('Connection stablished')

    return connection_pool


