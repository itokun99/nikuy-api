import axios from 'axios';
import { useState, useEffect, useCallback } from 'react';
import { Button } from 'react-bootstrap';
import ModalAuthor from './components/ModalAuthor';
import { Form } from 'react-bootstrap';
import CardAuthor from './components/CardAuthor';


const App = ({ authorId }) => {

  const [author, setAuthor] = useState(null);
  const [modal, showModal] = useState(false);


  const onChange = data => {
    setAuthor(data);
    showModal(false);
  }

  const getAuthor = useCallback(() => {
    if (authorId) {
      const isDev = window.location.hostname === 'localhost';
      const baseUrl = isDev ? 'http://localhost:8000/api' : 'https://elites.id/api'

      axios.get(`${baseUrl}/v1/members/${authorId}`)
        .then(response => response.data)
        .then(result => {
          if (result.data) {
            setAuthor(result.data);
          }
        })
    }
  }, [authorId])


  useEffect(() => {
    if (authorId) {
      getAuthor()
    }
  }, [authorId])

  return (
    <>
      <div className="card shadow mb-4">
        <div className="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 className="m-0 font-weight-bold text-primary">Author</h6>
        </div>
        <div className="card-body">
          {author && (
            <>
              <Form.Control type="hidden" name="id_user" value={author.id} />
              <CardAuthor
                name={author.name}
                photo={author.photo}
                title={author.title}
              />
              <div className="mb-3"></div>
            </>
          )}
          <div>
            {author
              ? (
                <>
                  <Button size="sm" variant="primary" className="mr-2" onClick={() => showModal(true)}>Ganti Author</Button>
                  <Button size="sm" variant="danger" onClick={() => setAuthor(null)}>Hapus</Button>
                </>
              )
              : (<Button size="sm" variant="primary" onClick={() => showModal(true)}>Pilih Author</Button>)
            }

          </div>
        </div>
      </div>
      <ModalAuthor show={modal} onHide={() => showModal(false)} onChange={onChange} />
    </>
  )
}


export default App;