import actionTypes from '../actionTypes';

const initialState = {
  modalAuth: {
    show: false,
    state: 'login'
  },
  modalUpgrade: {
    show: false
  }
}

const modal = (state = initialState, action) => {
  switch (action.type) {
    case actionTypes.modal.SET_MODAL_AUTH:
      return {
        ...state,
        modalAuth: {
          ...state.modalAuth,
          ...action.value
        }
      }
    case actionTypes.modal.SET_MODAL_UPGRADE:
      return {
        ...state,
        modalUpgrade: {
          ...state.modalUpgrade,
          ...action.value
        }
      }
    default:
      return state;
  }
}

export default modal;