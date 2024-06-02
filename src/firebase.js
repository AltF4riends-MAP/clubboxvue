// src/firebaseConfig.js
import { initializeApp } from 'firebase/app';
import { getAuth } from 'firebase/auth';
import { getFirestore } from 'firebase/firestore';

const firebaseConfig = {
  apiKey: "AIzaSyBsQse1mKxQ1F7-l41RE1Oz4QhP91qgmLw",
  authDomain: "clubbox-system.firebaseapp.com",
  projectId: "clubbox-system",
  storageBucket: "clubbox-system.appspot.com",
  messagingSenderId: "359955007424",
  appId: "1:359955007424:web:67ba150aad7d439d6eea25",
  measurementId: "G-D9WWVVXX7W"
};

// Initialize Firebase
const firebaseApp = initializeApp(firebaseConfig);

// Initialize Firebase Authentication and get a reference to the service
const auth = getAuth(firebaseApp);

// Initialize Firestore and get a reference to the service
const db = getFirestore(firebaseApp);

export { firebaseApp, auth, db };
