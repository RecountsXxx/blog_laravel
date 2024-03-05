import axios, {post} from 'axios';

export const getPost = async (postId) => {
    try {
        const response = await axios.get(`http://localhost/api/post/${postId}`);
        return response.data.data;
    } catch (error) {
        console.error('Ошибка при получении данных поста:', error);
        throw error;
    }
};

export const likePost = async(postId) =>{
    try {
        const response = await axios.post(`http://localhost/api/post/add_like`,{
            post_id:postId
        });
    } catch (error) {
        console.error(error);
        throw error;
    }
}

export const viewPost = async (postId) =>{
    try {
        const response = await axios.post(`http://localhost/api/post/add_view`,{
            post_id:postId
        });
    } catch (error) {
        console.error(error);
        throw error;
    }
}


export const addComment = async(comment_text,post_id,author_id) =>{
    try {
        const postData = {
            comment_text: comment_text,
            post_id: post_id,
            author_id: author_id,
        };
        const response = await axios.post('http://localhost/api/post/add_comment', postData);
        if (response.status === 200) {
            return { success: true };
        } else {
            return { success: false, error: 'Failed to add comment' };
        }
    } catch (error) {
        console.error('Error adding comment:', error);
        return { success: false, error: 'Failed to add comment' };
    }
}

export const reportPost = (postId,who_was_reported_id) =>{
    const postIdInt = parseInt(postId);
    const whoWasReportedIdInt = parseInt(who_was_reported_id);

    const formData = new FormData();
    formData.append('post_id', postIdInt);
    formData.append('who_was_reported_id', whoWasReportedIdInt);

    try {
        const response = axios.post(`http://localhost/api/report/post`, formData);
    } catch (error) {
        console.error(error);
        throw error;
    }
}

export const reportComment = (comment_id,who_was_reported_id) =>{
    const commentIdInt = parseInt(comment_id);
    const whoWasReportedIdInt = parseInt(who_was_reported_id);

    const formData = new FormData();
    formData.append('comment_id', commentIdInt);
    formData.append('who_was_reported_id', whoWasReportedIdInt);

    try {
        const response = axios.post(`http://localhost/api/report/comment`, formData);
    } catch (error) {
        console.error(error);
        throw error;
    }
}