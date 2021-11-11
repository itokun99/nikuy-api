import { memo, useEffect } from 'react';
import PropTypes from 'prop-types';
import { Modal, Form, Button } from 'react-bootstrap';

const ModalUploadImage = ({
  show,
  name,
  image,
  loading,
  disabled,
  onChange,
  onSubmit,
  onClose,
  errors
}) => {

  const onChangeInput = e => {
    e.preventDefault();
    const reader = new FileReader();
    const file = e.target.files[0];

    reader.onloadend = () => {
      setTimeout(() => {
        if (reader.result) {
          onChange({ image: reader.result, file }, name)
        }
      }, 100);
    };

    if (file) {
      reader.readAsDataURL(file);
    }
  };

  console.log('errors.file', errors.file)

  return (
    <Modal
      show={show}
      onHide={onClose}
      backdrop="static"
      keyboard={false}
    >
      <Modal.Header closeButton>
        <Modal.Title>Upload Image</Modal.Title>
      </Modal.Header>
      <Modal.Body>
        <img src={image || '/assets/img/nofoto.png'} className="w-100 mb-3" alt="" />
        {loading ?
          (<small className="text-muted">Loading...</small>)
          : (
            <>
              <Form.File
                id="custom-file"
                label="Upload"
                custom
                accept=".png,.jpg"
                isInvalid={Boolean(errors.file)}
                onChange={onChangeInput}
              />
              {errors.file && <Form.Text className="text-danger">{errors.file}</Form.Text>}
            </>
          )
        }
      </Modal.Body>
      <Modal.Footer>
        <Button onClick={onSubmit} disabled={disabled} variant="primary">Upload</Button>
      </Modal.Footer>
    </Modal>
  )
}

ModalUploadImage.propTypes = {
  show: PropTypes.bool,
  image: PropTypes.string,
  loading: PropTypes.bool,
  disabled: PropTypes.bool,
  onChange: PropTypes.func,
  name: PropTypes.string,
  onClose: PropTypes.func,
  errors: PropTypes.object,
};

ModalUploadImage.defaultProps = {
  show: false,
  image: '',
  loading: false,
  disabled: false,
  name: '',
  errors: {},
  onChange: () => { },
  onClose: () => { }
};

export default memo(ModalUploadImage);