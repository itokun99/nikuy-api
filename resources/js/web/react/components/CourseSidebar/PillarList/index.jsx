import { memo } from 'react';
import PropTypes from 'prop-types';
import PillarItem from '../PillarItem';

const PillarList = ({ items }) => {
  return (
    <div className="pillar-list">
      {items.map((item, index) => {
        return (
          <PillarItem key={index} item={item} />
        )
      })}
    </div>
  )
}


PillarList.propTypes = {
  items: PropTypes.array
}
PillarList.defaultProps = {
  items: []
}

export default memo(PillarList);