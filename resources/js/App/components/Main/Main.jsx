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
        <h4 className="mainsubtitle">----LUCIE BARÁNKOVÁ----</h4>
        <h1 className='maintitle'>Salon Lucie</h1>
        <h5 className='mainsubtitle'>Best Hair Style in Ostrava</h5>
        <Link to={pathprefix+'/stylistselect'}>
          <div className='buttonbook'>Book now</div>
        </Link>
        <div className='buttonabout'>About us</div>
      </div>

    </div>
  )
  }
}