import { render, screen, fireEvent, act } from '@testing-library/react'
import { Pagination } from './Pagination'

describe('Pagination', () => {
  const onChangePage = jest.fn()

  const renderPagination = (
    currentPage: number = 1,
    onChange: (page: number) => void = onChangePage
  ) => {
    render(<Pagination total={100} limit={10} currentPage={currentPage} onChangePage={onChange} />)
  }

  it('render pagination and active first link', async () => {
    renderPagination()
    const firstLink = await screen.findByText('1')
    expect(firstLink).toBeInTheDocument()
    expect(firstLink.classList.contains('active')).toBeTruthy()
  })

  it('show another active link', async () => {
    renderPagination(3)
    const activeLink = await screen.findByText('3')
    expect(activeLink).toBeInTheDocument()
    expect(activeLink.classList.contains('active')).toBeTruthy()
  })

  it('check event onChangePage', async () => {
    renderPagination(1)

    await act(async () => {
      const link = await screen.findByText('2')
      fireEvent.click(link)
    })

    expect(onChangePage).toHaveBeenCalled()
  })
})
