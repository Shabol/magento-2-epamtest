var config = {
    "map": {
        "*": {
            'Magento_Checkout/js/model/shipping-save-processor/default': 'EpamTst_ModuleCustomize/js/model/shipping-save-processor/default'
        }
    },
    config: {
        mixins: {
            'Magento_Checkout/js/action/set-shipping-information': {
                'EpamTst_ModuleCustomize/js/action/set-shipping-information-mixin': true
            }
        }
    }
};