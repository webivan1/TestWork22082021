import { FC, ReactElement } from 'react'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faStar } from '@fortawesome/free-solid-svg-icons'
import { SizeProp } from '@fortawesome/fontawesome-svg-core'

type PropTypes = {
  limit?: number
  stars: number
  size?: SizeProp
}

export const Stars: FC<PropTypes> = ({ limit = 5, stars, size = 'sm' }) => {
  let content: ReactElement[] = []

  for (let i = 1; i <= limit; i++) {
    if (i <= stars) {
      content.push(
        <FontAwesomeIcon
          key={i}
          data-testid="star-active"
          size={size}
          className="text-warning me-1"
          icon={faStar}
        />
      )
    } else {
      content.push(
        <FontAwesomeIcon
          key={i}
          data-testid="star"
          size={size}
          className="text-muted me-1"
          icon={faStar}
        />
      )
    }
  }

  return <div className="align-items-center d-inline-flex">{content}</div>
}
