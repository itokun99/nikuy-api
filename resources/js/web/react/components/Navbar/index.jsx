import { memo } from 'react';
import Image from '../Image';
import { NavLink, Link } from 'react-router-dom';
import { useSelector, shallowEqual } from 'react-redux';
import { Navbar, Nav, Button, Container, NavDropdown } from 'react-bootstrap';
import { profileAccountSelector } from '../../modules';
import { modalAuth } from '../../controls';
import { logout } from '../../services';

const menus = [
  { title: 'Event', path: '/event' },
  { title: 'Course', path: '/course' },
  { title: 'Forum', path: '/forum' },
  { title: 'Community', path: '/community' },
]

const NavbarSite = () => {

  const account = useSelector(profileAccountSelector, shallowEqual);

  const renderNavItem = () => {
    if (account) {
      return (
        <Nav className="ml-auto align-items-center">
          {menus.map((menu, index) => {
            return (
              <NavLink
                key={index}
                className="nav-link"
                activeClassName="active"
                to={menu.path}
              >
                {menu.title}
              </NavLink>
            )
          })}
          <NavDropdown title={(
            <img width={24} height={24} src="/assets/img/ic-notif.png" alt="" />
          )} id="notification-menu">
            <NavDropdown.Item href="/">Dropdown 1</NavDropdown.Item>
            <NavDropdown.Item href="/">Dropdown 2</NavDropdown.Item>
          </NavDropdown>
          <NavLink
            className="nav-link"
            activeClassName="active"
            to="/profile"
          >
            <Image
              backgroundImage source={account?.photo}
              alt={account?.name}
              style={{ width: 40, height: 40, backgroundPosition: 'center' }}
              resizeMode="cover" className="rounded-circle" />
          </NavLink>
          <Button onClick={logout} size="sm" variant="link mr-lg-3 text-muted text-decoration-none font-weight-bolder">Logout</Button>
        </Nav>
      )
    }

    return (
      <Nav className="ml-auto">
        <Button onClick={() => modalAuth(true)} size="lg" variant="link mr-lg-3 text-light text-decoration-none">Login</Button>
        <Button onClick={() => modalAuth(true, 'register')} size="lg" variant="primary" className="font-weight-bold">Daftar</Button>
      </Nav>
    )
  }



  return (
    <Navbar className="nav-bar" sticky="top" variant="dark" expand="lg">
      <Container>
        <Link className="navbar-brand" to="/">
          <img
            src="/assets/img/LogoPutih.png"
            width="180"
            className="d-inline-block align-top"
            alt="elites"
          />
        </Link>
        <Navbar.Toggle aria-controls="basic-navbar-nav" />
        <Navbar.Collapse id="basic-navbar-nav">
          {renderNavItem()}
        </Navbar.Collapse>
      </Container>
    </Navbar>
  )
}

export default memo(NavbarSite)