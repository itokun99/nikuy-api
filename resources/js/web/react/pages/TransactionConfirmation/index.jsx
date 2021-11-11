import { useState, useEffect, useCallback } from 'react';
import { Row, Col, Container, Card, Form, Button } from 'react-bootstrap';
import { Redirect, useParams, useHistory } from 'react-router-dom';
import { BaseContainer } from '../../containers';
import { useSelector, shallowEqual } from 'react-redux';
import { profileAccountSelector, bankSelector, paymentSelector } from '../../modules';
import { getBanks, getPayments, getTransaction, updateTransaction } from '../../services';
import { getTokenFromStorage, useForm, validator } from '../../utils';
import { toast } from 'react-toastify';
import { InputUpload } from '../../components';
import { showLoading } from '../../controls';

const formState = {
  name: '',
  bank: '',
  owner: '',
  account: '',
  image: '',
  file: null
}

const errorState = {
  name: '',
  bank: '',
  owner: '',
  account: '',
  file: ''
}


const TransactionConfirmation = () => {
  const token = getTokenFromStorage();
  const { id } = useParams();
  const history = useHistory();

  const account = useSelector(profileAccountSelector, shallowEqual);
  const bank = useSelector(bankSelector, shallowEqual);
  const payment = useSelector(paymentSelector, shallowEqual);

  const [form, setForm] = useForm(formState);
  const [errors, setError] = useState(errorState);

  const [transaction, setTransaction] = useState(null);

  console.log('form', form)

  const banks = bank?.data || [];
  const payments = payment?.data || [];

  const getTransactionData = useCallback(() => {
    if (id) {
      showLoading(true);
      getTransaction(id).then(data => {
        showLoading(false);
        setTransaction(data);
        setForm(data.name, 'name')
      }).catch(err => {
        showLoading(false);
        toast.error(err?.message);
      })
    }
  }, [id])

  const onChange = (e, f) => {
    const { name, value } = e?.target;

    if (errors[name] !== "") {
      setError(prev => ({
        ...prev,
        [name]: ""
      }));
    }

    if (name === 'account') {
      if (!validator.isTypingPhoneNumberOnly(value)) {
        return
      }
    }

    if (name === 'file') {
      setForm(f.file, 'file');
      setForm(f.image, 'image');
    } else {
      setForm(value, name);
    }
  };

  const validate = () => {
    const err = { ...errors };

    if (validator.isEmpty(form.bank)) {
      err.bank = 'Mohon isi pilih Bank asal anda'
    }

    if (validator.isEmpty(form.owner)) {
      err.owner = 'Mohon isi pemilik rekening anda'
    }

    if (validator.isEmpty(form.account)) {
      err.account = 'Mohon isi nomor rekning anda'
    }

    if (!form.file) {
      err.file = 'Mohon upload bukti pembayaran';
    }

    if (form.file?.size >= 1000000) {
      err.file = 'File lebih dari 1 MB, maksimal 1 MB';
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

      showLoading(true);
      await updateTransaction(id, form)
      showLoading(false);

      toast.success("Berhasil mengupdate transaksi");
      return history.push('/transaction')

    } catch (err) {
      console.log(err);
      showLoading(false);
      toast.error(err?.message)
    }
  }


  useEffect(() => {
    getBanks();
    getPayments();
  }, [])

  useEffect(() => {
    getTransactionData();
  }, [getTransactionData])

  if (!token) {
    return <Redirect to="/" />
  }

  if (!account) {
    return null;
  }

  const renderContent = () => {
    if (!transaction) {
      return null;
    }

    return (
      <>
        <div className="transaction__header">
          <span className="transaction__title">{transaction.name}</span>
        </div>
        <Container>
          <Row className="justify-content-center">
            <Col xs={12} lg={8}>
              <Card className="card-dark-bg text-light transaction__card mb-5">
                <Card.Header className="text-center transaction__card-header">
                  <h5 className="m-0">BAYAR SEBELUM {transaction.expired_at}</h5>
                </Card.Header>
                <Card.Body className="text-center">
                  <span className="transaction__price">{transaction.nominal_display}</span>
                </Card.Body>
              </Card>
              {payments.map(payment => {
                return (
                  <Card key={payment.id} className="card-dark-bg text-light transaction__card mb-5">
                    <Card.Header className="text-center transaction__card-header">
                      <h5 className="m-0">{payment.type}</h5>
                    </Card.Header>
                    <Card.Body className="text-center">
                      <div>
                        <img style={{ maxWidth: 300 }} className="w-100 mb-3" src={payment.bank?.logo} alt={payment.bank?.name} />
                      </div>
                      <div>
                        <h5>No. Rekening {payment.number}</h5>
                      </div>
                      <div>
                        <h5>A/N {payment.owner}</h5>
                      </div>
                    </Card.Body>
                  </Card>
                )
              })}

              <Card className="card-dark-bg text-light transaction__card mb-5">
                <Card.Header className="text-center transaction__card-header">
                  <h5 className="m-0">UNGGAH BUKTI TRANSFER</h5>
                </Card.Header>
                <Card.Body className="">
                  <Row className="justify-content-center">
                    <Col xs={12} lg={8}>
                      <div className="transaction__alert">
                        <div className="transaction__alert-header text-center mb-3">
                          <h5 className="m-0 text-danger">Mohon Diperhatikan</h5>
                        </div>
                        <div className="transaction__alert-body p-3 mb-3">
                          Pengiriman bukti transfer WAJIB dilakukan setelah anda melakukan transfer. Kami menyarankan untuk menyimpan / screenshot bukti transfer anda.
                        </div>
                      </div>
                      <Form onSubmit={onSubmit}>
                        <Form.Group>
                          <Form.Label>Bank Asal</Form.Label>
                          <Form.Control
                            custom
                            as="select"
                            name="bank"
                            value={form.bank}
                            className="input-dark"
                            isInvalid={Boolean(errors.bank)}
                            onChange={onChange}
                          >
                            <option>Pilih</option>
                            {banks.map((bank, index) => {
                              return (
                                <option key={index} value={bank.name}>{bank.name}</option>
                              )
                            })}
                          </Form.Control>
                          <Form.Control.Feedback type="invalid">{errors.bank}</Form.Control.Feedback>
                        </Form.Group>

                        <Form.Group>
                          <Form.Label>Nama Pemilik Rekening</Form.Label>
                          <Form.Control
                            name="owner"
                            type="text"
                            className="input-dark"
                            isInvalid={Boolean(errors.owner)}
                            placeholder="Atas nama"
                            value={form.owner}
                            onChange={onChange}

                          />
                          <Form.Control.Feedback type="invalid">{errors.owner}</Form.Control.Feedback>
                        </Form.Group>

                        <Form.Group>
                          <Form.Label>Nomor Rekening</Form.Label>
                          <Form.Control
                            name="account"
                            type="text"
                            className="input-dark"
                            isInvalid={Boolean(errors.account)}
                            placeholder="Masukan Nomor Rekening"
                            value={form.account}
                            onChange={onChange}

                          />
                          <Form.Control.Feedback type="invalid">{errors.account}</Form.Control.Feedback>
                        </Form.Group>

                        <Form.Group className="mb-4">
                          <Form.Label>Upload Bukti Pembayaran</Form.Label>
                          <InputUpload
                            name="file"
                            label={form.file?.name || "Upload file"}
                            onChange={onChange}
                            image={form.image}
                            className="input-dark"
                            isInvalid={Boolean(errors.file)} />
                          {errors.file ? (
                            <Form.Text className="text-danger">{errors.file}</Form.Text>
                          ) : (
                            <Form.Text>Maksimal ukuran file 1 MB</Form.Text>
                          )}
                        </Form.Group>

                        <Button block type="submit" variant="primary" className="font-weight-bold text-white">
                          KONFIRMASI PEMBARAN
                        </Button>
                      </Form>
                    </Col>
                  </Row>
                </Card.Body>
              </Card>
            </Col>
          </Row>
        </Container>
      </>
    )
  }

  return (
    <BaseContainer footer={false}>
      {renderContent()}
    </BaseContainer>
  )
}

export default TransactionConfirmation;