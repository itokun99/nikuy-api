import  actionTypes from '../actionTypes';


const initialState = {
  list: {
    error: false,
    loading: false,
    data: []
  }
}

function bank(state = initialState, action) {
  switch (action.type) {
    case actionTypes.bank.SET_BANKS:
      return {
        ...state,
        list: {
          ...state.list,
          ...action.value
        }
      }
    default:
      return state;
  }
}

export default bank;