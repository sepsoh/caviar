import {create} from 'apisauce';


let postData = {
    email:'',
    password: ''
}
let responseData;

function setResponse(response){
    responseData = response;
}

export function userLoginAPI (email,password,returnVal) {
    const api = create({
        baseURL: 'http://localhost:8080/api/user',
        headers: {
            Accept: 'application/json',
            'Content-Type': 'application/json'
        }
    });
    
    postData.email = email;
    postData.password = password;
    api.post('/login',postData).then(response => {
        setResponse(response);
        returnVal(response);
    });
}