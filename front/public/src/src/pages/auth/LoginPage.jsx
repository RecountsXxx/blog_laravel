import {React,useState} from 'react'
import axios from 'axios'
import {redirect} from "react-router-dom";

function LoginPage(){
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [error, setError] = useState('');

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            const response = await axios.post('http://localhost/api/auth/login', {
                email,
                password,
            });
            const data = response.data;
            if (response.status === 200) {
                setError('Login succesfull');
                localStorage.setItem('token', data.token);




                const userData = {
                    id: data.data.user.id,
                    name: data.data.user.name,
                    email: data.data.user.email,
                    email_verified: data.data.user.email_verified,
                    created_at: data.data.user.created_at,
                };
                console.log(userData);

                localStorage.setItem('user', JSON.stringify(userData));
                window.location.href='/';
            } else {
                setError(data.message || 'Login failed');
            }
        } catch (error) {
            console.error('Error:', error);
            setError('Login failed');
        }
    };

    return (
        <>
            <div className="col-md-10 text-black d-flex justify-center align-items-center">
                <div>
                    <form onSubmit={handleSubmit}>
                        <label>
                            Email:
                            <input
                                type="text"
                                value={email}
                                onChange={(e) => setEmail(e.target.value)}
                            />
                        </label>
                        <label>
                            Password:
                            <input
                                type="password"
                                value={password}
                                onChange={(e) => setPassword(e.target.value)}
                            />
                        </label>
                        {error && <div>{error}</div>}
                        <button type="submit">Login</button>
                    </form>
                </div>
            </div>
        </>
    );
}

export default LoginPage;