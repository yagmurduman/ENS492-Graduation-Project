module.exports = {
  transpileDependencies: [
    'vuetify'
  ],

  outputDir: 'dist',
  assetsDir: 'static',
  // baseUrl: IS_PRODUCTION
  // ? 'http://cdn123.com'
  // : '/',
  // For Production, replace set baseUrl to CDN
  // And set the CDN origin to `yourdomain.com/static`
  // Whitenoise will serve once to CDN which will then cache
  // and distribute
  devServer: {
    proxy: {
      '/app*': {
        // Forward frontend dev server request for /api to flask dev server
        target: 'http://34.66.139.63:5000/'
      }
    }
  }
}