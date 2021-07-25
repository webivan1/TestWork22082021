import React, { FC } from 'react'
import { useHotelGrid } from './useHotelGrid'
import { Alert } from 'react-bootstrap'
import { Pagination } from '../../pagination/Pagination'
import { HotelList } from './HotelList'
import { HotelContext } from './hotelContext'

export const HotelGrid: FC = () => {
  const { loading, error, total, perPage, currentPage, models, fetchList, removeItem } =
    useHotelGrid()

  return (
    <div>
      <p>Total: {total}</p>

      <Alert show={!!error} variant="danger">
        {error}
      </Alert>

      <HotelContext.Provider value={{ onRemove: removeItem }}>
        <HotelList models={models} />
      </HotelContext.Provider>

      <Pagination
        total={total}
        limit={perPage}
        currentPage={currentPage}
        onChangePage={fetchList}
        disabled={loading}
      />
    </div>
  )
}
