import { regex } from './regex';

const validator = {}

validator.isEmpty = function (value) {

  // check zero value
  if(!value) return true;

  // check object
  if(value && typeof value.length === 'undefined') {
    if(Object.keys(value).length === 0) {
      return true
    }
  }

  // check arrays
  if(value && typeof value !== 'string' && typeof value.length === 'number') {
    if(value.length === 0) {
      return true;
    }
  }

  return false
}

validator.isEmail = function (str) {
  if(typeof str !== 'string') return false;
  return regex.email.test(String(str).toLowerCase());
}

validator.isPhone = function (str) {
  // if(typeof str !== 'string') return false;
  // return regex.phoneNumber.test(String(str));
  return true;
}

validator.isTypingPhoneNumberOnly = function (str) {
  if(typeof str !== 'string') return false;

  return regex.typingPhoneNumber.test(String(str));
}


validator.min = function (value, min = 0) {

  if(typeof value === 'string') {
    if(String(value).length < min) {
      return false;
    }
  }

  if(typeof value === 'number') {
    if (value < min) {
      return false;
    }
  }

  if(typeof value === 'object' && typeof value.length !== 'undefined') {
    if(Array(value).length < min) {
      return false;
    }
  }

  return true
}

validator.max = function (value, max = 0) {

  if(typeof value === 'string') {
    if(String(value).length > max) {
      return false;
    }
  }

  if(typeof value === 'number') {
    if (value  > max) {
      return false;
    }
  }

  if(typeof value === 'object' && typeof value.length !== 'undefined') {
    if(Array(value).length > max) {
      return false;
    }
  }

  return true
}


export {
  validator
}