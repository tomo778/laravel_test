try {
    window.$ = window.jQuery = require('jquery');
} catch (e) {}

window.axios = require('axios')

// Ajaxリクエストであることを示すヘッダーを付与する
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

window.axios.interceptors.response.use(
  response => response,
  error => error.response || error
)