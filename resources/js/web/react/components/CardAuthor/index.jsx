import { memo } from 'react';

const CardAuthor = ({ name, photo, title }) => {
  return (
    <div className="media mb-3 align-items-center">
      <img width={50} height={50} src={photo} className="mr-3 rounded-circle" alt={name} />
      <div className="media-body">
        <h6 className="m-0 text-white"><strong>{name}</strong></h6>
        <small className="text-white">{title}</small>
      </div>
    </div>
  )
}

export default memo(CardAuthor);