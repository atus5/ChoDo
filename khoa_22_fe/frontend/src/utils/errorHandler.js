/**
 * Global error handler utility
 * Ensures consistent error handling across the application
 */

import axios from 'axios';

/**
 * Setup global axios error interceptor
 * @param {Object} router - Vue Router instance
 * @param {Object} toaster - Vue Toaster instance
 */
export function setupErrorInterceptor(router, toaster) {
  axios.interceptors.response.use(
    (response) => response,
    (error) => {
      // Handle 401 Unauthorized
      if (error.response?.status === 401) {
        const keyAdmin = localStorage.getItem("key_admin");
        const keyClient = localStorage.getItem("key_client");
        
        if (keyAdmin) {
          localStorage.removeItem("key_admin");
          localStorage.removeItem("admin_name");
          localStorage.removeItem("admin_email");
          toaster.error("Phiên đăng nhập hết hạn");
          router.push("/admin/dang-nhap");
        } else if (keyClient) {
          localStorage.removeItem("key_client");
          localStorage.removeItem("ho_va_ten");
          localStorage.removeItem("email_kh");
          localStorage.removeItem("check_kh");
          toaster.error("Phiên đăng nhập hết hạn");
          router.push("/client/dang-nhap");
        }
      }
      
      // Handle 500 Server error
      if (error.response?.status === 500) {
        console.error('Server error:', error);
        toaster.error("Có lỗi xảy ra trên máy chủ");
      }
      
      // Handle network error
      if (!error.response) {
        console.error('Network error:', error);
        toaster.error("Lỗi kết nối mạng");
      }
      
      return Promise.reject(error);
    }
  );
}

/**
 * Handle API error response
 * @param {Object} error - Axios error object
 * @param {Object} toaster - Vue Toaster instance
 * @param {string} defaultMessage - Default error message
 */
export function handleApiError(error, toaster, defaultMessage = "Có lỗi xảy ra") {
  const message = error.response?.data?.message || defaultMessage;
  toaster.error(message);
  console.error('API Error:', error);
}
