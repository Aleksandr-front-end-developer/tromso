import webpack from "webpack-stream";
import webPackConfigDev from '../webpack.dev.js';

export const jsDev = () => {
	return app.gulp.src(app.path.src.js)
		.pipe(app.plugins.plumber(
			app.plugins.notify.onError({
				title: "JS Dev",
				message: "Error: <%= error.message %>"
			}))
		)
		.pipe(webpack({
			config: webPackConfigDev
		}))
		.pipe(app.gulp.dest(app.path.build.js))
		.pipe(app.plugins.browsersync.stream());
}
