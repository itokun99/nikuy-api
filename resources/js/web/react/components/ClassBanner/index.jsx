import { memo } from 'react';
import Image from '../Image';
import CardClass from '../CardClass';
import PropTypes from 'prop-types';
import Slider from 'react-slick';
import { Col } from 'react-bootstrap';
import { useHistory, Link } from 'react-router-dom';
import { profileAccountSelector } from '../../modules';
import { modalAuth, modalUpgrade } from '../../controls';
import { useSelector, shallowEqual } from 'react-redux';

const ClassBanner = ({ items, sectionTitle, classTitle, icon, classData }) => {

  const history = useHistory();
  const account = useSelector(profileAccountSelector, shallowEqual);
  const isAuthenticated = Boolean(account);

  const onClickStartClass = item => {
    if (!isAuthenticated) {
      return modalAuth(true);
    }

    const memberships = classData?.memberships || [];

    if (memberships.includes(account?.membership?.id) && (account?.membership?.id === item?.membership?.id || account?.membership?.order > item?.membership?.order)) {
      return history.push(`/course/${classData?.id}/${item?.pillar}/${item?.id}`);
    }

    modalUpgrade(true);
  }


  return (
    <div className="container class-banner">
      <div className="class-banner__header mb-3">
        <div className="row">
          <div className="col-12">
            <h2 className="class-banner__title text-light">{sectionTitle}</h2>
          </div>
        </div>
      </div>
      <div className="class-banner__body p-0 p-md-4 rounded">
        <div className="row">
          <div className="d-none d-lg-block col-12 col-lg-3">
            <Image width={100} source={icon} alt={sectionTitle} className="mb-3" />
            <h3 className='headline-heavy title-class title-class text-white mb-4'>
              {classTitle}
            </h3>
            <Link to='/course' className='body-light title-link text-white'>{`Lihat Semua >`}</Link>
          </div>

          <div className="p-0 p-md-2 col-12 col-lg-9">
            <Slider
              dots={true}
              infinite={false}
              speed={500}
              slidesToShow={3}
              slidesToScroll={1}
              dots={false}
              responsive={[
                {
                  breakpoint: 767,
                  settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    arrows: false
                  }
                }
              ]}
            >
              {items.map(item => {
                return (
                  <Col key={item.id}>
                    <CardClass
                      image={item.image}
                      title={item.name}
                      onClick={() => onClickStartClass(item)}
                    />
                  </Col>
                )
              })}
            </Slider>
          </div>
        </div>
      </div>
    </div>
  )
}


ClassBanner.propTypes = {
  items: PropTypes.array,
  sectionTitle: PropTypes.string,
  classTitle: PropTypes.string,
  icon: PropTypes.string,
};
ClassBanner.defaultProps = {
  items: [],
  sectionTitle: '',
  classTitle: '',
  icon: ''
};


export default memo(ClassBanner);