const mysql = require('mysql');

module.exports =  class Stocks {

    seeAllInformationOfStockWithDateLimit( information , result ) {


        let query = `select * from ${information.stockName} where date >= 
                                    '${String(information.startDate)}' and date <= 
                                    '${String(information.finishDate)}';`;
        let connection = mysql.createConnection({
            host: "localhost",
            user: "root",
            password: "ensALI!)(PASS82",
            database: "khepri_db"
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