import { useEffect, useState } from 'react';
import { Row, Col, Modal, Button } from 'react-bootstrap';
import { Redirect, useHistory } from 'react-router-dom';
import {
  CardProfilePhoto,
  CardProfileMembership,
  CardProfileForm,
  CardProfilePassword,
  CardTransaction
} from '../../components';
import { BaseContainer, ProfileContainer } from '../../containers';
import { useSelector, shallowEqual } from 'react-redux';
import { profileAccountSelector, transactionSelector } from '../../modules';
import { getTokenFromStorage } from '../../utils';
import { getTransactions } from '../../services';

const menus = [
  { id: 1, title: 'Data Transaksi Anda', path: '/transaction' },
];


const Transaction = () => {
  const token = getTokenFromStorage();
  const history = useHistory();
  const account = useSelector(profileAccountSelector, shallowEqual);
  const transaction = useSelector(transactionSelector, shallowEqual);

  const [modal, setModal] = useState(false);
  const [detail, setDetail] = useState({});

  const items = transaction.data || [];

  const onContinuePayment = item => {
    history.push(`/transaction/${item.id}`);
  }

  const onCloseModal = () => {
    setModal(false);
  }

  const onRead = () => {
    setModal(false);
  }

  const onClickTransaction = item => {
    setModal(true);
    setDetail(item);
  }


  const renderList = () => {
    if (items.length === 0) {
      return <div className="text-light">Tidak ada transaksi</div>
    }

    return (
      <>
        {items.map(item => {
          return (
            <CardTransaction
              title={item.name}
              price={item.nominal_display}
              createdAt={item.created_at}
              expiredAt={item.expired_at}
              status={item.status}
              onClick={() => onClickTransaction(item)}
              onContinuePayment={() => onContinuePayment(item)}
            />
          )
        })}
      </>
    )
  }

  const renderModal = () => {
    return (
      <Modal
        show={modal}
        size="lg"
        onHide={onCloseModal}
        aria-labelledby="contained-modal-title-vcenter"
        centered
        className="modal-transaksi"
      >
        <Modal.Body className="card-dark-bg text-light p-3 p-lg-4">
          <Row className="mb-4">
            <Col sm={12} lg={6}>
              {detail.evidence && (
                <a href={detail.evidence} target="_blank">
                  <img className="w-100" src={detail.evidence} alt={detail.title} />
                </a>
              )}
            </Col>
            <Col sm={12} lg={6}>
              <h5 className="mb-4"><strong>{detail.title}</strong></h5>
              <div className="mb-2">
                <div className="font-weight-bold">Biaya</div>
                <div className="text-secondary">{detail.nominal_display}</div>
              </div>
              <div className="mb-2">
                <div className="font-weight-bold">Nomor Rekening</div>
                <div className="text-secondary">{detail.account_number}</div>
              </div>
              <div className="mb-2">
                <div className="font-weight-bold">Atas Nama</div>
                <div className="text-secondary">{detail.account_owner}</div>
              </div>
              <div className="mb-2">
                <div className="font-weight-bold">Bank</div>
                <div className="text-secondary">{detail.bank}</div>
              </div>
              <div className="mb-2">
                <div className="font-weight-bold">Status</div>
                <div className="text-info">{detail.status}</div>
              </div>
            </Col>
          </Row>
          <Row>
            <Col xs={12}>
              <Button onClick={onRead} variant="outline-secondary" block size="lg" className="font-weight-bold">{`TUTUP & TANDAI SUDAH DIBACA`}</Button>
            </Col>
          </Row>
        </Modal.Body>
      </Modal>
    )
  }

  useEffect(() => {
    getTransactions()
  }, [])


  if (!token) {
    return <Redirect to="/" />
  }

  return (
    <>
      <BaseContainer footer={false}>
        <ProfileContainer menus={menus}>
          <Row>
            <Col sm={12}>
              {renderList()}
            </Col>
          </Row>
        </ProfileContainer>
      </BaseContainer>
      {renderModal()}
    </>
  )
}

export default Transaction;