"use strict";


window.dceAmountField = {
	refresherGenerators: {}
};

dceAmountField.registerRefresherGenerator = function(field_id, refresherGenerator) {
	this.refresherGenerators[field_id] = refresherGenerator;
}

dceAmountField.getFieldValue = (form, id) => {
	let data = new FormData(form);
	let key = `form_fields[${id}]`;
	if (data.has(key)) {
		return data.get(key);
	}
	key = `form_fields[${id}][]`
	if (data.has(key))  {
		return data.getAll(key);
	}
	return "";
}

dceAmountField.makeGetFieldFunction = (form) => {
	return (id) => {
		let val = dceAmountField.getFieldValue(form, id);
		// fields with multiple selections get summed up.
		if (Array.isArray(val)) {
			if (! val.length) {
				return 0;
			}
			val = val.map((v) => {
				let r = parseFloat(v);
				return isNaN(r) ? 0 : r;
			});
			return val.reduce((a,b) => a + b);
		}
		let r = parseFloat(val);
		return isNaN(r) ? 0 : r;
	}
}

function initializeAmountField(wrapper, widget) {
	let hiddenInput = wrapper.getElementsByClassName('dce-amount-hidden')[0];
	let visibleInput = wrapper.getElementsByClassName('dce-amount-visible')[0];
	let form = widget.getElementsByTagName('form')[0];
	let fieldId = hiddenInput.dataset.fieldId;
	let textBefore = hiddenInput.dataset.textBefore;
	let textAfter = hiddenInput.dataset.textAfter;
	let shouldRound = hiddenInput.dataset.shouldRound;
	let roundPrecision = hiddenInput.dataset.roundPrecision;
	let realTime = hiddenInput.dataset.realTime === 'yes';
	if (hiddenInput.dataset.hide == 'yes') {
		wrapper.style.display = "none";
	}
	let refresherGenerator = dceAmountField.refresherGenerators[fieldId];
	// if the user code has a syntax error the registration will have failed and
	// we won't find the field:
	if (! refresherGenerator) {
		visibleInput.value = amountFieldLocale.syntaxError;
		return;
	}
	let refresher = refresherGenerator(dceAmountField.makeGetFieldFunction(form));
	let onChange = () => {
		let result = refresher();
		if ( shouldRound === 'yes' ) {
			result = Number(result).toFixed(roundPrecision);
		}
		hiddenInput.value = result;
		visibleInput.value = textBefore + result + textAfter;
		if ("createEvent" in document) {
			var evt = document.createEvent("HTMLEvents");
			evt.initEvent("change", false, true);
			hiddenInput.dispatchEvent(evt);
		}
		else {
			hiddenInput.fireEvent("onchange");
		};
	}
	onChange();
	form.addEventListener('input', onChange);
}

function initializeAllAmountFields($scope) {
	$scope.find('.elementor-field-type-amount').each((_, w) => initializeAmountField(w, $scope[0]));
}

jQuery(window).on('elementor/frontend/init', function() {
	if(elementorFrontend.isEditMode()) {
		return;
	}
	elementorFrontend.hooks.addAction('frontend/element_ready/form.default', initializeAllAmountFields);
});
