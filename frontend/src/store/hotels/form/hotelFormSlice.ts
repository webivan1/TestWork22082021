import { createSlice, PayloadAction } from '@reduxjs/toolkit'
import { HotelFormStateType, HotelFormType, HotelResponseStatus } from './types'
import { AppThunk } from '../../index'
import { createHotelApi, updateHotelApi } from './api'
import { HotelIdType } from '../types'

const initialState: HotelFormStateType = {
  error: null,
  success: null,
  loading: false,
}

export const hotelFormSlice = createSlice({
  name: 'hotel/form',
  initialState,
  reducers: {
    startFetching: (state) => {
      state.loading = true
      state.error = null
      state.success = null
    },
    stopFetching: (state) => {
      state.loading = false
    },
    setError: (state, { payload }: PayloadAction<string>) => {
      state.error = payload
    },
    setSuccess: (state, { payload }: PayloadAction<string>) => {
      state.success = payload
    },
    reset: (state) => {
      state.loading = false
      state.error = null
      state.success = null
    },
  },
})

export const { startFetching, stopFetching, setError, setSuccess, reset } = hotelFormSlice.actions

export const createHotelAsync =
  (form: FormData | HotelFormType): AppThunk =>
  async (dispatch) => {
    try {
      dispatch(startFetching())
      const response = await createHotelApi(form)
      if (response.status === HotelResponseStatus.error) {
        throw new Error(response.errorMessage)
      } else {
        dispatch(setSuccess(`You have created a new hotel ${response.model.name}`))
      }
    } catch (e) {
      dispatch(setError(e.message))
    } finally {
      dispatch(stopFetching())
    }
  }

export const updateHotelAsync =
  (id: HotelIdType, form: FormData | HotelFormType): AppThunk =>
  async (dispatch) => {
    try {
      dispatch(startFetching())
      const response = await updateHotelApi(id, form)
      if (response.status === HotelResponseStatus.error) {
        throw new Error(response.errorMessage)
      } else {
        dispatch(setSuccess(`You have updated a hotel ${response.model.name}`))
      }
    } catch (e) {
      dispatch(setError(e.message))
    } finally {
      dispatch(stopFetching())
    }
  }

export default hotelFormSlice.reducer
