import { api } from '../lib/api';

export async function csrf() {
  await api.get('/sanctum/csrf-cookie');
}
export async function login(credentials) {
  await csrf();
  const { data } = await api.post('/login', credentials);
  return data.user;
}
export async function register(payload) {
  await csrf();
  const { data } = await api.post('/register', payload);
  return data.user;
}
export async function getUser() {
  const { data } = await api.get('/api/user');
  return data;
}
export async function logout() {
  await api.post('/logout');
}
