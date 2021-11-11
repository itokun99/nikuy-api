import { API } from '../../configs';
import { store, setClasses } from '../../modules';

export async function getClasses(payload = {}) {
  try {

    store.dispatch(setClasses({ loading: true }));
    const response = await API.classes(payload);

    if(!response || !response.data) {
      throw response;
    }

    const { data, meta } = response;


    store.dispatch(setClasses({ 
      loading: false, 
      error: true,
      data,
      meta
    }));

    return data;
  } catch (err) {
    store.dispatch(setClasses({ loading: false, error: true }));
    throw err;
  }
}

export async function getClass(id) {
  try {
    const payload = {
      path: id,
    }

    const response = await API.classes(payload);

    if(!response || !response.data) {
      throw response;
    }

    return response.data;
  } catch (err) {
    console.log('err', err);
    throw err;    
  }
}