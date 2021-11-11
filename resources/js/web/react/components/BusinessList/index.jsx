import { memo, useEffect } from 'react';
import CardBusiness from '../CardBusiness';
import { getUserBusiness, deleteBusiness } from '../../services';
import { profileBusinessSelector } from '../../modules';
import { useSelector, shallowEqual } from 'react-redux';
import { Button } from 'react-bootstrap';
import { useHistory } from 'react-router-dom';
import { toast } from 'react-toastify';
import { resolveBackendValidationError } from '../../utils';

const BusinessList = () => {

  const business = useSelector(profileBusinessSelector, shallowEqual);
  const items = business.data || [];
  const loading = business.loading || false;
  const history = useHistory();

  const navigateToAdd = () => {
    history.push('/profile/business/add');
  };

  const navigateToEdit = id => {
    history.push(`/profile/business/${id}`);
  }

  const onDelete = id => {
    deleteBusiness(id)
      .then(() => {
        toast.success("Berhasil menghapus data bisnis");
        return getUserBusiness()
      })
      .catch(err => {
        const resError = resolveBackendValidationError(err);
        return toast.error(resError?.message || "Terjadi kesalahan");
      })
  }

  useEffect(() => {
    getUserBusiness()
  }, []);

  const renderItems = () => {
    if (loading) {
      return (
        <div className="text-white">Sedang memuat</div>
      )
    }

    return (
      <>
        {items.map(item => (
          <CardBusiness
            key={item.id}
            name={item.name}
            industry={item.industry}
            photo={item.photo}
            field={item.business_field}
            founded={item.founded}
            onClick={() => navigateToEdit(item.id)}
            onDelete={() => onDelete(item.id)}
          />
        ))}
      </>
    )
  }

  return (
    <div className="business-list mb-5">
      <div className="business-list__header">
        <h4 className="business-list__title text-white font-weight-bold mb-4">Bisnis Aktif Anda</h4>
      </div>
      <div className="business-list__body mb-4">
        {renderItems()}
      </div>
      <div className="business-list__footer">
        <Button
          type="button"
          variant="secondary"
          block size="lg"
          className="font-weight-bold text-white"
          onClick={navigateToAdd}
        >
          + TAMBAH BISNIS BARU
        </Button>
      </div>
    </div>
  )
}

export default memo(BusinessList);