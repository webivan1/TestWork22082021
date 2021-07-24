import { HotelType } from '../types'

export enum HotelResponseStatus {
  error = 'error',
  success = 'success',
}

export type HotelFormStateType = {
  error: string | null
  success: string | null
  loading: boolean
}

export type HotelFormResponseType =
  | {
      status: HotelResponseStatus.success
      model: HotelType
    }
  | {
      status: HotelResponseStatus.error
      errorMessage: string
    }

export type HotelFormType = Omit<HotelType, 'id'>
