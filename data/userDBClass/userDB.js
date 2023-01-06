const mySql = require('mysql');

//export user class as module 
module.exports = class User{

    //sign up method which add the information to user information table in User database
    signup(information,result){
        //create connection with our database
        let connection = mySql.createConnection({
            host: "localhost",
            user: "root",
            password: "ensALI!)(PASS82",
            database: "User"
        });
        //connect to our database
        connection.connect( (err) => {
            
            //this query insert information to user information table
            let query = `INSERT INTO userInformation VALUES('${information.email}',`+
                        `'${information.password}','${information.name}',`+
                        `'${information.date}')`;
            //this condition is for when we had error to connect to our database
            if(err){
                //return value which explain we had problem to connect to our data base
                let response = {
                    status: false,
                    statusId: 502,
                    message: "there is problem to connect to dataBase"
                };

                return result(response);
            }else{
                //send our query to database
                connection.query(query,(err) =>{
                    //this condtion statment is for when we got a problem to connect to 
                    if(err){
                        //return value which explain we had problem with our query
                        let response = {
                            status: false,
                            statusId: 502,
                            message: "there is somthing wrong about this query"
                        };
                        return result(response);
                    }else{
                        //in this part our signup was successfull so it will return true as status with respons status 200
                        let response = {
                            status: true,
                            statusId: 200,
                            message: "successfully signed up"
                        };
                        return result(response);
                    }
                });
            }
       });
    
    }
    //login with input email and password and return true if they were in our database
    login(email,password,result){
        //create connection with our database
        let connection = mySql.createConnection({
            host: "localhost",
            user: "root",
            password: "ensALI!)(PASS82",
            database: "User"
        });
        
        //connect to our database
        connection.connect( (err) => {
            //query which look for row with input email and password
            let query = `select * from userInformation where email = '${email}' AND password ='${[password]}';`;
            //this condition statment is for when we got problem to connect to our database
            if(err){
                //return value which shows that we had problem to connect to our database
                let response = {
                    status: false,
                    statusId: 502,
                    message: "there is problem to connect to dataBase"
                };
                 return result(response);
            }else{
                //send out query to database
                connection.query(query,(err,dataResult ) =>{
                    //statment condition for where we had error with our query
                    if(err){
                        //return value which explain that we got problem with our query
                        let response = {
                            status: false,
                            statusId: 502,
                            message: "there is somthing wrong about this query"
                        };
                        return result(response);
                    }else{
                        //if there is nothing find with our input email and password 
                        //which means the username or password is wrong 
                        if( dataResult[0] == null){
                            //return value which explain that inpu emial and password was wrong with 400 status (bad request)
                            let response = {
                                status: false,
                                statusId: 400,
                                message: "wrong username or password"
                            };
                            return result(response);  
                        }else{
                            //return value which show that user can successfullu login
                            let response ={
                                status: true,
                                statusId: 200,
                                message: "login",
                                userInformation : {
                                    name : dataResult[0].name,
                                    email : dataResult[0].email,
                                    date : dataResult[0].date
                                }
                            };

                            return result(response);
                        }
                    }
                });
            }
       });
    }
    //check if we already had the inpuy username in our database or not 
    checkUserName(email,result){
        //create connection to our database
        let connection = mySql.createConnection({
            host: "localhost",
            user: "root",
            password: "ensALI!)(PASS82",
            database: "User"
        });
        //connect to our database
        connection.connect( (err) => {
            //query to search for input username in our database
            let query = `select email from userInformation where email = '${email}';`;
            //conditional statement fot error whene we want to connect to our database
            if(err){
                //return value which explain that we had an error to connect to our database with status 502
                let response = {
                    status: false,
                    statusId: 502,
                    message: "ther is problem to connect to dataBase"
                };
                 return result(response);
            }else{
                //send query to our database
                connection.query(query,(err,dataResult ) =>{
                    //condition statement for when we got an problem with our query
                    if(err){
                        //return value which explain that we had problem with our query
                        let response = {
                            status: false,
                            statusId: 502,
                            message: "there is somthing wrong about this query"
                        };
                        return result(response);
                    }else{
                        //if first row of data result is not null shows that we already 
                        //had this username in our database else it is unique
                        if( dataResult[0] != null){
                            //return value which shows that we already had this username in our database with status 400 (bad request)
                            let response = {
                                status: false,
                                statusId: 400,
                                message: "we already had this username in our databases"
                            };
                            return result(response);  
                        }else{
                            //return value which means that the input username was unique and correct
                            let response ={
                                status: true,
                                statusId: 200,
                                message: "can use this username"
                            };
                            return result(response);
                        }
                    }
                });
            }
       });
    }
}