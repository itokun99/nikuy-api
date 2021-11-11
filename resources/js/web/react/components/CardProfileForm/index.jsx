import { memo, useEffect, useState } from 'react';
import { Card, Form, Button } from 'react-bootstrap';
import { useForm, validator } from '../../utils'
import { profileAccountSelector, provinceSelector } from '../../modules';
import { getProfile, getProvinces, updateProfile } from '../../services';
import { useSelector, shallowEqual } from 'react-redux';
import { toast } from 'react-toastify';

const genders = [
  { label: 'Laki-laki', value: 'Laki-laki' },
  { label: 'Perempuan', value: 'Perempuan' },
]

const formState = {
  id: null,
  name: '',
  email: '',
  phone: '',
  address: '',
  dob: '',
  province: '',
  title: '',
  summary: ''
}

const errorState = {
  name: '',
  email: '',
  phone: '',
  address: '',
  dob: '',
  province: '',
  title: '',
  summary: ''
}

const CardProfileForm = () => {

  const account = useSelector(profileAccountSelector, shallowEqual);
  const province = useSelector(provinceSelector, shallowEqual);
  const provinces = province?.data || [];

  const [form, setForm] = useForm(formState);
  const [errors, setError] = useState(errorState);
  const [loading, setLoading] = useState(false);

  const onChangeInput = e => {
    const { name, value } = e?.target;

    if (errors[name] !== "") {
      setError(prev => ({
        ...prev,
        [name]: ""
      }));
    }

    if (name === 'phone') {
      if (!validator.isTypingPhoneNumberOnly(value)) {
        return
      }
    }

    setForm(value, name);
  };

  const validate = () => {
    const err = { ...errors };

    if (validator.isEmpty(form.name)) {
      err.name = 'Mohon isi nama lengkap anda'
    } else if (!validator.min(form.name, 2)) {
      err.name = 'Nama Lengkap minimal berisi 2 huruf'
    }

    if (validator.isEmpty(form.address)) {
      err.address = 'Mohon isi alamat lengkap anda'
    }

    if (validator.isEmpty(form.dob)) {
      err.dob = 'Mohon isi tanggal lahir anda'
    }

    if (validator.isEmpty(form.gender)) {
      err.gender = 'Mohon pilih jenis kelamin anda'
    }

    if (validator.isEmpty(form.phone)) {
      err.phone = 'Mohon isi nomor handphone aktif anda'
    } else if (!validator.isPhone(form.phone)) {
      err.phone = 'Format nomor handphone tidak valid'
    } else if (!validator.max(form.phone, 15)) {
      err.phone = 'Nomor handphone maksimal 15 karakter'
    }

    if (validator.isEmpty(form.email)) {
      err.email = 'Mohon isi email anda';
    } else if (!validator.isEmail(form.email)) {
      err.email = 'Format email tidak valid';
    }

    setError(err);
    const invalid = Object.values(err).some(e => e !== '')
    return !invalid;
  }

  const onSubmit = async e => {
    try {
      e?.preventDefault?.();

      if (!validate()) {
        return
      }

      setLoading(true);
      await updateProfile(form);
      await getProfile();
      setLoading(false);
      return toast.success('Berhasil mengupdate profile!');

    } catch (err) {
      console.log('err', err);
      setLoading(false);
      return toast.error(err?.message || 'Terjadi Kesalahan', err);

    }
  }


  useEffect(() => {
    if (account) {
      setForm({
        id: null,
        name: account.name,
        email: account.email,
        phone: account.phone,
        address: account.address,
        dob: account.dob,
        province: account.province?.id,
        title: account.title,
        summary: account.summary,
        gender: account.gender,
      }, 'multiple')
    }
  }, [account])

  useEffect(() => {
    if (provinces && !provinces.length) {
      getProvinces();
    }
  }, [provinces])



  return (
    <Card className="card-profile-form p-3 text-white card-dark-bg mb-5">
      <Card.Body>
        <Form onSubmit={onSubmit}>
          <h3 className="mb-4"><strong>Atur Profile</strong></h3>
          <Form.Group>
            <Form.Label>Nama Lengkap</Form.Label>
            <Form.Control
              name="name"
              type="text"
              className="input-dark"
              isInvalid={Boolean(errors.name)}
              placeholder="Masukan nama lengkap anda"
              value={form.name}
              onChange={onChangeInput}

            />
            <Form.Control.Feedback type="invalid">{errors.name}</Form.Control.Feedback>
          </Form.Group>
          <Form.Group>
            <Form.Label>Alamat Lengkap</Form.Label>
            <Form.Control
              as="textarea"
              rows={5}
              name="address"
              className="input-dark"
              isInvalid={Boolean(errors.address)}
              placeholder="Masukan alamat lengkap anda"
              value={form.address}
              onChange={onChangeInput}
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
              onChange={onChangeInput}
            >
              <option>Pilih</option>
              {provinces.map(p => (
                <option key={p.id} value={p.id}>{p.name}</option>
              ))}
            </Form.Control>
            <Form.Control.Feedback type="invalid">{errors.province}</Form.Control.Feedback>
          </Form.Group>
          <Form.Group>
            <Form.Label>Tanggal Lahir</Form.Label>
            <Form.Control
              name="dob"
              type="date"
              className="input-dark"
              isInvalid={Boolean(errors.dob)}
              placeholder="Masukan tanggal lahir"
              value={form.dob}
              onChange={onChangeInput}
            />
            <Form.Control.Feedback type="invalid">{errors.dob}</Form.Control.Feedback>
          </Form.Group>
          <Form.Group>
            <Form.Label>Jenis Kelamin</Form.Label>
            <Form.Control
              custom
              as="select"
              name="gender"
              value={form.gender}
              className="input-dark"
              isInvalid={Boolean(errors.gender)}
              onChange={onChangeInput}
            >
              <option>Pilih</option>
              {genders.map((gender, index) => {
                return (
                  <option key={index} value={gender.value}>{gender.label}</option>
                )
              })}
            </Form.Control>
            <Form.Control.Feedback type="invalid">{errors.gender}</Form.Control.Feedback>
          </Form.Group>
          <Form.Group>
            <Form.Label>Nomor Handphone</Form.Label>
            <Form.Control
              type="text"
              name="phone"
              value={form.phone}
              className="input-dark"
              isInvalid={Boolean(errors.phone)}
              placeholder="Masukan nomor handphone anda"
              onChange={onChangeInput}
              maxLength={15}
            />
            <Form.Control.Feedback type="invalid">{errors.phone}</Form.Control.Feedback>
          </Form.Group>
          <Form.Group>
            <Form.Label>Alamat Email</Form.Label>
            <Form.Control
              type="email"
              name="email"
              value={form.email}
              className="input-dark"
              isInvalid={Boolean(errors.email)}
              placeholder="Masukan alamat email anda"
              onChange={onChangeInput}
            />
            <Form.Control.Feedback type="invalid">{errors.email}</Form.Control.Feedback>
          </Form.Group>
          <Form.Group>
            <Form.Label>Title</Form.Label>
            <Form.Control
              type="text"
              name="title"
              value={form.title}
              className="input-dark"
              isInvalid={Boolean(errors.title)}
              placeholder="Masukan title anda"
              onChange={onChangeInput}
            />
            <Form.Control.Feedback type="invalid">{errors.title}</Form.Control.Feedback>
          </Form.Group>
          <Form.Group className="mb-5">
            <Form.Label>Summary</Form.Label>
            <Form.Control
              as="textarea"
              rows={5}
              name="summary"
              className="input-dark"
              isInvalid={Boolean(errors.summary)}
              placeholder="Masukan alamat lengkap anda"
              value={form.summary}
              onChange={onChangeInput}
            />
            <Form.Control.Feedback type="invalid">{errors.summary}</Form.Control.Feedback>
          </Form.Group>
          <Button disabled={loading} block size="lg" variant="secondary" type="submit" className="text-white font-weight-bold">UBAH PROFILE ANDA</Button>
        </Form>
      </Card.Body>
    </Card>
  )
}

export default memo(CardProfileForm);