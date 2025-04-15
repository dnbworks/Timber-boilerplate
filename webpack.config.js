const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CleanWebpackPlugin = require("clean-webpack-plugin");
const ManifestPlugin = require('webpack-manifest-plugin');

 module.exports = {
   mode: "development",
   entry: {
				main: "./src/index.js"
		},
   output: {
		 filename: 'js/[name].[contenthash].js',
     path: path.resolve(__dirname, "dist")
   },
   plugins: [
    new MiniCssExtractPlugin({ filename: "css/[name].[contenthash].css" }),
    new CleanWebpackPlugin(),
		new ManifestPlugin(),

  ],
  module: {
    rules: [
      {
        test: /\.(woff2?|eot|ttf|otf|woff|svg)?$/,
        use: [{
          loader: 'file-loader',
          options: {
            name: '[name].[ext]',
            outputPath: 'fonts/',
            publicPath: '../fonts/',
          },
  
        }]
      },
      {
        test: /\.scss$/,
        use: [
          MiniCssExtractPlugin.loader, //3. Extract css into files
          "css-loader", //2. Turns css into commonjs
          "sass-loader" //1. Turns sass into css
        ]
      },
    ]
  }
 };