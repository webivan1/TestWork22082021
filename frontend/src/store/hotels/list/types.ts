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

export enum HotelRemoveResponseStatus {
  error = 'error',
  success = 'success',
}

export type HotelRemoveResponseType =
  | {
      status: HotelRemoveResponseStatus.error
      errorMessage: string
    }
  | {
      status: HotelRemoveResponseStatus.success
    }
