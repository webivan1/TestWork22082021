import React, { FC, useContext } from 'react'
import { HotelItemType } from '../../../store/hotels/list/types'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faPencilAlt, faTrashAlt } from '@fortawesome/free-solid-svg-icons'
import { Link } from 'react-router-dom'
import { HotelContext } from './hotelContext'

type PropTypes = {
  item: HotelItemType
}

export const HotelItem: FC<PropTypes> = ({ item: { id, city, name } }) => {
  const { onRemove } = useContext(HotelContext)

  return (
    <tr>
      <td>
        <Link to={`/hotel/${id}/view`}>{id}</Link>
      </td>
      <td>{name}</td>
      <td>{city}</td>
      <td>
        <Link className="me-2" to={`/hotel/${id}/edit`}>
          <FontAwesomeIcon className="text-dark" icon={faPencilAlt} />
        </Link>
        <a href="#" className="text-danger" onClick={() => onRemove(id)}>
          <FontAwesomeIcon icon={faTrashAlt} />
        </a>
      </td>
    </tr>
  )
}
