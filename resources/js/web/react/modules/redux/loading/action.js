import actionTypes from '../actionTypes';

/**
 * @name setLoading
 * @description action reducer for set loading modal
 * @param {*} value
 */
export const setLoading = value => ({
  type: actionTypes.loading.SET_LOADING,
  value
});