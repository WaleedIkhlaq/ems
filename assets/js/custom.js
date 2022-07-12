let path = 'http://ems.erpsirius.net/';

function getCompanyShifts ( company_id, row ) {
    let csrf_token = jQuery ( '#csrf_field' ).val ();

    if ( company_id > 0 ) {
        jQuery.ajax ( {
            url: path + 'companies/getCompanyShifts',
            type: 'get',
            data: {
                csrf_ems_token: csrf_token,
                company_id: company_id,
            },
            contentType: 'application/json',
            beforeSend: function () {
                jQuery ( '#addMoreCompanies' ).html ( 'Adding more...' );
            },
            success: function ( response ) {
                jQuery ( '#addMoreCompanies' ).html ( 'Add More' );
                jQuery ( '#shifts-' + row ).html ( response );
            }
        } );
    }
}

function addMoreCompanies () {
    let csrf_token = jQuery ( '#csrf_field' ).val ();
    let row = jQuery ( '#row' ).val ();
    let nextRow = parseInt ( row ) + 1;
    jQuery ( '#row' ).val ( nextRow );

    jQuery.ajax ( {
        url: path + 'companies/addMoreCompanies',
        type: 'get',
        data: {
            csrf_ems_token: csrf_token,
            row: row,
        },
        contentType: 'application/json',
        beforeSend: function () {
            jQuery ( '#addMoreCompanies' ).html ( 'Adding more...' );
        },
        success: function ( response ) {
            jQuery ( '#addMoreCompanies' ).html ( 'Add More' );
            jQuery ( '#addMoreCompaniesRow' ).append ( response );
            jQuery ( '.select2-' + row ).select2 ();
        }
    } );
}