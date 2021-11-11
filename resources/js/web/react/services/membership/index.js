import { API } from '../../configs';
import { store, setMembershipList  } from '../../modules';

export async function getMembershipList() {
  try {
    store.dispatch(setMembershipList({ loading: true }));
    const response = await API.membership();

    if(!response || !response.data) {
      throw response;
    }
    store.dispatch(setMembershipList({ loading: false, error: true, data: response.data }));
    return response.data;
  } catch (e) {
    store.dispatch(setMembershipList({ loading: false, error: true }));
    throw e;
  }
}

export async function getMembership(id) {
  try {
    const request = {
      path: id
    }
    const response = await API.membership(request);

    if(!response || !response.data) {
      throw response;
    }
    return response.data;
  } catch (err) {
    throw err
  }
}