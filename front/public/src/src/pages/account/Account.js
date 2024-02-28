import React, { useState, useEffect } from 'react';
import { ToastContainer, toast } from 'react-toastify';
import uploadIcon from '../../assets/images/upload-icon.png';
import { getUser, updateUser, deletePost, fetchUserPosts, uploadAvatar } from '../../services/account/UserService';
import {updateAvatarInNavMenu, updateNameInNavMenu} from '../../services/nav/NavService';
function Account() {
    const [user,setUser] = useState(JSON.parse(localStorage.getItem('user')));
    const [posts, setPosts] = useState([]);
    const [avatar, setAvatar] = useState(null);

    if(!user){
        return 'Please login';
    }

    useEffect(() => {
        setUser(getUser());
        const storedUser = localStorage.getItem('user');
        if (storedUser) {
            const parsedUser = JSON.parse(storedUser);
            loadUserPosts(parsedUser[0].id);
        }
    }, []);

    const loadUserPosts = (userId) => {
        fetchUserPosts(userId)
            .then(response => {
                setPosts(response.data.data.posts);
            })
            .catch(error => {
                console.error('Ошибка при получении постов пользователя:', error);
            });
    };

    const handleUpdateUser = (updatedUser) => {
        if (updatedUser.password === updatedUser.password_confirmation) {
            updateUser(updatedUser)
                .then(response => {
                    setUser(updatedUser);
                    localStorage.setItem('user', JSON.stringify([updatedUser]));
                    console.log(response);
                    toast.success('Admin his updated');
                })
                .catch(error => {
                    console.error('Ошибка при обновлении профиля:', error);
                });
        } else {
            toast.error('Password is not match');
        }
        updateNameInNavMenu(user.name);
    };

    const handleDeletePost = (postId) => {
        deletePost(postId)
            .then(response => {
                setPosts(posts.filter(post => post.id !== postId));
                toast.success('Post his deleted');
            })
            .catch(error => {
                console.error('Ошибка при удалении поста:', error);
            });
    };

    const handleUploadAvatar = () => {
        uploadAvatar(user.id, avatar)
            .then(response => {
                toast.success('Avatar his updated');
            })
            .catch(error => {
                console.error('Ошибка при загрузке аватара:', error);
            });

        updateAvatarInNavMenu(user.avatar_url,user.name);
    };

    const formatDate = (dateString) => {
        const date = new Date(dateString);
        return date.toLocaleString();
    };

    return (
        <div className="gap-5 p-5 col-md-10 text-black d-flex justify-top justify-content-center align-items-start">
            <ToastContainer></ToastContainer>
            <div className="d-flex flex-row w-100 gap-5">
                <div>
                    <h1 className="my-4">User profile</h1>
                    <img id="account_avatar" src={user.avatar_url} alt="Previous Avatar" width="100px" height="100px" className="mb-3 img-fluid" />
                    <form onSubmit={(e) => {
                        e.preventDefault();
                        handleUpdateUser(user);
                    }}>
                        <div className="mb-3">
                            <label htmlFor="username" className="form-label">Username</label>
                            <input placeholder="Enter new username" type="text" className="form-control" id="name"
                                   value={user.name}
                                   onChange={(e) => setUser({...user, name: e.target.value})}/>
                        </div>
                        <div className="mb-3">
                            <label htmlFor="password" className="form-label">Password</label>
                            <input placeholder="Enter new password" type="password" className="form-control"
                                   id="password" value={user.password}
                                   onChange={(e) => setUser({...user, password: e.target.value})}/>
                        </div>
                        <div className="mb-3">
                            <label htmlFor="password" className="form-label">Confirm password</label>
                            <input placeholder="Enter new confirm password" type="password" className="form-control"
                                   id="password_confirmation" value={user.password_confirmation}
                                   onChange={(e) => setUser({...user, password_confirmation: e.target.value})}/>
                        </div>
                        <button type="submit" className="btn btn-primary">Save changes</button>
                    </form>
                    <form onSubmit={(e) => {
                        e.preventDefault();
                        handleUploadAvatar();
                    }}>
                        <div className="mb-3">
                            <label htmlFor="avatar" className="form-label">Select new avatar</label>
                            <div className="input-group">
                                <input type="file" className="form-control" id="avatar"
                                       onChange={(e) => setAvatar(e.target.files[0])}/>
                                <label htmlFor="avatar" className="input-group-text">
                                    <img src={uploadIcon} alt="Upload" width="24" height="24"/>
                                </label>
                            </div>
                        </div>
                        <button type="submit" className="btn btn-primary">Update avatar</button>
                    </form>
                </div>
                <div className="w-75">
                    <h2 className="my-4">List posts</h2>
                    <ul className="list-group">
                        {posts && posts.length > 0 ? (
                            posts.map(post => (
                                <li key={post.id}
                                    className="list-group-item d-flex justify-content-between align-items-center">
                                    {post.title}
                                    <span className="badge bg-secondary">{formatDate(post.created_at)}</span>
                                    <button className="btn btn-danger"
                                            onClick={() => handleDeletePost(post.id)}>Удалить
                                    </button>
                                </li>
                            ))
                        ) : (
                            <label>Not found posts</label>
                        )}
                    </ul>
                </div>
            </div>
        </div>
    );
}

export default Account;

