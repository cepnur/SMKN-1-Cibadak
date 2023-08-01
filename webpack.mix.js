const mix = require("laravel-mix");
require("laravel-mix-svg-vue");
require("laravel-mix-bundle-analyzer");
const path = require("path");

require("fast-glob");

const config = require("./webpack.config");
mix.setPublicPath("./");
mix.webpackConfig(config);

mix.browserSync("http://sitesmk.test");
mix.sass("resources/sass/app.scss", "dist/css").options({
  processCssUrls: false,
  postCss: [require("postcss-import"), require("tailwindcss/nesting"), require("tailwindcss"), require("autoprefixer")],
});

mix
  .js("resources/js/app.js", "dist/js")
  .vue({ version: 3 })
  .svgVue({
    svgPath: "resources/images/svg",
    extract: false,
    svgoSettings: [{ removeTitle: true }, { removeViewBox: false }, { removeDimensions: true }],
  })
  .extract()
  .version();

mix
  .js("resources/js/appEditor.js", "dist/js")
  .vue({ version: 3 })
  .extract()
  .svgVue({
    svgPath: "resources/images/svg",
    extract: false,
    svgoSettings: [{ removeTitle: false }, { removeViewBox: false }, { removeDimensions: true }],
  });

mix.sourceMaps().version();
mix.disableSuccessNotifications();

if (!mix.inProduction()) {
  mix.bundleAnalyzer();
}

mix.webpackConfig({
  stats: {
    children: true,
  },
});
