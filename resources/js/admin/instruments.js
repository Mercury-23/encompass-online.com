/*
* instruments.index.js
* - This file is the entry point for the admin dashboard
* */

import Swal from 'sweetalert2';
import moment from 'moment';
import axios from 'axios';
import $ from 'jquery';
import DataTable from 'datatables.net-dt';

// Constants
const URL_GET_DATA = '/instruments';
const URL_DELETE_DATA = '/instruments/';
const $table = $('#instruments-table');
const deleteButton = `
            <button class="btn btn-danger btn-sm py-1 px-4 bg-red-500 hover:bg-red-700 text-white delete">
                <i class="fa-solid fa-trash-can"></i>
            </button>`;

// Wait for the document to load
console.log('Instruments page loaded');
// Initialize DataTables
initDataTable();
// Initialize event handlers
initHandlers();


function initDataTable() {
    // get all data
    axios.get(URL_GET_DATA).then(res => {
        let {data} = res.data;
        // Format the data
        const tableData = data.map(n => {
            return {
                id: n.id,
                name: n.name,
                created: moment(n.created_at).format('MMMM Do YYYY, h:mm:ss a'),
                updated: moment(n.updated_at).format('MMMM Do YYYY, h:mm:ss a'),
            }
        });
        const columns = [
            {data: 'id'},
            {data: 'name'},
            {data: 'created'},
            {data: 'updated'},
            {
                data: null, // This column does not correspond to any data field
                defaultContent: deleteButton, // Delete button
                orderable: false // Disable sorting for this column
            }
        ];
        // Initialize DataTables
        $table.DataTable({
            data: tableData,
            columns
        });
    }).catch((e) => {
        console.log(e);
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
        });
    });
}

function initHandlers() {
    // Catch delete button click
    $table.on('click', '.delete', function (e) {
        let $row = $(this).closest('tr');
        let id = $row.find('td:first-child').text();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true, // Show cancel button
            confirmButtonColor: '#3085d6', // Blue button
            cancelButtonColor: '#d33', // Red button
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Delete the instrument
                axios.delete(URL_DELETE_DATA + id).then(res => {
                    console.log(res);
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Data has been deleted.',
                        icon: 'success',
                    });
                    // Remove the row from the table
                    $table.DataTable().row($row).remove().draw();
                }).catch((e) => {
                    console.log(e);
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    });
                });
            }
        });
    });
}
