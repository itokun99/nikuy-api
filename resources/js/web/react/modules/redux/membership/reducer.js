import actionTypes from '../actionTypes';

const initialState = {
  list: {
    error: false,
    loading: false,
    data: []
  }
}

const membership = (state = initialState, action) => {
  switch (action.type) {
    case actionTypes.membership.SET_MEMBERSHIP_LIST:
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

export default membership;