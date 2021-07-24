import React, { FC } from 'react'
import { BrowserRouter as Router, Switch, Route } from 'react-router-dom'
import { Container } from 'react-bootstrap'
// views
import { Home } from './views/home/Home'
import { Hotels } from './views/hotels/Hotels'
import { HotelCreate } from './views/hotels/HotelCreate'
import { HotelUpdate } from './views/hotels/HotelUpdate'
import { HotelDetail } from './views/hotels/HotelDetail'
import { AppNav } from './components/layouts/AppNav'

export const App: FC = () => {
  return (
    <Router>
      <AppNav
        menu={[
          { label: 'List', link: '/hotels' },
          { label: 'Create', link: '/hotel/create' },
        ]}
      />

      <Container className="py-5">
        <Switch>
          <Route exact path="/" component={Home} />
          <Route path="/hotels" component={Hotels} />
          <Route path="/hotel/create" component={HotelCreate} />
          <Route path="/hotel/:id/edit" component={HotelUpdate} />
          <Route path="/hotel/:id/view" component={HotelDetail} />
        </Switch>
      </Container>
    </Router>
  )
}
