import TerserPlugin from "terser-webpack-plugin";

import * as path from 'path';

const srcFolder = "src";
const builFolder = "assets";
const rootFolder = path.basename(path.resolve());

const paths = {
	src: path.resolve(srcFolder),
	build: path.resolve(builFolder)
}
const config = {
	mode: "production",
	optimization: {
		minimizer: [new TerserPlugin({
			extractComments: true,
		})],
	},
	output: {
		path: `${paths.build}`,
		filename: 'app.min.js',
		publicPath: '/',
	},

}
export default config;