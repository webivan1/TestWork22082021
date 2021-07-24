import React, { FC } from 'react'
import { Spinner } from 'react-bootstrap'

type PropTypes = {
  show?: boolean
}

export const Loading: FC<PropTypes> = ({ show = false }) => {
  if (!show) {
    return <></>
  }

  return (
    <Spinner data-testid="loading" animation="border" role="status">
      <span className="visually-hidden">Loading...</span>
    </Spinner>
  )
}
