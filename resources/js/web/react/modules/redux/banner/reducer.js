import actionTypes from '../actionTypes';

const initialState = {
  homeBanner: {
    data: [],
    loading: false,
    error: false,
  },
  classBanner: {
    data: [],
    loading: false,
    error: false
  }
};

const banner = (state = initialState, action) => {
  switch (action.type) {
    case actionTypes.banner.SET_HOME_BANNER:
      return {
        ...state,
        homeBanner: {
          ...state.homeBanner,
          ...action.value
        }
      };
    case actionTypes.banner.SET_CLASS_BANNER:
      return {
        ...state,
        classBanner: {
          ...state.classBanner,
          ...action.value
        }
      }
    default:
      return state;
  }
};

export default banner;