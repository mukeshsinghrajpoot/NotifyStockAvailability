var config = {
    map: {
        '*': {
            stockenquiry: 'Bluethinkinc_NotifyStockAvailability/js/stockenquiry',
            stocklistenquiry: 'Bluethinkinc_NotifyStockAvailability/js/stocklistenquiry',
            stockgroupenquiry: 'Bluethinkinc_NotifyStockAvailability/js/stockgroupenquiry',
            'Magento_Swatches/js/swatch-renderer':'Bluethinkinc_NotifyStockAvailability/js/swatch-renderer'
        }
    },
    shim: {
        'stockenquiry': {
            deps: ['jquery']
        },
        'stocklistenquiry': {
            deps: ['jquery']
        },
        'stockgroupenquiry':
        {
            deps: ['jquery']
        }
    }
};
