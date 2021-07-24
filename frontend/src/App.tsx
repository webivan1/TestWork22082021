import React, { FC } from 'react'
import { BrowserRouter as Router, Switch, Route } from 'react-router-dom'
import { Home } from './views/home/Home'

export const App: FC = () => {
  return (
    <div>
      <p>Here is navigation</p>

      <Router>
        <Switch>
          <Route exact path="/" component={Home} />
          <Route path="/hotels" component={Home} />
          <Route path="/hotel/create" component={Home} />
          <Route path="/hotel/:id/edit" component={Home} />
          <Route path="/hotel/:id/view" component={Home} />
        </Switch>
      </Router>
    </div>
  )
}
