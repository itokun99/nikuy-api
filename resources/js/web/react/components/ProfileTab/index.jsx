import { memo } from 'react';
import PropTypes from 'prop-types';
import { Row, Col } from 'react-bootstrap';
import { NavLink, useLocation } from 'react-router-dom';

const ProfileTab = ({ menus }) => {
  const currentLocation = useLocation();
  console.log('currentLocation', currentLocation)
  return (
    <Row className="profile-tab py-4 mb-4 justify-content-center">
      {menus.map(menu => (
        <Col key={menu.id} xs={6} className="text-center">
          <NavLink
            exact
            to={menu.path}
            isActive={(match, location) => {
              if (match) return true;

              if (location?.pathname?.split?.("/")?.[2]?.includes(menu.path?.split?.("/")?.[2])) {
                return true;
              }

              return false;
            }}
            className="profile-tab__nav-link"
            activeClassName="profile-tab__nav-link--active"
          >
            <strong>{menu.title}</strong>
          </NavLink>
        </Col>
      ))}
    </Row>
  )
}

ProfileTab.propTypes = {
  menus: PropTypes.array
};
ProfileTab.defaultProps = {
  menus: []
}

export default memo(ProfileTab);