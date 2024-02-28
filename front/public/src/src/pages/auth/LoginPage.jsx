import React, { useState } from 'react';
import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import { Link } from "react-router-dom";
import { login } from '../../services/auth/AuthService';
import './style.css';
import logo_icon from '../../assets/images/login.webp';

function LoginPage() {
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [loading, setLoading] = useState(false);

    const handleSubmit = async (e) => {
        e.preventDefault();
        setLoading(true);

        const success = await login(email, password);

        if (success) {
            toast.success('Login successful');
            window.location.href = '/';
        } else {
            toast.error('Invalid login or password');
        }

        setLoading(false);
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
                                    <p className="lead fw-normal mb-0 me-3">Sign in</p>
                                </div>

                                <div className="divider d-flex align-items-center my-4">
                                    <p className="text-center fw-bold mx-3 mb-0">Artzone</p>
                                </div>

                                <div className="form-outline mb-4">
                                    <input
                                        type="email"
                                        id="email"
                                        value={email}
                                        required={true}
                                        onChange={(e) => setEmail(e.target.value)}
                                        className="form-control form-control-lg"
                                        placeholder="Enter a valid email address"
                                    />
                                </div>

                                <div className="form-outline mb-3">
                                    <input
                                        type="password"
                                        id="password"
                                        value={password}
                                        required={true}
                                        onChange={(e) => setPassword(e.target.value)}
                                        className="form-control form-control-lg"
                                        placeholder="Enter password"
                                    />
                                </div>

                                <div className="d-flex justify-content-between align-items-center">
                                    <div className="form-check mb-0">
                                        <input
                                            className="form-check-input me-2"
                                            type="checkbox"
                                            value=""
                                            id="form2Example3"
                                        />
                                        <label className="form-check-label" htmlFor="form2Example3">
                                            Remember me
                                        </label>
                                    </div>
                                    <a href="#" className="text-body">
                                        Forgot password?
                                    </a>
                                </div>

                                <div className="text-center text-lg-start mt-4 pt-2">
                                    {loading ? (
                                        <button type="submit" className="disabled bg_green_auth w-100">
                                            <i className="animate-spin fas fa-spinner"></i>
                                            Processing...
                                        </button>
                                    ) : (
                                        <button type="submit" className=" bg_green_auth w-100">
                                            Login
                                        </button>
                                    )}
                                    <p className="small fw-bold mt-2 pt-1 mb-0">
                                        Don't have an account? <Link to='/register'><a href="#" className="link-danger">Create an account</a></Link>
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

export default LoginPage;
