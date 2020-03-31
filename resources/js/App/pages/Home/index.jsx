import React from 'react';
import { Link } from 'react-router-dom';


import './Home.scss';

export default class Home extends React.Component {

  render() {
    const pathprefix = this.props.location.pathname
    console.log(this.props)
    return (
      <div>
        <div className='mainPage'>
          <div className='mainPage__header'>
            <h3>Logo</h3>
            <h3>Hamb</h3>
          </div>
          <div className='mainPage__box'>
            <h1 className='mainTitle1'>Salon</h1>
            <h1 className='mainTitle2'>Lucie</h1>
            <h3 className='mainSubtitle'>Best Hair Style in Ostrava</h3>
            <Link to={pathprefix + '/SelectStylist'}>
              <div className='buttonBook1'>BOOK NOW</div>
            </Link>
              <div className='buttonAbout'>ABOUT US</div>
            </div>
            <div className='aboutSection'>
            <h1>Hair your head deserves</h1>
            <h4>Salón Lucie has been in the center of Ostrava since 2003.
              Our top hair stylists create the latest lines of cuts and color fashion trends for you.
              We use the latest technologies and products of GOLDWELL.
              Lucie salon will fulfill all your dreams of beautiful hair and new image.
              We cordially invite you!</h4>
              

            <Link to={pathprefix + '/SelectStylist'}>
            <div className='buttonBook2'>BOOK NOW</div>
            </Link>
             
            <h4>Salón Lucie has been in the center of Ostrava since 2003.
              Our top hair stylists create the latest lines of cuts and color fashion trends for you.
              We use the latest technologies and products of GOLDWELL.
              Lucie salon will fulfill all your dreams of beautiful hair and new image.
              We cordially invite you!</h4>
          </div>
        </div>
      </div>
      
    )
  }
}