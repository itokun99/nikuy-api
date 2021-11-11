import { memo, useState } from 'react';
import { Card, Form, Button } from 'react-bootstrap';
import { useForm, validator, resolveBackendValidationError } from '../../utils';
import { updatePassword } from '../../services';
import { toast } from 'react-toastify';

const formState = {
  old_password: '',
  password: '',
  password_confirmation: '',
}

const errorState = {
  old_password: '',
  password: '',
  password_confirmation: '',
}

const CardProfilePassword = () => {

  const [form, setForm] = useForm(formState);
  const [errors, setError] = useState(errorState);
  const [loading, setLoading] = useState(false);

  const onChange = e => {
    const { name, value } = e.target;

    setForm(value, name);

    if (errors[name] !== '') {
      setError(v => ({
        ...v,
        [name]: ''
      }))
    }
  }

  const validate = () => {
    const err = { ...errors }

    if (!form.old_password) {
      err.old_password = 'Mohon masukan kata sandi lama'
    }

    if (!form.password) {
      err.password = 'Mohon masukan kata sandi baru'
    }

    if (!validator.min(form.password, 6)) {
      err.password = 'Kata sandi minimal 6 karakter'
    }

    if (!form.password_confirmation) {
      err.password_confirmation = 'Mohon masukan konfirmasi kata sandi'
    }

    if (form.password_confirmation !== form.password) {
      err.password_confirmation = 'Konfirmasi kata sandi tidak cocok'
    }

    setError(err);

    const invalid = Object.values(err).some(e => e !== '')
    return !invalid;
  }

  const onSubmit = e => {
    e?.preventDefault?.();
    if (!validate()) {
      return
    }

    setLoading(true);
    updatePassword(form)
      .then(() => {
        setLoading(false);
        setForm(formState, 'multiple');
        setError(errorState);
        return toast.success('Berhasil mengubah kata sandi');
      })
      .catch(err => {
        const resError = resolveBackendValidationError(err);
        setLoading(false);
        return toast.error(resError?.message || 'Terjadi kesalahan');
      })
  }

  return (
    <Card className="card-profile-password p-3 text-white card-dark-bg mb-5">
      <Card.Body>
        <Form onSubmit={onSubmit}>
          <h3 className="mb-4"><strong>Atur Kata Sandi</strong></h3>
          <Form.Group>
            <Form.Label>Kata Sandi Lama</Form.Label>
            <Form.Control
              name="old_password"
              className="input-dark"
              type="password"
              placeholder="Masukan kata sandi lama anda"
              value={form.old_password}
              onChange={onChange}
              isInvalid={Boolean(errors.old_password)}
            />
            <Form.Control.Feedback type="invalid">{errors.old_password}</Form.Control.Feedback>
          </Form.Group>

          <Form.Group>
            <Form.Label>Kata Sandi Baru</Form.Label>
            <Form.Control
              name="password"
              className="input-dark"
              type="password"
              placeholder="Masukan kata sandi baru anda"
              value={form.password}
              onChange={onChange}
              isInvalid={Boolean(errors.password)}
            />
            <Form.Control.Feedback type="invalid">{errors.password}</Form.Control.Feedback>
          </Form.Group>

          <Form.Group>
            <Form.Label>Konfirmasi Kata Sandi Baru</Form.Label>
            <Form.Control
              name="password_confirmation"
              type="password"
              className="input-dark" type="password"
              placeholder="Masukan konfirmasi kata sandi baru anda"
              value={form.password_confirmation}
              onChange={onChange}
              isInvalid={Boolean(errors.password_confirmation)}
            />
            <Form.Control.Feedback type="invalid">{errors.password_confirmation}</Form.Control.Feedback>
          </Form.Group>

          <Button
            block
            size="lg"
            variant="secondary"
            type="submit"
            disabled={loading}
            className="text-white font-weight-bold"
          >
            UBAH KATA SANDI
          </Button>
        </Form>
      </Card.Body>
    </Card>
  )
}

export default memo(CardProfilePassword);