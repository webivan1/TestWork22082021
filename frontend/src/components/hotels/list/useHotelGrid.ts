import { useAppDispatch, useAppSelector } from '../../../store/hooks'
import { fetchHotelsAsync, removeHotelAsync } from '../../../store/hotels/list/hotelsSlice'
import { HotelIdType } from '../../../store/hotels/types'
import { useEffect } from 'react'

declare const confirm: (message: string) => boolean

export const useHotelGrid = () => {
  const dispatch = useAppDispatch()

  const {
    loading,
    error,
    info: { total, per_page, current_page, data },
  } = useAppSelector((state) => state.hotels)

  const fetchList = async (page: number = 1) => {
    if (!loading) {
      await dispatch(fetchHotelsAsync(page))
    }
  }

  const removeItem = async (id: HotelIdType) => {
    if (confirm('Are you sure?')) {
      await dispatch(removeHotelAsync(id))
    }
  }

  useEffect(() => {
    // load first page
    fetchList()
  }, [dispatch])

  return {
    loading,
    error,
    total,
    perPage: per_page,
    currentPage: current_page,
    models: data,
    fetchList,
    removeItem,
  }
}
