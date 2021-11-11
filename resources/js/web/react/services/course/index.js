import { API } from '../../configs';

export async function getCourse(id) {
  try {
    const payload = {
      path: id,
    }

    const response = await API.courses(payload);

    if(!response || !response.data) {
      throw response;
    }

    return response.data;
  } catch (err) {
    console.log('err', err);
    throw err;    
  }
}

export async function submitProgress(id) {
  try {
    const payload = {
      path: `${id}/submit-progress`,
    }

    const response = await API.courses(payload);

    if(!response) {
      throw response;
    }

    return response;
  } catch (err) {
    console.log('err', err);
    throw err;    
  }
}