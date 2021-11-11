import actionTypes from '../actionTypes';

const initialState = {
  account: null,
  access: null,
  business: {
    error: false,
    loading: false,
    data: []
  }
};


const profile = (state = initialState, action) => {
  switch (action.type) {
    case actionTypes.profile.SET_PROFILE_ACCOUNT:
      return {
        ...state,
        account: action.value
      }
    case actionTypes.profile.SET_PROFILE_ACCESS:
      return {
        ...state,
        access: action.value
      }
    case actionTypes.profile.SET_PROFILE_BUSINESS:
      return {
        ...state,
        business: {
          ...state.business,
          ...action.value
        }
      }
    case actionTypes.global.LOGOUT:
      return initialState;
    default:
      return state;
  }
}

export default profile;