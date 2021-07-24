import { createSlice, PayloadAction } from '@reduxjs/toolkit'
import { HotelDetailStateType } from './types'
import { AppThunk } from '../../index'
import { fetchHotelApi } from './api'
import { HotelIdType, HotelType } from '../types'

const initialState: HotelDetailStateType = {
  error: null,
  loading: false,
  model: null,
}

export const hotelDetailSlice = createSlice({
  name: 'hotel/detail',
  initialState,
  reducers: {
    startFetching: (state) => {
      state.loading = true
      state.error = null
    },
    stopFetching: (state) => {
      state.loading = false
    },
    setError: (state, { payload }: PayloadAction<string>) => {
      state.error = payload
    },
    setModel: (state, { payload }: PayloadAction<HotelType>) => {
      state.model = payload
    },
  },
})

export const { startFetching, stopFetching, setError, setModel } = hotelDetailSlice.actions

export const fetchHotelAsync =
  (id: HotelIdType): AppThunk =>
  async (dispatch) => {
    try {
      dispatch(startFetching())
      const model = await fetchHotelApi(id)
      dispatch(setModel(model))
    } catch (e) {
      dispatch(setError(e.message))
    } finally {
      dispatch(stopFetching())
    }
  }

export default hotelDetailSlice.reducer
