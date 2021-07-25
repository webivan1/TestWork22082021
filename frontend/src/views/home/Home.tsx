import React, { FC } from 'react'
import { Link } from 'react-router-dom'

export const Home: FC = () => {
  return (
    <>
      <h4>Home page</h4>

      <p>
        Actual list of popular <Link to="/hotels">hotels</Link> in the world
      </p>
    </>
  )
}
