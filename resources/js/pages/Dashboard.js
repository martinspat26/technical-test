import React, { useState, useEffect } from 'react';
import LoadingSpinner from '../components/LoadingSpinner';

function Dashboard() {
    const [isLoading, setIsLoading] = useState(true);
    const [windFarms, setWindFarms] = useState([]);
    const [indexWindFarm, setIndexWindFarm] = useState(-1);

    useEffect(() => {
        const token = localStorage.getItem('token');

        fetch('/api/dashboard',
            {
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + token,
                }
            })
            .then(response => response.json())
            .then(data => {
                setWindFarms(data);
                setIsLoading(false);
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }, []);

    return (
        <div className="bg-gradient-to-r from-purple-300 to-white-500 min-h-screen">
            <button className="absolute top-0 right-0 m-4 p-2 bg-purple-500 hover:bg-purple-800 text-white font-bold rounded" onClick={() => {
                localStorage.removeItem('token');
                window.location.href = '/';
            }}>Logout</button>
            {isLoading === false ?
                <div>
                    <h1 className="font-mono text-center text-4xl font-bold">WindFarms</h1>
                    <div className="justify-center flex gap-20 self-center mt-4 font-mono font-bold">
                        {windFarms.map((windFarm, index) => (
                            <div key={windFarm.id}
                                className={`cursor-pointer hover:bg-purple-200 rounded-lg shadow-lg p-4 bg-white ${indexWindFarm === index ? 'bg-purple-400' : ''}`}
                                onClick={() => setIndexWindFarm(index)}>
                                {windFarm.name}
                            </div>
                        ))}
                    </div>

                    {indexWindFarm !== -1 && (
                        <div className="flex flex-row">
                            <div className='basis-1/4'></div>
                            <div className='basis-1/2 bg-white shadow-md rounded-lg shadow-lg overflow-hidden mx-2 my-4'>
                                <div className="font-mono text-center mt-4">
                                    <strong>Name:</strong> {windFarms[indexWindFarm].name}&nbsp;&nbsp;&nbsp;&nbsp;
                                    <strong>Location:</strong> {windFarms[indexWindFarm].location}&nbsp;&nbsp;&nbsp;&nbsp;
                                    <strong>Number of Turbines:</strong> {windFarms[indexWindFarm].turbines.length}
                                </div>
                                <ul>
                                    {windFarms[indexWindFarm].turbines.map((turbine, index) => (
                                        <li key={index}>
                                            <div className='font-mono text-center mt-4'>
                                                <strong>Name:</strong> {turbine.name}&nbsp;&nbsp;&nbsp;&nbsp;
                                                <strong>Number of Components</strong> {turbine.components.length}
                                            </div>
                                            <ul>
                                                {turbine.components.map((component, index) => (
                                                    <li key={index}>
                                                        <div className="font-mono text-center">
                                                            <strong>Name:</strong> {component.name}&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <strong>Grade:</strong><span className={component.grade === 5 ? 'text-red-800 font-bold' : ''}> {component.grade} </span>
                                                        </div>
                                                    </li>
                                                ))}
                                            </ul>
                                        </li>
                                    ))}
                                </ul>
                            </div>
                            <div className='basis-1/4'></div>
                        </div>
                    )}
                </div> :
                <LoadingSpinner />
            }
        </div>
    );
}

export default Dashboard;
