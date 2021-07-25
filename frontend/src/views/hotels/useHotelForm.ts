import { useAppDispatch, useAppSelector } from '../../store/hooks'
import { useHistory } from 'react-router-dom'
import { HotelFormType } from '../../store/hotels/form/types'
import { createHotelAsync, reset, updateHotelAsync } from '../../store/hotels/form/hotelFormSlice'
import { useEffect } from 'react'
import { HotelIdType } from '../../store/hotels/types'

export const useHotelForm = () => {
  const dispatch = useAppDispatch()
  const router = useHistory()

  const { loading, error, success } = useAppSelector((state) => state.hotelForm)

  const handlerCreate = async (data: FormData) => {
    await dispatch(createHotelAsync(data, ({ id }) => router.push(`/hotel/${id}/view`)))
  }

  const handlerUpdate = async (id: HotelIdType, data: FormData) => {
    await dispatch(updateHotelAsync(id, data))
  }

  useEffect(() => {
    return () => {
      dispatch(reset())
    }
  }, [dispatch])

  return {
    loading,
    error,
    success,
    handlerCreate,
    handlerUpdate,
  }
}
