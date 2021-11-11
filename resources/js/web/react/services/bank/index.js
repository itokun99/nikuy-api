import { API } from '../../configs';
import { store, setBanks } from '../../modules';

export async function getBanks() {
  try {

    store.dispatch(setBanks({ loading: true }));
    const response = await API.banks();

    if(!response || !response.data) {
      throw response;
    }
    store.dispatch(setBanks({ loading: false, error: false, data: response.data }));
    return response.data;
  } catch (err) {
    store.dispatch(setBanks({ loading: false, error: true }));
    throw err;
  }
}