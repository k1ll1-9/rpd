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
  publicPath: process.env.NODE_ENV === 'production' ? '/local/components/syllabuses/RPD.single/templates/.default/' : '/',
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
          target: 'https://lk.vavt.ru/local/components/syllabuses-test/RPD.single/templates/.default/api/index.php'
        }
    }
  }
}
