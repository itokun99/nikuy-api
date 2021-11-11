import actionTypes from '../actionTypes';

export const setTransactions = value => ({
  type: actionTypes.transaction.SET_TRANSACTIONS,
  value
});