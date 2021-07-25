import { FC, useMemo } from 'react'
import ReactPaginate from 'react-js-pagination'

type PropTypes = {
  total: number
  limit: number
  currentPage: number
  onChangePage: (page: number) => void
  disabled?: boolean
}

export const Pagination: FC<PropTypes> = ({
  total,
  limit,
  currentPage,
  onChangePage,
  disabled = false,
}) => {
  const totalPages = useMemo(() => Math.ceil(total / limit), [total, limit])

  if (totalPages <= 1 || !total) {
    return null
  }

  return (
    <ReactPaginate
      activePage={currentPage}
      itemsCountPerPage={limit}
      totalItemsCount={total}
      pageRangeDisplayed={5}
      onChange={(e) => (disabled ? null : onChangePage(e))}
      innerClass="pagination pg-blue"
      itemClass="page-item"
      linkClass="page-link"
      activeClass="active"
      activeLinkClass="active"
    />
  )
}
