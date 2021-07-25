import { render, screen } from '@testing-library/react'
import { Stars } from './Stars'

describe('Stars', () => {
  const renderStars = (limit: number, stars: number) => {
    render(<Stars stars={stars} limit={limit} />)
  }

  ;[
    [10, 2],
    [4, 1],
    [5, 5],
  ].forEach(([limit, stars]) => {
    it(`Check stars, limit: ${limit}, stars: ${stars}`, async () => {
      renderStars(limit, stars)

      const active = await screen.queryAllByTestId('star-active')
      const noActive = await screen.queryAllByTestId('star')

      expect(active.length).toBe(stars)
      expect(active.length + noActive.length).toBe(limit)
    })
  })
})
