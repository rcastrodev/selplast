let table = $('#page_table_slider').DataTable({
    serverSide: true,
    ajax: `${root}/get-list`,
    bSort: true,
    order: [],
    destroy: true,
    columns: [
        { data: "id" },
        { data: "order" },
        { data: "name" },
        { data: "image" },
        { data: "category" },
        { data: 'actions', name: 'actions', orderable: false, searchable: false }
    ],
    language: {
        url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json",
    }, 
});


