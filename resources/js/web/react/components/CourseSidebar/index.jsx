import { memo } from 'react';
import { Card } from 'react-bootstrap';
import PropTypes from 'prop-types';
import PillarList from './PillarList';

const CourseSidebar = ({ classData }) => {
  const pillars = classData?.pillars || [];

  return (
    <div className="course-sidebar">
      <div className="course-sidebar__header">
        <Card className="card-dark-bg">
          <Card.Body>
            <span className="course-sidebar__title">
              <strong>{classData?.name}</strong>
            </span>
          </Card.Body>
        </Card>
      </div>
      <div className="course-sidebar__body">
        <div className="course-sidebar__subtitle">Konten Kelas</div>
        <PillarList items={pillars} />
      </div>
      <div className="course-sidebar__footer"></div>
    </div>
  )
}

CourseSidebar.propTypes = {
  classData: PropTypes.object
};
CourseSidebar.defaultProps = {
  classData: {}
};

export default memo(CourseSidebar)