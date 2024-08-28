@if (session()->has('flash_message'))
    <script>
        Swal.fire({
            title: "{{ session('flash_message.title') }}",
            text: "{{ session('flash_message.message') }}",
            icon: "{{ session('flash_message.level') }}",
            timer: 2500,
            showConfirmButton: true
        });
    </script>
@endif

@if (session('import_debug'))
    <script>
        alert('Import Debug:\n' + JSON.stringify(@json(session('import_debug'))));
    </script>
@endif


@if (session()->has('flash_message_overlay'))
    <script>
        Swal.fire({
            title: "{{ session('flash_message_overlay.title') }}",
            text: "{{ session('flash_message_overlay.message') }}",
            icon: "{{ session('flash_message_overlay.level') }}",
            showCancelButton: true,
            confirmButtonText: "{{ session('flash_message_overlay.confirmButtonText') }}",
            cancelButtonText: "{{ session('flash_message_overlay.cancelButtonText') }}"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ session('flash_message_overlay.urlToProceed') }}";
            }
        });
    </script>
@endif

