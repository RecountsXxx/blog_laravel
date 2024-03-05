import axios from 'axios';

const headers = {
    'Content-Type': 'application/json',
    'Accept': 'application/json'
};

export const getUser = () => {
    const storedUser = localStorage.getItem('user');
    if (storedUser) {
        return JSON.parse(storedUser)[0];
    }
    return {};
};

export const updateUser = (updatedUser) => {
    const userData = {
        user_id:updatedUser.id,
        name:updatedUser.name,
        password:updatedUser.password,
    }
    return axios.put(`http://localhost/api/account/update-user`, userData, { headers });
};

export const uploadAvatar = (userId, avatar) => {
    const formData = new FormData();
    formData.append('avatar', avatar);
    formData.append('user_id', userId);
    return axios.post('http://localhost/api/account/avatar-upload', formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    });
};

export const fetchUserPosts = (user_id) => {
    const formData = new FormData();
    formData.append('user_id',user_id);
    return axios.post(`http://localhost/api/post/user`, formData);
};

export const deletePost = async (postId) => {
        const response = await axios.delete(`http://localhost/api/post/${postId}`);
        return response.data.data.message;
}

export const logout = () =>{
   return axios.get('http://localhost/api/auth/logout');
}