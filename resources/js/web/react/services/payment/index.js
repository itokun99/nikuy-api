import { API } from '../../configs';
import { store, setPayments } from '../../modules';

export async function getPayments() {
  try {
    store.dispatch(setPayments({ loading: true }));
    const response = await API.payments();
    if(!response || !response.data) {
      throw response;
    }

    store.dispatch(setPayments({ loading: false, error: false, data: response.data }));
    return response.data;
  } catch (err) {
    store.dispatch(setPayments({ loading: false, error: true }));
    throw err;
  }
}