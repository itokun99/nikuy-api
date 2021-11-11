import { API } from '../../configs';
import { store, setProfileAccess, setProfileAccount, setLogout } from '../../modules';
import { saveTokenToStorage, deleteTokenFromStorage } from '../../utils';
import { toast } from 'react-toastify';


export async function login (email, password) {
  const request = {
    body: { email, password }
  };

  try {
    const response = await API.login(request);
    
    if(!response || !response.data) {
      throw response;
    }

    const  { data } = response;
    store.dispatch(setProfileAccess(data));
    saveTokenToStorage(data?.token);
    return data;
  } catch (err) {
    throw err;
  }
}

export async function register(form = {}) {
  try {
    const request = {
      body: {
        ...form
      }
    };
  
    const response = await API.register(request);
  
    if(!response) {
      throw response;
    }

    return response;
  } catch(err) {
    throw err
  }
}

export function logout() {
    store.dispatch(setLogout())
    API.logout();
    deleteTokenFromStorage();
}