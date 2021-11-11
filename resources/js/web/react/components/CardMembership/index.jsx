import { memo } from 'react';
import PropTypes from 'prop-types';
import { Card, Button } from 'react-bootstrap';

const CardMembership = ({ name, image, description, price, current, onClick, disabled }) => {
  return (
    <Card className="card-membership card-dark-bg text-light">
      <div className="card-membership__header p-3">
        <h5 className="card-membership__title text-center m-0"><strong>{name}</strong></h5>
      </div>
      <div className="card-membership__image-holder text-center">
        <img className="w-100" src={image} alt={name} />
      </div>
      <div className="card-membership__price-holder p-2 text-center">
        <span className="card-membership__price">{price}</span>
      </div>
      <div className="card-membership__body p-3">
        <div dangerouslySetInnerHTML={{ __html: description }} />
      </div>
      <div className="card-membership__footer p-3">
        {current ? (
          <Button block variant="outline-secondary" className="font-weight-bold">STATUS ANDA SAAT INI</Button>
        ) : (
          <Button disabled={disabled} block className="text-white font-weight-bold" variant="secondary" onClick={onClick}>UPGRADE</Button>
        )}
      </div>
    </Card>
  )
}

CardMembership.propTypes = {
  name: PropTypes.string,
  image: PropTypes.string,
  description: PropTypes.string,
  price: PropTypes.string,
  current: PropTypes.bool,
  onClick: PropTypes.func,
  disabled: PropTypes.bool
};
CardMembership.defaultProps = {
  name: '',
  image: '',
  description: '',
  price: '',
  onClick: () => { },
  current: false,
  disabled: false
};

export default memo(CardMembership);