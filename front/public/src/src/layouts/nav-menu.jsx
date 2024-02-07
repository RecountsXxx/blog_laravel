import React, {useEffect, useState} from 'react'
import './style.css';
import axios from 'axios';

import burger_icon from '../source/images/burger-icon.png';
import account_icon from '../source/images/account-icon.png';
import settings_icon from '../source/images/settings-icon.png';
import theme_icon from '../source/images/theme-icon.png';
import language_icon from '../source/images/language-icon.png';
<<<<<<< HEAD
import { Outlet, Link } from "react-router-dom";
function navMenu(){

    const [category,setCategories] = useState([]);
    const [user,setUser] = useState(JSON.parse(localStorage.getItem('user')));


    useEffect(() => {
=======
const navMenu = () =>{

    const [category,setCategories] = useState([]);
    useEffect(() => {
        // Выполняем запрос на сервер при монтировании компонента
>>>>>>> 458b4afb329d8221f3ed6afa97c6146f49316ad7
        axios.get('http://localhost/api/category')
            .then(response => {
                setCategories(response.data);
            })
            .catch(error => {
                console.error('Ошибка при получении данных:', error);
            });
    }, []);


    return ([
         <div className="container-fluid d-flex flex-column vh-100 p-0 w-100">
             <div className="pb-4 p-0 nav_first">
                 <div className="mt-2 d-flex flex-row justify-center align-items-center">
<<<<<<< HEAD
                     <Link className="text-decoration-none text-white" to="/"><label className="text-decoration-none ms-4 me-3 logo_label">Artzone</label></Link>
=======
                     <label className="ms-4 me-3 logo_label">Artzone</label>
>>>>>>> 458b4afb329d8221f3ed6afa97c6146f49316ad7
                     <img className="mt-2 ms-5" src={burger_icon} width="30px" height="30px"/>
                 </div>

                 <div className="ms-4 account mt-4 d-flex flex-row justify-center align-items-center">


<<<<<<< HEAD
                     {user ? (
                         <div className="d-flex flex-row mb-1">
                             <img src={account_icon} width="60px" height="60px"/>
                             <div className="ms-4 d-flex flex-column">
                                 <label className="fs-5 text-white">{user['name']}</label>
                                 <label className="fs-6 text-white">Default user</label>
                             </div>
                         </div>
                     ) : (
                         <div className="d-flex flex-row mb-1">
                             <img src={account_icon} width="60px" height="60px"/>
                             <div className="ms-4 d-flex flex-column">
                                 <Link className="text-decoration-none" to="/login"> <a className="text-white fs-5 text-decoration-none cursor_pointer">Sign in or</a></Link>
                                 <Link className="text-decoration-none" to="/register"><a  className="text-white fs-5 text-decoration-none cursor_pointer">create an account</a></Link>
                             </div>
                         </div>)}
=======

                     <img src="http://localhost/storage/avatars/129/original.webp" width="50px" height="50px"/>
                     <div className="ms-3 d-flex flex-column">
                         <label className="fs-5 text-white">Antonio Bruskey</label>
                         <label className="fs-6 text-white">Full manager</label>
                     </div>
>>>>>>> 458b4afb329d8221f3ed6afa97c6146f49316ad7
                 </div>

                 <div className="features mt-4 ms-4 d-flex  flex-row justify-center align-items-center">
                     <img src={theme_icon} width="35px" height="35px"/>
                     <img src={language_icon} width="35px" height="35px"/>
                     <img src={settings_icon} width="35px" height="35px"/>
                     <img src={account_icon} width="35px" height="35px"/>
                 </div>
             </div>

             <div className="p-0 mt-1 nav_second flex-grow-1">
                 <ul className="list-unstyled">
                     {category.map(item => (
                         <li key={item.id} className="ms-4 me-4 category_item pb-2 d-flex flex-column justify-center align-items-start">
                             <label className="category_name">{item.name}</label>
                             <label className="category_counts">{item.post_count} Postst</label>
                         </li>
                     ))}
                 </ul>
             </div>

             <label className="absolute bottom-0">© 2024 Artzone LLC </label>
         </div>
    ]);

}

export default navMenu;