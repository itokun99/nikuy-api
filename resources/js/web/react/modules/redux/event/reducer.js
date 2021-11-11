import actionTypes from '../actionTypes';

const initialState = {
  incommingEvent: { 
    loading: false,
    error: false,
    data: [],
  }
}

const event = (state = initialState, action) => {
  switch (action.type) {
    case actionTypes.event.SET_INCOMMING_EVENTS:
      return {
        ...state,
        incommingEvent: {
          ...state.incommingEvent,
          ...action.value,
        }
      }
    default:
      return state;
  }
}

export default event;