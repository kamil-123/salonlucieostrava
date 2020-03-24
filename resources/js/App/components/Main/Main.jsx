import React from 'react';
import { Link } from 'react-router-dom';

import './Main.scss';

export default class Main extends React.Component{

  render(){
    const pathprefix=this.props.location.pathname
    console.log(this.props)
    return (
    <div className='mainpage'>
      
      <div className='mainpage__box'>
        <h1 className='maintitle'>Salon<br></br>Lucie</h1>
        <h3 className='mainsubtitle'>Best Hair Style in Ostrava</h3>
        <Link to={pathprefix+'/stylistselect'}>
          <div className='buttonbook'>Book now</div>
        </Link>
        <div className='buttonabout'>About us</div>
      </div>

    </div>
  )
  }
}