const mix = require('laravel-mix');
const config = require('./webpack.config');
require('laravel-mix-eslint');

function publicPath(dir) {
  return path.join(__dirname, '/public', dir);
}

function resolve(dir) {
  return path.join(__dirname, '/resources/js', dir);
}

Mix.listen('configReady', webpackConfig => {
  // Add "svg" to image loader test
  const imageLoaderConfig = webpackConfig.module.rules.find(
    rule =>
      String(rule.test) ===
      String(/(\.(png|jpe?g|gif|webp)$|^((?!font).)*\.svg$)/)
  );
  imageLoaderConfig.exclude = resolve('icons');
});
mix.copy('node_modules/element-ui/lib/theme-chalk/fonts/*', 'public/css/fonts/');
mix.js('resources/js/app.js', 'public/js')
  .extract([
    'vue',
    'axios',
    'vuex',
    'vue-router',
    'vue-tables-2',
    'vue-i18n',
    'element-ui',
    'dropzone',
    'tui-editor',
    'codemirror',
    'moment',
    'lodash',
    'vue2-dropzone',
    'vuedraggable',
    'echarts',
    'vue-count-to'
  ])
  .options({
    processCssUrls: false,
    postCss: [
      require('tailwindcss')('./public/js/tailwind.config.js'),
      require('autoprefixer'),
    ]
  })
  .sass('resources/js/styles/index.scss', 'public/css/app.css', {
    implementation: require('node-sass'),
  })
mix.webpackConfig(config);

if (mix.inProduction()) {
  mix.version();
} else {
  if (process.env.LARAJS_USE_ESLINT === 'true') {
    mix.eslint({
      fix: true,
      cache: false,
    });
  }
  // Development settings
  // mix.browserSync({
  //   proxy: process.env.APP_URL,
  //   files: ['resources/js/**/*']
  // });
  mix
    .sourceMaps()
    .webpackConfig({
      devtool: 'cheap-eval-source-map', // Fastest for development
    });
}


