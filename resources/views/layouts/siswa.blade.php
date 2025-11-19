<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Siswa App</title>
</head>
<body class="bg-gray-100">

<div class="flex h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg p-5 flex flex-col">
        <h2 class="text-2xl font-bold mb-8 text-blue-600">Siswa App</h2>

        <nav class="flex-1">
            <ul class="space-y-4">

                <li>
                    <a href="/siswa"
                       class="block p-3 rounded hover:bg-blue-50 hover:text-blue-700">
                        📚 Data Siswa
                    </a>
                </li>

                <li>
                    <a href="{{ route('profile.kandidat') }}"
                    class="block p-3 rounded hover:bg-blue-50 hover:text-blue-700">
                        👤 Profile
                    </a>
                </li>


                <li>
                    <form action="/logout" method="POST">
                        @csrf
                        <button class="w-full text-left p-3 rounded
                                hover:bg-red-50 hover:text-red-600">
                            🚪 Logout
                        </button>
                    </form>
                </li>

            </ul>
        </nav>

    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 overflow-y-auto">
        @yield('content')
    </main>

</div>

</body>
</html>
