import { useEffect } from 'react';
import { BigBanner, CardClassBig, ClassPagination } from '../../components';
import { BaseContainer } from '../../containers';
import { Container } from 'react-bootstrap';
import { homeBannerSelector, classesSelector, profileAccountSelector } from '../../modules';
import { getHomeBanners, getClasses } from '../../services';
import { useSelector, shallowEqual } from 'react-redux';
import { Redirect, useHistory } from 'react-router-dom';
import { getTokenFromStorage } from '../../utils';
import { modalUpgrade } from '../../controls';
import Plyr from 'plyr';

const Course = () => {
  const token = getTokenFromStorage();
  const history = useHistory();
  const account = useSelector(profileAccountSelector, shallowEqual);
  const banner = useSelector(homeBannerSelector, shallowEqual);
  const classList = useSelector(classesSelector, shallowEqual);
  const banners = banner?.data || [];
  const classes = classList?.data || [];
  const classPagination = classList?.meta;

  const onClickStartClass = item => {

    const memberships = item?.memberships || [];

    if (memberships.includes(account?.membership?.id)) {
      return history.push(`/course/${item?.id}`);
    }
    modalUpgrade(true);
  }

  const onClickPagination = page => {
    getClasses({
      params: { page }
    }).then(() => {
      setTimeout(() => {
        Plyr.setup('video');
      }, 100)
    })
  }

  useEffect(() => {
    getHomeBanners();
    getClasses().then(() => {
      setTimeout(() => {
        Plyr.setup('video');
      }, 100)
    });
  }, [])

  if (!token) {
    return <Redirect to="/" />
  }

  return (
    <BaseContainer>
      <BigBanner items={banners} />
      <Container>
        <h2 className="mb-5 text-light font-weight-bold">{account?.membership?.name}</h2>
        {classes.map(item => {
          return (
            <CardClassBig
              key={item.id}
              title={item.name}
              count={item.total_course}
              image={item.image}
              message={item.message}
              description={item.description}
              onClick={() => onClickStartClass(item)}
            />
          )
        })}

        {classPagination && (
          <ClassPagination
            last={classPagination?.last_page}
            current={classPagination?.current_page}
            onClick={onClickPagination}
          />
        )}
      </Container>
    </BaseContainer >
  )
}

export default Course;