import { FC } from 'react'
import { HotelFormType } from '../../../store/hotels/form/types'
import { Button, Form, Row, Col, Image } from 'react-bootstrap'
import { ControlField } from './ControlField'
import { useHotelForm } from './useHotelForm'

type PropTypes = {
  initialData?: HotelFormType
  onSubmit: (data: FormData) => void
  buttonText: string
  disabled?: boolean
}

export const HotelForm: FC<PropTypes> = ({
  initialData = {
    name: '',
    image: '',
    city: '',
    address: '',
    description: '',
  },
  onSubmit,
  buttonText,
  disabled = false,
}) => {
  const { handleSubmit, control, errors, imageRef, createFormData } = useHotelForm(initialData)

  return (
    <Form noValidate onSubmit={handleSubmit(createFormData(onSubmit))}>
      <ControlField
        name="name"
        label="Name"
        control={control}
        rules={{ required: true, maxLength: 50 }}
        errors={errors}
      />

      <Row>
        <Col md={3}>
          <ControlField
            name="city"
            label="City"
            control={control}
            rules={{ required: true, maxLength: 50 }}
            errors={errors}
          />
        </Col>
        <Col>
          <ControlField
            name="address"
            label="Address"
            control={control}
            rules={{ required: true, maxLength: 200 }}
            errors={errors}
          />
        </Col>
      </Row>

      {initialData.image && (
        <div className="my-2">
          <Image src={initialData.image} thumbnail width={200} />
        </div>
      )}

      <ControlField
        name="image"
        label="Image"
        control={control}
        rules={{ required: !initialData.image }}
        errors={errors}
        type="file"
        ref={imageRef}
      />

      <ControlField
        name="description"
        label="Description"
        control={control}
        errors={errors}
        as="textarea"
      />

      <ControlField
        name="stars"
        label="Stars"
        control={control}
        rules={{ min: 1, max: 5, pattern: /^\d+$/ }}
        errors={errors}
        type="number"
      />

      <Row>
        <Col>
          <ControlField
            name="latitude"
            label="Latitude"
            control={control}
            errors={errors}
            type="number"
          />
        </Col>
        <Col>
          <ControlField
            name="longitude"
            label="Longitude"
            control={control}
            errors={errors}
            type="number"
          />
        </Col>
      </Row>

      <div className="d-flex justify-content-end mt-3">
        <Button disabled={disabled} type="submit">
          {buttonText}
        </Button>
      </div>
    </Form>
  )
}
