import { store, setLoading } from '../../modules';

export function showLoading(show = true) {
  store.dispatch(setLoading(show));
}