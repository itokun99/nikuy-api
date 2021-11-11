import { Row, Col } from 'react-bootstrap';
import { Redirect } from 'react-router-dom';
import {
  CardProfilePhoto,
  CardProfileMembership,
  CardProfileForm,
  CardProfilePassword
} from '../../components';
import { BaseContainer, ProfileContainer } from '../../containers';
import { getTokenFromStorage } from '../../utils';

const menus = [
  { id: 1, title: 'Akun Profile Anda', path: '/profile' },
  { id: 2, title: 'Akun Bisnis Anda', path: '/profile/business' }
];


const Profile = () => {
  const token = getTokenFromStorage();


  if (!token) {
    return <Redirect to="/" />
  }

  return (
    <BaseContainer footer={false}>
      <ProfileContainer menus={menus}>
        <Row>
          <Col sm={12} md={5}>
            <CardProfilePhoto />
            <CardProfileMembership />
          </Col>
          <Col sm={12} md={7}>
            <CardProfileForm />
            <CardProfilePassword />
          </Col>
        </Row>
      </ProfileContainer>
    </BaseContainer>
  )
}

export default Profile;