const { response } = require('express');
const mySql = require('mysql');

module.exports = class User{

    login(email,password,result){
        let connection = mySql.createConnection({
            host: "localhost",
            user: "root",
            password: "ensALI!)(PASS82",
            database: "User"
        });
 
        connection.connect( (err) => {
            
            let query = `select * from userInformation where email = '${email}' AND password ='${[password]}';`;
            
            if(err){
                let response = {
                    status: false,
                    statusId: 502,
                    message: "ther is problem to connect to dataBase"
                };
                 return result(response);
            }else{
                connection.query(query,(err,dataResult ) =>{
                    if(err){
                        let response = {
                            status: false,
                            statusId: 502,
                            message: "there is somthing wrong about this query"
                        };
                        return result(response);
                    }else{
                        if( dataResult[0] == null){
                            let response = {
                                status: false,
                                statusId: 400,
                                message: "wrong username or password"
                            };
                            return result(response);  
                        }else{
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
    checkUserName(email,result){

        let connection = mySql.createConnection({
            host: "localhost",
            user: "root",
            password: "ensALI!)(PASS82",
            database: "User"
        });

        connection.connect( (err) => {
            
            let query = `select email from userInformation where email = '${email}';`;
            
            if(err){
                let response = {
                    status: false,
                    statusId: 502,
                    message: "ther is problem to connect to dataBase"
                };
                 return result(response);
            }else{
                connection.query(query,(err,dataResult ) =>{
                    if(err){
                        let response = {
                            status: false,
                            statusId: 502,
                            message: "there is somthing wrong about this query"
                        };
                        return result(response);
                    }else{
                        if( dataResult[0] != null){
                            let response = {
                                status: false,
                                statusId: 400,
                                message: "we already had this username in our databases"
                            };
                            return result(response);  
                        }else{
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