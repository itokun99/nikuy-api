import { memo, useState, useEffect, useCallback } from 'react';
import CardBusinessPhoto from '../CardBusinessPhoto';
import CardBusinessInfo from '../CardBusinessInfo';
import { getDetailUserBussiness, addBusiness, editBusiness } from '../../services';
import { Row, Col, Form } from 'react-bootstrap';
import { useForm, validator, resolveBackendValidationError } from '../../utils';
import { useParams, useHistory } from 'react-router-dom';
import { toast } from 'react-toastify';

const formState = {
  name: '',
  description: '',
  founded: '',
  business_field: '',
  industry: '',
  address: '',
  email: '',
  phone: '',
  turnover: '',
  number_of_employees: '',
  instagram: '',
  facebook: '',
  website: '',
  province: '',
  file: null,
  photo: '/assets/img/nofoto.png'
}

const errorState = {
  name: '',
  description: '',
  founded: '',
  business_field: '',
  industry: '',
  address: '',
  email: '',
  phone: '',
  turnover: '',
  province: '',
  number_of_employees: '',
  instagram: '',
  facebook: '',
  website: '',
  file: '',
  photo: ''
}

const BusinessForm = () => {
  const { id } = useParams();
  const history = useHistory();
  const [form, setForm] = useForm(formState);
  const [errors, setError] = useState(errorState);
  const [loading, setLoading] = useState(false);
  const disabled = loading;

  console.log('errors', errors)

  const getData = useCallback(() => {
    if (id) {
      setLoading(true);
      getDetailUserBussiness(id).then(data => {
        setLoading(false);
        setForm({
          name: data?.name,
          description: data?.description,
          founded: data?.founded,
          business_field: data?.business_field,
          industry: data?.industry,
          address: data?.address,
          email: data?.email,
          phone: data?.phone,
          turnover: data?.turnover,
          number_of_employees: data?.number_of_employees,
          instagram: data?.instagram,
          facebook: data?.facebook,
          website: data?.website,
          province: data?.province?.id,
          file: null,
          photo: data?.photo
        }, 'multiple')
      }).catch(err => {
        toast.error(err?.message);
        setLoading(false);
      });
    }
  }, [id])



  const validate = () => {
    const err = { ...errors };

    if (!form.name) {
      err.name = "Mohon isi nama bisnis anda";
    }

    if (!form.description) {
      err.description = "Mohon isi deskripsi bisnis anda";
    }

    if (!form.founded) {
      err.founded = "Mohon isi tahun didirikannya usaha anda";
    }

    if (!form.business_field) {
      err.business_field = "Mohon isi bidang bisnis anda";
    }

    if (!form.industry) {
      err.industry = "Mohon isi industri bisnis anda";
    }

    if (!form.address) {
      err.address = "Mohon isi alamat bisnis anda";
    }

    if (!form.province) {
      err.province = "Mohon pilih provinsi usaha anda";
    }

    if (!form.phone) {
      err.phone = "Mohon isi nomor telepon bisnis anda";
    } else if (!validator.max(form.phone, 15)) {
      err.phone = 'Nomor handphone maksimal 15 karakter'
    }

    if (!form.turnover) {
      err.turnover = "Mohon isi omset bulanan bisnis anda";
    }

    if (!form.number_of_employees) {
      err.number_of_employees = "Mohon isi jumlah karyawan bisnis anda";
    }

    if (!form.email) {
      err.email = 'Mohon masukan alamat email bisnis anda';
    } else if (!validator.isEmail(form.email)) {
      err.email = 'Format email tidak valid';
    }

    setError(err);
    const invalid = Object.values(err).some(e => e !== '')
    return !invalid;
  }

  const onChange = (e, p) => {
    const { name, value } = e.target;

    if (name === 'file' && p) {
      setForm(p?.file, 'file');
      setForm(p?.image, 'photo');
    } else {
      setForm(value, name);
    }

    if (errors[name] !== "") {
      setError(v => ({
        ...v,
        [name]: ''
      }));
    }
  }

  const onSubmit = async e => {
    try {
      e?.preventDefault?.()

      if (!validate()) {
        console.log(validate())
        return
      }

      setLoading(true);
      if (id) {
        console.log('masuk')
        await editBusiness(id, form);
      } else {
        await addBusiness(form);
      }
      setLoading(false);
      if (id) {
        getData();
        return toast.success('Berhasil mengupdate bisnis anda');
      } else {
        setForm(formState, 'multiple')
        toast.success('Berhasil menambahkan bisnis anda');
        return history.replace('/profile/business');
      }

    } catch (err) {
      console.log('err', err);
      setLoading(false);
      const resError = resolveBackendValidationError(err);
      return toast.error(resError?.message || 'Terjadi kesalahan');
    }
  }

  useEffect(() => {
    getData();
  }, [getData])

  return (
    <Form onSubmit={onSubmit}>
      <Row>
        <Col sm={12} md={5}>
          <CardBusinessPhoto
            form={form}
            errors={errors}
            onChange={onChange}
            disabled={disabled}
            isEdit={Boolean(id)}
          />
        </Col>
        <Col sm={12} md={7}>
          <CardBusinessInfo
            form={form}
            errors={errors}
            onChange={onChange}
            disabled={disabled}
          />
        </Col>
      </Row>
    </Form>
  )
}

export default memo(BusinessForm);