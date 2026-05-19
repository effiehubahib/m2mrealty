document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.deleteBtn').forEach(function (btn) {
            
            btn.addEventListener('click', function (e) {
                e.preventDefault(); // prevent default anchor behavior
                // Access data attributes
                const form = this.closest('form');
                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form if confirmed
                        form.submit();
                    }
                });
            });
        });
    });