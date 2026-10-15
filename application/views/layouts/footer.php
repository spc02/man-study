    </div> <!-- Close content-area -->

    <!-- Footer -->
    <footer class="mt-auto py-4 px-4 bg-transparent d-flex justify-content-between align-items-center text-muted" style="font-size: 0.85rem; border-top: 1px solid #f1f5f9;">
        <div>&copy; <?= date('Y') ?> MAN 1 Magelang. Semua hak cipta dilindungi.</div>
        <div>Versi 1.0.0</div>
    </footer>
</main>
</div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
<script>
    $('.datatable').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/2.0.8/i18n/id.json'
        }
    });

    // SweetAlert for data-confirm buttons
    $(document).on('click', 'button[data-confirm]', function(e) {
        e.preventDefault();
        var form = $(this).closest('form');
        var msg = $(this).attr('data-confirm');
        Swal.fire({
            title: 'Konfirmasi',
            text: msg,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Lanjutkan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                var btn = $(this);
                btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ...').prop('disabled', true);
                form.submit();
            }
        });
    });

    // Global loading state on standard forms
    $('form').on('submit', function(e) {
        if (!e.isDefaultPrevented()) {
            var btn = $(this).find('button[type="submit"]:not([data-confirm])');
            if (btn.length > 0) {
                btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
            }
        }
    });
    // Responsive table labels
    function setTableLabels() {
        $('table.table').each(function() {
            var headers = [];
            $(this).find('thead th').each(function() {
                headers.push($(this).text().trim());
            });
            $(this).find('tbody tr').each(function() {
                $(this).find('td').each(function(index) {
                    if (headers[index]) {
                        $(this).attr('data-label', headers[index]);
                    }
                });
            });
        });
    }
    
    setTableLabels();
    
    $('.datatable').on('draw.dt', function() {
        setTableLabels();
    });
</script>
</body>
</html>
