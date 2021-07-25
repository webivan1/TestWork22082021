import http from '../../../services/http'
import { HotelIdType } from '../types'
import { HotelFormResponseType, HotelFormType } from './types'

export const createHotelApi = (form: FormData): Promise<HotelFormResponseType> => {
  return http.post<HotelFormResponseType>('/hotel', form).then(({ data }) => data)
}

export const updateHotelApi = (id: HotelIdType, form: FormData): Promise<HotelFormResponseType> => {
  form.append('_method', 'PUT')
  return http.post<HotelFormResponseType>(`/hotel/${id}`, form).then(({ data }) => data)
}
