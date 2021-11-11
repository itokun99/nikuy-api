import { memo } from 'react';
import PropTypes from 'prop-types';
import { Form, Button, Row, Col, Alert } from 'react-bootstrap';
import { isMobile } from '../../../utils';

const LoginForm = ({
  form,
  errors,
  onSubmit,
  onClickState,
  onCloseAlert,
  onChange,
  alert,
  disabled,
  onClickForgotPassword
}) => {

  const renderForgotPassword = () => {
    if (isMobile()) {
      return "mailto:tessa@te-society.com?subject=Lupa Kata Sandi"
    }
    return "https://mail.google.com/mail/u/0/?fs=1&to=tessa@te-society.com&tf=cm&su=Lupa+Kata+Sandi";
  }

  return (
    <Form onSubmit={onSubmit}>
      <div className="modal-auth__header mb-4 d-none d-lg-block">
        <h2 className="modal-auth__form-title font-weight-bold">SELAMAT DATANG DI <span className="text-secondary">TE SOCIETY</span></h2>
        <small className="text-muted">Masuk ke akun Elites kamu!</small>
      </div>
      {alert.show && (
        <Alert variant={alert.type} onClose={onCloseAlert} dismissible>
          {alert.message}
        </Alert>
      )}
      <Form.Group>
        <Form.Label>Alamat E-mail</Form.Label>
        <Form.Control
          type="email"
          isInvalid={Boolean(errors.email)}
          placeholder="Masukkan alamat email yang terdaftar"
          value={form.email}
          onChange={e => onChange(e.target.value, 'email')}
          disabled={disabled}
        />
        <Form.Control.Feedback type="invalid">{errors.email}</Form.Control.Feedback>
      </Form.Group>
      <Form.Group>
        <Form.Label>Kata Sandi</Form.Label>
        <Form.Control
          value={form.password}
          isInvalid={Boolean(errors.password)}
          type="password"
          placeholder="Masukkan kata sandi yang terdaftar"
          onChange={e => onChange(e.target.value, 'password')}
          disabled={disabled}
        />
        <Form.Control.Feedback type="invalid">{errors.password}</Form.Control.Feedback>
      </Form.Group>
      <Row className="justify-space-between">
        <Col xs={6}>
          <Form.Check id="rememberme" type="checkbox" label="Ingatkan saya" />
        </Col>
        <Col xs={6} className="text-right">
          <a href={renderForgotPassword()} target="_blank">Lupa kata sandi?</a>
        </Col>
      </Row>
      <div className="pb-4"></div>
      <Button type="submit" block size="lg" variant="secondary" className="text-light mb-3 font-weight-bold" disabled={disabled}>Masuk</Button>
      <div className="text-center">
        <small className="text-muted">
          Belum punya akun Elites? <a href="#" onClick={onClickState}>Daftar</a>
        </small>
      </div>
    </Form>
  )
}

LoginForm.propTypes = {
  form: PropTypes.object,
  errors: PropTypes.object,
  onSubmit: PropTypes.func,
  onChange: PropTypes.func,
  onClickState: PropTypes.func,
  alert: PropTypes.object,
  onClickForgotPassword: PropTypes.func
};
LoginForm.defaultProps = {
  form: {},
  errors: {},
  alert: {
    show: false,
    message: ''
  },
  onSubmit: () => { },
  onChange: () => { },
  onClickForgotPassword: () => { },
  onClickState: () => { }
};

export default memo(LoginForm);