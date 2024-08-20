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

@if (session()->has('flash_message_overlay'))
    <script>
        Swal.fire({
            title: "{{ session('flash_message_overlay.title') }}",
            text: "{{ session('flash_message_overlay.message') }}",
            icon: "{{ session('flash_message_overlay.level') }}",
            showConfirmButton: true
        });
    </script>
@endif
