import {React,useState} from 'react'
import axios from 'axios'

function RegisterPage(){
    const [email, setEmail] = useState('');
    const [name, setName] = useState('');
    const [password_confirmation, setPassConfirm] = useState('');
    const [password, setPassword] = useState('');


    const [error, setError] = useState('');
    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            const response = await axios.post('http://localhost/api/auth/register', {
                name,
                email,
                password,
                password_confirmation
            });
            const data = response.data;
            if (response.status === 200) {
                setError('Register succesfull');
                localStorage.setItem('token', data.token);
            } else {
                setError(data.message || 'Login failed');
            }
        } catch (error) {
            console.error('Error:', error);
            setError('Register failed');
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
                            Name:
                            <input
                                type="text"
                                value={name}
                                onChange={(e) => setName(e.target.value)}
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
                        <label>
                            Confirm password:
                            <input
                                type="password"
                                value={password_confirmation}
                                onChange={(e) => setPassConfirm(e.target.value)}
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

export default RegisterPage;