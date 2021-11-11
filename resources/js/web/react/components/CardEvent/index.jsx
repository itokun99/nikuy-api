import { memo } from 'react';
import PropTypes from 'prop-types';
import Image from '../Image';
import CardAuthor from '../CardAuthor';
import { Card, Button } from 'react-bootstrap';


const CardEvent = ({ title, datetime, venue, image, onClick, author, price, priceDiscount }) => {

  const renderPriceTag = () => {
    if (!price) {
      return null
    }

    if (price && priceDiscount) {
      return (
        <div className="card-event__price">
          <span><strong>{priceDiscount}</strong></span>
          {`   `}
          <span style={{ opacity: 0.5 }}><strike>{price}</strike></span>
        </div>
      )
    }

    return (
      <div className="card-event__price">
        <strong>{price}</strong>
      </div>
    )
  }

  return (
    <Card className="card-event">
      <Card.Body className="p-4">
        <Card className="card-event__inner">
          <Image
            source={image}
            backgroundImage
            resizeMode="cover"
            className="card-img-top card-event__image">
            {renderPriceTag()}
          </Image>
          <Card.Body className="text-white">
            <Card.Title as="h5" className="card-event__title"><strong>{title}</strong></Card.Title>
            <Card.Text className="card-event__text">{datetime}</Card.Text>
            <Card.Text className="card-event__text">{venue}</Card.Text>
            {author && (
              <CardAuthor name={author.name} title={author.title} photo={author.photo} />
            )}

            <Button variant="primary" block onClick={onClick}>Daftar</Button>
          </Card.Body>
        </Card>
      </Card.Body>
    </Card>
  );
}

CardEvent.propTypes = {
  title: PropTypes.string,
  datetime: PropTypes.string,
  venue: PropTypes.string,
  image: PropTypes.string,
  onClick: PropTypes.func,
  author: PropTypes.object,
  price: PropTypes.string,
  priceDiscount: PropTypes.string
};
CardEvent.defaultProps = {
  title: '',
  datetime: '',
  venue: '',
  image: '',
  onClick: () => { },
  author: null,
  price: '',
  priceDiscount: ''
};

export default memo(CardEvent);