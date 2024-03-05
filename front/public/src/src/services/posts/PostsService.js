import axios from 'axios';

export const getPostsByCategory = async (categoryId, page) => {
    try {
        const response = await axios.post(`http://localhost/api/post/category`, {
            category_id: categoryId,
            page: page
        });
        return response.data.data;
    } catch (error) {
        console.error('Ошибка при получении данных постов:', error);
        throw error;
    }
};
