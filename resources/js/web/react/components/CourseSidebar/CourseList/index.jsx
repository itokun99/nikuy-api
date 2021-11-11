import { memo } from 'react';
import PropTypes from 'prop-types';
import CourseItem from '../CourseItem';

const CourseList = ({ pillar, items }) => {
  return (
    <div className="course-list">
      {items.map(item => {
        return (
          <CourseItem pillar={pillar} item={item} />
        )
      })}
    </div>
  )
}

CourseList.propTypes = {
  items: PropTypes.array,
  pillar: PropTypes.object
};
CourseList.defaultProps = {
  items: [],
  pillar: {}
};


export default memo(CourseList);