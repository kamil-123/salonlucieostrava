import React from 'react';
import {
    BrowserRouter as Router,
    Switch,
    Route,
  } from "react-router-dom";
import Home from './pages/Home';
// import Stylistselect from './Stylistselect/Stylistselect.jsx';
import BookAppointment from './pages/BookAppointment';


 

export default class App extends React.Component {

    render() {

        return (
            <div>
                <Router>
                    <Switch>
                        <Route path='/react/home' component={Home}/>
                        <Route path='/react/book-appointment' component={BookAppointment}/>
                    </Switch>
                </Router>
            </div>

 

        )

    }

}