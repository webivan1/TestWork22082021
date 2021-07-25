import { useAppDispatch, useAppSelector } from '../../store/hooks'
import { useParams } from 'react-router-dom'
import { useEffect } from 'react'
import { fetchHotelAsync } from '../../store/hotels/detail/hotelDetailSlice'

type RouteParamTypes = {
  id: string
}

export const useHotelItem = () => {
  const { id } = useParams<RouteParamTypes>()
  const dispatch = useAppDispatch()
  const { loading, error, model } = useAppSelector((state) => state.hotelDetail)

  useEffect(() => {
    dispatch(fetchHotelAsync(id))
  }, [id])

  return {
    loading,
    error,
    model,
  }
}
