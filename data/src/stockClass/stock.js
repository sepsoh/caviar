const mysql = require('mysql');

module.exports =  class Stocks {
    setDBInfo (){
        this.DB = {
            host: "localhost",
            user: "root",
            password: "ensALI!)(PASS82",
            database: "User"
        };
    }
   
    seeAllInformationOfStockWithDateLimit( information , result ) {


        let query = `select * from ${information.stockName} where date >= 
                                    '${String(information.startDate)}' and date <= 
                                    '${String(information.finishDate)}';`;
        this.setDBInfo();
        let connection = mysql.createConnection({
            host: this.DB.host,
            user: this.DB.user,
            password: this.DB.password,
            database: this.DB.database
          });
        
        connection.connect(  ( err )=> {
            
            if( err ) {

                //console.log(`ther is problem to connect to data base ${err}`);
                let response = {
                    status: false,
                    statusId: 502,
                    message: `there is problem to connect to data base`
                };
                return result(response);
            
            }else {
                connection.query( query ,( err , dataResult , fields ) => {
                    
                    if( err ) {
                        
                        //console.log(`there is problem to find your query error ${err}`);
                        let response = {
                            status: false,
                            statusId: 502,
                            message: `ther is problem to connect to find your query`
                        };
                        return(result(response));
                    }else {
                        let response = {
                            status: true,
                            statusId: 200,
                            message: `everything is good`,
                            data: dataResult
                        };
                        return(result(response));
                    
                    }
             
                });                
            }
        
        });
        
    }

}