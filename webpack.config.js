var Encore = require('@symfony/webpack-encore');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Add 1 entry for each "page" of your app
     * (including one that's included on every page - e.g. "app")
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
     */
    .addEntry('app-style', './assets/scss/app.scss')
    .addEntry('app', './assets/js/app.js')
    .addEntry('analytics-form', './assets/js/analytics-form.js')
    .addEntry('analytics-results', './assets/js/analytics-results.js')
    .addEntry('register-form', './assets/js/register-form.js')

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    // enables @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })

    .addLoader({
        enforce: 'pre',
        test: /\.(js|vue)$/,
        loader: 'eslint-loader',
        exclude: /node_modules/,
        options: {
            fix: true,
            emitError: true,
            emitWarning: true,
        },
    })

    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // enables VueJs support
    //.enableVueLoader()

    // uncomment if you use Sass/SCSS files
    .enableSassLoader(
        () => {},
        { resolveUrlLoaderOptions: { removeCR: true } }
    )

    // uncomment if you're having problems with a jQuery plugin
    //.autoProvidejQuery()

    .copyFiles({
        from: './assets/images',

        to: 'images/[path][name].[ext]',

        // if versioning is enabled, add the file hash too
        //to: 'images/[path][name].[hash:8].[ext]',

        // only copy files matching this pattern
        //pattern: /\.(png|jpg|jpeg)$/
    })
    ;

const webpackConfig = Encore.getWebpackConfig();


module.exports = webpackConfig;