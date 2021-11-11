import actionTypes from '../actionTypes';

const initialState = {
  show: false
};

const loading = (state = initialState, action) => {
  switch (action.type) {
    case actionTypes.loading.SET_LOADING:
      return {
        ...state,
        show: action.value
      };
    default:
      return state;
  }
};

export default loading;