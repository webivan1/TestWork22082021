import { HotelForm } from './HotelForm'
import { HotelFormType } from '../../../store/hotels/form/types'

const initialValue: HotelFormType = {
  name: 'Test Name',
  city: 'Test City',
  address: 'Test Address',
  image: '',
  description: '',
}

const fields = [
  'name',
  'address',
  'city',
  'image',
  'description',
  'image',
  'stars',
  'latitude',
  'longitude',
]

describe('HotelForm', () => {
  it('render fields', async () => {
    // as soon as possible
  })
})
