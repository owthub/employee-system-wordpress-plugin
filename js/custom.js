jQuery(function() {
    // List employee data table
    new DataTable('#tbl-employee');

    // Employee form validation
    jQuery("#ems-frm-add-employee").validate();
});