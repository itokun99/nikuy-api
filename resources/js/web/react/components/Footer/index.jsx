import { memo } from 'react';
import { Link } from 'react-router-dom';

const Footer = () => {

  return (
    <div className="container-fluid text-center pb-4 pt-4">
      <div className="navfooter subheader-heavy">
        <ul>
          <li><Link to="/">Home</Link></li>
          <li><a href="https://wa.me/6282111959536" target="_blank">Contact</a></li>
          <li><Link to="/privacy">Privacy</Link></li>
        </ul>
        <p className="subheader-heavy text-white">Copyright &copy; The Entrepreneurs Society 2020</p>
      </div>
    </div>
  )
}

export default memo(Footer);