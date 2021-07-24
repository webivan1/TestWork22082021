import React, { FC } from 'react'
import { useAppDispatch, useAppSelector } from '../../store/hooks'
import { fetchHotelsAsync } from '../../store/hotels/list/hotelsSlice'

export const Hotels: FC = () => {
  const dispatch = useAppDispatch()
  const {
    loading,
    error,
    info: { total, data },
  } = useAppSelector((state) => state.hotels)

  const fetchList = async (page: number = 1) => {
    await fetchHotelsAsync(page)
  }

  return <div>List of hotels</div>
}
