import { HotelType } from '../types'

export type HotelsPaginationInfoType = {
  total: number
  per_page: number
  current_page: number
  data: HotelType[]
}

export type HotelsStateType = {
  error: null | string
  loading: boolean
  info: HotelsPaginationInfoType
}
