import App from './App';
import ReactDOM from 'react-dom';
const rootElement = document.getElementById('event-author');
const authorId = rootElement.getAttribute('data-author-id');
ReactDOM.render(<App authorId={authorId} />, rootElement);