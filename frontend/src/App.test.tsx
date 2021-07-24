import { App } from './App'
import { renderWithRedux } from './store/render-test-store'

describe('App', () => {
  it('check renders', () => {
    renderWithRedux(<App />)
  })
})
