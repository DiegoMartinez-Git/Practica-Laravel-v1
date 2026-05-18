@if (session('success'))
    <div id="alert-success" style="background: #d1e7dd; color: #0f5132; padding: 10px; margin-bottom: 15px; border: 1px solid #badbcc;">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div id="alert-error" style="background: #f8d7da; color: #842029; padding: 10px; margin-bottom: 15px; border: 1px solid #f5c2c7;">
        {{ session('error') }}
    </div>
@endif

<script>
    setTimeout(() => {
        const successAlert = document.getElementById('alert-success');
        const errorAlert = document.getElementById('alert-error');

        if (successAlert) {
            successAlert.style.display = 'none';
        }

        if (errorAlert) {
            errorAlert.style.display = 'none';
        }
    }, 2000);
</script>
