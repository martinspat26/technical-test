import ReactDOM from 'react-dom';
import React, { useState, useEffect } from 'react';

function Dashboard() {
    const [windFarms, setWindFarms] = useState([]);
    useEffect(() => {
        fetch('/api/dashboard')
            .then(response => response.json())
            .then(data => {
                setWindFarms(data);
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }, []);

    return (
        <div>
            <h1>WindFarms Dashboard</h1>
            <ul>
                {windFarms.map(windFarm => (
                    <li key={windFarm.id}>
                        <h2>{windFarm.name}</h2>
                        <ul>
                            {windFarm.turbines.map(turbine => (
                                <li key={turbine.id}>
                                    <h3>{turbine.name}</h3>
                                    <ul>
                                        {turbine.components.map(component => (
                                            <li key={component.id}>
                                                <span>Name: {component.name}</span><br/>
                                                <span>Grade: {component.grade}</span>
                                            </li>
                                        ))}
                                    </ul>
                                </li>
                            ))}
                        </ul>
                    </li>
                ))}
            </ul>
        </div>
    );
}

export default Dashboard;

if (document.getElementById('dashboard')) {
    ReactDOM.render(<Dashboard />, document.getElementById('dashboard'));
}