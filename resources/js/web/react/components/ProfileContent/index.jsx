import { memo } from 'react';
import { Col, Row, Container } from 'react-bootstrap';

const ProfileContent = ({ children }) => {
  return (
    <div className="profile-content">
      <div className="profile-content__inner">
        <Container>
          <Row>
            <Col>{children}</Col>
          </Row>
        </Container>
      </div>
    </div>
  )
}

export default memo(ProfileContent)