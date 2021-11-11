import PropTypes from "prop-types";
import { Form } from 'react-bootstrap';

const InputUpload = ({ name, label, image, onChange, isInvalid, className }) => {

  const onChangeInput = e => {
    e.preventDefault();
    const reader = new FileReader();
    const file = e.target.files[0];

    reader.onloadend = () => {
      setTimeout(() => {
        if (reader.result) {
          onChange(e, { image: reader.result, file })
        }
      }, 100);
    };

    if (file) {
      reader.readAsDataURL(file);
    }
  };


  return (
    <>
      {image && (
        <img src={image} className="w-100 mb-3" alt="" />
      )}
      <Form.File
        id="custom-file"
        label={label}
        custom
        name={name}
        onChange={onChangeInput}
        accept=".jpg,.png"
        isInvalid={isInvalid}
        className={className}
      />
    </>
  )
}

InputUpload.propTypes = {
  name: PropTypes.string,
  label: PropTypes.string,
  image: PropTypes.string,
  onChange: PropTypes.func,
  isInvalid: PropTypes.bool,
  className: PropTypes.string
}

InputUpload.defaultProps = {
  name: 'file',
  label: 'Upload File',
  image: '',
  isInvalid: false,
  className: '',
  onChange: () => { }
}

export default InputUpload;