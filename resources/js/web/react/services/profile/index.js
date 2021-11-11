import { API } from '../../configs';
import { store, setProfileAccount, setProfileBusiness } from '../../modules';

export async function getProfile() {
  try {
    const response = await API.profile();

    if(!response || !response.data) {
      throw response;
    }

    const { data } = response;
    store.dispatch(setProfileAccount(data));
    return data;
  } catch (err) {
    throw err;
  }
}

export async function uploadPhoto(file) {
  try {
    const formData = new FormData();
    formData.append('file', file);

    const request = {
      type: 'form-data',
      body: formData
    }

    const response = await API.uploadPhoto(request);
    if(!response) {
      throw response;
    }
    return response;
  } catch (err) {
    throw err;
  }
}

export async function deletePhoto() {
  try {
    const response = await API.deletePhoto();
    if(!response) {
      throw response;
    }
    return response;
  } catch (err) {
    throw err;
  }
}

export async function updateProfile(form) {
  try {
    const request = {
      body: form
    }

    const response = await API.updateProfile(request);

    if(!response) {
      throw response;
    }
    return response;
  } catch (err) {
    throw err;
  }
}

export async function updatePassword(form) {
  try {
    const request = {
      body: form
    }

    const response = await API.updatePassword(request);

    if(!response) {
      throw response;
    }
    return response;
  } catch (err) {
    throw err;
  }
}


export async function getUserBusiness() {
  try {

    store.dispatch(setProfileBusiness({
      error: false,
      loading: true, 
    }));

    const response = await API.profileBusiness();

    if(!response || !response.data)  {
      store.dispatch(setProfileBusiness({
        error: true,
        loading: false, 
      }));
      throw response;
    }

    const { data } = response;

    store.dispatch(setProfileBusiness({
      error: false,
      loading: false, 
      data
    }));

    return data;

  } catch (err) {
    store.dispatch(setProfileBusiness({
      error: true,
      loading: false, 
    }));
    throw err;
  }
}


export async function getDetailUserBussiness(id) {
  try {
    const request = {
      path: id
    }

    const response = await API.profileBusiness(request);

    if(!response || !response.data) {
      throw err;
    }

    const { data } = response;

    return data;
  } catch (err) {
    throw err;
  }
}


export async function addBusiness(form = {}) {
  try {
    const formData = new FormData;
    Object.keys(form).forEach((key) => {
      formData.append(key, form[key]);
    });

    const request = {
      type: 'form-data',
      body: formData
    };

    const response = await API.addBusiness(request);

    if(!response) {
      throw response;
    }
    return response;
  } catch (err) {
    throw err;
  }
}

export async function editBusiness(id, form = {}) {
  try {
    const formData = new FormData;
    Object.keys(form).forEach((key) => {
      formData.append(key, form[key]);
    });

    const request = {
      path: id,
      type: 'form-data',
      body: formData
    };

    const response = await API.editBusiness(request);

    if(!response) {
      throw response;
    }
    return response;
  } catch (err) {
    throw err;
  }
}

export async function deleteBusiness(id) {
  try {
    const request = {
      path: id
    }

    const response = await API.deleteBusiness(request);

    if(!response) {
      throw response;
    }

    return response;
  } catch (err) {
    throw err;
  }
}