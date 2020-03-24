import React from 'react';
import {
    BrowserRouter as Router,
    Switch,
    Route,
  } from "react-router-dom";
import Main from './Main/Main.jsx';
import Stylistselect from './Stylistselect/Stylistselect.jsx';

 

export default class App extends React.Component {

    render() {

        return (
            <>
            <Router>
                <Switch>
                    <Route path='/react/stylistselect' component={Stylistselect}/>    
                    <Route path='/react' component={Main}/>
                    
                </Switch>
            </Router>
            </>

 

        )

    }

}