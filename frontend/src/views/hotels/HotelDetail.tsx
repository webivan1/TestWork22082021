import React, { FC } from 'react'
import { Alert, Col, Image, Row } from 'react-bootstrap'
import { Loading } from '../../components/loading/Loading'
import { Stars } from '../../components/stars/Stars'
import { useHotelItem } from './useHotelItem'

export const HotelDetail: FC = () => {
  const { error, loading, model } = useHotelItem()

  if (error) {
    return <Alert variant="danger">{error}</Alert>
  }

  if (loading || !model) {
    return <Loading show />
  }

  return (
    <>
      <h4 className="mb-3">
        {model.name} {model.stars && <Stars stars={model.stars} />}
      </h4>
      <p className="text-muted">
        <b className="text-dark">{model.city}, </b>
        {model.address}
      </p>
      <Row>
        {model.image && (
          <Col xs={12} sm="auto" md="auto" className="mb-2">
            <Image thumbnail width={300} src={model.image} alt={model.name} title={model.name} />
          </Col>
        )}
        <Col>
          <p>{model.description}</p>
        </Col>
      </Row>
    </>
  )
}
