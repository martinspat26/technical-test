import ReactDOM from 'react-dom';
import React from 'react';
import Dashboard from './Dashboard';
import Login from './Login';

function App() {
  const checkAuth = () => {
    const token = localStorage.getItem('token');
    if (!token || token === 'undefined') {
      return false;
    }
    return true;
  }
  
  return ( 
    <div>
      {checkAuth() ? <Dashboard /> : <Login />}
    </div>
  );
}

export default App;

if (document.getElementById('root')) {
    ReactDOM.render(<App />, document.getElementById('root'));
}
