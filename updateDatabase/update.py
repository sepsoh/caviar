import sys
sys.path.append('src')

import Db_update
import Db_connect

class Update():
    
    def __init__(self, Method = 'nasdaq', symbol= None, parent = None):
  
        self.connection_pool = Db_connect.connect(self)
        self.db_list = {}
        self.method = Method

    db_update = Db_update.db_update

