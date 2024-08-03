const path = require('path');

module.exports = {
	entry: {
		site: './src/site/index.ts',
		admin: './src/admin/index.ts',
	},
	module: {
		rules: [
			{
				test: /\.tsx?$/,
				use: 'ts-loader',
				exclude: /node_modules/,
			},
			{
				test: /\.css$/,
				use: ['style-loader', 'css-loader'],
			},
		],
	},
	resolve: {
		extensions: ['.tsx', '.ts', '.js'],
	},
	output: {
		filename: '[name]/index.js',
		path: path.resolve(__dirname, 'public/assets/js'),
	},
};
