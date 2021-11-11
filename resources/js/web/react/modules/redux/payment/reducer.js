import actionTypes from '../actionTypes';


const initialState = {
  list: {
    data: []
  }
}

function payment(state = initialState, action) {
  switch (action.type) {
    case actionTypes.payment.SET_PAYMENTS:
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

export default payment;