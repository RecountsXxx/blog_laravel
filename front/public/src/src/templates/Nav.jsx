import React, {useEffect, useState} from 'react'
import './style.css';
import axios from 'axios';
import burger_icon from '../assets/images/burger-icon.png';
import account_icon from '../assets/images/account-icon.png';
import settings_icon from '../assets/images/settings-icon.png';
import theme_icon from '../assets/images/theme-icon.png';
import language_icon from '../assets/images/language-icon.png';
import loggout_icon from '../assets/images/loggout-icon.png'
import { Outlet, useLocation, Link } from "react-router-dom";
import {logout} from '../services/account/UserService';

function nav({ onSelectCategory }) {
    const [category,setCategories] = useState([]);
    const [user,setUser] = useState(JSON.parse(localStorage.getItem('user')));
    const [selectedKey, setSelectedKey] = useState(1);

    useEffect(() => {
        axios.get('http://localhost/api/category')
            .then(response => {
                setCategories(response.data.data.categories);
            })
            .catch(error => {
                console.error('Ошибка при получении данных:', error);
            });
    }, []);

    useEffect(() => {
        setSelectedKey(1);
    }, [location.pathname]);

    function selectCategory(event, key) {
        setSelectedKey(key);
        onSelectCategory(key);
    }


    async function loggout(){
        console.log(await logout());
        localStorage.removeItem('user');
        localStorage.removeItem('token');
        window.location.href = '/';
    }

    return ([
        <div className="container-fluid d-flex flex-column vh-100 p-0 w-100">
            <div className="pb-4 p-0 nav_first">
                <div className="mt-2 d-flex flex-row justify-center align-items-center">
                    <Link className="text-decoration-none text-white" to="/"><label
                        className="text-decoration-none ms-4 me-3 logo_label">Artzone</label></Link>

                    {user ? (
                        <div className="d-flex flex-row mb-1">
                            <img className="mt-2 ms-5 cursor_pointer" onClick={loggout} src={loggout_icon} width="35px"
                                 height="35px"/>
                        </div>
                    ) : (
                        <div className="d-flex flex-row mb-1">
                            <img className="mt-2 ms-5" src={burger_icon} width="30px" height="30px"/>
                        </div>)}

                </div>

                <div className="ms-4 account mt-4 d-flex flex-row justify-center align-items-center">

                    {user ? (
                        <div className="d-flex flex-row mb-1">
                            <img id="nav_avatar" src={user[0]['avatar_url']} width="60px" height="60px" alt="avatar"/>
                            <div className="ms-4 d-flex flex-column">
                                <label id="nav_name" className="fs-5 text-white"> {user[0]['name']}</label>
                                <label className="fs-6 text-white">Default user</label>
                            </div>
                        </div>
                    ) : (
                        <div className="d-flex flex-row mb-1">
                            <img src={account_icon} width="60px" height="60px"/>
                            <div className="ms-4 d-flex flex-column">
                                <Link className="text-decoration-none" to="/login"> <a
                                    className="text-white fs-5 text-decoration-none cursor_pointer">Sign in
                                    or</a></Link>
                                <Link className="text-decoration-none" to="/register"><a
                                    className="text-white fs-5 text-decoration-none cursor_pointer">create an
                                    account</a></Link>
                            </div>
                        </div>)}
                </div>

                <div className="features mt-4 ms-4 d-flex  flex-row justify-center align-items-center">
                    <img src={theme_icon} width="35px" height="35px"/>
                    <img src={language_icon} width="35px" height="35px"/>
                    <img src={settings_icon} width="35px" height="35px"/>
                    {user ? (<Link to='account'><img src={account_icon} width="35px" height="35px"/></Link>) : (<Link to='/login'><img src={account_icon} width="35px" height="35px"/></Link>)}
                </div>
            </div>

            <div className="p-0 mt-1 nav_second flex-grow-1">
                <ul className="list-unstyled">
                    {category.map(item => (
                        <Link key={item.id} className="disabled link cursor_pointer" to='/'>
                        <li key={item.id} onClick={(e) => selectCategory(e, item.id)}
                            className={` me-4 category_item pb-2 d-flex flex-row cursor_pointer justify-center align-items-start ${selectedKey === item.id ? 'selected' : ''}`}>
                                {selectedKey === item.id && (
                                    <div className="additional_div">q</div>
                                )}
                                <div className="ms-4 d-flex flex-column justify-center align-items-start ">
                                    <label className={`category_name ${selectedKey === item.id ? 'selected' : ''}`}>{item.name}</label>
                                    <label id={'category_count_' + item.id} className={`category_counts ${selectedKey === item.id ? 'selected' : ''}`}>{item.post_count} Posts</label>
                                </div>
                        </li>
                        </Link>
                    ))}
                </ul>
            </div>

            <label className="absolute bottom-0">© 2024 Artzone LLC </label>
        </div>
    ]);

}

export default nav;