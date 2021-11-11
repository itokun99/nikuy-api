import { memo, useState, useEffect } from 'react';
import PropTypes from 'prop-types';
import { useParams, useHistory } from 'react-router-dom';
import CourseList from '../CourseList';

const PillarItem = ({ key, item }) => {
  const history = useHistory();
  const { id, pillarId } = useParams();

  const [dropdown, setDropdown] = useState(false);

  const onClickItem = () => {
    setDropdown(!dropdown);
    history.push(`/course/${id}/${item?.id}`);
  }

  useEffect(() => {
    if (pillarId && pillarId == item?.id) {
      setDropdown(true);
    }
  }, [pillarId, item?.id])

  return (
    <>
      <div tabIndex={key} className="pillar-item" onClick={onClickItem}>
        <span>{item.name}</span>
        <span className="pillar-item__icon">
          {dropdown
            ? <img src="/assets/img/img-arrow-up.png" alt="" />
            : <img src="/assets/img/img-arrow-down.png" alt="" />
          }
        </span>
      </div>
      {dropdown && (
        <CourseList pillar={item} items={item.courses} />
      )}
    </>
  )
}

PillarItem.propTypes = {
  key: PropTypes.number,
  item: PropTypes.object
};
PillarItem.defaultProps = {
  key: 1,
  item: {}
};

export default memo(PillarItem);