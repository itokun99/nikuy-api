import { memo } from 'react';
import PropTypes from 'prop-types';
import { Row, Col, Form, Button, Alert } from 'react-bootstrap';

const RegisterForm = ({
  form,
  errors,
  onSubmit,
  onClickState,
  alert,
  onCloseAlert,
  onChange,
  disabled,
}) => {

  const disabledButton = Object.values(form).some(e => {
    if (typeof e !== 'boolean') {
      if (e !== '') {
        return true;
      }
    }
    return false
  })


  return (
    <Form onSubmit={onSubmit}>
      <div className="modal-auth__header mb-4 d-none d-lg-block">
        <h2 className="modal-auth__form-title font-weight-bold">SELAMAT DATANG DI <span className="text-secondary">TE SOCIETY</span></h2>
        <small className="text-muted">Daftar akun Elites kamu!</small>
      </div>
      {alert.show && (
        <Alert variant={alert.type} onClose={onCloseAlert} dismissible>
          {alert.message}
        </Alert>
      )}
      <Form.Group>
        <Form.Label>Nama Lengkap</Form.Label>
        <Form.Control
          type="text"
          placeholder="Masukkan nama lengkap anda"
          value={form.name}
          disabled={disabled}
          isInvalid={Boolean(errors.name)}
          onChange={e => onChange(e.target.value, 'name')}
        />
        <Form.Control.Feedback type="invalid" >{errors.name}</Form.Control.Feedback>
      </Form.Group>
      <Form.Group>
        <Form.Label>Alamat Lengkap</Form.Label>
        <Form.Control
          as="textarea"
          rows={5}
          placeholder="Tuliskan alamat lengkap anda"
          value={form.address}
          disabled={disabled}
          isInvalid={Boolean(errors.address)}
          onChange={e => onChange(e.target.value, 'address')}
        />
        <Form.Control.Feedback type="invalid" >{errors.address}</Form.Control.Feedback>
      </Form.Group>
      <Form.Group>
        <Form.Label>Tanggal Lahir</Form.Label>
        <Form.Control
          type="date"
          placeholder="hari/bulan/tahun"
          value={form.dob}
          disabled={disabled}
          isInvalid={Boolean(errors.dob)}
          onChange={e => onChange(e.target.value, 'dob')}
        />
        <Form.Control.Feedback type="invalid" >{errors.dob}</Form.Control.Feedback>
      </Form.Group>
      <Form.Group>
        <Form.Label>Jenis Kelamin</Form.Label>
        <Form.Control
          as="select"
          value={form.gender}
          disabled={disabled}
          isInvalid={Boolean(errors.gender)}
          onChange={e => onChange(e.target.value, 'gender')}
        >
          <option>Pilih...</option>
          <option value="Laki-laki">Laki-laki</option>
          <option value="Perempuan">Perempuan</option>
        </Form.Control>
        <Form.Control.Feedback type="invalid" >{errors.gender}</Form.Control.Feedback>
      </Form.Group>
      <Form.Group>
        <Form.Label>Nomor Handphone</Form.Label>
        <Form.Control
          type="text"
          placeholder="Tulis nomor handphone aktif anda"
          value={form.phone}
          disabled={disabled}
          isInvalid={Boolean(errors.phone)}
          onChange={e => onChange(e.target.value, 'phone')}
          maxLength={15}
        />
        {Boolean(errors.phone)
          ? (
            <Form.Control.Feedback type="invalid" >{errors.phone}</Form.Control.Feedback>
          )
          : (
            <Form.Text className="text-muted">
              Diawali +62 atau 0
            </Form.Text>
          )
        }

      </Form.Group>
      <Form.Group>
        <Form.Label>Alamat E-mail</Form.Label>
        <Form.Control
          type="email"
          placeholder="Masukan alamat email"
          value={form.email}
          disabled={disabled}
          isInvalid={Boolean(errors.email)}
          onChange={e => onChange(e.target.value, 'email')}
        />
        <Form.Control.Feedback type="invalid" >{errors.email}</Form.Control.Feedback>
      </Form.Group>
      <Form.Group>
        <Form.Label>Kata Sandi</Form.Label>
        <Form.Control
          type="password"
          placeholder="Silahkan masukan kata sandi anda"
          value={form.password}
          disabled={disabled}
          isInvalid={Boolean(errors.password)}
          onChange={e => onChange(e.target.value, 'password')}
        />
        <Form.Control.Feedback type="invalid" >{errors.password}</Form.Control.Feedback>
      </Form.Group>
      <Form.Group>
        <Form.Label>Konfirmasi Kata Sandi</Form.Label>
        <Form.Control
          type="password"
          placeholder="Tulis ulang kata sandi yang terdaftar"
          value={form.password_confirmation}
          disabled={disabled}
          isInvalid={Boolean(errors.password_confirmation)}
          onChange={e => onChange(e.target.value, 'password_confirmation')}
        />
        <Form.Control.Feedback type="invalid" >{errors.password_confirmation}</Form.Control.Feedback>
      </Form.Group>
      <Row className="justify-space-between">
        <Col xs={12}>
          <Form.Check checked={Boolean(form.agree)} onChange={e => onChange(e.target.checked, 'agree')} id="rememberme" type="checkbox" label={
            (<>
              Saya membaca dan menyetujui <a href="#">{`Syarat & Ketentuan`}</a></>)
          } />
        </Col>
      </Row>
      <div className="pb-4"></div>
      <Button type="submit" block size="lg" variant="secondary" className="text-light font-weight-bold mb-3" disabled={disabledButton && !form.agree || disabled}>Daftar</Button>
      <div className="text-center">
        <small className="text-muted">
          Sudah punya akun Elites? <a href="#" onClick={onClickState}>Login</a>
        </small>
      </div>
    </Form>
  )
}

RegisterForm.propTypes = {
  form: PropTypes.object,
  errors: PropTypes.object,
  onSubmit: PropTypes.func,
  onClickState: PropTypes.func,
  alert: PropTypes.object,
  onChange: PropTypes.func,
};
RegisterForm.defaultProps = {
  form: {},
  errors: {},
  alert: {
    show: false,
    message: ''
  },
  onSubmit: () => { },
  onClickState: () => { },
  onChange: () => { }
};

export default memo(RegisterForm);