import { API } from '../../configs';

export async function getPillar(id) {
  try {
    const payload = {
      path: id,
    }

    const response = await API.pillars(payload);

    if(!response || !response.data) {
      throw response;
    }

    return response.data;
  } catch (err) {
    console.log('err', err);
    throw err;    
  }
}