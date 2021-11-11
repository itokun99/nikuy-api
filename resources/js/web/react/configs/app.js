import { getBaseUrl } from '../utils';

const appInfo = {
  name: 'Elites',
  versionName: '1.0.0',
  development: true,
};


const appEnvironment = {
  api: {
    baseUrl: getBaseUrl(),
  }
};

const appActiveConfig = appEnvironment;

export { appInfo, appEnvironment, appActiveConfig };