let path = 'http://ems.erpsirius.net/';

jQuery ( function () {
    jQuery ( ".datepicker" ).datepicker ();
} );

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

function if_late_arrival ( id ) {
    if ( jQuery ( '#late-arrival-' + id ).is ( ':checked' ) ) {
        jQuery ( '.late-hours-' + id ).css ( 'display', 'flex' );
        jQuery ( '.late-hours-' + id + ' input' ).prop ( 'required', true );
    } else {
        jQuery ( '.late-hours-' + id ).css ( 'display', 'none' );
        jQuery ( '.late-hours-' + id + ' input' ).prop ( 'required', false );
    }
}

function getEmployeesByShiftAndCompany ( shift_id ) {
    let csrf_token = jQuery ( '#csrf_field' ).val ();
    let company = jQuery ( '#company' ).val ();

    if ( shift_id > 0 && company > 0 ) {
        jQuery.ajax ( {
            url: path + 'employees/getEmployeesByShiftAndCompany',
            type: 'get',
            data: {
                csrf_ems_token: csrf_token,
                company_id: company,
                shift_id: shift_id,
            },
            contentType: 'application/json',
            beforeSend: function () {
                jQuery ( '#assignLeaves' ).html ( 'Searching employees...' );
            },
            success: function ( response ) {
                jQuery ( '#assignLeaves' ).html ( 'Submit' );
                jQuery ( '#employees' ).html ( response );
            }
        } );
    }
}