import { memo } from 'react';
import { Card } from 'react-bootstrap';
import PropTypes from 'prop-types';

const CourseContent = ({ data }) => {
  return (
    <div className="course-content">
      <div className="course-content__inner">
        <Card>
          <Card.Header className="course-content__header">
            <Card.Title className="m-0 course-content__title"><strong>{data.title}</strong></Card.Title>
          </Card.Header>
          <Card.Body>
            {data?.image && (
              <img className="w-100 mb-3" src={data?.image} alt="" />
            )}
            <div
              className="course-content__html"
              dangerouslySetInnerHTML={{ __html: data.description }}
            />
          </Card.Body>
        </Card>
      </div>
    </div>
  )
}

CourseContent.propTypes = {
  data: PropTypes.object
};
CourseContent.defaultProps = {
  data: {}
};

export default memo(CourseContent);