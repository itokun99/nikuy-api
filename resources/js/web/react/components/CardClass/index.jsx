import { memo } from 'react';
import Image from '../Image';
import PropTypes from 'prop-types';
import { Button } from 'react-bootstrap';

const CardClass = ({ image, title, onClick }) => {
  return (
    <div className='card card-class'>
      <Image resizeMode='cover' backgroundImage className='card-img-top card-class__image' source={image} alt={title} />
      <div className='card-body d-flex flex-column justify-content-between'>
        <h6 className='card-title card-class__title text-white mb-4'>{title}</h6>
        <Button
          block
          type="button"
          onClick={onClick}
          variant="primary"
        >Mulai Kelas</Button>
      </div>
    </div>
  )
}

CardClass.propTypes = {
  image: PropTypes.string,
  title: PropTypes.string,
  onClick: PropTypes.func,
}

CardClass.defaultProps = {
  image: '',
  title: '',
  onClick: () => { }
}

export default memo(CardClass)