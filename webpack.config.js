var path = require('path');
module.exports = {
	entry: './resources/scripts/app.js',
	output: {
		path: path.resolve(__dirname, './public/assets/scripts'),
		filename: 'app.js',
	},
};