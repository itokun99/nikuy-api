import actionTypes from '../actionTypes';

const initialState = {
  list: {
    error: false,
    loading: false,
    data: []
  }
}

function transaction (state = initialState, action) {
  switch(action.type) {
    case actionTypes.transaction.SET_TRANSACTIONS:
      return {
        ...state,
        list: {
          ...state.list,
          ...action.value
        }
      }
    case actionTypes.global.LOGOUT:
      return initialState;
    default:
      return state;
  }
}

export default transaction;