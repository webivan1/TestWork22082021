import React, { FC } from 'react'
import { Link } from 'react-router-dom'
import { Container, Nav, Navbar } from 'react-bootstrap'

type MenuItemType = {
  link: string
  label: string
}

type PropTypes = {
  menu: MenuItemType[]
}

export const AppNav: FC<PropTypes> = ({ menu }) => {
  return (
    <Navbar bg="dark" variant="dark">
      <Container>
        <Navbar.Brand as={Link} to="/" className="text-warning">
          <b>Hotels</b>
        </Navbar.Brand>
        <Nav className="me-auto">
          {menu.map(({ link, label }) => (
            <Nav.Link data-testid="menu-item" key={link} as={Link} to={link}>
              {label}
            </Nav.Link>
          ))}
        </Nav>
      </Container>
    </Navbar>
  )
}
