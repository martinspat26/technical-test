import React, { useState, useEffect } from 'react';
import LoadingSpinner from '../components/LoadingSpinner';
import { set } from 'lodash';

function Login() {
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState('');
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');

    const login = () => {
        setIsLoading(true);

        fetch('/api/tokens/create', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ email, password }),
        })
            .then(response => {
                if (response.status >= 400 && response.status < 600) {
                    return response.json().then(data => {
                        setError(data.message);
                    });
                } else if (response.status === 200) {
                    return response.json();
                } else {
                    console.log('An error occurred');
                }
            })
            .then(data => {
                if (!data) return;
                localStorage.setItem('token', data.access_token);
                window.location.href = '/';
            })
            .catch(error => {
                console.error('Error:', error);
            })
            .finally(() => {
                setIsLoading(false);
            });
    }

    const isValidEmail = () => {
        return email !== '' && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    const isValidPassword = () => {
        return password !== '';
    }

    const isValidForm = () => {
        return isValidEmail() && isValidPassword();
    }

    return (
        <div className="bg-gradient-to-r from-purple-300 to-white-500 min-h-screen">
            {isLoading ? <LoadingSpinner /> :
                <div className='flex justify-center items-center min-h-screen'>
                    <div className='basis-1/3 bg-white shadow-md rounded-lg shadow-lg overflow-hidden mx-2 my-4'>
                        <div className="p-4">
                            <input
                                type="text"
                                placeholder="Email"
                                value={email} onChange={e => setEmail(e.target.value)}
                                className="bg-white w-full h-12 rounded-md border border-gray-300 pl-2"
                            />

                            {!isValidEmail() ? (
                                <span className="text-red-500 text-sm">Email is not valid</span>
                            ) : null}
                            <input
                                type="password"
                                placeholder="Password"
                                value={password}
                                onChange={e => { setPassword(e.target.value); setError(''); }}
                                className="bg-white w-full mt-8 h-12 rounded-md border border-gray-300 pl-2"
                            />

                            {!isValidPassword() ? (
                                <span className="text-red-500 text-sm">Password is not valid</span>
                            ) : null}

                            {error !== '' ? (
                                <span className="text-red-500 mt-4 text-sm">{error}</span>
                            ) : null}

                            <button
                                onClick={login}
                                disabled={!isValidForm()}
                                className="w-full bg-purple-500 mt-8 text-white rounded-md p-2 hover:bg-purple-800 disabled:opacity-50">
                                Login
                            </button>
                        </div>
                    </div>
                </div>
            }
        </div>
    );
}

export default Login;