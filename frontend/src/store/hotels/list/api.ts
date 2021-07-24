import { HotelsPaginationInfoType } from './types'
import http from '../../../services/http'

export const fetchHotelsApi = (currentPage: number): Promise<HotelsPaginationInfoType> => {
  return http.get<HotelsPaginationInfoType>(`/hotels?page=${currentPage}`).then(({ data }) => data)
}
