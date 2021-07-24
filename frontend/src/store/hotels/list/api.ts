import { HotelRemoveResponseType, HotelsPaginationInfoType } from './types'
import http from '../../../services/http'
import { HotelIdType } from '../types'

export const fetchHotelsApi = (currentPage: number): Promise<HotelsPaginationInfoType> => {
  return http.get<HotelsPaginationInfoType>(`/hotels?page=${currentPage}`).then(({ data }) => data)
}

export const removeHotelApi = (id: HotelIdType): Promise<HotelRemoveResponseType> => {
  return http.delete<HotelRemoveResponseType>(`/hotel/${id}`).then(({ data }) => data)
}
