import { memo } from 'react';
import { Modal, Button } from 'react-bootstrap';
import { modalUpgradeSelector } from '../../modules';
import { modalUpgrade } from '../../controls';
import { useSelector, shallowEqual } from 'react-redux';
import { useHistory } from 'react-router-dom';

const ModalMembershipUpgrade = ({ }) => {

  const history = useHistory();
  const modal = useSelector(modalUpgradeSelector, shallowEqual);

  const onHide = () => {
    modalUpgrade(false);
  }

  const onClickUpgrade = () => {
    modalUpgrade(false);
    history.push("/membership");
  }

  return (
    <Modal
      show={modal.show}
      size="lg"
      onHide={onHide}
      aria-labelledby="contained-modal-title-vcenter"
      centered
      className="modal-upgrade"
    >
      <Modal.Body className="p-4 card-dark-bg text-light">
        <div className="text-center">
          <img src="/assets/img/Lock.png" width="25%" />
          <h2>Upgrade Status Membership</h2>
          <p className="text-center">Anda harus Upgrade Status terlebih dahulu...</p>
          <Button onClick={onClickUpgrade} block variant="secondary" size="lg" className="text-white font-weight-bold">
            UPGRADE
          </Button>
        </div>
      </Modal.Body>
    </Modal>
  )
}

export default memo(ModalMembershipUpgrade);