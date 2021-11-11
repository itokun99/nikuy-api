import actionTypes from '../actionTypes';

const initialState = {
  list : {
    error: false,
    loading: false,
    meta: null,
    data: []
  }
}

function classes (state = initialState, action) {
  switch (action.type) {
    case actionTypes.classes.SET_CLASSES:
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
      return state
  }
}

export default classes;