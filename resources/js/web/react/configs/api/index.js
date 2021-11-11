import apiRequest from './config';
import { apiEndpoint } from './url';

const API = {};

// Authentication
API.login = apiRequest.post(apiEndpoint.login);
API.register = apiRequest.post(apiEndpoint.register);
API.logout = apiRequest.get(apiEndpoint.logout);

// Banners
API.banners = apiRequest.get(apiEndpoint.banners);
API.classBanners = apiRequest.get(apiEndpoint.classBanners);

// Event
API.events = apiRequest.get(apiEndpoint.events);

// Profile
API.profile = apiRequest.get(apiEndpoint.profile);
API.updateProfile = apiRequest.post(apiEndpoint.profile);
API.uploadPhoto = apiRequest.post(apiEndpoint.profilePhoto);
API.deletePhoto = apiRequest.delete(apiEndpoint.profilePhoto);
API.updatePassword = apiRequest.post(apiEndpoint.profilePassword);

// Profile Business
API.profileBusiness = apiRequest.get(apiEndpoint.profileBusiness);
API.addBusiness = apiRequest.post(apiEndpoint.addBusiness);
API.editBusiness = apiRequest.post(apiEndpoint.editBusiness);
API.deleteBusiness = apiRequest.delete(apiEndpoint.deleteBusiness);

// Provinces
API.provinces = apiRequest.get(apiEndpoint.provinces);

// Membership
API.membership = apiRequest.get(apiEndpoint.membership);

// Bank
API.banks = apiRequest.get(apiEndpoint.banks);

// Payment
API.payments = apiRequest.get(apiEndpoint.payments);

// Transaction
API.transactions = apiRequest.get(apiEndpoint.transactions);
API.createTransaction = apiRequest.post(apiEndpoint.createTransaction);
API.updateTransaction = apiRequest.post(apiEndpoint.updateTransaction);

// Classes
API.classes = apiRequest.get(apiEndpoint.classes);

// Courses
API.courses = apiRequest.get(apiEndpoint.courses);

// Pillars
API.pillars = apiRequest.get(apiEndpoint.pillars);

export default API;