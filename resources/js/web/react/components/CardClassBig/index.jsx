import { memo } from 'react';
import PropTypes from 'prop-types';
import { Card, Row, Col, Button } from 'react-bootstrap';

const CardClassBig = ({ title, image, count, description, onClick }) => {
  return (
    <Card className="card-class-big mb-5">
      <Card.Body>
        <Row>
          <Col sm={12} md={4} className="card-class-big__left d-flex flex-column justify-content-between">
            <img className="w-100 mb-4" src={image} alt={title} />
            <div className="card-class-big__action">
              <Button onClick={onClick} variant="primary" className="font-weight-bold text-white" block>Mulai Kelas</Button>
            </div>
          </Col>
          <Col>
            <Card className="card-class-big__right">
              <Card.Body>
                <Card.Title><strong>{title}</strong></Card.Title>
                <Card.Text>{count ? `${count} pelajaran` : 'tidak ada pelajaran'}</Card.Text>
                <div className="card-class-big__desc">
                  <div dangerouslySetInnerHTML={{ __html: description }} />
                </div>
              </Card.Body>
            </Card>
          </Col>
        </Row>
      </Card.Body>
    </Card>
  )
}

CardClassBig.propTypes = {
  title: PropTypes.string,
  image: PropTypes.string,
  count: PropTypes.number,
  description: PropTypes.string,
  onClick: PropTypes.func,
};

CardClassBig.defaultProps = {
  title: '',
  image: '',
  count: 0,
  description: '',
  onClick: () => { }
};

export default memo(CardClassBig)