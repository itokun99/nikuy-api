import axios from 'axios';
import { getTokenFromStorage } from '../../utils';

const apiInstance = axios.create({
  baseURL: '',
  timeout: 60000,
  validateStatus: status => status >= 200 && status < 300
});

class ApiRequest {
  static get(route, token = false) {
    return payload => this.request('GET', route, payload, token);
  }

  static put(route, token = false) {
    return payload => this.request('PUT', route, payload, token);
  }

  static post(route, token = false) {
    return payload => this.request('POST', route, payload, token);
  }

  static delete(route, token = false) {
    return payload => this.request('DELETE', route, payload, token);
  }

  static patch(route, token = false) {
    return payload => this.request('PATCH', route, payload, token);
  }

  static resolveParams(params) {
    const paramsResult = [];
    Object.keys(params).map(e => paramsResult.push(`${e}=${params[e]}`));
    return paramsResult.join('&');
  }

  static async request(method, route, payload = {}) {
    const path = payload.path ? `/${payload.path}` : '';
    const params = payload.params
      ? `?${this.resolveParams(payload.params)}`
      : '';
    const customUrl = payload.url ? payload.url : '';
    const baseHeaders = {
      'Content-Type':
        payload.type === 'form-data'
          ? 'multipart/form-data'
          : 'application/json'
    };

    const token = getTokenFromStorage()

    if (token) {
      baseHeaders['Authorization'] = `Bearer ${token}`;
    }

    const requestPayload = {
      url: customUrl.length > 0 ? customUrl : route + path + params,
      method,
      headers: payload.headers
        ? { ...baseHeaders, ...payload.headers }
        : baseHeaders,
      data: payload.body ? payload.body : {}
    };

    try {
      const response = await apiInstance.request(requestPayload);

      // karena pakai axios response asli ada di data
      if (response.data) {
        return response.data;
      }
      return response;
    } catch (err) {
      if (err && err.response && err.response.data) {
        throw err.response.data;
      } else if (err && err.response) {
        throw err.response;
      } else {
        throw err;
      }
    }
  }
}

export default ApiRequest;