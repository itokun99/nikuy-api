import { memo } from 'react';
import PropTypes from 'prop-types';
import Image from '../Image';
import { Card, Button, Form } from 'react-bootstrap';

const numberEmployes = [
  "kurang dari 50 Orang",
  "50 - 100 Orang",
  "100 - 500 Orang",
  "500 - 1000 Orang",
  "lebih dari 1000 Orang"
];

const turnovers = [
  "kurang dari IDR 10 juta",
  "IDR 10 juta - IDR 50 juta",
  "IDR 50 juta - IDR 100 juta",
  "IDR 100 juta - IDR 250 juta",
  "IDR 250 juta - IDR 500 juta",
  "lebih dari IDR 500 juta"
];

const CardBusinessPhoto = ({
  form,
  errors,
  onChange,
  disabled
}) => {

  const onChangeInput = e => {
    e?.preventDefault();
    const reader = new FileReader();
    const file = e.target.files[0];

    reader.onloadend = () => {
      setTimeout(() => {
        if (reader.result) {
          onChange(e, { image: reader.result, file })
        }
      }, 100);
    };

    if (file) {
      reader.readAsDataURL(file);
    }
  };

  return (
    <>
      <Card className="card-profile-photo mb-5 text-white">
        <Card.Body>
          <div className="card-profile-photo__holder">
            <Image backgroundImage source={form?.photo} className="card-profile-photo__image" resizeMode="cover">
              <div className="card-profile-photo__image-action">
                <Form.File
                  id="custom-file"
                  custom
                  accept=".png,.jpg"
                  isInvalid={Boolean(errors.file)}
                  disabled={disabled}
                  onChange={onChangeInput}
                  name="file"
                  className="card-profile-photo__image-input"
                />
                <Image className="card-profile-photo__image-icon" source="/assets/img/ic-camera.png" />
              </div>
            </Image>
          </div>
          <div className="card-profile-photo__text text-center mb-3 text-white font-weight-bold mb-5">
            {form?.name}
          </div>
          <Form.Group>
            <Form.Label>Deskripsi Singkat Bisnis Anda</Form.Label>
            <Form.Control
              as="textarea"
              rows={5}
              name="description"
              className="input-dark"
              isInvalid={Boolean(errors.description)}
              placeholder="Masukan deskripsi bisnis anda"
              value={form.description}
              onChange={onChange}
              disabled={disabled}
            />
            <Form.Control.Feedback type="invalid">{errors.description}</Form.Control.Feedback>
          </Form.Group>
          <Form.Group>
            <Form.Label>Jumlah Karyawan</Form.Label>
            <Form.Control
              custom
              as="select"
              name="number_of_employees"
              value={form.number_of_employees}
              className="input-dark"
              isInvalid={Boolean(errors.number_of_employees)}
              onChange={onChange}
              disabled={disabled}
            >
              <option>Pilih</option>
              {numberEmployes.map((val, index) => {
                return (
                  <option key={index} value={val}>{val}</option>
                )
              })}
            </Form.Control>
            <Form.Control.Feedback type="invalid">{errors.number_of_employees}</Form.Control.Feedback>
          </Form.Group>
          <Form.Group>
            <Form.Label>Omset per bulan</Form.Label>
            <Form.Control
              custom
              as="select"
              name="turnover"
              value={form.turnover}
              className="input-dark"
              isInvalid={Boolean(errors.turnover)}
              onChange={onChange}
              disabled={disabled}
            >
              <option>Pilih</option>
              {turnovers.map((val, index) => {
                return (
                  <option key={index} value={val}>{val}</option>
                )
              })}
            </Form.Control>
            <Form.Control.Feedback type="invalid">{errors.turnover}</Form.Control.Feedback>
          </Form.Group>
        </Card.Body>
      </Card>
    </>
  )
}

CardBusinessPhoto.propTypes = {
  form: PropTypes.object,
  errors: PropTypes.object,
  onChange: PropTypes.func,
  disabled: PropTypes.bool
};
CardBusinessPhoto.defaultProps = {
  form: {},
  errors: {},
  isEdit: false,
  onChange: () => { },
};

export default memo(CardBusinessPhoto);