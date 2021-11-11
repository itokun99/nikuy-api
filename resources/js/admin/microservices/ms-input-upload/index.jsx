import App from './App';
import ReactDOM from 'react-dom';
const rootElement = document.getElementById('input-upload');

// render by id
if (rootElement) {
  const name = rootElement.getAttribute('name');
  const label = rootElement.getAttribute('label');
  const id = rootElement.getAttribute('id');
  const image = rootElement.getAttribute('image');
  ReactDOM.render(<App id={id} name={name} label={label} image={image} />, rootElement);
}

// render by class
const classElement = document.getElementsByClassName('input-upload');

if (classElement && classElement.length > 0) {
  let i = 0;
  do {
    let element = classElement[i];
    const name = element.getAttribute('name');
    const label = element.getAttribute('label');
    const id = String(i);
    const image = element.getAttribute('image');
    ReactDOM.render(<App id={id} name={name} label={label} image={image} />, element);
    i++;
  } while (i < classElement.length);
}