import React from "react";
import { StatusBar } from 'expo-status-bar';
import { Alert, Button, Dimensions, SafeAreaView, StyleSheet, Text, TextInput, TouchableHighlight, TouchableOpacity, View } from 'react-native';

import { useFonts } from 'expo-font'
import * as SplashScreen from 'expo-splash-screen'

import {scale} from 'react-native-size-matters'
import { useState } from 'react';
SplashScreen.preventAutoHideAsync();

import { userLoginAPI  } from './api/userLoginAPI';





import signupPage from './view/js/signupPage';
import { createStackNavigator } from '@react-navigation/stack';

const Stack = createStackNavigator();
const StackNavigator = () => (
  <Stack.Navigator>
    <Stack.Screen name='app' component={App}/>
    <Stack.Screen name='signup' component={signupPage}/>
  </Stack.Navigator>
)

export default function App({navigation}) {

    const [email , setEmail] = useState('');
    const [Password, setPassword] = useState('');
    const [error,setError] = useState('');

    const login = () => {
          userLoginAPI(email,Password,(response) => {
            console.log(response);
            //let response = getLoginResonse();
            if(response != null){
                //esponse = JSON.parse(response);
                if(response.status === 200){
                setError("successfuly logen in "+response.data.userInformation.email);
                }else if(response.status === 400){
                setError("incorrect username or password");
                }else{
                setError("there os problem with server");
                }
            }else{
            setError("there is problem with server1");
            }
        });
    }
  
    const signupClicked = () => {
      console.log("hi");
      navigation.navigate('signup');
    }

    const forgotPassword = () => {

    }


    let [fontsLoaded] = useFonts({
        'Lato-Light' : require('./assets/fonts/Lato-Light.ttf'),
    });

    if (!fontsLoaded) {
        return null;
    }

 
    return (   
      

    <View style = {styles.container}>
      <View style= {styles.container}>
        <Text style= {styles.welcomeLabel}>Khepri</Text>
        <View>
          <Text style= {styles.description}>Accurate prediction of stock market</Text>
        </View>
      </View>
      <View style = {styles.loginContainer}>
        <Text style = {styles.error}>{error}</Text>
        <Text style = {styles.loginInputDescriprion}>Email:</Text>
        <TextInput placeholder='Email' style={styles.textInput} onChangeText={email => setEmail(email)}/>
        <Text style = {styles.loginInputDescriprion}>Password:</Text>
        <TextInput placeholder='Password' secureTextEntry= {true} style={styles.textInput} onChangeText={text => setPassword(text)}/>
        <TouchableHighlight style={styles.loginButton}>
          <Button title='Login' color='#31c41c' fontFamily='Lato-Light'  onPress={() => {login()}}/>
        </TouchableHighlight>
        <TouchableOpacity onPress={() => {signupClicked()}}>
          <Text style={styles.createAcc}>create new account</Text>
        </TouchableOpacity>
        <TouchableOpacity onPress={() => {forgotPassword()}}>
          <Text style={styles.createAcc}>forgot password</Text>
        </TouchableOpacity>
        
      </View>
      <StatusBar style="auto" />
    </View>
 );
}



const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#2c3e4a',
    alignItems: 'center',
    justifyContent: 'center',
  },
  welcomeLabel: {
    color:'#FFFFFF',
    fontFamily:'Lato-Light',
    fontSize : scale(25),
    shadowColor: '3D0000',
  },
  error: {
    color: 'red',
    fontFamily: 'Lato-Light' ,
    fontSize: scale(18),
    fontStyle: 'Italic',
  },
  description :{
    marginTop:scale(15),
    color: "#4b5b68",
    fontFamily: 'Lato-Light',
    fontSize: scale(15),
    fontStyle: 'Italic',
    fontWeight: 'bold'
  },
  loginContainer: {
    flex: 3,
    paddingTop: scale(45),
    alignItems: 'center',
  },
  textInput: {
    borderColor:'#31c46c',
    borderWidth:scale(3),
    borderRadius:10,
    padding : scale(10),
    backgroundColor : "#4b5b68",
    color: "#FFFFFF",
    fontFamily: "Lato-Light",
    fontSize : scale(12),
    width:scale(250),
    marginBottom: scale(10),
    marginTop: scale(10)
  },
  loginInputDescriprion: {
    color: "#FFFFFF",
    fontFamily: "Lato-Light",
    fontSize: scale(18),
    marginBottom: scale(10),
    marginTop: scale(10)
  },
  loginButton: {
    marginTop:scale(10),
    padding : scale(10),
    width: scale(80)
  },
  createAcc:{
    color: "#e3e5e6",
    fontFamily: "Lato-Light",
    fontSize: scale(10),
    textDecorationLine: 'underline',
    marginTop: scale(5)
  }
});

