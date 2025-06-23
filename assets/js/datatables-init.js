/**
 * DataTables initialization script
 * This script initializes DataTables with export functionality for all tables with class 'table'
 */
document.addEventListener('DOMContentLoaded', function() {
  // Indonesian language for DataTables
  const indonesianLanguage = {
    "emptyTable": "Tidak ada data yang tersedia pada tabel ini",
    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
    "infoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
    "infoPostFix": "",
    "thousands": ".",
    "lengthMenu": "Tampilkan _MENU_ entri",
    "loadingRecords": "Memuat...",
    "processing": "Memproses...",
    "search": "Cari:",
    "zeroRecords": "Tidak ditemukan data yang sesuai",
    "paginate": {
      "first": "Pertama",
      "last": "Terakhir",
      "next": "Selanjutnya",
      "previous": "Sebelumnya"
    },
    "aria": {
      "sortAscending": ": aktifkan untuk mengurutkan kolom ke atas",
      "sortDescending": ": aktifkan untuk mengurutkan kolom ke bawah"
    },
    "buttons": {
      "copy": "Salin",
      "copyTitle": "Salin ke Clipboard",
      "copySuccess": {
        "_": "Menyalin %d baris ke clipboard",
        "1": "Menyalin 1 baris ke clipboard"
      },
      "print": "Cetak",
      "excel": "Excel",
      "pdf": "PDF",
      "csv": "CSV",
      "colvis": "Visibilitas Kolom"
    }
  };

  // Initialize all tables with class 'table' but exclude 'manual-init'
  const tables = document.querySelectorAll('table.table:not(.manual-init)');

  tables.forEach(function(table) {
    // Skip tables that don't have a thead element
    if (!table.querySelector('thead')) {
      return;
    }

    try {
      // Initialize DataTable with export buttons
      const dataTable = $(table).DataTable({
        language: indonesianLanguage,
        responsive: true,
        // Improved DOM layout with buttons in the same row as search
        dom: '<"card-header border-0 d-flex justify-content-between align-items-center"<"d-flex align-items-center"l><"d-flex align-items-center dt-buttons-inline"B><"d-flex align-items-center ms-auto"f>>' +
             '<"table-responsive px-0"t>' +
             '<"card-footer border-0 d-flex justify-content-between align-items-center py-3"<"text-muted"i><"pagination mb-0"p>>',
        lengthMenu: [
          [10, 25, 50, 100, -1],
          ['10 baris', '25 baris', '50 baris', '100 baris', 'Semua']
        ],
        pageLength: 10,
        // Improved button styling and organization
        buttons: [
          {
            extend: 'collection',
            text: '<i class="fas fa-download me-1"></i> Export',
            className: 'btn btn-sm btn-primary',
            autoClose: true,
            fade: 150,
            buttons: [
              {
                extend: 'copy',
                text: '<i class="fas fa-copy me-1"></i> Salin',
                className: 'btn btn-sm btn-outline-primary',
                exportOptions: {
                  columns: ':visible:not(:last-child)'
                }
              },
              {
                extend: 'csv',
                text: '<i class="fas fa-file-csv me-1"></i> CSV',
                className: 'btn btn-sm btn-outline-primary',
                exportOptions: {
                  columns: ':visible:not(:last-child)'
                }
              },
              {
                extend: 'excel',
                text: '<i class="fas fa-file-excel me-1"></i> Excel',
                className: 'btn btn-sm btn-outline-primary',
                exportOptions: {
                  columns: ':visible:not(:last-child)'
                }
              },
              {
                extend: 'pdf',
                text: '<i class="fas fa-file-pdf me-1"></i> PDF',
                className: 'btn btn-sm btn-outline-primary',
                exportOptions: {
                  columns: ':visible:not(:last-child)'
                },
                orientation: 'landscape',
                pageSize: 'A4',
                customize: function(doc) {
                  doc.defaultStyle.fontSize = 10;
                  doc.styles.tableHeader.fontSize = 11;
                  doc.styles.tableHeader.alignment = 'left';
                  doc.styles.tableBodyEven.alignment = 'left';
                  doc.styles.tableBodyOdd.alignment = 'left';
                }
              },
              {
                extend: 'print',
                text: '<i class="fas fa-print me-1"></i> Cetak',
                className: 'btn btn-sm btn-outline-primary',
                exportOptions: {
                  columns: ':visible:not(:last-child)'
                },
                customize: function(win) {
                  $(win.document.body).css('font-size', '10pt');
                  $(win.document.body).find('table')
                    .addClass('compact')
                    .css('font-size', 'inherit');
                }
              }
            ]
          },
          {
            extend: 'colvis',
            text: '<i class="fas fa-columns me-1"></i> Kolom',
            className: 'btn btn-sm btn-primary ms-2'
          }
        ],
        // Improved column definitions
        columnDefs: [
          {
            targets: -1,
            orderable: false,
            searchable: false,
            width: '80px',
            className: 'text-center'
          },
          {
            targets: '_all',
            className: 'align-middle'
          }
        ],
        // Improved styling and responsiveness
        initComplete: function() {
          // Style the search input
          $('.dataTables_filter input')
            .addClass('form-control form-control-sm')
            .attr('placeholder', 'Cari...')
            .css('width', '200px');

          $('.dataTables_filter label').contents().filter(function() {
            return this.nodeType === 3;
          }).remove();

          // Style the length menu
          $('.dataTables_length select').addClass('form-select form-select-sm');

          // Style the buttons container
          $('.dt-buttons-inline').addClass('mx-2');

          // Ensure buttons are properly styled
          $('.dt-button').addClass('btn-sm');
          $('.dt-button-collection').addClass('dropdown-menu-end');

          // Add zebra striping for better readability
          $(this).closest('.dataTables_wrapper').find('tbody tr:odd').addClass('bg-light');

          // Add hover effect
          $(this).closest('.dataTables_wrapper').find('tbody tr').hover(
            function() { $(this).addClass('bg-soft-primary'); },
            function() { $(this).removeClass('bg-soft-primary'); }
          );

          // Make the table header sticky
          $(this).closest('.dataTables_wrapper').find('thead').addClass('sticky-top bg-white');

          // Add shadow to the table
          $(this).closest('.table-responsive').addClass('shadow-sm');

          // Tambahkan kode untuk memastikan pagination selalu terlihat
          $(this).closest('.dataTables_wrapper').find('.card-footer').css({
            'position': 'sticky',
            'bottom': '0',
            'background-color': 'white',
            'z-index': '1'
          });

          // Hapus scroll pada container jika tidak diperlukan
          if ($(this).height() < 400) {
            $(this).closest('.table-responsive').css('overflow-y', 'visible');
          }
        }
      });

      // Add responsive behavior for window resize
      $(window).on('resize', function() {
        dataTable.columns.adjust().responsive.recalc();
      });

    } catch (error) {
      console.error('Error initializing DataTable:', error);
    }
  });
});

