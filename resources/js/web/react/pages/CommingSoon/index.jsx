import { Container } from 'react-bootstrap';
import { BaseContainer } from '../../containers';

const CommingSoon = () => {
  return (
    <BaseContainer>
      <div style={{
        backgroundImage: `url("/assets/img/img-bg.jpeg")`,
        height: 'calc(100vh - 90px)',
        backgroundPosition: 'center',
        backgroundSize: 'cover'
      }}>
        <Container style={{ height: '100%', display: 'flex', alignItems: 'center' }}>
          <h1 className="text-light display-3 font-weight-bold"><strong>Comming Soon</strong></h1>
        </Container>
      </div>
    </BaseContainer>
  )
}

export default CommingSoon;