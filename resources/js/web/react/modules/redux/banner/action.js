import actionTypes from '../actionTypes';

export const setHomeBanner = value => ({
  type: actionTypes.banner.SET_HOME_BANNER,
  value
});

export const setClassBanner = value => ({
  type: actionTypes.banner.SET_CLASS_BANNER,
  value
})