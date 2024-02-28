import React from 'react'
import AllPostsComponent from '../posts/PostsComponent'
import PostComponent from '../post/PostComponent'
import './style.css';
import {useLocation} from "react-router-dom";
function MainPage({selectedCategory,selectedPost, selectPost}){
    return(
        <>
            <div className="col-md-5 all_posts">
                <AllPostsComponent selectedPost={selectPost} selectedCategory={selectedCategory}/>
            </div>
            <div className="col-md-5  post">
                <PostComponent selectedPost={selectedPost}></PostComponent>
            </div>
        </>
    )
}

export default MainPage;