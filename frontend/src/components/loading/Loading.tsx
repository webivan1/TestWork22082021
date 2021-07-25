import React, { FC } from 'react'
import { Spinner } from 'react-bootstrap'

type PropTypes = {
  show?: boolean
  size?: 'sm'
}

export const Loading: FC<PropTypes> = ({ show = false, size = undefined }) => {
  if (!show) {
    return <></>
  }

  return (
    <Spinner data-testid="loading" size={size} animation="border" role="status">
      <span className="visually-hidden">Loading...</span>
    </Spinner>
  )
}
