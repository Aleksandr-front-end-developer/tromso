export const server = (done) => {
  app.plugins.browsersync.init({
    proxy: "http://tromso.loc",
    // baseDir: "./",
    notify: false,
    online: true,
    open: true,
  });
};
