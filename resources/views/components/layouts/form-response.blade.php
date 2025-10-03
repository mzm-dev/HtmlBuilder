<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Builder MZM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    @livewireStyles
</head>
<div class="relative flex w-full flex-col md:flex-row">

    <!-- main content  -->
    <div id="main-content" class="h-svh w-full overflow-y-auto bg-white dark:bg-neutral-950">
        <!-- Add main content here  -->
        {{ $slot }}
    </div>

</div>

@livewireScripts
{{-- <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v1.x.x/dist/livewire-sortable.js"></script> --}}
</body>

</html>
