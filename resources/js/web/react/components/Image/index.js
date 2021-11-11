import { memo } from 'react';
import PropTypes from 'prop-types';

const Image = ({
  source,
  backgroundImage,
  children,
  style,
  className,
  title,
  resizeMode,
  alt,
  onClick,
  width,
  height
}) => {
  if (backgroundImage) {
    return (
      <div
        className={className}
        style={{
          backgroundImage: `url(${source})`,
          ...(resizeMode && { backgroundSize: resizeMode }),
          ...(width && { width }),
          ...(height && { height }),
          ...style
        }}
        alt={alt}
        title={title}
        onClick={onClick}
      >
        {children}
      </div>
    );
  }

  return (
    <img
      src={source}
      className={className}
      style={style}
      alt={alt}
      title={title}
      width={width}
      height={height}
      onClick={onClick}
    />
  );
}

Image.propTypes = {
  source: PropTypes.any,
  children: PropTypes.any,
  backgroundImage: PropTypes.bool,
  style: PropTypes.object,
  className: PropTypes.string,
  title: PropTypes.string,
  alt: PropTypes.string,
  resizeMode: PropTypes.string,
  onClick: PropTypes.func,
  height: PropTypes.number,
  width: PropTypes.number,
};

Image.defaultProps = {
  title: '',
  alt: '',
  source: null,
  backgroundImage: false,
  resizeMode: 'contain',
  width: null,
  height: null,
  onClick: () => {}
};

export default memo(Image);