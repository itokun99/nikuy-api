import { memo } from 'react';
import PropTypes from 'prop-types';
import CardEvent from '../CardEvent';
import { profileAccountSelector } from '../../modules';
import { modalAuth } from '../../controls';
import { Container, Row, Col } from 'react-bootstrap';
import { useSelector, shallowEqual } from 'react-redux';

const EventList = ({ items, sectionTitle }) => {

  const account = useSelector(profileAccountSelector, shallowEqual);
  const isAuthenticated = Boolean(account);

  const onClickRegister = () => {
    if (!isAuthenticated) {
      return modalAuth(true);
    }
  }

  return (
    <div className="event-list mb-5">
      <Container>
        <div className="event-list__header mb-4">
          <Row>
            <Col>
              <h2 className="text-white">{sectionTitle}</h2>
            </Col>
          </Row>
        </div>
        <div className="event-list__body">
          <Row>
            {items.map(item => {
              return (
                <Col key={item.id} xs={12} sm={6} md={6} lg={4} className="mb-5">
                  <CardEvent
                    title={item.name}
                    image={item.image}
                    venue={item.venue}
                    datetime={item.datetime}
                    author={item.author}
                    price={item?.price_display?.original}
                    priceDiscount={item?.price_display?.discount}
                    onClick={() => onClickRegister(item.id)}
                  />
                </Col>
              )
            })}
          </Row>
        </div>
      </Container>
    </div>
  )
}

EventList.propTypes = {
  items: PropTypes.array,
  sectionTitle: PropTypes.string
};
EventList.defaultProps = {
  items: [],
  sectionTitle: ''
};

export default memo(EventList);