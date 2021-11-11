import { memo } from 'react';
import PropTypes from 'prop-types';
import { Pagination } from 'react-bootstrap';

const ClassPagination = ({ first, last, current, onClick }) => {

  const disablePrev = current <= 1;
  const disabledNext = current >= last;
  const items = Array.from({ length: last }, (_, i) => i + 1);
  const disabledPagination = !items || items.length === 0;

  const onClickItem = page => {
    console.log('Change page')
    onClick(page)
  }


  if (disabledPagination) return null;

  return (
    <Pagination className="class-pagination">
      <Pagination.First disabled={disablePrev} onClick={!disablePrev ? () => onClickItem(first) : null} />
      <Pagination.Prev disabled={disablePrev} onClick={!disablePrev ? () => onClickItem(current - 1) : null} />
      {items.map(page => {
        const activePage = current === page;
        return (
          <Pagination.Item active={activePage} onClick={!activePage ? () => onClickItem(page) : null}>{page}</Pagination.Item>
        )
      })}
      <Pagination.Next disabled={disabledNext} onClick={!disabledNext ? () => onClickItem(current + 1) : null} />
      <Pagination.Last disabled={disabledNext} onClick={!disabledNext ? () => onClickItem(last) : null} />
    </Pagination>
  )
}

ClassPagination.propTypes = {
  first: PropTypes.number,
  last: PropTypes.number,
  current: PropTypes.number,
  onClick: PropTypes.func,
};
ClassPagination.defaultProps = {
  first: 1,
  last: 1,
  current: 1,
  onClick: () => { }
};

export default memo(ClassPagination);