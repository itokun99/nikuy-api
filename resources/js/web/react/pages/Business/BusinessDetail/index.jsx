import { Redirect } from 'react-router-dom';
import { BusinessForm } from '../../../components';
import { BaseContainer, ProfileContainer } from '../../../containers';
import { useSelector, shallowEqual } from 'react-redux';
import { profileAccountSelector } from '../../../modules';
import { getTokenFromStorage } from '../../../utils';

const menus = [
  { id: 1, title: 'Akun Profile Anda', path: '/profile' },
  { id: 2, title: 'Akun Bisnis Anda', path: '/profile/business' }
];


const BusinessDetail = () => {
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
        <BusinessForm />
      </ProfileContainer>
    </BaseContainer>
  )
}

export default BusinessDetail;