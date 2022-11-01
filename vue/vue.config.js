const Dotenv = require('dotenv-webpack');
const path = require('path');

function resolve(dir) {
  return path.resolve(__dirname, dir);
}

module.exports = {
  css: {
    extract: false,
  },
  configureWebpack: {
    resolve: {
      extensions: ['.js', '.vue', '.json', '.ts'],
      alias: {
        '@': resolve('src/'),
      },
    },
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
