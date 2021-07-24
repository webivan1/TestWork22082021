import store, { reducer, RootState } from './index'
import { ReactElement } from 'react'
import { render } from '@testing-library/react'
import { Provider } from 'react-redux'
import { configureStore } from '@reduxjs/toolkit'

export type MockRootStateType = {
  [K in keyof RootState]?: RootState[K]
}

export type ReduxRenderType = {
  initialState: MockRootStateType
} & {
  [K in string]?: any
}

const testState: MockRootStateType = { ...store.getState() }

export function renderWithRedux(
  component: ReactElement,
  { initialState, ...otherOptions }: ReduxRenderType = { initialState: { ...testState } }
) {
  const newStore = configureStore({
    reducer,
    preloadedState: { ...testState, ...initialState },
  })

  return render(<Provider store={newStore}>{component}</Provider>, {
    ...otherOptions,
  })
}

export default testState
