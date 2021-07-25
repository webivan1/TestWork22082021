import React, { FC } from 'react'
import { Alert } from 'react-bootstrap'
import { Loading } from '../../components/loading/Loading'
import { useHotelItem } from './useHotelItem'
import { HotelForm } from '../../components/hotels/form/HotelForm'
import { useHotelForm } from './useHotelForm'

export const HotelUpdate: FC = () => {
  const { error: errorView, loading: loadingView, model } = useHotelItem()
  const { loading, error, success, handlerUpdate } = useHotelForm()

  if (errorView) {
    return <Alert variant="danger">{errorView}</Alert>
  }

  if (loadingView || !model) {
    return <Loading show />
  }

  return (
    <>
      <div className="d-flex align-items-center mb-3">
        <div className="me-2 h4 my-0">Update hotel #{model.id}</div>
        <Loading size="sm" show={loading} />
      </div>

      {error && <Alert variant="danger">{error}</Alert>}
      {success && <Alert variant="success">{success}</Alert>}

      <HotelForm
        disabled={loading}
        onSubmit={(data) => handlerUpdate(model.id, data)}
        buttonText={'Update'}
        initialData={model}
      />
    </>
  )
}
