import http from '../../../services/http'
import { HotelIdType } from '../types'
import { HotelFormResponseType, HotelFormType } from './types'

export const createHotelApi = (form: FormData | HotelFormType): Promise<HotelFormResponseType> => {
  return http.post<HotelFormResponseType>('/hotel', form).then(({ data }) => data)
}

export const updateHotelApi = (
  id: HotelIdType,
  form: FormData | HotelFormType
): Promise<HotelFormResponseType> => {
  return http.put<HotelFormResponseType>(`/hotel/${id}`, form).then(({ data }) => data)
}
