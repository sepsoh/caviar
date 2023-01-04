const mysql = require('mysql');


class MysqlInformation {

    constructor() {

        this.host = 'localhost';
        this.dataBase = 'khepri-db';
        this.user = 'root';
        this.password = 'ensALI!)(PASS82';
    
    }

    setTable( stockName ) {
        
        this.stockName = stockName;
    
    }

}
class Stocks {

    constructor() {

    } 
    
    /*setName( name ) {
    
        this.name = name;
    
    }
    setDate( date ) {
    
        this.date = date;
    
    }
    
    setClose( close ) {
    
        this.close = close;
    
    }
    
    setVolume( volume ) {
    
        this.volume = volume;
    
    }

    setOpen( open ) {
    
        this.open = open;
    
    }

    setHigh( high ) {

        this.high = high;
    
    }
    
    setLow( low ) {
    
        this.low = low;
    
    }
   */ 

    seeAllInformationOfStock( stockName ) {

        var query = 'select * from '+stockName+';';

        var connection = mysql.createConnection({
            host: "localhost",
            user: "root",
            password: "ensALI!)(PASS82",
            database: "khepri_db"
          });
        
        connection.connect(  ( err )=> {
            
            if( err ) {

                console.log(`there is problem to find your query error ${err}`);
                return false;
            
            }else {
                connection.query( query ,( err , result , fields ) => {
                    
                    if( err ) {
                        console.log(result);
                        console.log(`there is problem to find your query error ${err}`);
                        return false;
                     
                    }else {

                        
                    
                    }
             
                });                
            }
        
        });
        
    }

}

module.exports.Stocks = Stocks;

var stock = new Stocks();
console.log( stock.seeAllInformationOfStock('AAPL')+' hi');
console.log( stock.result);