import { memo } from 'react';

const CardAuthor = ({ name, photo, title }) => {
  return (
    <div className="media">
      <img width={50} height={50} src={photo} className="mr-3 rounded-circle" alt={name} />
      <div className="media-body">
        <h6 className="mt-0">{name}</h6>
        <small>{title}</small>
      </div>
    </div>
  )
}

export default memo(CardAuthor);