module.exports = {
  'extends': 'stylelint-config-standard-scss',
  'rules': {
		'declaration-block-trailing-semicolon': 'always',
    'selector-pseudo-class-no-unknown': null,
    "no-descending-specificity": null,
    'no-empty-source': null,
    'string-quotes': 'double',
    'at-rule-no-unknown': [
      true,
      {
        'ignoreAtRules': [
          'extend',
          'at-root',
          'debug',
          'warn',
          'error',
          'if',
          'else',
          'for',
          'each',
          'while',
          'mixin',
          'include',
          'content',
          'return',
          'function',
          'tailwind',
          'apply',
          'responsive',
          'variants',
          'screen',
          'use',
		  'forward'
        ],
      },
    ],
	'selector-type-no-unknown': [true, {
      ignore: ["custom-elements", "default-namespace"],
    }]
  },
};
