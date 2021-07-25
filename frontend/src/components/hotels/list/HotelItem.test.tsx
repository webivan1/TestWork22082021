import { HotelItem } from './HotelItem'
import { render, screen } from '@testing-library/react'
import { BrowserRouter as Router } from 'react-router-dom'
import { HotelItemType } from '../../../store/hotels/list/types'

describe('HotelItem', () => {
  it('check render props', async () => {
    const item: HotelItemType = {
      id: 'IdType',
      name: 'TestName',
      city: 'TestCity',
    }

    render(
      <Router>
        <HotelItem item={item} />
      </Router>
    )

    const [id, name, city] = await Promise.all([
      screen.findByText(item.id),
      screen.findByText(item.name),
      screen.findByText(item.city),
    ])

    expect(id).toBeInTheDocument()
    expect(name).toBeInTheDocument()
    expect(city).toBeInTheDocument()
  })
})
