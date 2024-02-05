// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.
importScripts('https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.10.1/firebase-messaging.js');

// Initialize the Firebase app in the service worker by passing in
// your app's Firebase config object.
// https://firebase.google.com/docs/web/setup#config-object
firebase.initializeApp({
    apiKey: "AIzaSyAx3Frz84EcU-ETkHd9nqW3Yf86hRqPzGk",
    authDomain: "myspot-834ca.firebaseapp.com",
    projectId: "myspot-834ca",
    storageBucket: "myspot-834ca.appspot.com",
    messagingSenderId: "160699421814",
    appId: "1:160699421814:web:25791bdba20166388dfb57",
    measurementId: "G-4H5QB803K2"
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
messaging.onBackgroundMessage((payload) => {
    console.log(
        '[firebase-messaging-sw.js] Received background message ',
        payload
    );
    // Customize notification here
    const notificationTitle = 'Background Message Title';
    const notificationOptions = {
        body: 'Background Message body.',
        icon: '/firebase-logo.png'
    };

    console.log('PAYLOAD', payload);
});