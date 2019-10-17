/**
 * Callback that fires when 'value' property is updated.
 */
 define([], function () {
    'use strict';

    return function (Form) {
        return Form.extend({
			onUpdate: function () {
			  	this.bubble('update', this.hasChanged());

			  	if (this.namespace === 'product_form' && ((this.index === 'profit_percentage') || (this.index === 'cost') || (this.index === 'overhead'))) 
                {
                    // The most hacky solution I've ever seen ...
				  	var costField 	  	    = document.getElementsByName("product[cost]")[0].value; //document.querySelector('[name="product\\[cost\\]"]').value();
				  	var overheadField 	    = document.getElementsByName("product[overhead]")[0].value; //document.querySelector('[name="product\\[overhead\\]"]').value();
				  	var profitpercentField  = document.getElementsByName("product[profit_percentage]")[0].value; //document.querySelector('[name="product\\[profit_percentage\\]"]').value();
				  	var recommendpriceValue = document.getElementsByName("product[recommended_price]")[0].value; 
				  	console.log(costField + '--' + overheadField + '--' + profitpercentField + '--' + recommendpriceValue);
				    
				    var priceField = document.querySelector('[name="product\\[price\\]"]');
				    //priceField.value = this.value() * 1.5;
				    var recommendpriceField = document.querySelector('[name="product\\[recommended_price\\]"]');

				    if (costField !== '' && overheadField !== '' && profitpercentField !== '') {
				    	var totalcost 	= parseFloat(costField) + parseFloat(overheadField);

				    	console.log('-totalcost-' + totalcost);
				    	var retailPrice = ((totalcost/(100-profitpercentField))*100); //keystone method which is taken from weebly
				    	console.log('-retailPrice-' + retailPrice);
				    	priceField.value = retailPrice.toFixed(2);
				    	recommendpriceField.value = retailPrice.toFixed(2);
				    	recommendpriceField.disabled = true;
				    	recommendpriceField.style.backgroundColor = "yellow";

					    // Force trigger the 'change'-event on this field:
					    var event = new Event('change');
					    priceField.dispatchEvent(event);
					    recommendpriceField.dispatchEvent(event);
					}

			  	}
			  this.validate();
			}
		});
    }
});