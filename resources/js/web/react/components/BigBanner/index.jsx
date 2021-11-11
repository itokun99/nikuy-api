import PropTypes from 'prop-types';
import Slider from 'react-slick';
import Image from '../Image';

const BigBanner = ({ items }) => {

  const onClickImage = link => {
    if (link) {
      window.open(link, '_blank');
    }
  }

  return (
    <div className="big-banner py-4 mb-5">
      <div className="container container-home">
        <Slider
          dots={true}
          infinite={true}
          speed={500}
          slidesToShow={1}
          slidesToScroll={1}
          arrows={false}
          touchThreshold={30}
        >
          {items.map(item => {
            return (
              <Image
                key={item.id}
                className="big-banner__image"
                source={item.image}
                alt={item.alt}
                backgroundImage
                resizeMode='cover'
                onClick={() => onClickImage(item.link)}
                style={Boolean(item.link) ? { cursor: 'pointer' } : {}}
              />
            )
          })}
        </Slider>
      </div>
    </div>
  )
}

BigBanner.propTypes = {
  items: PropTypes.array,
  loading: PropTypes.bool,
}
BigBanner.defaultProps = {
  items: [],
  loading: false
}

export default BigBanner;