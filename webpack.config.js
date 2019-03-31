var webpack = require('webpack');
var path = require('path');
var glob = require('glob');
var UglifyJsPlugin = require("uglifyjs-webpack-plugin");
var MiniCssExtractPlugin = require("mini-css-extract-plugin");
var OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin");
var PurgecssPlugin = require('purgecss-webpack-plugin');
var CleanWebpackPlugin = require('clean-webpack-plugin')

//console.log(glob.sync('./src/js/*.js'));

//get all javascript files and concatenate with scss file
var custom_entry = glob.sync('./src/js/*.js').concat(['./src/scss/main_styles.scss']);

/*
	convert array in the form of:
	{ 
		main_scripts: './src/js/main_scripts.js',
		Notification: './src/js/Notification.js',
		main_styles: './src/scss/main_styles.scss' 
	}
*/
var res={}
custom_entry.forEach(function(a){
  res[path.basename(a).replace(/\.[^/.]+$/, "")]=a
  //res[path.basename(a)]=a
})

//console.log(res);

//return webpack configuration
module.exports = {
	//entry: './src/js/app.js',
	entry:res,
	output: {
		//path to output folder - resolve path to absolute path
		path: path.resolve(__dirname, './public/dist/js'),
		filename: '[name].[chunkhash].js'
		// filename: (chunkData) => {
		// 	return chunkData.chunk.name === 'main_scripts' ? '[name].[chunkhash].js': '[name].js';
		// },
	},
	module:{
		rules:[
			{
				test: /\.css$/,
				use: ['style-loader', 'css-loader']
			},{ 
				test: /\.js$/, 
				exclude: /node_modules/, 
				loader: "babel-loader" 
			},{
				test: /\.s[ac]ss$/,
				use: [{
					loader: MiniCssExtractPlugin.loader,
					options: {
										// you can specify a publicPath here
										// by default it use publicPath in webpackOptions.output
										//publicPath: "../css",
								}
				},{
					loader: 'css-loader',
					options: {
						url: true
					}
				},{
					loader: 'postcss-loader', // Run post css actions
							options: {
								plugins: function () { // post css plugins, can be exported to postcss.config.js
										return [
											//require('precss'),
											require('autoprefixer')({
												'browsers': ['> 1%', 'last 2 versions']
											})
										];
								}
							}
					}, 'sass-loader']
			},{
				test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/,
				use: [{
					loader: 'file-loader',
						options: {
							name: '[name].[ext]',
							outputPath: '../fonts'
						}
				}]
			},{
				test: /\.(png|jpg|jpeg|gif|svg)$/,
				use: [{
						loader: 'file-loader', 
						options: {
							name: '[name].[ext]',
							outputPath: '../images'
						}
					},{
						loader: 'img-loader',
						options: {
							plugins: [
								require('imagemin-gifsicle')({
									interlaced: false
								}),
								require('imagemin-mozjpeg')({
									progressive: true,
									arithmetic: false
								}),
								require('imagemin-pngquant')({
									floyd: 0.5,
									speed: 2
								}),
								require('imagemin-svgo')({
									plugins: [
										{ removeTitle: true },
										{ convertPathData: false }
									]
								})
							]
						}
					}
				]
			}
			// ,{
			// 		test: require.resolve('jquery'),
			// 		use: [{
			// 				loader: 'expose-loader',
			// 				options: 'jQuery'
			// 		},{
			// 				loader: 'expose-loader',
			// 				options: '$'
			// 		}]
			// }
		]
	},
	plugins: [
		new CleanWebpackPlugin("public/dist", {
			root: __dirname, 
			verbose: true,
			dry: false
		})
		,new MiniCssExtractPlugin({
			// Options similar to the same options in webpackOptions.output
			// both options are optional
			filename: "../css/[name].[chunkhash].css",      		
			//chunkFilename: "[id].css"
		})
		,function(){
			this.plugin('done', stats => {
				require('fs').writeFileSync(
					path.join(__dirname, 'public/dist/manifest.json'),
					JSON.stringify(stats.toJson().assetsByChunkName)
				);
			})
		}
		// ,new PurgecssPlugin({
		//   //paths: glob.sync(`${PATHS.src}/**/*`,  { nodir: true }),
		//   paths: glob.sync(path.join(__dirname, 'templates/index.phtml'))
		// })
	],
	optimization: {
		////////////////////////////////////////////////////////////////////////////////////////////////
		// DEFAULT FOR ENABLED FOR PRODUCTION / DISABLED FOR DEVELOPMENT
		////////////////////////////////////////////////////////////////////////////////////////////////
		minimizer: [
			new UglifyJsPlugin({
				cache: true,
				parallel: true,
				sourceMap: true // set to true if you want JS source maps
			}),
			new OptimizeCSSAssetsPlugin({})
		]
	}
}