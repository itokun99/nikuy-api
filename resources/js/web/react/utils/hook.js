import { useState } from 'react';

export const useForm = initialState => {
  const [state, setState] = useState(initialState);

  const onChangeState = (value, field) => {
    if (field === 'reset') {
      return setState(initialState);
    }

    if (field === 'multiple') {
      return setState(prevState => ({
        ...prevState,
        ...value
      }));
    }

    return setState(prevState => ({
      ...prevState,
      [field]: value
    }));
  };

  return [state, onChangeState];
};