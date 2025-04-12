const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

 module.exports = {
   mode: "development",
   entry: {
				main: "./src/index.js"
		},
   output: {
		 filename: '[name].[contenthash].js',
     path: path.resolve(__dirname, "dist")
   },
   plugins: [
    new MiniCssExtractPlugin({ filename: "[name].[contenthash].css" })
  ],
  module: {
    rules: [
      {
        test: /\.scss$/,
        use: [
          MiniCssExtractPlugin.loader, //3. Extract css into files
          "css-loader", //2. Turns css into commonjs
          "sass-loader" //1. Turns sass into css
        ]
      }
    ]
  }
 };