/**
 * Webpack configuration.
 */
const path                    = require('path')
const MiniCssExtractPlugin    = require('mini-css-extract-plugin')
const OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin')
const cssnano                 = require('cssnano')
const { CleanWebpackPlugin }  = require('clean-webpack-plugin')
const UglifyJsPlugin          = require('uglifyjs-webpack-plugin')

// JS Directory path.
const JS_DIR    = path.resolve(__dirname, 'resources/js')
const IMG_DIR   = path.resolve(__dirname, 'resources/images')
const BUILD_DIR = path.resolve(__dirname, 'assets')

const entry = {
  editor: JS_DIR + '/app.js'
}

const output = {
  path: BUILD_DIR,
  filename: 'js/app.js'
}

const plugins = (argv) => [
  new CleanWebpackPlugin({
    cleanStaleWebpackAssets: ('production' === argv.mode)
  }),

  new MiniCssExtractPlugin({
    filename: 'css/app.css'
  }),
]

const rules = [
  {
    test: /\.js$/,
    include: [JS_DIR],
    exclude: /node_modules/,
    use: 'babel-loader'
  },
  {
    test: /\.scss$/,
    exclude: /node_modules/,
    use: [
      MiniCssExtractPlugin.loader,
      'css-loader',
      'postcss-loader',
      'sass-loader',
    ]
  },
  {
    test: /\.(png|jpg|svg|jpeg|gif|ico)$/,
    use: {
      loader: 'file-loader',
      options: {
        name: '[name].[ext]',
        publicPath: 'production' === process.env.NODE_ENV ? '../' : '../../',
        outputPath: 'images'
      }
    }
  },
  {
    test: /\.(ttf|otf|eot|svg|woff(2)?)(\?[a-z0-9]+)?$/,
    exclude: [IMG_DIR, /node_modules/],
    use: {
      loader: 'file-loader',
      options: {
        name: '[path][name].[ext]',
        publicPath: 'production' === process.env.NODE_ENV ? '../' : '../../'
      }
    }
  }
]

/**
 * Since you may have to disambiguate in your webpack.config.js between development and production builds,
 * you can export a function from your webpack configuration instead of exporting an object
 *
 * @param {string} env environment ( See the environment options CLI documentation for syntax examples. https://webpack.js.org/api/cli/#environment-options )
 * @param argv options map ( This describes the options passed to webpack, with keys such as output-filename and optimize-minimize )
 * @return {{output: *, devtool: string, entry: *, optimization: {minimizer: [*, *]}, plugins: *, module: {rules: *}, externals: {jquery: string}}}
 *
 * @see https://webpack.js.org/configuration/configuration-types/#exporting-a-function
 */
module.exports = (env, argv) => ({

  entry: entry,

  output: output,

  /**
   * A full SourceMap is emitted as a separate file ( e.g.  main.js.map )
   * It adds a reference comment to the bundle so development tools know where to find it.
   * set this to false if you don't need it
   */
  devtool: 'source-map',

  module: {
    rules: rules
  },

  optimization: {
    minimizer: [
      new OptimizeCssAssetsPlugin({
        cssProcessor: cssnano
      }),

      new UglifyJsPlugin({
        cache: false,
        parallel: true,
        sourceMap: false
      })
    ]
  },

  plugins: plugins(argv),

  externals: {
    jquery: 'jQuery'
  }
})