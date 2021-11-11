import actionTypes from '../actionTypes';


export const setProfileAccount = value => ({
  type: actionTypes.profile.SET_PROFILE_ACCOUNT,
  value
});

export const setProfileAccess = value => ({
  type: actionTypes.profile.SET_PROFILE_ACCESS,
  value
});

export const setProfileBusiness = value => ({
  type: actionTypes.profile.SET_PROFILE_BUSINESS,
  value
});