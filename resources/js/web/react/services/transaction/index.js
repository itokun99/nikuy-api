import { API } from '../../configs';
import { store, setTransactions } from '../../modules';

export async function getTransactions(payload) {
  try {
    store.dispatch(setTransactions({ loading: true }));
    const response = await API.transactions(payload);
    if(!response || !response.data) {
      throw response;
    }

    store.dispatch(setTransactions({ loading: false, error: false, data: response.data  }));
    return response.data;
  } catch (e) {
    store.dispatch(setTransactions({ loading: false, error: true }));
    console.log(e)
    throw e
  }
} 


export async function getTransaction(id) {
  try {
    const request = {
      path: id
    }
    const response = await API.transactions(request);

    if(!response || !response.data) {
      throw response;
    }
    return response.data;
  } catch (e) {
    console.log(e)
    throw e
  }
} 

export async function createTransaction(form) {
  try {
    const request = {
      body: form
    }
    const response = await API.createTransaction(request);
    if(!response || !response.data) {
      throw response;
    }
    
    return response.data;
  } catch (e) {
    console.log(e)
    throw e
  }
}


export async function updateTransaction(id, form = {}) {
  try {

    const formData = new FormData();
    
    Object.keys(form).forEach(key => {
      formData.append(key, form[key]);
    })

    const request = {
      path: id,
      type: 'form-data',
      body: formData
    }
    const response = await API.updateTransaction(request);
    if(!response) {
      throw response;
    }
    return response;
  } catch (e) {
    console.log(e)
    throw e
  }
}