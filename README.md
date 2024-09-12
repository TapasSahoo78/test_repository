('#usersTable').DataTable({
    dom: 'Bfrtip',
    buttons: [
        {
            extend: 'csv',
            title: 'Users Data',
            exportOptions: {
                columns: [0, 1, 2] // Exclude the 'Created At' column (index 3)
            }
        },
        {
            extend: 'excel',
            title: 'Users Data'
        },
        {
            extend: 'pdf',
            title: 'Users Data',
            exportOptions: {
                columns: [0, 1, 2] // Exclude the 'Created At' column (index 3)
            }
        },
        {
            extend: 'print',
            title: 'Users Data'
        }
    ]
});