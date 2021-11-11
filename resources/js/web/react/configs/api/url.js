import { appActiveConfig } from '../app';

const apiEndpoint = {
  // authentication
  login: `${appActiveConfig.api.baseUrl}/v1/login`,
  register: `${appActiveConfig.api.baseUrl}/v1/register`,
  logout: `${appActiveConfig.api.baseUrl}/v1/logout`,

  // banners
  banners: `${appActiveConfig.api.baseUrl}/v1/banners`,
  classBanners: `${appActiveConfig.api.baseUrl}/v1/class-banners`,

  // event
  events: `${appActiveConfig.api.baseUrl}/v1/events`,

  // profile
  profile: `${appActiveConfig.api.baseUrl}/v1/profile`,
  profilePhoto: `${appActiveConfig.api.baseUrl}/v1/profile/photo`,
  profilePassword: `${appActiveConfig.api.baseUrl}/v1/profile/password`,
  profileBusiness: `${appActiveConfig.api.baseUrl}/v1/profile/business`,
  addBusiness: `${appActiveConfig.api.baseUrl}/v1/profile/business/add`,
  editBusiness: `${appActiveConfig.api.baseUrl}/v1/profile/business/edit`,
  deleteBusiness: `${appActiveConfig.api.baseUrl}/v1/profile/business/delete`,

  // province
  provinces: `${appActiveConfig.api.baseUrl}/v1/provinces`,

  //membership
  membership: `${appActiveConfig.api.baseUrl}/v1/membership`,

  // bank
  banks: `${appActiveConfig.api.baseUrl}/v1/banks`,

  // payment
  payments: `${appActiveConfig.api.baseUrl}/v1/payments`,

  // transaction
  transactions: `${appActiveConfig.api.baseUrl}/v1/transactions`,
  createTransaction: `${appActiveConfig.api.baseUrl}/v1/transactions/create`,
  updateTransaction: `${appActiveConfig.api.baseUrl}/v1/transactions/update`,

  // classes
  classes: `${appActiveConfig.api.baseUrl}/v1/classes`,

  // courses
  courses: `${appActiveConfig.api.baseUrl}/v1/courses`,

  // pillars
  pillars: `${appActiveConfig.api.baseUrl}/v1/pillars`
};

export { apiEndpoint };