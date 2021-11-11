import { memo, useState } from 'react';
import Image from '../Image';
import ModalUploadImage from '../ModalUploadImage';
import { Card, Button } from 'react-bootstrap';
import { profileAccountSelector } from '../../modules';
import { getProfile, uploadPhoto, deletePhoto } from '../../services';
import { useSelector, shallowEqual } from 'react-redux';
import { toast } from 'react-toastify';

const formState = {
  photo: '',
  file: null
}

const errorState = {
  photo: '',
  file: ''
}

const CardProfilePhoto = () => {

  const account = useSelector(profileAccountSelector, shallowEqual);

  const [showModal, setModal] = useState(false);
  const [form, setForm] = useState(formState);
  const [errors, setError] = useState(errorState);
  const [loading, setLoading] = useState(false);

  const onCloseModal = () => {
    setModal(false);
    setForm(formState);
  }

  const onChange = ({ image, file }) => {
    setForm(v => ({
      ...v,
      photo: image,
      file
    }));
  }

  const onClickDelete = async () => {

    try {
      setLoading(true);
      await deletePhoto();
      await getProfile();
      setLoading(false);
      return toast.success('Berhasil menghapus foto');
    } catch (err) {
      console.log('err', err);
      setLoading(false);
      return toast.error(err?.message || 'Terjadi kesalahan');
    }

  }

  const validate = () => {
    const err = { ...errors };

    if (!form.file) {
      err.file = 'Harap pilih file gambar terlebih dahulu'
    }

    setError(err);
    const invalid = Object.values(err).some(e => e !== '')
    return !invalid;
  }

  const onUpload = async () => {
    try {
      if (!validate()) {
        return
      }

      setLoading(true);
      await uploadPhoto(form.file);
      await getProfile();
      setLoading(false);
      onCloseModal();
      return toast.success("Berhasil mengubah photo");
    } catch (err) {
      toast.err(err?.message || 'Terjadi Kesalahan');
      console.log(err);
      setLoading(false)
    }
  }

  return (
    <>
      <Card className="card-profile-photo mb-5">
        <Card.Body>
          <div className="card-profile-photo__holder">
            <Image backgroundImage source={account?.photo} className="card-profile-photo__image" resizeMode="cover">
              <div onClick={() => setModal(true)} className="card-profile-photo__image-action">
                <Image className="card-profile-photo__image-icon" source="/assets/img/ic-camera.png" />
              </div>
            </Image>
          </div>
          {account?.photo && (
            <div className="card-profile-photo__delete text-center mb-3">
              <Button className="text-decoration-line" variant="link" onClick={onClickDelete}>
                Hapus Foto
              </Button>
            </div>
          )}
          <div className="card-profile-photo__text text-center mb-3 text-white font-weight-bold">
            {account?.name}
          </div>
          <div className="card-profile-photo__text text-center mb-3 text-white font-weight-bold">
            ID: {account?.id}
          </div>
        </Card.Body>
      </Card>
      <ModalUploadImage
        show={showModal}
        image={form.photo}
        errors={errors}
        onChange={onChange}
        onSubmit={onUpload}
        onClose={onCloseModal}
        disabled={!form.photo || loading}
      />
    </>
  )
}

export default memo(CardProfilePhoto);