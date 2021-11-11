import { useEffect } from 'react';
import PropTypes from 'prop-types';
import { Helmet } from 'react-helmet';
import { Navbar, Footer, ModalAuth, ModalMembershipUpgrade } from '../../components';

const BaseContainer = ({ children, title, description, image, footer }) => {

  return (
    <>
      <Helmet>
        <title>{title}</title>
        <meta content={title} name='og:title' />
        <meta content={description} name='description' />
        <meta content={description} property='og:description' />
      </Helmet>
      <Navbar />
      {children}
      {footer && <Footer />}
      <ModalAuth />
      <ModalMembershipUpgrade />
    </>
  )
}

BaseContainer.propTypes = {
  children: PropTypes.any,
  footer: PropTypes.bool,
}
BaseContainer.defaultProps = {
  children: null,
  footer: true
}

export default BaseContainer;