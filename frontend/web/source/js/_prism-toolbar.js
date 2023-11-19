(function () {
	if (!self.Prism) {
		return;
	}

	// Attach our hook, only for those parts that we highlighted
	Prism.hooks.add('after-highlight', function (env) {

		// Check if inline or actual code block (credit to line-numbers plugin)
		var pre = env.element.parentNode;

		/* if (!pre || !/pre/i.test(pre.nodeName) || pre.className.indexOf('code-toolbar') === -1) {
				return;
		} */

		// Setup the toolbar
		var toolbar = document.createElement('div');
		toolbar.setAttribute('class', 'toolbar');

		var linkCopy = document.createElement('a');
		linkCopy.innerHTML = 'Copy to clipboard';

		toolbar.appendChild(linkCopy);

		linkCopy.addEventListener('click', function (e) {
			e.preventDefault();
			var copyText = pre.getElementsByTagName('code')[0];
			console.log(copyText);
			CopyToClipboard(copyText);
		});



		// Add our toolbar to the <pre> tag
		pre.appendChild(toolbar);
	});

	function CopyToClipboard(el) {
		console.log(el);
		if (window.getSelection) {  // all browsers, except IE before version 9
			var selection = window.getSelection();
			var rangeToSelect = document.createRange();
			rangeToSelect.selectNodeContents(el);

			selection.removeAllRanges();   // clears the current selection
			selection.addRange(rangeToSelect);
		} else {  // Internet Explorer before version 9
			if (document.selection) {
				var rangeToSelect = document.body.createTextRange();
				rangeToSelect.moveToElementText(el);
				rangeToSelect.select();
			}
		}

		document.execCommand("copy");
	}
})();