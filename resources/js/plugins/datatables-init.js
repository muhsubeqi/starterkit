import DataTables from "datatables.net"
import 'datatables.net-bs5'
import 'datatables.net-buttons'
import 'datatables.net-buttons/js/dataTables.buttons'
import 'datatables.net-buttons/js/buttons.html5'
import 'datatables.net-buttons/js/buttons.print';
import 'datatables.net-buttons-bs5'
import 'datatables.net-buttons/js/buttons.colVis.js'
import 'datatables.net-responsive'
import 'datatables.net-responsive-bs5'
import JSZip from "jszip"
window.JSZip = JSZip

// DataTables, for more examples you can check out https://www.datatables.net/
class pageTablesDatatables {
	/*
	 * Init DataTables functionality
	 *
	 */
	static initDataTables() {
		// Override a few default classes
    jQuery.extend(true, DataTables.ext.classes, {
      search: {
        input: "form-control form-control-sm",
      },
      length: {
        select: "form-select form-select-sm",
      },
    });

    // Override a few defaults
    jQuery.extend(true, DataTables.defaults, {
      responsive: true,
      language: {
        emptyTable: 'No matching records found',
        lengthMenu: "_MENU_",
        search: "_INPUT_",
        searchPlaceholder: "Search..",
        info: "Page <strong>_PAGE_</strong> of <strong>_PAGES_</strong>",
        paginate: {
          first: '<i class="fa fa-angle-double-left"></i>',
          previous: '<i class="fa fa-angle-left"></i>',
          next: '<i class="fa fa-angle-right"></i>',
          last: '<i class="fa fa-angle-double-right"></i>'
        },
      },
      dom: "<'row'<'col-sm-12'P>>" +
        "<'.row flex-column flex-md-row align-items-center justify-content-between mb-3'" +
        "<'.col-auto d-flex justify-content-center justify-content-md-start mb-md-0'lB>" +
        "<'.col-auto d-flex justify-content-center justify-content-md-end'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7 d-flex justify-content-center justify-content-md-end'p>>",
      buttons: [
            {
              extend: 'colvis',
              text: '<i class="fa fa-eye"></i>',
              titleAttr: 'Column Visibility',
              className: 'btn btn-sm',
            },
            // {
            //     extend: 'copyHtml5',
            //     text: '<i class="fa fa-copy"></i>',
            //     titleAttr: 'Copy',
            //     className: 'btn btn-sm',
            //     exportOptions: {
            //       columns: ':visible'
            //     },
            // },
            {
                extend: 'excelHtml5',
                text: '<i class="fa fa-file-excel"></i>',
                titleAttr: 'Export to Excel',
                className: 'btn btn-sm',
                exportOptions: {
                  columns: ':visible'
                },
            },
            // {
            //     extend: 'pdfHtml5',
            //     text: '<i class="fa fa-file-pdf"></i>',
            //     titleAttr: 'Export to PDF',
            //     className: 'btn btn-sm',
            //     exportOptions: {
            //       columns: ':visible'
            //     },
            // },
            {
                extend: 'print',
                text: '<i class="fa fa-print"></i>',
                titleAttr: 'Print',
                title:'',
                className: 'btn btn-sm',
                exportOptions: {
                  columns: ':visible'
                },
            },
        ]
      });

      // Override buttons default classes
      jQuery.extend(true, DataTables.Buttons.defaults, {
        dom: {
          button: {
            className: 'btn btn-sm btn-light',
          },
        }
      });

      // Init full DataTable
      jQuery('.js-dataTable-full').DataTable({
        pagingType: "simple_numbers",
        layout: {
          topStart: {
            pageLength: {
              menu: [5, 10, 15, 20]
            },
          },
        },
        pageLength: 5,
        autoWidth: false,
      });

      // Init DataTable with Buttons
      jQuery('.js-dataTable-buttons').DataTable({
        pagingType: "simple_numbers",
        layout: {
          topStart: {
            buttons: ['copy', 'excel', 'csv', 'pdf', 'print']
          },
        },
        pageLength: 5,
        autoWidth: false,
      });
    }

	/*
	 * Init functionality
	 *
	 */
	static init() {
		this.initDataTables();
	}
}

// Initialize when page loads
One.onLoad(() => pageTablesDatatables.init());
