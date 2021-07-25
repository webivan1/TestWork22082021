import { HotelIdType } from '../../../store/hotels/types'
import { createContext } from 'react'

export type HotelContextType = {
  onRemove: (id: HotelIdType) => void
}

export const HotelContext = createContext<HotelContextType>({
  onRemove: () => {},
})
