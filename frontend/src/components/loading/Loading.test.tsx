import { render, screen } from '@testing-library/react'
import { Loading } from './Loading'

describe('Loading', () => {
  it('shown in the document', async () => {
    render(<Loading show />)
    const el = await screen.findByTestId('loading')
    expect(el).toBeInTheDocument()
  })

  it('hidden in the document', async () => {
    render(<Loading />)
    const el = await screen.queryByTestId('loading')
    expect(el).not.toBeInTheDocument()
  })
})
