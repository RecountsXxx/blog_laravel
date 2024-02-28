import React, { useState } from 'react';
import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import { Link } from "react-router-dom";
import './style.css';
import logo_icon from "../../assets/images/login.webp";
import { register } from '../../services/auth/AuthService';

function RegisterPage() {
    const [email, setEmail] = useState('');
    const [name, setName] = useState('');
    const [password_confirmation, setPassConfirm] = useState('');
    const [password, setPassword] = useState('');
    const [loading, setLoading] = useState(false);

    const handleSubmit = async (e) => {
        e.preventDefault();
        setLoading(true);
        if (password === password_confirmation) {
            const { success, token, error } = await register(name, email, password, password_confirmation);

            if (success) {
                toast.info('Registration successful');
                localStorage.setItem('token', token);
                setLoading(false);
            } else {
                toast.error(error);
                setLoading(false);
            }
        } else {
            toast.error('Password does not match the confirm password');
            setLoading(false);
        }
    };

    return (
        <div className="col-md-10 text-black d-flex justify-center align-items-center">
            <ToastContainer />
            <section className="vh-100 w-100">
                <div className="container-fluid h-custom">
                    <div className="row d-flex justify-content-center align-items-center h-100">
                        <div className="col-md-9 col-lg-6 col-xl-5">
                            <img
                                src={logo_icon}
                                className="img-fluid"
                                alt="Sample image"
                            />
                        </div>
                        <div className="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                            <form onSubmit={handleSubmit}>
                                <div
                                    className="d-flex flex-row align-items-center justify-content-center justify-content-lg-center">
                                    <p className="lead fw-normal mb-0 me-3">Create an account</p>
                                </div>

                                <div className="divider d-flex align-items-center my-4">
                                    <p className="text-center fw-bold mx-3 mb-0">Artzone</p>
                                </div>

                                <div className="form-outline mb-4">
                                    <input
                                        type="email"
                                        id="form3Example3"
                                        className="form-control form-control-lg"
                                        required={true}
                                        placeholder="Enter a valid email address"
                                        onChange={(e) => setEmail(e.target.value)}
                                        value={email}
                                    />
                                </div>
                                <div className="form-outline mb-4">
                                    <input
                                        type="text"
                                        id="form3Example3"
                                        className="form-control form-control-lg"
                                        placeholder="Enter a username"
                                        required={true}
                                        onChange={(e) => setName(e.target.value)}
                                        value={name}
                                    />
                                </div>
                                <div className="form-outline mb-3">
                                    <input
                                        type="password"
                                        id="form3Example4"
                                        required={true}
                                        className="form-control form-control-lg"
                                        placeholder="Enter password"
                                        onChange={(e) => setPassword(e.target.value)}
                                        value={password}
                                    />
                                </div>
                                <div className="form-outline mb-3">
                                    <input
                                        type="password"
                                        id=""
                                        className="form-control form-control-lg"
                                        placeholder="Confirm password"
                                        required={true}
                                        onChange={(e) => setPassConfirm(e.target.value)}
                                        value={password_confirmation}
                                    />
                                </div>

                                <div className="text-center text-lg-start mt-4 pt-2">
                                    {loading ? (
                                        <button type="submit" className="disabled bg_green_auth w-100">
                                            <i className="animate-spin fas fa-spinner"></i>
                                            Processing...
                                        </button>
                                    ) : (
                                        <button type="submit" className=" bg_green_auth w-100">
                                            Register
                                        </button>
                                    )}
                                    <p className="small fw-bold mt-2 pt-1 mb-0">
                                        Already have an account? <Link to="/login"><a href="#" className="link-danger">Sign in</a></Link>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    );
}

export default RegisterPage;
