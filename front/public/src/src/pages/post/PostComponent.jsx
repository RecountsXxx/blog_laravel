import React, { useEffect, useState } from 'react';
import { format } from 'date-fns';
import { getPost, likePost, viewPost, addComment,reportPost,reportComment} from '../../services/post/PostService';
import like_icon from '../../assets/images/like-icon.png';
import send_icon from '../../assets/images/send-icon.png';
import views_icon from '../../assets/images/views-icon.png';
import report_icon from '../../assets/images/report-icon.png';
import {toast, ToastContainer} from "react-toastify";
import {useParams} from "react-router-dom";
function PostComponent({ selectedPost }) {
    const { postId } = useParams();
    const [post, setPost] = useState({});
    const [author, setAuthor] = useState({});
    const [isLoading, setIsLoading] = useState(true);
    const [comments, setComments] = useState([]);
    const [newComment, setNewComment] = useState('');
    const [user,setUser] = useState(JSON.parse(localStorage.getItem('user')));

    useEffect(() => {
        const fetchData = async () => {
            setIsLoading(true);
            try {
                let postData = 0;
                if(postId != null){
                    postData = await getPost(postId);
                }
                else{
                    postData = await getPost(selectedPost);
                }
                setPost(postData.post);
                setAuthor(postData.post.author);
                viewPost(postData.post.id);
                setComments(postData.post.comments);
                setIsLoading(false);
            } catch (error) {
                console.error('Ошибка при получении данных поста:', error);
                setIsLoading(false);
            }
        };
        fetchData();
    }, [selectedPost]);


    function handlerLikePost(){
        if(user != null) {
            likePost(post.id);
            toast.success('Like!');
        }
        else{
            toast.error('Not loggined');
        }
    }

    async function handleAddComment() {
        if(user != null){
            try {
                await addComment(newComment, post.id, user[0].id);
                toast.success('Comment sended!');
                setNewComment('');
                const postData = await getPost(selectedPost);
                setComments(postData.post.comments);
            } catch (error) {
                console.error('Ошибка при добавлении комментария:', error);
                toast.error('Ошибка при добавлении комментария');
            }
        }
        else{
            toast.error('Not loggined');
        }
    }

    function handleReportComment(commentId){
        if(user != null) {
            toast.success('Report commited');
            reportComment(commentId, user[0].id)
        }
        else{
            toast.error('Not loggined');
        }
    }

    function handleReportPost(postId){
        if(user != null) {
            toast.success('Report commited');
            reportPost(postId, user[0].id);
        }
        else{
            toast.error('Not loggined');
        }
    }

    if (isLoading || !post.title) {
        return (
            <div className="d-flex justify-content-center align-items-center" style={{ height: '100vh' }}>
                <div className="spinner-border text-primary" role="status">
                    <span className="visually-hidden">Loading...</span>
                </div>
            </div>
        );
    }

    return (
        <div className="ms-1 mt-1 me-1">
            <ToastContainer />
            <div className="d-flex flex-column align-items-start mt-4 ms-4">
                <label style={{textAlign: "left"}}
                       className="align-items-start me-5 fs-2 text-secondary">{post.title}</label>
                <div className="fff d-flex container justify-content-between">
                    <div className="d-flex flex-row">
                        <img width="45px" height="45px" src={author.avatar_url} alt={author.name}/>
                        <div className="ms-3 flex-column d-flex">
                            <label className="align-items-end fs-6 text-secondary">Started by <label
                                className="text-success">{author.name}</label> </label>
                            <label className="align-items-end fs-6 text-secondary">on <label
                                className="font-bold">{format(new Date(post.created_at), "do MMMM yyyy HH:mm")}</label> </label>
                        </div>
                    </div>
                    <div className="d-flex ms-5 flex-row">
                        <div className="ms-5 gap-3">
                            <img className="ms-5" width="35px" height="35px" src={views_icon} alt='like'/>
                            <label className="ms-2 mt-1 text-secondary">Views {post.views_count}</label>
                        </div>
                        <img onClick={handlerLikePost} className="ms-4" width="35px" height="35px" src={like_icon}
                             alt='like'/>
                        <img onClick={() => handleReportPost(post.id)}  className="ms-4" width="35px" height="35px" src={report_icon}
                             alt='report'/>
                    </div>
                </div>

                <div>
                    <div className="mt-3" dangerouslySetInnerHTML={{__html: post.text}}/>
                </div>
                <div className="mt-4 w-100">
                    <div className="mt-3 w-100">

                        <div className="coment-bottom bg-white p-2 px-4">
                            <div className="d-flex flex-row add-comment-section mt-4 mb-4"><input type="text"     onChange={(e) => setNewComment(e.target.value)} value={newComment} className="form-control mr-3" placeholder="Add comment"/>
                                <button className="btn btn-primary" onClick={handleAddComment} type="button">Comment</button>
                            </div>
                            <div className="commented-section mt-2 w-100">
                                {comments.map((comment, index) => (
                                    <div className="mt-3 mb-2 mb-1">
                                        <div className="d-flex flex-row align-items-center commented-user">
                                            <img className="rounded-circle" width="45px" height="45px"
                                                 src={comment.author.avatar_url}
                                                 alt={comment.author.name}/>
                                            <h5 className="ms-2 mr-2">{comment.author.name}</h5>
                                            <span className="dot mb-1"></span>
                                            <span
                                                className="ms-2 mb-1 ml-2">{format(new Date(comment.created_at), "do MMMM yyyy HH:mm")}</span>
                                            <span  onClick={() => handleReportComment(comment.id)}  className="cursor_pointer ms-5 mb-1 text-warning">Send report</span>
                                        </div>
                                        <div className="ms-3 mt-1 flex-grow-1"
                                             style={{wordWrap: 'break-word', overflowWrap: 'break-word'}}>
                                            <p>{comment.comment_text}</p>
                                            <hr/>
                                        </div>

                                    </div>
                                ))}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default PostComponent;
