import './App.css';
import React from 'react'

import { io } from 'socket.io-client';
import { BrowserRouter, Routes, Route } from "react-router-dom";

import NavMenu from "./layouts/nav-menu";
import MainPage from "./pages/main/MainPage";

import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import LoginPage from "./pages/auth/LoginPage";
import RegisterPage from "./pages/auth/RegisterPage";



function App() {

  let socket = io('/', {
    autoConnect: true
  });
  socket.on('connect', (data) => {
    console.log('connect')
  })

  socket.on('disconnect', (data) => {
    console.log('disconnect')
    console.log(data)
    toast.error('Disconnect')
  })
  socket.on ('socket.myNameIs', (data) => {
    console.log('MyName Is')
    console.log(data)
    toast.info("Server name: " + data);
  })
  socket.on ('socket.ping', (data) => {
    toast.dark("Ping: " + Date(data));
  })
  socket.on ('socket.php', (data) => {
    toast.warning("From Laravel: " + data);
  })

  console.log('App Starting')

  return (
      <div className="App">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
              crossOrigin="anonymous"/>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
                crossOrigin="anonymous"></script>
        <div className="container-fluid vh-100">
          <div className=" row h-100">

            <BrowserRouter>
              <div className="p-0 col-md-2 text-white nav_menu"> {/* Боковой хеадер */}
                <NavMenu></NavMenu>
              </div>
              <Routes>
                <Route path="/" element={<MainPage/>}></Route>
                <Route path="/login" element={<LoginPage/>}></Route>
                <Route path="/register" element={<RegisterPage/>}></Route>
              </Routes>
            </BrowserRouter>
          </div>
        </div>
      </div>
  );
}

export default App;