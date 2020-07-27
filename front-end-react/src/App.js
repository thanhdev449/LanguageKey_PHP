import React from "react";
//import logo from "./logo.svg";
import "./App.css";
import { Button } from "reactstrap";

function App() {
    return (
        <div className="App">
            <header className="App-header">
                {/* <img src={logo} className="App-logo" alt="logo" />
                <p>
                    Edit <code>src/App.js</code> and save to reload.
                </p>
                <a className="App-link" href="https://reactjs.org" target="_blank" rel="noopener noreferrer">
                    Learn React
                </a> */}
                <Button color="primary">primary</Button>
                <Button color="secondary">secondary</Button>
                <Button color="success">success</Button>
                <Button color="info">info</Button>
                <Button color="warning">warning</Button>
                <Button color="danger">danger</Button>
                <Button color="link">link</Button>
            </header>
        </div>
    );
}

export default App;
