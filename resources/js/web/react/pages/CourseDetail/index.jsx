import { useEffect, useState, useCallback } from 'react';
import { useParams, Redirect } from 'react-router-dom';
import { toast } from 'react-toastify';
import { CourseSidebar, CourseContent } from '../../components';
import { BaseContainer } from '../../containers';
import { getClass, getCourse, getPillar, submitProgress } from '../../services';
import { showLoading } from '../../controls';
import { getTokenFromStorage } from '../../utils';
import Plyr from 'plyr';

const initialContentState = {
  title: '',
  image: '',
  description: '',
}

const Course = () => {
  const { id, pillarId, courseId } = useParams();
  const token = getTokenFromStorage();
  const [currentClass, setCurrentClass] = useState(null);
  const [content, setContent] = useState(initialContentState);


  const initClass = useCallback(async () => {
    try {
      let data = null;
      showLoading(true);
      const classData = await getClass(id);
      if (courseId) {
        data = await getCourse(courseId);
        submitProgress(courseId);
      } else if (pillarId) {
        data = await getPillar(pillarId);
      }

      showLoading(false);



      setCurrentClass(classData);


      setTimeout(() => {
        Plyr.setup('video');
      }, 100);

      if (data) {
        return setContent(prev => ({
          ...prev,
          title: data.name,
          image: data.image || "",
          description: data.description
        }))
      }
      return setContent(prev => ({
        ...prev,
        title: classData.name,
        image: classData.image || "",
        description: classData.description
      }))
    } catch (err) {
      showLoading(false);
      return toast.error(err?.message || 'Terjadi kesalahan');
    }
  }, [id, pillarId, courseId])


  useEffect(() => {
    initClass()
  }, [initClass]);

  if (!token) {
    return <Redirect to="/" />
  }

  return (
    <BaseContainer footer={false}>
      <CourseSidebar classData={currentClass} />
      <CourseContent data={content} />
    </BaseContainer >
  )
}

export default Course;