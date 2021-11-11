import { API } from '../../configs';
import { store, setProvinces } from '../../modules';

export async function getProvinces() {
  try {
    store.dispatch(setProvinces({ error: false, loading: true }));
    const response = await API.provinces();
    if(!response || !response.data) {
      store.dispatch(setProvinces({ error: true, loading: false }));
      throw response;
    }

    const { data } = response;
    store.dispatch(setProvinces({ error: false, loading: false, data }));
    return data;

  } catch (err) {
    throw err;
  }
}