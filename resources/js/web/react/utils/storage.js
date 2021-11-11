export function getTokenFromStorage() {
  const token = localStorage.getItem('auth:access');

  if(!token) {
    return null
  }
  return token;
}

export function saveTokenToStorage(token) {
  localStorage.setItem('auth:access', token);
}

export function deleteTokenFromStorage() {
  localStorage.removeItem('auth:access');
}