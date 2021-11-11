import { memo, useEffect } from 'react';
import { Row, Col } from 'react-bootstrap';
import { getMembershipList, createTransaction } from '../../services';
import CardMembership from '../CardMembership';
import { membershipSelector, profileAccountSelector } from '../../modules';
import { showLoading } from '../../controls';
import { useSelector, shallowEqual } from 'react-redux';
import { useHistory } from 'react-router-dom';
import { toast } from 'react-toastify';

const MembershipList = () => {
  const history = useHistory();
  const account = useSelector(profileAccountSelector, shallowEqual);
  const membership = useSelector(membershipSelector, shallowEqual);
  const items = membership.data || [];

  const upgrade = item => {
    const conf = window.confirm(`Konfirmasi upgrade membership ${item.name}, lanjutkan?`)
    if (conf) {
      showLoading(true);
      createTransaction({
        name: `Upgrade membership ke ${item.name}`,
        membership: item.id
      }).then(data => {
        toast.success("Transaksi telah dibuat, selanjutnya mohon selesaikan pembayaran");
        showLoading(false);
        history.push(`/transaction/${data.id}`);
      }).catch(err => {
        showLoading(false);
        toast.error(err?.message);
      })
    }
  }

  useEffect(() => {
    getMembershipList();
  }, [])

  return (
    <div className="membership-list">
      <Row>
        {items.map(item => {
          const currentMembership = item.id === account.membership?.id || false;
          const disabled = item.order < account.membership?.order || false;
          return (
            <Col key={item.id} xs={12} sm={6} lg={4} className="mb-4">
              <CardMembership
                name={item.name}
                description={item.description}
                price={item.price_display?.original}
                image={item.image}
                current={currentMembership}
                disabled={disabled}
                onClick={() => upgrade(item)}
              />
            </Col>
          )
        })}
      </Row>
    </div>
  )
}

export default memo(MembershipList);