import actionTypes from '../actionTypes';

const initialState = {
  province: {
    loading: false,
    error: false,
    data: []
  }
}

function province(state = initialState, action) {
  switch (action.type){
    case actionTypes.province.SET_PROVINCES:
      return {
        ...state,
        province: {
          ...state.province,
          ...action.value
        } 
      }
    default:
      return state;
  }
}

export default province;