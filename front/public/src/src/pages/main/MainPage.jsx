import React from 'react'
import AllPostsComponent from '../../components/posts/PostsComponent'
import PostComponent from '../../components/post/PostComponent'

function MainPage(){
    return(
        <>
            <div className="col-md-5 bg-secondary">
                <AllPostsComponent/>
            </div>
            <div className="col-md-5 bg-black">
                <PostComponent/>
            </div>
        </>
    )
}

export default MainPage;