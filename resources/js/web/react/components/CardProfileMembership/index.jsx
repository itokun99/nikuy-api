import { memo } from 'react';
import { Card, Button } from 'react-bootstrap';
import { profileAccountSelector } from '../../modules';
import { useSelector, shallowEqual } from 'react-redux';
import { useHistory } from 'react-router-dom';

const CardProfileMembership = () => {
  const account = useSelector(profileAccountSelector, shallowEqual);
  const data = account?.membership || null
  const history = useHistory();

  const onClickUpgrade = () => {
    history.push('/membership');
  }

  if (!data) return null;

  return (
    <Card className="card-profile-membership mb-5 pt-3 pb-3 text-white mb-5">
      <Card.Body>
        <div className="text-center">
          <span>Status Membership</span>
        </div>
        <div className="text-center">
          <h2><strong>{data.name}</strong></h2>
        </div>
        <div>
          <img className="w-100 mb-5" src={data.image} alt={data.name} />
        </div>
        <Button
          block
          variant="outline-secondary"
          type="button"
          className="font-weight-bold"
          size="lg"
          onClick={onClickUpgrade}
        >
          UPGRADE KELAS
        </Button>
      </Card.Body>
    </Card>
  )
}

export default memo(CardProfileMembership);