import { memo } from 'react';
import PropTypes from 'prop-types';
import { ProfileSidebar, ProfileContent, ProfileTab } from '../../components';

const ProfileContainer = ({ children, menus }) => {
  return (
    <>
      <div className="profile-container">
        <ProfileSidebar />
        <ProfileContent>
          {menus && menus.length > 0 && (
            <ProfileTab menus={menus} />
          )}
          {children}
        </ProfileContent>
      </div>
    </>
  )
}


ProfileContainer.propTypes = {
  children: PropTypes.any,
  menus: PropTypes.array
};

ProfileContainer.defaultProps = {
  children: null,
  menus: []
};


export default memo(ProfileContainer);