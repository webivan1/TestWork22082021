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
        </Switch>
      </Router>
    </div>
  )
}
