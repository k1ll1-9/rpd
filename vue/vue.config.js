module.exports = {
  css: {
    extract: false,
  },
  configureWebpack: {
    optimization: {
      splitChunks: false
    }
  },
  filenameHashing: false,
  outputDir: '../dist',
  chainWebpack: config => {
    config.plugin('copy').tap(([options]) => {
      options[0].ignore.push('RPD Form - dev_files/**')
      return [options]
    })
  }
}