import { API } from '../../configs';
import { store, setIncommingEvents } from '../../modules';


export async function getIncommingEvents(){
  try {
    const request = {
      params: {
        category: 'incomming-event'
      }
    }

    store.dispatch(setIncommingEvents({ loading: true, error: false }));
    const response = await API.events(request);

    if(!response && !response.data) {
      store.dispatch(setIncommingEvents({ loading: false, error: true }));
      throw response;
    }

    const { data } = response;

    store.dispatch(setIncommingEvents({ data, loading: false, error: false }));
    return data;
    
  } catch (err) {
    store.dispatch(setIncommingEvents({ loading: false, error: true }));
    throw err;
  }
}