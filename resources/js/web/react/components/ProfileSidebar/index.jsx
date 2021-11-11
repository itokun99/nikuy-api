import { memo } from 'react';
import { NavLink } from 'react-router-dom';

const menus = [
  { id: 1, title: 'Profile', path: '/profile' },
  { id: 2, title: 'Membership', path: '/membership' },
  { id: 3, title: 'Transaksi', path: '/transaction' },
]

const ProfileSidebar = () => {
  return (
    <div className="profile-sidebar">
      {menus.map(menu => (
        <NavLink
          key={menu.id}
          className="profile-sidebar__nav-link"
          activeClassName="profile-sidebar__nav-link--active"
          to={menu.path}
        >
          {menu.title}
        </NavLink>
      ))}
    </div>
  )
}

export default memo(ProfileSidebar);