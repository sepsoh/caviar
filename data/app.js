const express = require('express');
const app = express();

const mysql = require('mysql');

const os = require('os');

//cpuParameter is a program which calculate the cpu Usage and return it to us
const cpuParameter = require('./cpuParameter/cpuAverage');

//Stock is class which have a lots of function that can connect to our data bases and return the value that we want so it makes our code much cleaner
const Stock = require('./stockClass/stock.js');
let stock = new Stock();


app.use(express.json());
//this api return us true whene our cpu and memory usage is smaller than 90% and also sent this two value 
app.get('/api/getStatus',(req,res) => {
    cpuParameter.findCPUUsage((cpuUsage) => {
        let memoryUsage = 100 - ~~(100 * os.freemem / os.totalmem); //calculate our memory usage with os module
        let result; // is true when our memory usage and cpu usage is less than 90% and returm false otherwise
        if(cpuUsage > 90 || memoryUsage > 90){
            result = false; 
        }else{
            result = true;
        }
        //response is object which we send it as JSON file
        let response = {
            result: result,
            cpuUsage: cpuUsage,
            memoryUsage: memoryUsage
        };
        if(result){
            res.status(200).send(JSON.stringify(response)); 
        }else{
            res.status(502).send(JSON.stringify(response));
        }

    });
});

//creating api to get information of stocks between two date
app.post('/api/raw/getStockInfo',(req,res) => {
    //in request body we get three argument name of stock , start Date , finish Date 
    if(!req.body.name && !req.body.startDate && !req.body.finishDate){
        //wrong input request
        let response = {
            result:false,
            status:`bad rquest`
        };
        res.send(400).send(JSON.stringify(response));
    }else{
        //information object is object which show the information of datas that we want to find in our databases
        let information = {
            stockName : req.body.name,
            startDate : req.body.startDate,
            finishDate : req.body.finishDate
        }
        //seeAllInformationOfStockWithDateLimit is function in our Stock class that return the information of stock in our database between two input date
        stock.seeAllInformationOfStockWithDateLimit(information,(result) => {
            console.log(result.message );//this mesaage is for command line to know the status
            if(result.status == true){
                /*response object have a status which is true if it can find the data in databases and have message and also have result 
                which is object of data which we want and sent it*/
                let response = {
                    status: result.status,
                    message: result.message,
                    data: result.data
                };
                res.status(result.statusId).send(JSON.stringify(response));
            }else{ 
                 /*response object have a status which is true if it can find and it dosent have data becuse it cant find data for any reason*/
                let response = {
                    status: result.status,
                    message: result.message,
                };
                res.status(result.statusId).send(JSON.stringify(response));
            }
        }); 
    }
 
//app will be lister for request on port 8080 localhost
});
app.listen(8080, () =>{
    console.log('listening on port 8080');
});

 