import React, { FC } from 'react'
import { useAppSelector } from '../../store/hooks'
import { Loading } from '../../components/loading/Loading'
import { HotelGrid } from '../../components/hotels/list/HotelGrid'

export const Hotels: FC = () => {
  const { loading } = useAppSelector((state) => state.hotels)

  return (
    <>
      <div className="d-flex align-items-center mb-3">
        <div className="me-2 h4 my-0">Hotels</div>
        <Loading size="sm" show={loading} />
      </div>

      <HotelGrid />
    </>
  )
}
