import React from 'react';

const LoadingSpinner = () => {
    return (
        <div className="flex justify-center items-center h-screen">
        <div className="w-20 h-20 border-t-4 border-gray-500 border-solid rounded-full animate-spin"></div>
        </div>
    );
};

export default LoadingSpinner;