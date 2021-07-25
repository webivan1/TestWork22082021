import { HotelFormType } from '../../../store/hotels/form/types'
import { Control, Controller, UseControllerProps } from 'react-hook-form'
import { FieldErrors } from 'react-hook-form/dist/types/errors'
import { forwardRef } from 'react'
import { Form } from 'react-bootstrap'

type PropControlFiledTypes = {
  name: keyof HotelFormType
  label: string
  control: Control<HotelFormType>
  rules?: UseControllerProps['rules']
  errors: FieldErrors<HotelFormType>
  type?: 'text' | 'number' | 'email' | 'file'
  as?: 'input' | 'select' | 'textarea'
}

export const ControlField = forwardRef<HTMLInputElement, PropControlFiledTypes>(
  ({ name, label, control, rules, errors, type = 'text', as = 'input' }, ref) => {
    return (
      <Controller
        name={name}
        control={control}
        rules={rules}
        render={({ field: { name, onChange, value } }) => (
          <div className="mb-2">
            <Form.Group>
              <Form.Label>{label}</Form.Label>
              <Form.Control
                as={as}
                type={type}
                name={name}
                onChange={(event) => onChange(event.nativeEvent)}
                defaultValue={value}
                isInvalid={!!errors[name]}
                ref={ref}
                data-testid={`hotel-form-${name}`}
              />
            </Form.Group>
          </div>
        )}
      />
    )
  }
)
