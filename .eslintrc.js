module.exports = {
    root: true,
    env: {
        node: true,
    },
    extends: [
        'plugin:vue/vue3-essential',
        'eslint:recommended',
    ],

    // applying stricter rules than the default configuration for better code quality
    rules: {
        'vue/html-indent': ['error', 4],
        'vue/html-closing-bracket-newline': ['error', { 'singleline': 'never', 'multiline': 'never' }],
        'vue/max-attributes-per-line': ['error', {'singleline': 10, 'multiline': 1}],
        'indent': ['error', 4],
        'linebreak-style': ['error', 'unix'],
        'quotes': ['error', 'single'],
        'semi': ['error', 'always'],
        'no-unused-vars': ['error', { 'argsIgnorePattern': '^_' }],
        'comma-dangle': ['error', 'always-multiline'],
        'space-before-function-paren': ['error', 'never'],
        'eqeqeq': ['error', 'always'], // This prevents numerous bugs
        'vue/eqeqeq': ['error', 'always'],
    },
};
