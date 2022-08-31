const Dotenv = require('dotenv-webpack');

module.exports = {
  css: {
    extract: false,
  },
  configureWebpack: {
    optimization: {
      splitChunks: false
    },
    plugins: [
      new Dotenv()
    ]
  },
  filenameHashing: false,
  outputDir: '../dist',
  publicPath: process.env.NODE_ENV === 'production' ? '/local/components/syllabuses/main/templates/.default/' : '/',
  chainWebpack: config => {
    config.plugin('copy').tap(([options]) => {
      options[0].ignore.push('RPD Form - dev_files/**')
      return [options]
    })
  }
}

if (process.env.NODE_ENV === 'development') {
  module.exports.devServer = {
    host: 'localhost',
    proxy: {
      '/api':
        {
          target: process.env.VUE_APP_API_TARGET,
          changeOrigin: true,
          pathRewrite: {
            '^/api/index.php' : '/index.php',
            '^/api/generatePDF.php' : '/generatePDF.php'
          }
        }
    }
  }
}
