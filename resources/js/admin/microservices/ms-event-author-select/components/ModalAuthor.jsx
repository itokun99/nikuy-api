import axios from 'axios';
import { useEffect, useState, useCallback } from 'react';
import { Modal, Button, Table, Form, Col } from 'react-bootstrap';
import PropTypes from 'prop-types';
import CardAuthor from './CardAuthor';

const ModalAuthor = ({ show, onHide, onChange }) => {

  const [input, setInput] = useState('');
  const [loading, setLoading] = useState(false);
  const [members, setMembers] = useState([])


  const getMembers = async (search) => {
    try {
      const isDev = window.location.hostname === 'localhost';
      const baseUrl = isDev ? 'http://localhost:8000/api' : 'https://elites.id/api'

      setLoading(true);
      const response = await axios.get(`${baseUrl}/v1/members${search ? '?search=' + search : ''}`)
      const result = response.data;
      setLoading(false);
      if (result?.data) {
        setMembers(result?.data);
      }
    } catch (e) {
      setLoading(false);
      console.log('error', e)
    }
  }

  const onSubmit = e => {
    e?.preventDefault?.();
    getMembers(input);
  }

  const onSelect = data => {
    onChange(data);
  }

  const renderTable = () => {

    if (loading) {
      return (
        <tr>
          <td colSpan={2} className="text-center">Sedang memuat...</td>
        </tr>
      )
    }

    if (members.length === 0) {
      return (
        <tr>
          <td colSpan={2} className="text-center">Tidak ada member</td>
        </tr>
      )
    }

    return (
      <>
        {members.map(member => {
          return (
            <tr key={member.id}>
              <td>
                <CardAuthor photo={member.photo} name={member.name} title={member.title} />
              </td>
              <td className="text-right">
                <Button onClick={() => onSelect(member)} size="sm" variant="primary">Pilih</Button>
              </td>
            </tr>
          )
        })}
      </>
    )
  }


  useEffect(() => {
    if (show) {
      getMembers()
    }
  }, [show])


  return (
    <Modal show={show} onHide={onHide}>
      <Modal.Header closeButton>
        <Modal.Title>Pilih Author</Modal.Title>
      </Modal.Header>
      <Modal.Body>
        <Form onSubmit={onSubmit}>
          <Form.Group style={{ display: 'flex' }}>
            <div className="mr-2" style={{ flex: 1 }}>
              <Form.Control
                type="text"
                placeholder="Cari member..."
                value={input}
                onChange={e => setInput(e.target.value)}
              />
            </div>
            <Button variant="primary">Cari</Button>
          </Form.Group>
        </Form>
        <Table borderless hover>
          <tbody>
            {renderTable()}
          </tbody>
        </Table>
      </Modal.Body>
    </Modal>
  )
}

ModalAuthor.propTypes = {
  show: PropTypes.bool,
  onHide: PropTypes.func,
  onChange: PropTypes.func
}

ModalAuthor.defaultProps = {
  show: false,
  onHide: () => { },
  onChange: () => { }
};

export default ModalAuthor;