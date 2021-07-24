import { render, screen } from '@testing-library/react'
import { BrowserRouter as Router } from 'react-router-dom'
import { AppNav } from './AppNav'

describe('AppNav', () => {
  const menu = [
    { label: 'Test', link: '/test' },
    { label: 'Another link', link: '/another-link' },
  ]

  beforeEach(() => {
    render(
      <Router>
        <AppNav menu={menu} />
      </Router>
    )
  })

  it('should contain brand name', async () => {
    const brand = await screen.findByText('Hotels')
    expect(brand).toBeInTheDocument()
  })

  it('should render menu', () => {
    menu.forEach(async ({ label, link }) => {
      const item = await screen.findByText(label)
      expect(item).toBeInTheDocument()
      expect(item.getAttribute('href')).toEqual(link)
    })
  })
})
