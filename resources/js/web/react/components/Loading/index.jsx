import { memo } from 'react';
import PropTypes from 'prop-types';

const Loading = ({ show, message }) => {
  return (
    <div className={`loading ${show ? 'loading--show' : ''}`}>
      <div className="loading__content">
        <img className="loading__image" src="/assets/img/img-loading.svg" alt="" />
        <span className="loading__text">{message}</span>
      </div>
    </div>
  )
}

Loading.propTypes = {
  show: PropTypes.bool,
  message: PropTypes.string,
}
Loading.defaultProps = {
  show: false,
  message: 'Loading...'
}

export default memo(Loading);