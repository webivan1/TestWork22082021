import { createSlice, PayloadAction } from '@reduxjs/toolkit'
import { HotelRemoveResponseStatus, HotelsPaginationInfoType, HotelsStateType } from './types'
import { AppThunk } from '../../index'
import { fetchHotelsApi, removeHotelApi } from './api'
import { HotelIdType } from '../types'

const initialState: HotelsStateType = {
  error: null,
  loading: false,
  info: {
    total: 0,
    per_page: 0,
    current_page: 1,
    data: [],
  },
}

export const hotelsSlice = createSlice({
  name: 'hotels',
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
    setInfo: (state, { payload }: PayloadAction<HotelsPaginationInfoType>) => {
      state.info = payload
    },
  },
})

export const { startFetching, stopFetching, setError, setInfo } = hotelsSlice.actions

export const fetchHotelsAsync =
  (page: number = 1): AppThunk =>
  async (dispatch) => {
    try {
      dispatch(startFetching())
      const info = await fetchHotelsApi(page)
      dispatch(setInfo(info))
    } catch (e) {
      dispatch(setError(e.message))
    } finally {
      dispatch(stopFetching())
    }
  }

export const removeHotelAsync =
  (id: HotelIdType): AppThunk =>
  async (dispatch) => {
    try {
      dispatch(startFetching())
      const response = await removeHotelApi(id)
      if (response.status === HotelRemoveResponseStatus.error) {
        throw new Error(response.errorMessage)
      } else {
        // update list and reset pagination
        await fetchHotelsAsync()
      }
    } catch (e) {
      dispatch(setError(e.message))
    } finally {
      dispatch(stopFetching())
    }
  }

export default hotelsSlice.reducer
