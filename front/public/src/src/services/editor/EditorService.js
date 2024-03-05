import axios from 'axios';
import {toast} from "react-toastify";

export const addPost = async (title, text, author_id, category_id) => {
    try {
        const postData = {
            title,
            text,
            author_id,
            category_id,
        };
        const response = await axios.post('http://localhost/api/post', postData);
        if (response.status === 200) {
            incrimentPostsCount(category_id);
            return { success: true };
        } else {
            return { success: false, error: 'Failed to add post' };
        }
    } catch (error) {
        toast.error("Error: " + JSON.parse(error.response.request.response).message);
        console.error('Error adding post:', error);
        return { success: false, error: 'Failed to add post' };
    }
};

export const fetchCategories = async () => {
    try {
        const response = await axios.get('http://localhost/api/category');
        return response.data.data.categories
    } catch (error) {
        console.error('Error fetching categories:', error);
        return [];
    }
};

function incrimentPostsCount(category_id){
    let category_li = document.getElementById('category_count_' + category_id);
    let countText = category_li.textContent;
    let count = parseInt(countText.replace(' Posts', ''));
    console.log(count + 1);
    category_li.textContent = (count + 1) + ' Posts';
}
