const express = require('express');
const app = express();

const mysql = require('mysql');

const os = require('os');

const process = require('process');
//cpuParameter is a program which calculate the cpu Usage and return it to us
const cpuParameter = require('./cpuParameter/cpuAverage');

//Stock is class which have a lots of function that can connect to our data bases and return the value that we want so it makes our code much cleaner
const Stock = require('./stockClass/stock.js');
const stock = new Stock();

const UserDB = require('./userDBClass/userDB.js');
const userDB = new UserDB();

const readSCV = require('./stockInformation/readCSV.js');

const cors = require('cors');
app.use(cors({
    origin: ['http://localhost:19006']
}));

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
app.post('/api/raw/getStockData',(req,res) => {
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
});
//search for stock information
app.post('/api/raw/search' , (req , res) => {
    let searchString = req.body.searchString;
    readSCV( (stockInformation) => {
        let returnValue = [];
        //search in all stocks array
        for (let stock of stockInformation){
            //if stock name or symbol has the input string
            if(String(stock.symbol).search(searchString) != -1 || String(stock.name).search(searchString) != -1){
                //add stock info to return value arraye which means that it have the input string
                returnValue.push(stock);    
            }
        }
        //if return value array lengh is 0 shows that we couldnt finde the input string
        if(returnValue.length == 0){
            let respons = {
                status : false,
                message : `cant find stock`
            };
            res.status(400).send(JSON.stringify(respons));
        }else{
            let respons = {
                status : true,
                result : returnValue
            };
            res.status(200).send(JSON.stringify(respons));
        }
    });
});
//return all stock information
app.get('/api/raw/allStockInformation' , (req,res) => {
    //read from csv file
    readSCV( (stockInformation) => {
        let respons = {
            status : true,
            result : stockInformation
        };
        res.status(200).send(JSON.stringify(respons));
    });
});
//post method to check if we had already input email in database or dont
app.post('/api/user/emailCheck' , (req,res) => {
    let email = req.body.email;
    //use checkUserName method from User class in userDB program
    userDB.checkUserName(email,  (result) => {
        //set status and message for input email after check that
        let response = {
            status: result.status,
            message: result.message
        };
        //send the respons value as json with statusId
        res.status(result.statusId).send(JSON.stringify(response));
    });
});
//post method to check login with input email and password
app.post('/api/user/login' , (req,res) => {
    let email = req.body.email;
    let password = req.body.password;
    //use login methid from User class in userDB program 
    userDB.login(email , password , (result) => {
        //create object as response value with status true or false , message and userInformation object
        let response = { 
            status: result.status,
            message: result.message,
            userInformation: result.userInformation
        };
        //send respons value as JSON with status id
        res.status(result.statusId).send(JSON.stringify(response));
    });
});
//put method to signup user with the information email password name and date
app.put('/api/user/signup' , (req,res) => {
    //create object for userInformation with request body values 
    let userInformation = {
        email : req.body.email,
        password : req.body.password,
        name: req.body.name,
        date : req.body.date
    };
    //use signup method from User class in userDB program
    userDB.signup(userInformation, (result) => {
        //create objet respons value with status and mesaage which can show our signup was successfull or not
        let response = {
            status: result.status,
            message: result.message
        };
        //send our respons object as JSON with status id
        res.status(result.statusId).send(JSON.stringify(response));
    });
});

const port = process.env.PORT || 8080;
//app will be listen for request on port 8080 localhost
//let port = 8080;
app.listen(port, () =>{
    console.log(`listening on port ${port}`);
}); 