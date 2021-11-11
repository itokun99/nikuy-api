import { useState, useEffect } from 'react';
import PropTypes from "prop-types";

const App = ({ name, label, id, image }) => {

  const [img, setImg] = useState('');

  const onChange = e => {
    e.preventDefault();
    const reader = new FileReader();
    const file = e.target.files[0];

    reader.onloadend = () => {
      setTimeout(() => {
        if (reader.result) {
          setImg(reader.result);
        }
      }, 100);
    };

    if (file) {
      reader.readAsDataURL(file);
    } else {
      setImg(image);
    }
  };


  useEffect(() => {
    if (image) {
      setImg(image);
    }
  }, [image]);


  return (
    <>
      {img && (
        <img src={img} className="w-100 mb-3" alt="" />
      )}
      <div className="custom-file">
        <input onChange={onChange} type="file" name={name} className="custom-file-input" id={`customFile-${id}`}
          accept=".jpg,.png" />
        <label className="custom-file-label" htmlFor={`customFile-${id}`}>{label}</label>
      </div>
    </>
  )
}

App.propTypes = {
  name: PropTypes.string,
  label: PropTypes.string,
  id: PropTypes.string,
  image: PropTypes.string,
}

App.defaultProps = {
  name: 'file',
  label: 'Upload File',
  id: 'input-file',
  image: ''
}

export default App;