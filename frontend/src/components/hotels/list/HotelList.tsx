import React, { FC } from 'react'
import { HotelItemType } from '../../../store/hotels/list/types'
import { Card, Table } from 'react-bootstrap'
import { HotelItem } from './HotelItem'

type PropTypes = {
  models: HotelItemType[]
}

export const HotelList: FC<PropTypes> = ({ models }) => {
  return (
    <Card className="shadow-sm mb-3">
      <Table className="mb-0">
        <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>City</th>
            <th />
          </tr>
        </thead>
        <tbody>
          {models.map((item) => (
            <HotelItem key={item.id} item={item} />
          ))}
        </tbody>
      </Table>
    </Card>
  )
}
