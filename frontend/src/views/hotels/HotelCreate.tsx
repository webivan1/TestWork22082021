import React, { FC } from 'react'
import { HotelForm } from '../../components/hotels/form/HotelForm'
import { Alert } from 'react-bootstrap'
import { Loading } from '../../components/loading/Loading'
import { useHotelForm } from './useHotelForm'

export const HotelCreate: FC = () => {
  const { loading, error, success, handlerCreate } = useHotelForm()

  return (
    <>
      <div className="d-flex align-items-center mb-3">
        <div className="me-2 h4 my-0">Create a hotel</div>
        <Loading size="sm" show={loading} />
      </div>

      {error && <Alert variant="danger">{error}</Alert>}
      {success && <Alert variant="success">{success}</Alert>}

      <HotelForm disabled={loading} onSubmit={handlerCreate} buttonText={'Create hotel'} />
    </>
  )
}
