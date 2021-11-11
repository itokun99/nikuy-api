import { createStore, combineReducers } from 'redux';
import actionTypes from './actionTypes';
/**
 * ======================================
 * REDUCER
 * ======================================
 */
import bank from './bank/reducer';
import loading from './loading/reducer';
import banner from './banner/reducer';
import profile from './profile/reducer';
import modal from './modal/reducer';
import event from './event/reducer';
import province from './province/reducer';
import membership from './membership/reducer';
import payment from './payment/reducer';
import transaction from './transaction/reducer';
import classes from './classes/reducer';

const reducer = combineReducers({
  loading,
  banner,
  profile,
  modal,
  event,
  province,
  membership,
  bank,
  payment,
  transaction,
  classes
});

/**
 * ======================================
 * STORE
 * ======================================
 */
const store = createStore(reducer);

export { store, actionTypes };

/**
 * ======================================
 * ACTION / DISPATCHER
 * ======================================
 */
export * from './loading/action';
export * from './banner/action';
export * from './profile/action';
export * from './modal/action';
export * from './event/action';
export * from './province/action';
export * from './membership/action';
export * from './bank/action';
export * from './payment/action';
export * from './transaction/action';
export * from './classes/action';
export * from './global/action';

/**
 * ======================================
 * SELECTOR
 * ======================================
 */
 export * from './loading/selector';
 export * from './banner/selector';
 export * from './profile/selector';
 export * from './modal/selector';
 export * from './event/selector';
 export * from './province/selector';
 export * from './membership/selector';
 export * from './bank/selector';
 export * from './payment/selector';
 export * from './transaction/selector';
 export * from './classes/selector';
