import { Row, Col } from 'react-bootstrap';
import { Redirect } from 'react-router-dom';
import { MembershipList } from '../../components';
import { BaseContainer, ProfileContainer } from '../../containers';
import { useSelector, shallowEqual } from 'react-redux';
import { profileAccountSelector } from '../../modules';
import { getTokenFromStorage } from '../../utils';

const menus = [
  { id: 1, title: 'Akun Member Anda', path: '/membership' },
];


const Membership = () => {
  const token = getTokenFromStorage();
  const account = useSelector(profileAccountSelector, shallowEqual);


  if (!token) {
    return <Redirect to="/" />
  }

  if (!account) {
    return null;
  }

  return (
    <BaseContainer footer={false}>
      <ProfileContainer menus={menus}>
        <Row>
          <Col xs={12}>
            <MembershipList />
          </Col>
        </Row>
      </ProfileContainer>
    </BaseContainer>
  )
}

export default Membership;