import React from 'react';
import {
    BrowserRouter as Router,
    Switch,
    Route,
  } from "react-router-dom";
import Home from './pages/Home';
import BookAppointment from './pages/BookAppointment';
import Header from './components/Header';
import './App.scss'; 

export default class App extends React.Component {

    render() {

        return (
            <div>
                <Router>
                    <Route component={Header} />
                    <Switch>
                        <Route path='/react/home' component={Home}/>
                        <Route path='/react/book-appointment' component={BookAppointment}/>
                    </Switch>
                </Router>
            </div>

 

        )

    }

}