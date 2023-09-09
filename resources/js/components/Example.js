import ReactDOM from 'react-dom';
import React, { useState } from 'react';

function Example() {
  // Declare a new state variable, which we'll call "count"  const [count, setCount] = useState(0);
  const [count, setCount] = useState(0);
  
  return (
    <div className="container">
    <div className="row justify-content-center">
      <div className="col-md-8">
        <div className="card">
          <div className="card-header">Laravel React</div>
          <div className="card-body">I'm a React component!</div>
        </div>
      </div>
    </div>

    <div>
      <p>You clicked {count} times</p>
      <button onClick={() => setCount(count + 1)}>
        Click me
      </button>
    </div>
  </div>
  );
}

export default Example;

if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}
