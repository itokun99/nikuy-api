import { store, setModalAuth, setModalUpgrade } from '../../modules';


export const modalAuth = (show = true, state = 'login') => {
  store.dispatch(setModalAuth({ show, state }));
}

export const modalUpgrade = (show = true) => {
  store.dispatch(setModalUpgrade({ show }));
}