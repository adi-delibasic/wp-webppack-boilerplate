const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const ImageminPlugin = require("imagemin-webpack-plugin").default;
const glob = require("glob");
const BrowserSyncPlugin = require("browser-sync-webpack-plugin");

module.exports = {
  mode: "development",
  context: path.resolve(__dirname, "assets"),
  output: {
    filename: "main.bundle.js",
    path: path.resolve(__dirname, "assets/dist"),
  },
  plugins: [
    new BrowserSyncPlugin(
      {
        proxy: "theme.local",
        files: ["**/*.php", "**/*.css", "**/*.js"],
        port: 3000,
        notify: false,
      },
      {
        // prevent BrowserSync from reloading the page
        // and let Webpack Dev Server take care of this
        reload: false,
      }
    ),

    new ImageminPlugin({
      externalImages: {
        context: ".",
        sources: glob.sync("assets/src/images/**/*.{png,jpg,jpeg,gif,svg}"),
        destination: "assets/dist/images",
        fileName: "[name].[ext]",
      },
    }),
    new MiniCssExtractPlugin(),
  ],
  module: {
    rules: [
      {
        test: /\.css$/,
        use: [
          MiniCssExtractPlugin.loader,
          {
            loader: "css-loader",
            options: {
              importLoaders: 1,
            },
          },
          {
            loader: "postcss-loader",
            options: {

              postcssOptions: {
                ident: 'postcss',
                plugins: [require("tailwindcss"), require("autoprefixer")],

              },
            }
          },
        ],
      },
    ],
  },
};
