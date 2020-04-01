import React from 'react';
import { Link } from 'react-router-dom';
import './Header.scss';

class Header extends React.Component {
  render () {
    return (
      <div className="header">
        <div className="header-content">
          <Link to="/react/home">
            <div className="logo">Logo</div>
          </Link>
         
          <div className="hamburger">
            <span className="hamb1"></span>
            <span className="hamb2"></span>
            <span className="hamb3"></span>
          </div>
        </div>
      </div>
    )
  }
}

export default Header;