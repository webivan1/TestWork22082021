import http from '../../../services/http'
import { HotelIdType, HotelType } from '../types'

export const fetchHotelApi = (id: HotelIdType): Promise<HotelType> => {
  return http.get<HotelType>(`/hotels/${id}`).then(({ data }) => data)
}
