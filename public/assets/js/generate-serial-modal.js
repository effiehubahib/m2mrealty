document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.deleteBtn').forEach(function (btn) {
            
            btn.addEventListener('click', function (e) {
                e.preventDefault(); // prevent default anchor behavior
                // Access data attributes
                const form = this.closest('form');
                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Generate serial numbers',
                    text: "Are you sure?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, generate it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form if confirmed
                        form.submit();
                    }
                });
            });
        });
    });