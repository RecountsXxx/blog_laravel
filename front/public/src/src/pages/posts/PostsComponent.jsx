import React, { useEffect, useState } from 'react';
import './style.css';
import search_icon from '../../assets/images/search-icon.png';
import add_icon from '../../assets/images/add-icon.png';
import note from '../../assets/images/note.png';
import note_on from '../../assets/images/note-on.png';
import axios from "axios";
import { Link, useLocation } from "react-router-dom";
import { format } from "date-fns";
import { getPostsByCategory } from "../../services/posts/PostsService";
import account_icon from "../../assets/images/account-icon.png";

export default function PostsComponent({ selectedCategory, selectedPost }) {
    const [posts, setPosts] = useState([]);
    const [selectedKey, setSelectedKey] = useState(1);
    const [searchQuery, setSearchQuery] = useState('');
    const [currentPage, setCurrentPage] = useState(1);
    const [totalPages, setTotalPages] = useState(1);
    const [isLoading, setIsLoading] = useState(false);
    const [user,setUser] = useState(JSON.parse(localStorage.getItem('user')));

    useEffect(() => {
        setIsLoading(true);
        getPosts();
    }, [selectedCategory, currentPage]);

    const getPosts = async () => {
        try {
            const data = await getPostsByCategory(selectedCategory, currentPage);
            const formattedPosts = data.posts.data.map(post => {
                const dateString = post.created_at;
                const dateParts = dateString.split(/[\-\T\:\.]+/);
                const date = new Date(Date.UTC(dateParts[0], dateParts[1] - 1, dateParts[2], dateParts[3], dateParts[4], dateParts[5]));
                post.date = format(date, "do MMMM yyyy");
                return post;
            });
            setPosts(formattedPosts);
            setTotalPages(data.posts.last_page);
            setIsLoading(false);
        } catch (error) {
            console.error('Ошибка при получении данных:', error);
            setIsLoading(false);
        }
    };
    function selectPost(event, key) {
        setSelectedKey(key);
        selectedPost(key);
    }

    function handleSearchInputChange(event) {
        setSearchQuery(event.target.value);
    }

    function handlePaginationClick(page) {
        setCurrentPage(page);
    }

    const filteredPosts = posts.filter(item =>
        item.title.toLowerCase().includes(searchQuery.toLowerCase())
    );

    return (
        <div className="text-black d-flex flex-column w-100">
            <div className="header flex-row mt-3">
                <label className="ms-5 me-5 fs-2 text-white">Works</label>
                <div className="d-flex flex-row gap-2">
                    <div className="add_post me-3 d-flex flex-row">
                        <input
                            className="hidden ms-2 me-2 search_input"
                            placeholder="Search topics"
                            type="text"
                            value={searchQuery}
                            onChange={handleSearchInputChange}
                        />
                        <img className="me-1" src={search_icon} width="35" height="35" alt="add"/>
                    </div>
                    <div className="add_post me-3 d-flex flex-row">
                        <img className="ms-1" src={add_icon} width="35" height="35" alt="add"/>
                        {user ? (
                            <Link className="disabled" to="/editor">
                                <label className="cursor_pointer fs-5 ms-3 me-2 text-white">New Post</label>
                            </Link>
                        ) : (
                            <Link className="disabled" to="/login">
                                <label className="cursor_pointer fs-5 ms-3 me-2 text-white">New Post</label>
                            </Link>
                        )}
                    </div>
                </div>
            </div>
            {isLoading ? (
                <div className="d-flex justify-content-center align-items-center" style={{height: '100vh'}}>
                    <div className="spinner-border text-primary spinner-border-lg" role="status">
                        <span className="visually-hidden">Loading...</span>
                    </div>
                </div>
            ) : (
                <React.Fragment>
                    <ul className="list-unstyled mt-4" style={{width: '100%'}}>
                        {filteredPosts.length === 0 && <li>No posts found.</li>}
                        {filteredPosts.map(item => (
                            <li
                                className={`d-flex p-1 flex-row ms-3 mr-3 mb-4 ${selectedKey === item.id ? 'selected-post' : ''}`}
                                onClick={(e) => selectPost(e, item.id)} key={item.id} style={{width: '100%'}}>
                                <img src={selectedKey === item.id ? note_on : note} width="60px" height="60px"/>
                                <div className="ms-2 d-flex flex-column justify-content-start align-items-start"
                                     style={{flex: 1}}>
                                    <label className="fs-4 text-white">{item.title}</label>
                                    <label className="fs-6 text-white">Started by <label
                                        className="text-white-50">{item.author.name}</label> • Written at <label
                                        className="text-white-50">{item.date}</label></label>
                                </div>
                            </li>
                        ))}
                    </ul>
                    <nav>
                        <ul className="pagination justify-content-center">
                            {Array.from({length: totalPages}, (_, i) => (
                                <li key={i} className={`page-item ${currentPage === i + 1 ? 'active' : ''}`}>
                                    <button onClick={() => handlePaginationClick(i + 1)} className="page-link">
                                        {i + 1}
                                    </button>
                                </li>
                            ))}
                        </ul>
                    </nav>
                </React.Fragment>
            )}
        </div>

    );
}

