import actionTypes from '../actionTypes';


export const setModalAuth = value => ({
  type: actionTypes.modal.SET_MODAL_AUTH,
  value
});

export const setModalUpgrade = value => ({
  type: actionTypes.modal.SET_MODAL_UPGRADE,
  value
});