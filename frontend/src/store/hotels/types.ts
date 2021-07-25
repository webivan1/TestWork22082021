export type HotelIdType = string | number

export type HotelType = {
  id: HotelIdType
  name: string
  image: string
  city: string
  address: string
  description: string
  stars?: number
  latitude?: number
  longitude?: number
}
