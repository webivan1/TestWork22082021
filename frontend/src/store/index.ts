import { configureStore, ThunkAction, Action } from '@reduxjs/toolkit'
import hotels from './hotels/list/hotelsSlice'
import hotelForm from './hotels/form/hotelFormSlice'
import hotelDetail from './hotels/detail/hotelDetailSlice'

export const reducer = {
  hotels,
  hotelForm,
  hotelDetail,
}

// @todo install middleware logger
const store = configureStore({
  reducer,
})

export type RootState = ReturnType<typeof store.getState>
export type AppDispatch = typeof store.dispatch
export type AppThunk<ReturnType = void> = ThunkAction<
  ReturnType,
  RootState,
  unknown,
  Action<string>
>

export default store
