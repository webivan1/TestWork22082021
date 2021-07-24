import { HotelType } from '../types'

export type HotelDetailStateType = {
  error: string | null
  loading: boolean
  model: HotelType | null
}
