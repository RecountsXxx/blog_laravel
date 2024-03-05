import axios from 'axios';
import {toast} from "react-toastify";

export const login = async (email, password) => {
    try {
        const response = await axios.post('http://localhost/api/auth/login', {
            email,
            password,
        });

        const data = response.data.data;
        if (response.status === 200) {
            localStorage.setItem('user', JSON.stringify([data.user]));
            localStorage.setItem('token', data.authorisation.token);
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.authorisation.token;
            return true;
        } else {
            return false;
        }
    } catch (error) {
        console.error('Error during login:', error);
        return false;
    }
};

export const register = async (name, email, password, password_confirmation) => {
    try {
        const response = await axios.post('http://localhost/api/auth/register', {
            name,
            email,
            password,
            password_confirmation
        });
        const data = response.data;
        if (response.status === 200) {
            return { success: true, token: data.token };
        } else {
            return { success: false, error: data };
        }
    } catch (error) {
        toast.error("Error: " + JSON.parse(error.response.request.response).message);
        console.error('Error during registration:', error);
        return { success: false, error: 'This email is already taken' };
    }
};
