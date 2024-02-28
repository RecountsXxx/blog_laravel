"use strict";
import './App.css';
import React, {useState} from 'react'

import { io } from 'socket.io-client';
import { BrowserRouter, Routes, Route } from "react-router-dom";

import NavMenu from "./templates/Nav";
import MainPage from "./pages/main/MainPage";

import 'react-toastify/dist/ReactToastify.css';
import LoginPage from "./pages/auth/LoginPage";
import RegisterPage from "./pages/auth/RegisterPage";
import Account from "./pages/account/Account";
import axios from "axios";
import Editor from "./pages/editor/EditorComponent";


function App() {
  const [selectedCategory, setSelectedCategory] = useState(1);
  const [selectedPost, setSelectedPost] = useState(1);

  const [isAuthenticated, setIsAuthenticated] = useState(localStorage.getItem('token') !== null);

  if(localStorage.getItem('token') != null){
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token');
  }
  // let socket = io('/', {
  //   autoConnect: true
  // });
  // socket.on('connect', (data) => {
  //   console.log('connect')
  // })
  //
  // socket.on('disconnect', (data) => {
  //   console.log('disconnect')
  //   console.log(data)
  // })
  // socket.on ('socket.myNameIs', (data) => {
  //   console.log('MyName Is')
  //   console.log(data)
  // })
  // socket.on ('socket.php', (data) => {
  //   toast.warning("From Laravel: " + data);
  // })
  //
  // console.log('App Starting')

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
              <div className="p-0 col-md-2 text-white nav_menu">
                <NavMenu   onSelectCategory={setSelectedCategory}></NavMenu>
              </div>
              <Routes>
                <Route path="/" element={<MainPage selectedPost={selectedPost} selectPost={setSelectedPost} selectedCategory={selectedCategory}/>}></Route>
                  <Route path="/post/:postId" element={<MainPage selectedPost={selectedPost} selectPost={setSelectedPost} selectedCategory={selectedCategory}/>}></Route>
                <Route path="/login" element={<LoginPage/>}></Route>
                <Route path="/register" element={<RegisterPage/>}></Route>
                {isAuthenticated && <Route path="/editor" element={<Editor />} />}
                {isAuthenticated && <Route path="/account" element={<Account />} />}

              </Routes>
            </BrowserRouter>
          </div>
        </div>
      </div>
  );
}

export default App;