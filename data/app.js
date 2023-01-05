const express = require('express');
const app = express();
const Stocks = require('./stock.js');
const mysql = require('mysql');
app.use(express.json());

app.get('/api/raw/:stockName',(req,res) => {
    if(!req.params.stockName){
        res.send(400);
        //console.log(res.body.name);
    }else{
        var stockName = req.params.stockName;
        var query = 'select * from '+stockName+';';
        console.log(stockName)
        
        var connection = mysql.createConnection({
    
            host: "localhost",
            user: "root",
            password: "ensALI!)(PASS82",
            database: "khepri_db"
        });
        
        connection.connect( ( err ) => {
            
            if( err ) {

                console.log(`there is problem to find your query error ${err}`);
                res.status(585);
                return false;
            
            }else {
                connection.query( query ,( err , result , fields ) => {
                    
                    if( err ) {
                    
                        console.log(`there is problem to find your query error ${err}`);
                        res.status(404).send('this stack is not exist in our data bases');
                        return false;
                     
                    }else {

                        res.send(JSON.stringify(result));

                    }
             
                });                
            }
        
        });
    }
});
app.post('/api/raw/getStockInfo',(req,res) => {
    if(!req.body.name && !req.body.startDate && !req.body.finishDate){
        res.send(400);
        console.log(req.body.name +' '+req.body.startDate+' '+req.body.finishDate);
    }else{
        let stockName = req.body.name;
        let startDate = req.body.startDate;
        let finishDate = req.body.finishDate;
        let query = 'select * from '+stockName+' where date>'+startDate+' and date <'+finishDate+';';
        console.log(stockName)
        
        let connection = mysql.createConnection({
    
            host: "localhost",
            user: "root",
            password: "ensALI!)(PASS82",
            database: "khepri_db"
        });
        
        connection.connect( ( err ) => {
            
            if( err ) {

                console.log(`there is problem to find your query error ${err}`);
                res.status(585);
                return false;
            
            }else {
                connection.query( query ,( err , result , fields ) => {
                    
                    if( err ) {
                    
                        console.log(`there is problem to find your query error ${err}`);
                        res.status(404).send('this stack is not exist in our data bases');
                        return false;
                     
                    }else {

                        res.send(JSON.stringify(result));

                    }
             
                });                
            }
        
        });
    }
 
    
});

app.listen(8080, () =>{
    console.log('listening on port 8080');
});

 