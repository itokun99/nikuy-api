import React from 'react';
import ReactDOM from 'react-dom';
import App from './App';
import { store } from './modules';
import { Provider } from 'react-redux';

const rootElement = document.getElementById('root');

if (rootElement) {
  ReactDOM.render(
    <React.StrictMode>
      <Provider store={store}>
        <App />
      </Provider>
    </React.StrictMode>,
    document.getElementById('root')
  );
}