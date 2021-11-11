
import { memo, useState, useEffect } from 'react';
import { useSelector, shallowEqual } from 'react-redux';
import { Modal, Row, Col } from 'react-bootstrap';
import { modalAuthSelector } from '../../modules';
import { login, register, getProfile } from '../../services';
import { modalAuth } from '../../controls';
import { useForm, validator, resolveBackendValidationError, isMobile } from '../../utils';
import LoginForm from './LoginForm';
import RegisterForm from './RegisterForm';
import { toast } from 'react-toastify';

const formLoginState = {
  email: '',
  password: '',
  agree: false
};

const errorLoginState = {
  email: '',
  password: '',
}

const formRegisterState = {
  name: '',
  address: '',
  dob: '',
  gender: '',
  phone: '',
  email: '',
  password: '',
  password_confirmation: '',
  agree: false
}

const errorRegisterState = {
  name: '',
  address: '',
  dob: '',
  gender: '',
  phone: '',
  email: '',
  password: '',
  password_confirmation: '',
}

const alertState = {
  show: false,
  message: '',
  type: ''
}

const ModalAuth = () => {

  const modal = useSelector(modalAuthSelector, shallowEqual);

  const [alert, setAlert] = useState(alertState);
  const [loading, setLoading] = useState(false);
  const [formLogin, setFormLogin] = useForm(formLoginState);
  const [formRegister, setFormRegister] = useForm(formRegisterState);
  const [errorLogin, setErrorLogin] = useState(errorLoginState);
  const [errorRegister, setErrorRegister] = useState(errorRegisterState);

  const onHide = () => {
    modalAuth(false);
  }

  const onChangeInputFormLogin = (value, field) => {
    setFormLogin(value, field);

    if (errorLogin[field] !== "") {
      setErrorLogin(prev => ({
        ...prev,
        [field]: ""
      }));
    }
  }

  const onChangeInputFormRegister = (value, field) => {

    if (field === 'phone') {
      if (!validator.isTypingPhoneNumberOnly(value)) {
        return
      }
    }

    setFormRegister(value, field);

    if (errorRegister[field] !== "") {
      setErrorRegister(prev => ({
        ...prev,
        [field]: ""
      }));
    }
  }

  const validateLogin = () => {
    const errors = { ...errorLogin };
    const form = { ...formLogin };

    if (validator.isEmpty(form.email)) {
      errors.email = 'Mohon isi email anda!';
    } else if (!validator.isEmail(form.email)) {
      errors.email = 'Format email tidak valid!';
    }

    if (validator.isEmpty(form.password)) {
      errors.password = 'Mohon isi kata sandi anda!';
    }

    setErrorLogin(errors);

    const invalid = Object.values(errors).some(e => e !== '')

    return !invalid;

  }

  const validateRegister = () => {
    const errors = { ...errorRegister };
    const form = { ...formRegister };

    if (validator.isEmpty(form.name)) {
      errors.name = 'Mohon isi nama lengkap anda'
    } else if (!validator.min(form.name, 2)) {
      errors.name = 'Nama Lengkap minimal berisi 2 huruf'
    }

    if (validator.isEmpty(form.address)) {
      errors.address = 'Mohon isi alamat lengkap anda'
    }

    if (validator.isEmpty(form.dob)) {
      errors.dob = 'Mohon isi tanggal lahir anda'
    }

    if (validator.isEmpty(form.gender)) {
      errors.gender = 'Mohon pilih jenis kelamin anda'
    }

    if (validator.isEmpty(form.phone)) {
      errors.phone = 'Mohon isi nomor handphone aktif anda'
    } else if (!validator.isPhone(form.phone)) {
      errors.phone = 'Format nomor handphone tidak valid'
    } else if (!validator.max(form.phone, 15)) {
      errors.phone = 'Nomor handphone maksimal 15 karakter'
    }

    if (validator.isEmpty(form.email)) {
      errors.email = 'Mohon isi email anda';
    } else if (!validator.isEmail(form.email)) {
      errors.email = 'Format email tidak valid';
    }

    if (validator.isEmpty(form.password)) {
      errors.password = 'Mohon isi kata sandi anda';
    } else if (!validator.min(form.password, 8)) {
      errors.password = 'Kata sandi minimal 8 karakter'
    }

    if (validator.isEmpty(form.password_confirmation)) {
      errors.password_confirmation = 'Mohon isi konfirmasi kata sandi anda';
    } else if (form.password !== form.password_confirmation) {
      errors.password_confirmation = 'Konfirmasi sandi tidak cocok'
    }

    setErrorRegister(errors);

    const invalid = Object.values(errors).some(e => e !== '')

    return !invalid;

  }

  const onClickCloseAlert = () => {
    setAlert(alertState);
  }

  const resetForm = () => {
    setFormRegister(formRegisterState, 'multiple');
    setFormLogin(formLogin, 'multiple');
  }

  const onSubmitLogin = async e => {
    e?.preventDefault?.();

    if (!validateLogin()) {
      return
    }

    try {
      setLoading(true);
      await login(formLogin.email, formLogin.password);
      const user = await getProfile();
      setLoading(false);
      resetForm();
      modalAuth(false);
      return toast.success(`Welcome back ${user?.name}!`)
    } catch (err) {
      console.log('err', err)
      setLoading(false);
      let resError = resolveBackendValidationError(err);
      return setAlert(v => ({
        ...v,
        show: true,
        type: 'danger',
        message: resError.message || 'Terjadi Kesalahan'
      }));
    }
  }

  const onSubmitRegister = e => {
    e?.preventDefault?.();

    if (!validateRegister()) {
      return
    }

    setLoading(true);
    register(formRegister)
      .then(() => {
        setLoading(false);
        setAlert(v => ({
          ...v,
          show: true,
          message: 'Registration Succesfull',
          type: 'success'
        }));
        resetForm();
        modalAuth(true, 'login');
      })
      .catch(err => {
        console.log('err', err)
        let resError = resolveBackendValidationError(err);
        setAlert(v => ({
          ...v,
          show: true,
          type: 'danger',
          message: resError.message || 'Terjadi Kesalahan'
        }));
        setLoading(false);
      })
  }


  const renderTab = () => {
    return (
      <div className="d-block d-lg-none">
        <Row>
          <Col>
            <div className="modal-auth__header mb-4 d-block d-lg-none">
              <h2 className="modal-auth__form-title text-center font-weight-bold">SELAMAT DATANG DI <span className="text-secondary">TE SOCIETY</span></h2>
            </div>
          </Col>
        </Row>
        <Row className="mb-4">
          <Col xs={6} className="text-center">
            <a onClick={() => modalAuth(true, 'login')} href="#" className={`text-decoration-none pb-2 ${modal.state === 'login' ? 'text-primary' : 'text-dark'}`} style={modal.state === 'login' ? { borderBottom: "2px solid #E73A63" } : {}}>LOGIN</a>
          </Col>
          <Col xs={6} className="text-center">
            <a onClick={() => modalAuth(true, 'register')} href="#" className={`text-decoration-none pb-2 ${modal.state === 'register' ? 'text-primary' : 'text-dark'}`} style={modal.state === 'register' ? { borderBottom: "2px solid #E73A63" } : {}}>DAFTAR</a>
          </Col>
        </Row>
      </div>
    )
  }





  const renderForm = () => {
    return (
      <div className={`modal-auth__form ${modal.state === 'register' ? 'modal-auth__form--register' : 'modal-auth__form--login'}`}>
        <button type="button" className="close modal-auth__form-close" onClick={onHide}>
          <span aria-hidden="true">&times;</span>
        </button>
        {renderTab()}
        {modal.state === 'login' && (
          <LoginForm
            alert={alert}
            form={formLogin}
            errors={errorLogin}
            disabled={loading}
            onSubmit={onSubmitLogin}
            onChange={onChangeInputFormLogin}
            onCloseAlert={onClickCloseAlert}
            onClickState={() => modalAuth(true, 'register')}
          />
        )}
        {modal.state === 'register' && (
          <RegisterForm
            alert={alert}
            form={formRegister}
            errors={errorRegister}
            disabled={loading}
            onSubmit={onSubmitRegister}
            onChange={onChangeInputFormRegister}
            onCloseAlert={onClickCloseAlert}
            onClickState={() => modalAuth(true, 'login')}
          />
        )}
      </div>
    )
  }

  useEffect(() => {
    if (modal.state === 'register') {
      setFormRegister(formRegisterState, 'multiple')
      setErrorRegister(errorRegisterState)
    }

    if (modal.state === 'login') {
      setFormLogin(formLoginState, 'multiple')
      setErrorLogin(errorLoginState)
    }
  }, [modal?.state])

  return (
    <Modal
      show={modal.show}
      size="lg"
      onHide={onHide}
      aria-labelledby="contained-modal-title-vcenter"
      centered
      className="modal-auth"
    >
      <Modal.Body className="p-0">
        <Row className="no-gutters">
          <Col xs={12} lg={4} className="d-none d-lg-block position-relative">
            <div className="modal-auth__overlay">
              <div>
                <img width={150} src="/assets/img/LogoPutih.png" className="mb-3" alt="" />
                <div className="mb-3">
                  <small className="text-light">
                    Sebuah komunitas pengusaha muda dengan tujuan untuk saling membantu, berkolaborasi, dan memajukan dunia wirausaha di Indonesia.
                  </small>
                </div>
                <small className="text-secondary font-weight-bold">#TempatKamuBerkembang</small>
              </div>
            </div>
            <div className="modal-auth__bg"></div>
          </Col>
          <Col xs={12} lg={8}>
            {renderForm()}
          </Col>
        </Row>
      </Modal.Body>
    </Modal>
  )
}


export default memo(ModalAuth);