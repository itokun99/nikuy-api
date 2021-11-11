import { API } from '../../configs';
import { store, setHomeBanner, setClassBanner } from '../../modules';


export async function getHomeBanners() {
   try {
    store.dispatch(setHomeBanner({ loading: true, error: false}));
    const response = await API.banners();

    if(!response.data) {
      store.dispatch(setHomeBanner({ loading: false, error: true}));
      throw response;
    }

    const { data } = response;
    
    store.dispatch(setHomeBanner({
      loading: false,
      error: false,
      data
    }));

    return data;
    
   } catch (err) {
      store.dispatch(setHomeBanner({ loading: false, error: true}));
      throw err;
   }
}

export async function getClassBanners() {
  try {
    store.dispatch(setClassBanner({ loading: true, error: false }));
    const response = await API.classBanners();


    if(!response.data) {
      store.dispatch(setClassBanner({ loading: false, error: true}));
      throw response;
    }

    const { data } = response;

    store.dispatch(setClassBanner({ loading: false, error: false, data}));

    return data;

  } catch (err) {
    store.dispatch(setClassBanner({ loading: false, error: true}));
    throw err;
  }
}