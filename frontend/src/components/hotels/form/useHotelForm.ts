import { useForm } from 'react-hook-form'
import { HotelFormType } from '../../../store/hotels/form/types'
import { useRef } from 'react'

export const useHotelForm = (initialData: HotelFormType) => {
  const {
    handleSubmit,
    control,
    formState: { errors },
  } = useForm<HotelFormType>({
    defaultValues: {
      ...initialData,
      image: '',
    },
  })

  const imageRef = useRef<HTMLInputElement>(null)

  const createFormData = (submit: (data: FormData) => void) => {
    return (values: HotelFormType) => {
      const form = new FormData()
      form.append('name', values.name)
      form.append('city', values.city)
      form.append('address', values.address)

      if (values.description) {
        form.append('description', values.description)
      }

      if (values.stars) {
        form.append('stars', String(values.stars))
      }

      if (values.latitude) {
        form.append('latitude', String(values.latitude))
      }

      if (values.longitude) {
        form.append('longitude', String(values.longitude))
      }

      if (imageRef.current && imageRef.current.files) {
        const file = imageRef.current.files.item(0)
        if (file) {
          form.append('image', file)
        }
      }

      submit(form)
    }
  }

  return {
    handleSubmit,
    createFormData,
    control,
    errors,
    imageRef,
  }
}
