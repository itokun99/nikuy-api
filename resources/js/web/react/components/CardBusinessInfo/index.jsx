import { memo, useEffect } from 'react';
import PropTypes from 'prop-types';
import { Link } from 'react-router-dom';
import { Card, Form, Button } from 'react-bootstrap';
import { provinceSelector } from '../../modules';
import { getProvinces } from '../../services';
import { useSelector, shallowEqual } from 'react-redux';

const CardBusinessInfo = ({ form, errors, onChange, disabled }) => {

  const province = useSelector(provinceSelector, shallowEqual);
  const provinces = province?.data || [];

  useEffect(() => {
    getProvinces()
  }, [])

  return (
    <Card className="card-profile-form p-3 text-white card-dark-bg mb-5">
      <Card.Body>
        <h3 className="mb-4"><strong>Atur Bisnis Anda</strong></h3>
        <Form.Group>
          <Form.Label>Nama Bisnis</Form.Label>
          <Form.Control
            name="name"
            type="text"
            className="input-dark"
            isInvalid={Boolean(errors.name)}
            placeholder="Masukan nama bisnis anda"
            value={form.name}
            onChange={onChange}
            disabled={disabled}
          />
          <Form.Control.Feedback type="invalid">{errors.name}</Form.Control.Feedback>
        </Form.Group>
        <Form.Group>
          <Form.Label>Tahun Berapa Bisnis Anda di Dirikan?</Form.Label>
          <Form.Control
            name="founded"
            type="date"
            className="input-dark"
            isInvalid={Boolean(errors.founded)}
            placeholder="Masukan tanggal didirikan lahir"
            value={form.founded}
            onChange={onChange}
            disabled={disabled}
          />
          <Form.Control.Feedback type="invalid">{errors.founded}</Form.Control.Feedback>
        </Form.Group>
        <Form.Group>
          <Form.Label>Bergerak di Bidang Apa Bisnis Anda?</Form.Label>
          <Form.Control
            name="business_field"
            type="text"
            className="input-dark"
            isInvalid={Boolean(errors.business_field)}
            placeholder="Masukan bidang bisnis anda"
            value={form.business_field}
            onChange={onChange}
            disabled={disabled}
          />
          <Form.Control.Feedback type="invalid">{errors.business_field}</Form.Control.Feedback>
        </Form.Group>
        <Form.Group>
          <Form.Label>Industri</Form.Label>
          <Form.Control
            name="industry"
            type="text"
            className="input-dark"
            isInvalid={Boolean(errors.industry)}
            placeholder="Masukan industri"
            value={form.industry}
            onChange={onChange}
            disabled={disabled}
          />
          <Form.Control.Feedback type="invalid">{errors.industry}</Form.Control.Feedback>
        </Form.Group>
        <Form.Group>
          <Form.Label>Alamat bisnis</Form.Label>
          <Form.Control
            as="textarea"
            rows={5}
            name="address"
            className="input-dark"
            isInvalid={Boolean(errors.address)}
            placeholder="Masukan alamat bisnis anda"
            value={form.address}
            onChange={onChange}
            disabled={disabled}
          />
          <Form.Control.Feedback type="invalid">{errors.address}</Form.Control.Feedback>
        </Form.Group>
        <Form.Group>
          <Form.Label>Provinsi</Form.Label>
          <Form.Control
            as="select"
            name="province"
            custom
            isInvalid={Boolean(errors.province)}
            className="input-dark"
            value={form.province}
            onChange={onChange}
            disabled={disabled}
          >
            <option>Pilih</option>
            {provinces.map(p => (
              <option key={p.id} value={p.id}>{p.name}</option>
            ))}
          </Form.Control>
          <Form.Control.Feedback type="invalid">{errors.province}</Form.Control.Feedback>
        </Form.Group>
        <Form.Group>
          <Form.Label>Email Bisnis</Form.Label>
          <Form.Control
            name="email"
            type="email"
            className="input-dark"
            isInvalid={Boolean(errors.email)}
            placeholder="Masukan email bisnis anda"
            value={form.email}
            onChange={onChange}
            disabled={disabled}
          />
          <Form.Control.Feedback type="invalid">{errors.email}</Form.Control.Feedback>
        </Form.Group>
        <Form.Group>
          <Form.Label>No. Telepon Bisnis</Form.Label>
          <Form.Control
            type="text"
            name="phone"
            value={form.phone}
            className="input-dark"
            isInvalid={Boolean(errors.phone)}
            placeholder="Masukan nomor telepon bisnis anda"
            onChange={onChange}
            maxLength={15}
            disabled={disabled}
          />
          <Form.Control.Feedback type="invalid">{errors.phone}</Form.Control.Feedback>
        </Form.Group>
        <Form.Group>
          <Form.Label>Akun Instagram Bisnis Anda</Form.Label>
          <Form.Control
            type="text"
            name="instagram"
            value={form.instagram}
            className="input-dark"
            isInvalid={Boolean(errors.instagram)}
            placeholder="Masukan akun instagram bisnis anda"
            onChange={onChange}
            disabled={disabled}
          />
          <Form.Control.Feedback type="invalid">{errors.instagram}</Form.Control.Feedback>
        </Form.Group>
        <Form.Group>
          <Form.Label>Page Facebook Bisnis Anda</Form.Label>
          <Form.Control
            type="text"
            name="facebook"
            value={form.facebook}
            className="input-dark"
            isInvalid={Boolean(errors.facebook)}
            placeholder="Masukan halaman facebook bisnis anda"
            onChange={onChange}
            disabled={disabled}
          />
          <Form.Control.Feedback type="invalid">{errors.facebook}</Form.Control.Feedback>
        </Form.Group>
        <Form.Group>
          <Form.Label>Website bisnis anda</Form.Label>
          <Form.Control
            type="text"
            name="website"
            value={form.website}
            className="input-dark mb-5"
            isInvalid={Boolean(errors.website)}
            placeholder="Masukan website bisnis anda"
            onChange={onChange}
            disabled={disabled}
          />
          <Form.Control.Feedback type="invalid">{errors.website}</Form.Control.Feedback>
        </Form.Group>
        <Button disabled={disabled} block size="lg" variant="secondary" type="submit" className="text-white font-weight-bold">SIMPAN DATA BISNIS ANDA</Button>
        <div className="text-center py-3">
          <Link to="/profile/business" className="text-white">Kembali ke daftar Bisnis Anda</Link>
        </div>
      </Card.Body>
    </Card>
  )
}

CardBusinessInfo.propTypes = {
  form: PropTypes.object,
  errors: PropTypes.object,
  onChange: PropTypes.func,
  disabled: PropTypes.bool
};

CardBusinessInfo.defaultProps = {
  form: {},
  errors: {},
  onChange: () => { },
  disabled: false
};

export default memo(CardBusinessInfo);