import { memo, useEffect } from 'react';
import PropTypes from 'prop-types';
import { useParams, useHistory } from 'react-router-dom';
import { useSelector, shallowEqual } from 'react-redux';
import { modalUpgrade } from '../../../controls';
import { profileAccountSelector } from '../../../modules';

const CourseItem = ({ pillar, item }) => {

  const account = useSelector(profileAccountSelector, shallowEqual);

  const history = useHistory();
  const { id, pillarId, courseId } = useParams();
  const active = courseId && courseId == item?.id;
  const isMembership = account?.membership?.id === item?.membership?.id || account?.membership?.order > item?.membership?.order;
  const isCompleted = item?.complete;

  const onClickItem = () => {
    if (isMembership) {
      return history.push(`/course/${id}/${pillarId}/${item?.id}`);
    }

    return modalUpgrade(true);
  }

  const renderIcon = () => {
    if (!isMembership) {
      return <img width={40} height={40} src="/assets/img/Lock.png" className="mr-2 rounded-circle" alt="" />
    }

    if (isCompleted) {
      return <img width={40} height={40} src="/assets/img/img-ok.png" className="mr-2 rounded-circle" alt="" />
    }

    return <div style={{ width: 40, height: 40 }} />
  }

  return (
    <div className={`course-item media mb-3 align-items-center ${active ? 'bg-primary' : ''}`} onClick={onClickItem}>
      {renderIcon()}
      <img width={40} height={40} src="/assets/img/img-play.png" className="mr-3 rounded-circle" alt="" />
      <div className="media-body">
        {pillar?.name && <h6 className="mb-2 text-white"><strong>{pillar.name}</strong></h6>}
        <h6 className="m-0 text-white">{item.name}</h6>
      </div>
    </div>
  )
}

CourseItem.propTypes = {
  item: PropTypes.object,
  pillar: PropTypes.object
};
CourseItem.defaultProps = {
  item: {},
  pillar: {},
};


export default memo(CourseItem);