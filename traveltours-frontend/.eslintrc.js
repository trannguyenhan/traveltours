module.exports = {
  root: true,

  env: {
    node: true,
    es6: true,
    es2017: true,
    es2020: true,
    browser: true,
    mongo: true,
  },

  plugins: ['prettier', 'vue', 'security'], //eslint-plugin-STRING

  extends: [
    'airbnb-base', // eslint-config
    'eslint:recommended',
    'plugin:security/recommended',
    // 'prettier', // eslint-config - no need
    'plugin:vue/recommended',
    'plugin:prettier/recommended', // enable plugin prettier - set rule: 'prettier/prettier': 'error' - extends eslint-config-prettier
    'prettier/vue', //eslint-config | extra exclusions for the another plugins, eg vue in this line
  ],

  rules: {
    // 'prettier/prettier': 'error', // - no need
    'vue/html-self-closing': [
      'error',
      {
        html: {
          void: 'any',
        },
      },
    ],
    'no-shadow': ['error', { allow: ['state'] }],
    'no-param-reassign': [
      'error',
      { props: false },
      // { props: true, ignorePropertyModificationsFor: ['state'] },
    ],
    'prefer-destructuring': ['error', { object: true, array: false }],
    'no-console': process.env.NODE_ENV === 'production' ? 'warn' : 'off',
    'no-debugger': process.env.NODE_ENV === 'production' ? 'warn' : 'off',
    'import/no-unresolved': 0,
    'import/extensions': 0,

    // [
    //   'error',
    //   'ignorePackages',
    //   {
    //     js: 'never',
    //     mjs: 'never',
    //     jsx: 'never',
    //     ts: 'never',
    //     tsx: 'never',
    //     vue: 'never',
    //   },
    // ],
  },

  // settings: {
  //   'import/resolver': "webpack"
  //   //  {
  //   //   node: {
  //   //     extensions: ['.js', '.jsx', '.ts', '.tsx', '.json', '.vue'],
  //   //   },
  //   //   webpack: webpack,
  //   //   // {
  //     //   config: 'webpack.dev.config.js', // path.resolve('./webpack.config.eslint.js'),
  //     // },
  //   },
  // },

  globals: {
    $nuxt: true,
  },

  parserOptions: {
    ecmaVersion: 2019,
    sourceType: 'module',
    parser: 'babel-eslint',
  },
};
