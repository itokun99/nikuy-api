import { memo } from 'react';
import PropTypes from 'prop-types';
import { Card, Button } from 'react-bootstrap';

const CardTransaction = ({
  title,
  price,
  createdAt,
  expiredAt,
  onClick,
  status,
  onContinuePayment
}) => {
  return (
    <Card className="card-transaction card-dark-bg  text-light mb-4">
      <Card.Body className="p-3 p-lg-4">
        <Card.Title className="card-transaction__title">{title}</Card.Title>
        <Card.Text>
          <p>{price}</p>
          <p>Tanggal Transaksi: {createdAt}</p>
          {expiredAt && <p>Tanggal Berakhir: {expiredAt}</p>}
          {status && <p>Status: {status}</p>}
        </Card.Text>
        {status === 'Pending' ? (
          <Button onClick={onContinuePayment} variant="secondary" size="sm">Lanjutkan Pembayaran</Button>
        ) : (
          <Button onClick={onClick} variant="outline-secondary" size="sm" className="mr-2">Lihat</Button>
        )}
      </Card.Body>
    </Card>
  )
}

CardTransaction.propTypes = {
  title: PropTypes.string,
  price: PropTypes.string,
  createdAt: PropTypes.string,
  expiredAt: PropTypes.string,
  onClick: PropTypes.func,
  onContinuePayment: PropTypes.func,
};
CardTransaction.defaultProps = {
  title: '',
  price: '',
  createdAt: '',
  expiredAt: '',
  onClick: () => { },
  onContinuePayment: () => { }
};

export default memo(CardTransaction);