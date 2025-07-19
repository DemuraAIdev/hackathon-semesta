import axios from "axios";

const api = axios.create({
  baseURL: import.meta.env.VITE_BACKEND_URL,
  headers: { Accept: "application/json" },
  validateStatus: () => true,
});

api.interceptors.request.use(function (c) {
  const token = localStorage.getItem("auth_token");
  if (token) {
    c.headers["Authorization"] = `Bearer ${token}`;
    c.headers["Content-Type"] = "multipart/form-data";
  }
  return c;
});

export default api;
