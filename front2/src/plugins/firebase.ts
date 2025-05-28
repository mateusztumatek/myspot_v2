// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import {getMessaging, onMessage} from "firebase/messaging";

// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyAx3Frz84EcU-ETkHd9nqW3Yf86hRqPzGk",
    authDomain: "myspot-834ca.firebaseapp.com",
    projectId: "myspot-834ca",
    storageBucket: "myspot-834ca.appspot.com",
    messagingSenderId: "160699421814",
    appId: "1:160699421814:web:25791bdba20166388dfb57",
    measurementId: "G-4H5QB803K2"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);


