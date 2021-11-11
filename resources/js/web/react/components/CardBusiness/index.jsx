import { memo } from 'react';
import Image from '../Image';
import { Card, Button } from 'react-bootstrap';
import PropTypes from 'prop-types';

const CardBusiness = ({
  name,
  photo,
  founded,
  field,
  industry,
  onClick,
  onDelete
}) => {
  const year = founded ? new Date(founded).getFullYear() : '';

  return (
    <Card className="card-dark-bg mb-5 w-100 text-white">
      <Card.Body className="p-3 p-lg-5">
        <div className="media">
          <Image style={{ backgroundPosition: 'center' }} backgroundImage width={150} height={150} source={photo} className="align-self-center mr-4 rounded-circle" resizeMode="cover" />
          <div className="media-body">
            <h5 className="mt-0">{name}</h5>
            {year && (<p>Didirikan tahun {year}</p>)}
            {field && <p>Bergerak di bidang {field}</p>}
            {industry && <p>Industri {industry}</p>}
            <div className="pb-3">
              <Button
                type="button"
                onClick={onClick}
                variant="outline-secondary"
                size="sm"
                className="mr-2"
              >
                Lihat
              </Button>
              <Button
                type="button"
                onClick={onDelete}
                variant="outline-danger"
                size="sm"
              >
                Hapus
              </Button>
            </div>
          </div>
        </div>
      </Card.Body>
    </Card>
  )
}

CardBusiness.propTypes = {
  name: PropTypes.string,
  photo: PropTypes.string,
  founded: PropTypes.string,
  field: PropTypes.string,
  industry: PropTypes.string,
  onClick: PropTypes.func,
  onDelete: PropTypes.func
};
CardBusiness.defaultProps = {
  name: '',
  photo: '',
  founded: '',
  field: '',
  industry: '',
  onClick: () => { },
  onDelete: () => { }
};

export default memo(CardBusiness);